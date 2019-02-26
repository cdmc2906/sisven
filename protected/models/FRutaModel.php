<?php

class FRutaModel extends DAOModel {

    public $campoFechaOrdenes = 'o_fch_creacion';

    public static function getFechaUltimaCarga() {
        $command1 = Yii::app()->db->createCommand("
           select MAX(r_fch_ingreso) as ultimacarga from tb_ruta_mb");

        $resultado1 = $command1->queryRow();
        $ultimacarga = $resultado1['ultimacarga'];

        return $ultimacarga;
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getCargaAnterior() {
        $sql = "select max(r_numero_carga_informacion) as ultimacarga FROM tb_ruta_mb;";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getRutaxCliente($codigo_cliente, $iniciales_ejecutivo) {
        $sql = "
           SELECT 
		R_DIA AS DIARUTA
		,R_RUTA AS RUTA
                ,R_SECUENCIA AS SECUENCIA
            FROM tb_ruta_mb
            WHERE 1=1
		AND R_COD_CLIENTE='" . $codigo_cliente . "'
		--  AND RIGHT(R_RUTA,3)='" . $iniciales_ejecutivo . "';
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getRutaxClientexSemana($codigo_cliente, $iniciales_ejecutivo, $semana, $periodo) {
        $sql = "
           SELECT 
		R_DIA AS DIARUTA
		,R_RUTA AS RUTA
                ,R_SECUENCIA AS SECUENCIA
            FROM tb_ruta_mb
            WHERE 1=1
		AND R_COD_CLIENTE='" . $codigo_cliente . "'
		AND R_SEMANA='" . $semana . "'
		AND pg_id='" . $periodo . "';
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getRutaxEjecutivoxDia($ejecutivo, $dia) {
        $sql = "
           SELECT 
		R_COD_CLIENTE AS CODIGOCLIENTE
		,R_RUTA AS RUTA
                ,R_SECUENCIA AS SECUENCIA
	FROM tb_ruta_mb
	WHERE 1=1
		AND R_DIA=" . $dia . "+1
		AND RIGHT(R_RUTA,3)='" . $ejecutivo . "'
        ORDER BY R_SECUENCIA;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getTotalClientesxRutaxEjecutivoxDia($ejecutivo, $dia) {
        $sql = "
           SELECT 
                    COUNT(*) AS TOTALCLIENTES
                FROM tb_ruta_mb 
                WHERE 1=1
                    AND RIGHT(r_ruta,3)='" . $ejecutivo . "' 
                    AND r_dia =" . $dia . ";";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getTotalClientesxRutaxEjecutivoxDiaxSemana($ejecutivo, $dia, $semana) {
        $sql = "
           SELECT 
                    COUNT(*) AS TOTALCLIENTES
                FROM tb_ruta_mb 
                WHERE 1=1
                    AND RIGHT(r_ruta,3)='" . $ejecutivo . "' 
                    AND r_semana='" . $semana . "' 
                    AND r_dia =" . $dia . "
                    AND pg_id is null
                    ;
                        ";
//        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getTotalClientesxRutaxEjecutivoxDiaxSemanaxPeriodo($ejecutivo, $dia, $semana, $periodo) {
        $sql = "
           SELECT 
                    COUNT(*) AS TOTALCLIENTES
                FROM tb_ruta_mb 
                WHERE 1=1
                    AND RIGHT(r_ruta,3)='" . $ejecutivo . "' 
                    AND r_semana='" . $semana . "' 
                    AND r_dia =" . $dia . "
                    AND pg_id=" . $periodo . ";";
//        var_dump($sql);        
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getTotalClientesNoVisitadosxRutaxEjecutivo(
    $inicialesEjecutivo
    , $dia
    , $fechaGestion
    , $codEjecutivo
    , $periodoAbierto
    , $semana) {
        $sql = "
             select 
	count(b.r_cod_cliente) as CLIENTESNOVISITADOS
	from 
		tb_ejecutivo_ruta as a
	inner join tb_ruta_mb as b
		on a.er_ruta=b.r_ruta
	where 1=1
		and a.er_usuario='" . $codEjecutivo . "' 
		and a.er_semana_visitar=" . $semana . " 
		and a.er_dia_visitar=" . $dia . "
                and b.r_semana=" . $semana . " 
		and b.r_estatus=1
		and b.pg_id=" . $periodoAbierto . "
		AND b.r_cod_cliente NOT IN 
            (SELECT h_cod_cliente
                FROM tb_historial_mb
                WHERE 1=1
                    AND convert(date,h_fecha)='" . $fechaGestion . "'
                    AND h_usuario='" . $codEjecutivo . "' 
                    AND h_semana=" . $semana . "
                        
            );

           ";
//        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getVisitasSupervisorRutaEjecutivoxFecha($rutaEjecutivo, $fechaGestion, $codSupervisor) {
        $sql = "
            SELECT count(*) as CLIENTESVISITADOS
                FROM tb_historial_mb
                where 1=1
                    and h_ruta ='" . $rutaEjecutivo . "'
                    and h_usuario='" . $codSupervisor . "'
                    and h_accion='Inicio visita'
                    and date(h_fecha)='" . $fechaGestion . "';
           ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getTotalChipsVentaFinSemana($fechaGestion, $codEjecutivo) {
        $fechaSabado = date('Y-m-d', strtotime($fechaGestion . ' + 1 days'));
        $fechaDomingo = date('Y-m-d', strtotime($fechaGestion . ' + 3 days'));

        $fechaHoraSabado = $fechaSabado . HORA_INICIO_DIA;
        $fechaHoraDomingo = $fechaSabado . HORA_FIN_DIA;
        $sql = "
            SELECT " . FuncionesBaseDatos::isnull('sqlsrv') . "(SUM(O_SUBTOTAL/" . PRECIO_UNITARIO_PRODUCTO_CHIP_MOVI . "),0) AS RESPUESTA
                FROM tb_ordenes_mb  
                WHERE 1=1 
                    -- AND DATE(O_FCH_CREACION) BETWEEN '" . $fechaSabado . "' AND '" . $fechaDomingo . "'
                    AND O_FCH_CREACION BETWEEN '" . $fechaHoraSabado . "' AND '" . $fechaHoraDomingo . "'
                    AND O_SUBTOTAL>0 
                    AND O_USUARIO='" . $codEjecutivo . "';
           ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getTotalChipsVentaDia_($fechaGestion, $codEjecutivo) {
        $sql = "
            -- VENTA DEL DIA
            SELECT " . FuncionesBaseDatos::isnull('sqlsrv') . "(SUM(O_SUBTOTAL/" . PRECIO_UNITARIO_PRODUCTO_CHIP_MOVI . ")),0) AS RESPUESTA
                FROM tb_ordenes_mb  
                WHERE 1=1 
                    AND DATE(O_FCH_CREACION)='" . $fechaGestion . "' 
                    AND O_SUBTOTAL>0 
                    AND O_USUARIO='" . $codEjecutivo . "';
           ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getTotalChipsVentaxDiaxHoraInicioxEjecutivo($fechaGestion, $horaInicio, $codEjecutivo) {
        $fechaHoraGestion = $fechaGestion . ' ' . $horaInicio;
//        $fechaHoraDiaDespues = date('Y-m-d', strtotime($fechaGestion . ' + 1 days')) . ' ' . $horaInicio;
        $fechaHoraDiaDespues = $fechaGestion . ' ' . HORA_FIN_DIA;

        $sql = "
            SELECT " . FuncionesBaseDatos::isnull('sqlsrv') . "(SUM(O_SUBTOTAL/" . PRECIO_UNITARIO_PRODUCTO_CHIP_MOVI . "),0) AS RESPUESTA
                FROM tb_ordenes_mb  
                WHERE 1=1 
                    AND O_FCH_CREACION BETWEEN '" . $fechaHoraGestion . "' AND '" . $fechaHoraDiaDespues . "'
                    AND O_SUBTOTAL>0 
                    AND O_USUARIO='" . $codEjecutivo . "';
           ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getTotalChipsVentaxDiaxHoraInicioxCliente($fechaGestion, $horaInicio, $codCliente) {
        $fechaHoraGestion = $fechaGestion . ' ' . $horaInicio;
        $fechaHoraDiaDespues = date('Y-m-d', strtotime($fechaGestion . ' + 1 days')) . ' ' . $horaInicio;
        $sql = "
            SELECT " . FuncionesBaseDatos::isnull('sqlsrv') . "(SUM(O_SUBTOTAL/" . PRECIO_UNITARIO_PRODUCTO_CHIP_MOVI . ")),0) AS RESPUESTA
                FROM tb_ordenes_mb  
                WHERE 1=1 
                    AND O_FCH_CREACION BETWEEN '" . $fechaHoraGestion . "' AND '" . $fechaHoraDiaDespues . "'
                    AND O_SUBTOTAL>0 
                    AND o_cod_cliente='" . $codCliente . "';
           ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getTotalChipsVentaRuta_($inicialesEjecutivo, $dia, $fechaGestion, $codEjecutivo) {
        $sql = "
            -- VENTA EN LA RUTA
            SELECT " . FuncionesBaseDatos::isnull('sqlsrv') . "(SUM(O_SUBTOTAL/" . PRECIO_UNITARIO_PRODUCTO_CHIP_MOVI . ")),0) AS RESPUESTA
                FROM tb_ordenes_mb  
                WHERE 1=1 
                    AND DATE(O_FCH_CREACION)='" . $fechaGestion . "' 
                    AND O_SUBTOTAL>0 
                    AND O_USUARIO='" . $codEjecutivo . "'
                    AND O_COD_CLIENTE IN 
                        (SELECT R_COD_CLIENTE 
                            FROM tb_ruta_mb 
                            WHERE 1=1 
                                AND R_DIA=" . $dia . "
                                AND RIGHT(R_RUTA,3)='" . $inicialesEjecutivo . "');
           ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getTotalChipsVentaRuta($inicialesEjecutivo, $dia, $fechaGestion, $horaInicio, $codEjecutivo, $periodo) {
        $fechaHoraGestion = $fechaGestion . ' ' . $horaInicio;
//        $fechaHoraDiaDespues = date('Y-m-d', strtotime($fechaGestion . ' + 1 days')) . ' ' . $horaInicio;
        $fechaHoraDiaDespues = $fechaGestion . ' ' . HORA_FIN_DIA;

        $sql = "
            -- VENTA EN LA RUTA
            SELECT " . FuncionesBaseDatos::isnull('sqlsrv') . "(SUM(O_SUBTOTAL/" . PRECIO_UNITARIO_PRODUCTO_CHIP_MOVI . "),0) AS RESPUESTA
                FROM tb_ordenes_mb  
                WHERE 1=1 
                    -- AND DATE(O_FCH_CREACION)='" . $fechaGestion . "' 
                    AND O_FCH_CREACION BETWEEN '" . $fechaHoraGestion . "' AND '" . $fechaHoraDiaDespues . "'
                    AND O_SUBTOTAL>0 
                    AND O_USUARIO='" . $codEjecutivo . "'
                    AND O_COD_CLIENTE IN 
                        (SELECT R_COD_CLIENTE 
                            FROM tb_ruta_mb 
                            WHERE 1=1 
                                AND R_DIA=" . $dia . "
                                AND RIGHT(R_RUTA,3)='" . $inicialesEjecutivo . "')
                                AND pg_id='" . $periodo . "'
                                    ;
           ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getTotalChipsVentaFueraRuta_($inicialesEjecutivo, $dia, $fechaGestion, $codEjecutivo) {
        $sql = "
            -- VENTA FUERA DE RUTA
            SELECT " . FuncionesBaseDatos::isnull('sqlsrv') . "(SUM(O_SUBTOTAL/" . PRECIO_UNITARIO_PRODUCTO_CHIP_MOVI . "),0) AS RESPUESTA
                FROM tb_ordenes_mb  
                WHERE 1=1 
                    AND DATE(O_FCH_CREACION)='" . $fechaGestion . "' 
                    AND O_SUBTOTAL>0 
                    AND O_USUARIO='" . $codEjecutivo . "' 
                    AND O_COD_CLIENTE NOT IN 
                        (SELECT R_COD_CLIENTE 
                            FROM tb_ruta_mb 
                            WHERE 1=1 
                                AND R_DIA=" . $dia . " 
                                AND RIGHT(R_RUTA,3)='" . $inicialesEjecutivo . "');
           ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getTotalChipsVentaFueraRuta($inicialesEjecutivo, $dia, $fechaGestion, $horaInicio, $codEjecutivo, $periodo, $semana) {
        $fechaHoraGestion = $fechaGestion . ' ' . $horaInicio;
//        $fechaHoraDiaDespues = date('Y-m-d', strtotime($fechaGestion . ' + 1 days')) . ' ' . $horaInicio;
        $fechaHoraDiaDespues = $fechaGestion . ' ' . HORA_FIN_DIA;

        $sql = "
            -- VENTA FUERA DE RUTA
            SELECT " . FuncionesBaseDatos::isnull('sqlsrv') . "(SUM(O_SUBTOTAL/" . PRECIO_UNITARIO_PRODUCTO_CHIP_MOVI . "),0) AS RESPUESTA
                FROM tb_ordenes_mb  
                WHERE 1=1 
                    -- AND DATE(O_FCH_CREACION)='" . $fechaGestion . "' 
                    AND O_FCH_CREACION BETWEEN '" . $fechaHoraGestion . "' AND '" . $fechaHoraDiaDespues . "'
                    AND O_SUBTOTAL>0 
                    AND O_USUARIO='" . $codEjecutivo . "' 
                    AND O_COD_CLIENTE NOT IN 
                        (SELECT R_COD_CLIENTE 
                            FROM tb_ruta_mb 
                            WHERE 1=1 
                                AND R_DIA=" . $dia . " 
                                AND RIGHT(R_RUTA,3)='" . $inicialesEjecutivo . "'
                                AND pg_id='" . $periodo . "'
                                AND r_semana='" . $semana . "'
                                    );
           ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getTotalClientesVentaFinSemana_($fechaGestion, $codEjecutivo) {
        $fechaSabado = date('Y-m-d', strtotime($fechaGestion . ' + 1 days'));
        $fechaDomingo = date('Y-m-d', strtotime($fechaGestion . ' + 2 days'));

        $sql = "
            -- CLIENTES CON VENTA EN FIN SEMANA
            SELECT " . FuncionesBaseDatos::isnull('sqlsrv') . "(COUNT(O_COD_CLIENTE),0) AS RESPUESTA
                FROM tb_ordenes_mb  
                WHERE 1=1 
                    AND DATE(O_FCH_CREACION) BETWEEN '" . $fechaSabado . "' AND '" . $fechaDomingo . "'
                    AND O_SUBTOTAL>0 
                    AND O_USUARIO='" . $codEjecutivo . "';
           ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getTotalClientesVentaFinSemana($fechaGestion, $codEjecutivo) {
        $fechaSabado = date('Y-m-d', strtotime($fechaGestion . ' + 1 days'));
        $fechaDomingo = date('Y-m-d', strtotime($fechaGestion . ' + 2 days'));

        $fechaHoraSabado = $fechaSabado . HORA_INICIO_DIA;
        $fechaHoraDomingo = $fechaSabado . HORA_FIN_DIA;

        $sql = "
            -- CLIENTES CON VENTA EN FIN SEMANA
            SELECT " . FuncionesBaseDatos::isnull('sqlsrv') . "(COUNT(O_COD_CLIENTE),0) AS RESPUESTA
                FROM tb_ordenes_mb  
                WHERE 1=1 
                    -- AND DATE(O_FCH_CREACION) BETWEEN '" . $fechaSabado . "' AND '" . $fechaDomingo . "'
                    AND O_FCH_CREACION BETWEEN '" . $fechaHoraSabado . "' AND '" . $fechaHoraDomingo . "'
                    AND O_SUBTOTAL>0 
                    AND O_USUARIO='" . $codEjecutivo . "';
           ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getTotalClientesVenta_($fechaGestion, $codEjecutivo) {
        $sql = "
            -- CLIENTES CON VENTA EN EL DIA
            SELECT " . FuncionesBaseDatos::isnull('sqlsrv') . "(COUNT(O_COD_CLIENTE),0) AS RESPUESTA
                FROM tb_ordenes_mb  
                WHERE 1=1 
                    AND DATE(O_FCH_CREACION)='" . $fechaGestion . "' 
                    AND O_SUBTOTAL>0 
                    AND O_USUARIO='" . $codEjecutivo . "';
           ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getTotalClientesVenta($fechaGestion, $codEjecutivo) {
        $fechaHoraGestion = $fechaGestion . HORA_INICIO_DIA;
//        $fechaHoraDiaDespues = date('Y-m-d', strtotime($fechaGestion . ' + 1 days')) . ' 09:00';
        $fechaHoraDiaDespues = $fechaGestion . HORA_FIN_DIA;

        $sql = "
            -- CLIENTES CON VENTA EN EL DIA
            SELECT " . FuncionesBaseDatos::isnull('sqlsrv') . "(COUNT(distinct O_COD_CLIENTE),0) AS RESPUESTA
                FROM tb_ordenes_mb  
                WHERE 1=1 
                    -- AND DATE(O_FCH_CREACION)='" . $fechaGestion . "' 
                    AND O_FCH_CREACION BETWEEN '" . $fechaHoraGestion . "' AND '" . $fechaHoraDiaDespues . "'
                    AND O_SUBTOTAL>0 
                    AND O_USUARIO='" . $codEjecutivo . "';
           ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getClientesNoVisitadosxRutaxEjecutivoxDiaxPeriodo($ejecutivo, $ruta, $dia, $fechaGestionado, $accionRevisar = 'Inicio visita', $periodoAbierto) {
        $sql = "
            select r_cod_cliente, r_nom_cliente
            from tb_ruta_mb 
            where 1=1
            and r_dia=" . $dia . "
            and r_ruta='" . $ruta . "'
            and pg_id ='" . $periodoAbierto . "'                
            and r_cod_cliente not in (
                select distinct h_cod_cliente
                from tb_historial_mb
                where 1=1
                and " . FuncionesBaseDatos::convertToDate('sqlsrv', 'H_FECHA') . "='" . $fechaGestionado . "'
                -- and date(h_fecha) ='" . $fechaGestionado . "'
                and h_usuario='" . $ejecutivo . "'
                and h_ruta='" . $ruta . "'
                and h_accion='" . $accionRevisar . "' )
            ;";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getClientesxRuta($codigoRuta, $periodo) {
        $sql = "
            select 
                    r_cod_cliente as CODIGOCLIENTE
                    ,r_nom_cliente as NOMBRECLIENTE
                    ,r_secuencia as SECUENCIARUTA
                    ,'' as CONTACTOS
                    ,'' as ESTADOVISITA
                    ,'' as VENTA
                    ,'' as LLAMADAANTERIOR
                from tb_ruta_mb 
                where 1=1 
                    and r_ruta='" . $codigoRuta . "'
                    and pg_id='" . $periodo . "'
                order by r_secuencia
            ;";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getRutasxEjecutivoxPeriodo($ejecutivo, $periodo) {
        $sql = "
            SELECT 
                    DISTINCT R_RUTA AS RUTA
                FROM tb_ruta_mb as a
                    inner join tb_ejecutivo_ruta as b
                        on a.r_ruta = b.er_ruta
                WHERE 1=1
                    AND pg_id=" . $periodo . "
                    AND b.er_usuario='" . $ejecutivo . "'
                ORDER BY 1;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

}
