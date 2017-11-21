<?php

/**
 * This is the model class for table "tb_asignacion".
 *
 * The followings are the available columns in table 'tb_asignacion':
 * @property integer $ID_ASIG
 * @property integer $ID_PRO
 * @property integer $ID_VEND
 * @property string $FECHAINGRESO_ASIG
 * @property integer $IDUSR_ASIF
 *
 * The followings are the available model relations:
 * @property TbVendedor $iDVEND
 * @property TbProducto $iDPRO
 */
class FRutaModel extends DAOModel {
    /*
     * Obtiene el listado de mines vendidos por el vendedor segun la fecha.
     * 
     * El tipo de vendedor influye en los meses en los que se obtiene las ventas
     *  Vendedores (1) =Ventas 4 meses atrás de la fecha de calculo
     *  Mayoristas(2) = Ventas en el mes anterior al calculo de las comisiones
     */

    public $campoFechaOrdenes = 'o_fch_creacion';

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

    public function getTotalClientesNoVisitadosxRutaxEjecutivo($inicialesEjecutivo, $dia, $fechaGestion, $codEjecutivo) {
        $sql = "
            SELECT 
                    COUNT(*) AS CLIENTESNOVISITADOS
                FROM tb_ruta_mb 
                WHERE 1=1
                    AND RIGHT(r_ruta,3)='" . $inicialesEjecutivo . "' 
                    AND r_dia ='" . $dia . "'
                    AND R_COD_CLIENTE NOT IN 
                        (SELECT H_COD_CLIENTE
                            FROM tb_historial_mb
                            WHERE 1=1
                                AND DATE(H_FECHA)='" . $fechaGestion . "'
                                AND H_USUARIO='" . $codEjecutivo . "'
            );
           ";
//        var_dump($sql);        die();
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

        $fechaHoraSabado = $fechaSabado . ' 09:00';
        $fechaHoraDomingo = $fechaSabado . ' 09:00';
        $sql = "
            -- VENTA DE FIN DE SEMANA
            SELECT IFNULL(SUM(O_SUBTOTAL),0) AS RESPUESTA
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
            SELECT IFNULL(SUM(O_SUBTOTAL),0) AS RESPUESTA
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

    public function getTotalChipsVentaDia($fechaGestion, $codEjecutivo) {
        $fechaHoraGestion = $fechaGestion . ' 09:00';
        $fechaHoraDiaDespues = date('Y-m-d', strtotime($fechaGestion . ' + 1 days')) . ' 09:00';
        $sql = "
            -- VENTA DEL DIA
            SELECT IFNULL(SUM(O_SUBTOTAL),0) AS RESPUESTA
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

    public function getTotalChipsVentaRuta_($inicialesEjecutivo, $dia, $fechaGestion, $codEjecutivo) {
        $sql = "
            -- VENTA EN LA RUTA
            SELECT IFNULL(SUM(O_SUBTOTAL),0) AS RESPUESTA
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

    public function getTotalChipsVentaRuta($inicialesEjecutivo, $dia, $fechaGestion, $codEjecutivo) {
        $fechaHoraGestion = $fechaGestion . ' 09:00';
        $fechaHoraDiaDespues = date('Y-m-d', strtotime($fechaGestion . ' + 1 days')) . ' 09:00';

        $sql = "
            -- VENTA EN LA RUTA
            SELECT IFNULL(SUM(O_SUBTOTAL),0) AS RESPUESTA
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
                                AND RIGHT(R_RUTA,3)='" . $inicialesEjecutivo . "');
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
            SELECT IFNULL(SUM(O_SUBTOTAL),0) AS RESPUESTA
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

    public function getTotalChipsVentaFueraRuta($inicialesEjecutivo, $dia, $fechaGestion, $codEjecutivo) {
        $fechaHoraGestion = $fechaGestion . ' 09:00';
        $fechaHoraDiaDespues = date('Y-m-d', strtotime($fechaGestion . ' + 1 days')) . ' 09:00';

        $sql = "
            -- VENTA FUERA DE RUTA
            SELECT IFNULL(SUM(O_SUBTOTAL),0) AS RESPUESTA
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
                                AND RIGHT(R_RUTA,3)='" . $inicialesEjecutivo . "');
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
            SELECT IFNULL(COUNT(O_COD_CLIENTE),0) AS RESPUESTA
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

        $fechaHoraSabado = $fechaSabado . ' 09:00';
        $fechaHoraDomingo = $fechaSabado . ' 09:00';

        $sql = "
            -- CLIENTES CON VENTA EN FIN SEMANA
            SELECT IFNULL(COUNT(O_COD_CLIENTE),0) AS RESPUESTA
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
            SELECT IFNULL(COUNT(O_COD_CLIENTE),0) AS RESPUESTA
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
        $fechaHoraGestion = $fechaGestion . ' 09:00';
        $fechaHoraDiaDespues = date('Y-m-d', strtotime($fechaGestion . ' + 1 days')) . ' 09:00';

        $sql = "
            -- CLIENTES CON VENTA EN EL DIA
            SELECT IFNULL(COUNT(O_COD_CLIENTE),0) AS RESPUESTA
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

    public function getClientesNoVisitadosxRutaxEjecutivoxDia($ejecutivo, $ruta, $dia, $fechaGestionado, $accionRevisar = 'Inicio visita') {
        $sql = "
            select r_cod_cliente, r_nom_cliente
            from tb_ruta_mb 
            where 1=1
            and r_dia=" . $dia . "
            and r_ruta='" . $ruta . "'
            and r_cod_cliente not in (
                select distinct h_cod_cliente
                from tb_historial_mb
                where 1=1
                and date(h_fecha) ='" . $fechaGestionado . "'
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

}
