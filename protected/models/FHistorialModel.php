<?php

class FHistorialModel extends DAOModel {

    public static function getFechaUltimaCarga() {
        $command1 = Yii::app()->db->createCommand("
            select MAX(h_fch_ingreso) as ultimacarga from tb_historial_mb");

        $resultado1 = $command1->queryRow();
//                var_dump($resultado1);die();
        $ultimacarga = $resultado1['ultimacarga'];

        return $ultimacarga;
    }

    public function getFechasHistorialxPeriodo($fechaInicioPeriodo, $fechaFinPeriodo, $semana, $accion = 'Inicio Visita') {
        $sql = "
            select distinct date(h_fecha) as fecha
                from tb_historial_mb
                where 1=1
                    and h_fecha between '" . $fechaInicioPeriodo . "' and '" . $fechaFinPeriodo . "'
                    and h_accion='" . $accion . "'
                    and h_semana=" . $semana . ";
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getHistorialxVendedorxFecha($accion = 'Inicio Visita', $fechagestion, $ejecutivo) {
        $sql = "
            SELECT 
                    H_FECHA as FECHAVISITA
                    ,H_COD_CLIENTE AS CODIGOCLIENTE
                    ,H_NOM_CLIENTE AS NOMBRECLIENTE
                    ,H_RUTA AS RUTAVISITA
                    ,h_latitud AS LATITUD
                    ,h_longitud AS LONGITUD
                FROM tb_historial_mb
                WHERE 1=1
                    AND DATE(H_FECHA) ='" . $fechagestion . "'
                    AND H_USUARIO='" . $ejecutivo . "'
                    AND H_ACCION='" . $accion . "'
                ORDER BY h_id ;
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getInicioFinVisitaClientexEjecutivoxFecha($accion, $fechagestion, $ejecutivo, $codCliente, $codigoHistorial) {

//        " . FuncionesBaseDatos::convertToTimeHHMMSS('sqlsrv', 'h_fecha') . "as HORAVISITA 
        $sql = "
            SELECT                    
                    " . FuncionesBaseDatos::convertToDateTimeYYYYMMDDHHMMSS('sqlsrv', 'h_fecha') . "as HORAVISITA 
                    ,h_id as IDHISTORIAL
                    ,H_ACCION
                    ,H_COD_CLIENTE
                FROM tb_historial_mb
                WHERE 1=1
                    AND " . FuncionesBaseDatos::convertToDate('sqlsrv', 'h_fecha') . "='" . $fechagestion . "'
                    AND H_USUARIO='" . $ejecutivo . "'
                    AND H_ACCION in ('Inicio visita','Fin de visita')
                    AND H_COD_CLIENTE='" . $codCliente . "'
                    AND H_ID>='" . $codigoHistorial . "'
                ORDER BY H_FECHA
                    ;
            ";
//       var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getHistorialxAccionxVendedorxFechaxHoraInicioxHoraFin($accion = 'Inicio Visita', $fechagestion, $horaInicio, $horaFin, $ejecutivo) {
        $fechaInicio = $fechagestion . ' ' . $horaInicio;
        $fechaFin = $fechagestion . ' ' . $horaFin;

        $sql = "
            SELECT 
                    " . FuncionesBaseDatos::convertToDateTimeYYYYMMDDHHMM('sqlsrv', 'H_FECHA') . " AS FECHAVISITA
                    -- formato mysql DATE_FORMAT(H_FECHA, '%Y-%m-%d %H:%i') AS FECHAVISITA
                    ,H_COD_CLIENTE AS CODIGOCLIENTE
                    ,H_NOM_CLIENTE AS NOMBRECLIENTE
                    ,H_RUTA AS RUTAVISITA
                    ,h_latitud AS LATITUD
                    ,h_longitud AS LONGITUD
                    ,h_id AS IDHISTORIAL
                    ,h_semana AS SEMANAHISTORIAL
                FROM tb_historial_mb
                WHERE 1=1
                    AND H_FECHA BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'
                    AND H_USUARIO='" . $ejecutivo . "'
                    AND H_ACCION='" . $accion . "'
                ORDER BY H_FECHA ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        //var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getHistorialxVendedorxFechaxHoraInicioxHoraFin(
            $filtrarAccion
            , $accion = 'Inicio Visita'
            , $fechagestion
            , $horaInicio
            , $horaFin
            , $ejecutivo) {

        $fechaInicio = $fechagestion . ' ' . $horaInicio;
        $fechaFin = $fechagestion . ' ' . $horaFin;

        $accionFiltrar = $filtrarAccion == 1 ? "AND H_ACCION = '" . $accion . "'" : "";

//        var_dump($filtrarAccion, $accionFiltrar);die();

        $sql = "
             SELECT 
                    " . FuncionesBaseDatos::convertToDateTimeYYYYMMDDHHMM('sqlsrv', 'H_FECHA') . " AS FECHAVISITA
                    ,H_COD_CLIENTE AS CODIGOCLIENTE
                    ,H_NOM_CLIENTE AS NOMBRECLIENTE
                    ,H_RUTA AS RUTAVISITA
                    ,h_latitud AS LATITUD
                    ,h_longitud AS LONGITUD
                    ,h_id AS IDHISTORIAL
                    ,h_semana AS SEMANAHISTORIAL
                    ,H_ACCION as accion
                    ,h_cod_accion as codigoitem
                    ,h_cod_comentario as CODIGOCOMENTARIO
                    --,'' as CHIPS
                    --,CAST(COALESCE(SUM(O_SUBTOTAL/" . PRECIO_UNITARIO_PRODUCTO_CHIP_MOVI . "),0) AS int)AS CHIPS   
                FROM tb_historial_mb
                WHERE 1=1
                    AND H_COD_CLIENTE <>'null'
                    AND H_FECHA BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'
                    AND H_USUARIO='" . $ejecutivo . "'
                    " . $accionFiltrar . "
                ORDER BY H_FECHA ;
            ";
//        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        //var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getHistorialxVendedorxFechaxHoraInicioxHoraFinSemana(
            $accion = 'Inicio Visita'
            , $fechagestion
            , $horaInicio
            , $horaFin
            , $ejecutivo
            , $semana) {
        $fechaInicio = $fechagestion . ' ' . $horaInicio;
        $fechaFin = $fechagestion . ' ' . $horaFin;

        $sql = "
            SELECT 
                    " . FuncionesBaseDatos::convertToDateTimeYYYYMMDDHHMM('sqlsrv', 'H_FECHA') . " AS FECHAVISITA
                    -- formato mysql DATE_FORMAT(H_FECHA, '%Y-%m-%d %H:%i') AS FECHAVISITA
                    ,H_COD_CLIENTE AS CODIGOCLIENTE
                    ,H_NOM_CLIENTE AS NOMBRECLIENTE
                    ,H_RUTA AS RUTAVISITA
                    ,h_latitud AS LATITUD
                    ,h_longitud AS LONGITUD
                    ,h_id AS IDHISTORIAL
                    ,h_semana AS SEMANAHISTORIAL
                FROM tb_historial_mb
                WHERE 1=1
                    AND H_FECHA BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'
                    AND H_USUARIO='" . $ejecutivo . "'
                    AND H_ACCION='" . $accion . "'
                    AND h_semana='" . $semana . "'
                ORDER BY H_FECHA ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        //var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getValidarVisitaClientexVendedorxFechaxPeriodo(
            $accion = 'Inicio Visita'
            , $codigoCliente
            , $codigoEjecutivo
            , $fechagestion
            , $semana
            , $periodo
    ) {

        $fechaInicio = $fechagestion . ' ' . '00:00:00';
        $fechaFin = $fechagestion . ' ' . '23:59:59';

        $sql = "
            SELECT 
                    H_FECHA AS FECHAVISITA
                    ,H_COD_CLIENTE AS CODIGOCLIENTE
                    ,H_NOM_CLIENTE AS NOMBRECLIENTE
                    ,H_RUTA AS RUTAVISITA
                    ,h_latitud AS LATITUD
                    ,h_longitud AS LONGITUD
                    ,h_id AS IDHISTORIAL
                FROM tb_historial_mb
                WHERE 1=1
                    AND H_FECHA BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'
                    AND H_COD_CLIENTE='" . $codigoCliente . "'
                    AND H_USUARIO='" . $codigoEjecutivo . "'
                    AND H_ACCION='" . $accion . "'
                    AND h_semana='" . $semana . "'
                   -- AND pg_id='" . $periodo . "'
                ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        //var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getHistorialxSupervisorxFechaxHoraInicioxHoraFin($accion = 'Inicio Visita', $fechagestion, $horaInicio, $horaFin, $ejecutivo, $ruta) {
        $fechaInicio = $fechagestion . ' ' . $horaInicio;
        $fechaFin = $fechagestion . ' ' . $horaFin;

        $sql = "
            SELECT 
                    H_FECHA AS FECHAVISITA
                    ,H_COD_CLIENTE AS CODIGOCLIENTE
                    ,H_NOM_CLIENTE AS NOMBRECLIENTE
                    ,H_RUTA AS RUTAVISITA
                    ,h_latitud AS LATITUD
                    ,h_longitud AS LONGITUD
                FROM tb_historial_mb
                WHERE 1=1
                    AND H_FECHA BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'
                    AND H_USUARIO='" . $ejecutivo . "'
                    AND H_ACCION='" . $accion . "'
                    AND h_ruta='" . $ruta . "'
                ORDER BY H_FECHA ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        //var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getHistorialxVendedorxFechaxHoraInicioxHoraFinxRuta($accion = 'Inicio Visita', $fechagestion, $horaInicio, $horaFin, $ejecutivo, $ruta) {
        $fechaInicio = $fechagestion . ' ' . $horaInicio;
        $fechaFin = $fechagestion . ' ' . $horaFin;

        $sql = "
            SELECT 
                    DATE_FORMAT(H_FECHA, '%Y-%m-%d %H:%i') AS FECHAVISITA
                    ,H_COD_CLIENTE AS CODIGOCLIENTE
                    ,H_NOM_CLIENTE AS NOMBRECLIENTE
                    ,H_RUTA AS RUTAVISITA
                    ,h_latitud AS LATITUD
                    ,h_longitud AS LONGITUD
                FROM tb_historial_mb
                WHERE 1=1
                    AND H_FECHA BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'
                    AND H_USUARIO='" . $ejecutivo . "'
                    AND H_ACCION='" . $accion . "'
                    AND H_ruta='" . $ruta . "'
                        
                ORDER BY H_FECHA ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        //var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getPrimeraVisitaxEjecutivoxFechaxHoraInicioxHoraFin($accion = 'Inicio Visita', $fechagestion, $horaInicio, $horaFin, $ejecutivo) {
        $fechaInicio = $fechagestion . ' ' . $horaInicio;
        $fechaFin = $fechagestion . ' ' . $horaFin;
        $sql = "
            SELECT 
            TOP 1
             " . FuncionesBaseDatos::convertToTimeHHMMSS('sqlsrv', 'H_FECHA') . "AS RESULTADO
             -- DATE_FORMAT(H_FECHA, '%H:%i') AS RESULTADO
                FROM tb_historial_mb
                WHERE 1=1
                    AND H_FECHA BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'
                    AND H_USUARIO='" . $ejecutivo . "'
                    AND H_ACCION='" . $accion . "'
                ORDER BY H_FECHA
                ;
            ";
//   var_dump($sql);        die();

        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getUltimaVisitaxEjecutivoxFechaxHoraInicioxHoraFin($accion = 'Inicio Visita', $fechagestion, $horaInicio, $horaFin, $ejecutivo) {
        $fechaInicio = $fechagestion . ' ' . $horaInicio;
        $fechaFin = $fechagestion . ' ' . $horaFin;
        $sql = "
            SELECT 
            TOP 1
             " . FuncionesBaseDatos::convertToTimeHHMMSS('sqlsrv', 'H_FECHA') . "AS RESULTADO
             -- DATE_FORMAT(H_FECHA, '%H:%i') AS RESULTADO
                FROM tb_historial_mb
                WHERE 1=1
                    AND H_FECHA BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'
                    AND H_USUARIO='" . $ejecutivo . "'
                    AND H_ACCION='" . $accion . "'
                ORDER BY H_FECHA DESC
                ;
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getHistorialxVendedorxRangoFecha($accion = 'Inicio Visita', $fechaInicio, $fechaFin, $ejecutivo) {
//        $anio = $datos['anio'];
        $sql = "
            SELECT 
                    DATE(H_FECHA) as FECHAVISITA
                    ,H_COD_CLIENTE AS CODIGOCLIENTE
                    ,H_NOM_CLIENTE AS NOMBRECLIENTE
                    ,H_RUTA AS RUTAVISITA
                    ,h_latitud AS LATITUD
                    ,h_longitud AS LONGITUD
                FROM tb_historial_mb
                WHERE 1=1
                    AND DATE(H_FECHA)='" . $fechagestion . "'
                        AND DATE(H_FECHA) BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'
                    AND H_USUARIO='" . $ejecutivo . "'
                    AND H_ACCION='" . $accion . "'
                ORDER BY H_FECHA ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getHistorialxVendedorxRangoFechaxHoraInicioxHoraFin($accion = 'Inicio Visita', $fechaInicio, $horaInicio, $horaFin, $fechaFin, $ejecutivo) {
        $fechaInicio = $fechagestion . ' ' . $horaInicio;
        $fechaFin = $fechagestion . ' ' . $horaFin;
        $sql = "
            SELECT 
                    DATE(H_FECHA) as FECHAVISITA
                    ,H_COD_CLIENTE AS CODIGOCLIENTE
                    ,H_NOM_CLIENTE AS NOMBRECLIENTE
                    ,H_RUTA AS RUTAVISITA
                    ,h_latitud AS LATITUD
                    ,h_longitud AS LONGITUD
                FROM tb_historial_mb
                WHERE 1=1
                    AND DATE(H_FECHA)='" . $fechagestion . "'
                        AND DATE(H_FECHA) BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'
                    AND H_USUARIO='" . $ejecutivo . "'
                    AND H_ACCION='" . $accion . "'
                ORDER BY H_FECHA ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getHistorialVisitaxEjecutivoxClientexFecha(
            $accion = 'Inicio Visita'
            , $codigoejecutivo
            , $codigocliente
            , $fecha) {
//        $anio = $datos['anio'];
        $sql = "
            SELECT 
                    DATE(H_FECHA) as FECHAVISITA
                    ,H_COD_CLIENTE AS CODIGOCLIENTE
                    ,H_NOM_CLIENTE AS NOMBRECLIENTE
                    ,H_RUTA AS RUTAVISITA
                   ,'' AS FILA
                FROM tb_historial_mb
                WHERE 1=1
                    AND DATE(H_FECHA)='" . $fecha . "'
                    AND H_USUARIO='" . $codigoejecutivo . "'
                    AND H_COD_CLIENTE='" . $codigocliente . "'
                    AND H_ACCION='" . $accion . "'
                ORDER BY H_FECHA ;
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getCantidadVisitasxEjecutivoxFechaxRuta($accion = 'Inicio Visita', $codigoejecutivo, $fecha, $ruta) {
        $sql = "
            SELECT 
                   count(distinct h_cod_cliente) as visitas_en_ruta
                FROM tb_historial_mb
                WHERE 1=1
                    AND " . FuncionesBaseDatos::convertToDate('sqlsrv', 'h_fecha') . "='" . $fecha . "'
                    AND H_USUARIO='" . $codigoejecutivo . "'
                    AND H_ACCION='" . $accion . "'
                    AND H_RUTA='" . $ruta . "'
                
                ;
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getCantidadVisitasxEjecutivoxFechaInicioxFechaFin($codigoejecutivo, $fechaI, $fechaF, $accion = 'Inicio Visita') {
        $sql = "
            SELECT 
                   count(distinct h_cod_cliente) as visitas_en_ruta
                FROM tb_historial_mb
                WHERE 1=1
                    AND " . FuncionesBaseDatos::convertToDate('sqlsrv', 'h_fecha') . "between '" . $fechaI . "' and '" . $fechaF . "'
                    AND H_USUARIO='" . $codigoejecutivo . "'
                    AND H_ACCION='" . $accion . "'
                ;
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getCantidadVisitasxEjecutivoxFechaxHoraInicioxHoraFin($accion = 'Inicio Visita', $codigoejecutivo, $fecha, $ruta, $horaInicio, $horaFin) {
        $fechaInicio = $fecha . ' ' . $horaInicio;
        $fechaFin = $fecha . ' ' . $horaFin;
        $sql = "
            SELECT 
                   count(distinct h_cod_cliente) as VISITASENRUTA
                FROM tb_historial_mb
                WHERE 1=1
                    AND H_FECHA BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'
                    AND H_USUARIO='" . $codigoejecutivo . "'
                    AND H_ACCION='" . $accion . "'
                    AND H_RUTA='" . $ruta . "'
                ORDER BY H_FECHA ;
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getDatosUltimaVisitaxEjecutivoxAccionxCodClientexFechaInicioxFechaFinxHoraInicioxHoraFinxRuta(
            $codigoEjecutivo
            , $accion = 'Inicio Visita'
            , $codigoCliente
            , $fechaInicio
            , $fechaFin
            , $horaInicio
            , $horaFin
            , $ruta) {
        $sql = "
              SELECT 
                   h_fecha
                   ,h_latitud AS LATITUDEJECUTIVO
                   ,h_longitud AS LONGITUDEJECUTIVO
                FROM tb_historial_mb
                WHERE 1=1
                    AND H_FECHA BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'
                    AND DATE_FORMAT(H_FECHA,'%H:%i') between '" . $horaInicio . "' AND '" . $horaFin . "'
                    AND H_USUARIO='" . $codigoEjecutivo . "'
                    AND H_ACCION='" . $accion . "'
                    AND H_RUTA='" . $ruta . "'
                    AND h_cod_cliente='" . $codigoCliente . "'
                ORDER BY H_FECHA DESC
                LIMIT 1;
                ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getCantidadClientesVisitadosxEjecutivoxFecha($codigoejecutivo, $fecha) {
        $txt1 = 'VISITAS';
        $txt2 = 'REPETIDAS';
        $txt3 = 'TODAS';

        $resultado = array();
        $sql1 = "
            -- select sum(rhd_valor) AS '" . $txt1 . "'
            select ISNULL(sum(CONVERT(int, rhd_valor)),0) AS '" . $txt1 . "'
            from tb_resumen_historial_diario 
            where 1=1
            -- and date(rhd_fecha_historial)='" . $fecha . "' 
            and " . FuncionesBaseDatos::convertToDate('sqlsrv', 'rhd_fecha_historial') . "='" . $fecha . "' 
            and rhd_cod_ejecutivo='" . $codigoejecutivo . "'
            and rhd_parametro IN ('VISITAS-EFECTUADAS-EN-RUTA','VISITAS-FUERA-RUTA'); 
            ";
//        var_dump($sql1);die();
        $command = $this->connection->createCommand($sql1);
        $datos1 = $command->queryAll();
        $resultado [$txt1] = (isset($datos1[0])) ? intval($datos1[0][$txt1]) : 0;

        $sql2 = "
            -- select sum(rhd_valor) AS '" . $txt2 . "'
            select ISNULL(sum(CONVERT(int, rhd_valor)),0) AS '" . $txt2 . "'
            from tb_resumen_historial_diario 
            where 1=1
            -- and date(rhd_fecha_historial)='" . $fecha . "' 
                and " . FuncionesBaseDatos::convertToDate('sqlsrv', 'rhd_fecha_historial') . "='" . $fecha . "' 
            and rhd_cod_ejecutivo='" . $codigoejecutivo . "'
            and rhd_parametro IN ('VISITAS-REPETIDAS');

            ";
        $command = $this->connection->createCommand($sql2);
        $datos2 = $command->queryAll();
        $resultado [$txt2] = (isset($datos2[0])) ? intval($datos2[0][$txt2]) : 0;

        $sql3 = "
            -- select sum(rhd_valor) AS '" . $txt3 . "'
            select ISNULL(sum(CONVERT(int, rhd_valor)),0) AS '" . $txt3 . "'
            from tb_resumen_historial_diario 
            where 1=1
           -- and date(rhd_fecha_historial)='" . $fecha . "' 
               and " . FuncionesBaseDatos::convertToDate('sqlsrv', 'rhd_fecha_historial') . "='" . $fecha . "' 
            and rhd_cod_ejecutivo='" . $codigoejecutivo . "'
            and rhd_parametro IN ('VISITAS-EFECTUADAS-EN-RUTA','VISITAS-FUERA-RUTA','VISITAS-REPETIDAS');
            ";
        $command = $this->connection->createCommand($sql3);
        $datos3 = $command->queryAll();
        $resultado [$txt3] = (isset($datos3[0])) ? intval($datos3[0][$txt3]) : 0;

//        var_dump($resultado);        DIE();
        $this->Close();
        return $resultado;
    }

    public function getClientesConYSinGestionxFecha($ejecutivo, $ruta, $fechaInicio, $fechaFinPeriodo, $periodo, $accion = 'Inicio Visita') {
//        var_dump($ejecutivo);die();
        $sql = "   
            select TIPO ,CONTEO_CLIENTES FROM (            
                    select 
                        a.er_usuario_nombre AS EJECUTIVO
                        ,b.r_ruta AS RUTA
                        ,count (distinct(b.r_cod_cliente)) as CONTEO_CLIENTES
                        ,c.pg_descripcion AS FECHA_PERIODO
                        ,c.pg_id AS PERIODO 
                        ,'VISITADOS' AS TIPO
                    FROM tb_ejecutivo_ruta as a
                        inner join tb_ruta_mb as b
                            on a.er_ruta=b.r_ruta
                        inner join tb_periodo_gestion as c
                            on b.pg_id=c.pg_id
                    where 1=1
                        and a.er_usuario='" . $ejecutivo . "'
                        and b.r_cod_cliente in (
                            select h_cod_cliente 
                                from tb_historial_mb 
                                where 1=1 
                                    and convert(date,h_fecha) between '" . $fechaInicio . "' and '" . $fechaFinPeriodo . "'
                                    and h_accion='" . $accion . "'
                                    and h_usuario='" . $ejecutivo . "'
                            )
                        and b.r_ruta='" . $ruta . "'
                    group by a.er_usuario_nombre,c.pg_descripcion,c.pg_id ,b.r_ruta               
                    union 
                    select 
                        a.er_usuario_nombre AS EJECUTIVO
                        ,b.r_ruta AS RUTA
                        ,count (distinct(b.r_cod_cliente)) as CONTEO_CLIENTES
                        ,c.pg_descripcion AS FECHA_PERIODO 
                        ,c.pg_id AS PERIODO 
                        ,'NO VISITADOS' AS TIPO
                    FROM tb_ejecutivo_ruta as a
                        inner join tb_ruta_mb as b
                            on a.er_ruta=b.r_ruta
                        inner join tb_periodo_gestion as c
                            on b.pg_id=c.pg_id
                    where 1=1
                        and a.er_usuario='" . $ejecutivo . "'
                        and b.r_cod_cliente not in (
                            select h_cod_cliente 
                                from tb_historial_mb 
                                where 1=1 
                                    and convert(date,h_fecha) between '" . $fechaInicio . "' and '" . $fechaFinPeriodo . "'
                                    and h_accion='" . $accion . "'
                                    and h_usuario='" . $ejecutivo . "'
                            )
                        and b.r_ruta='" . $ruta . "'
                    group by a.er_usuario_nombre,c.pg_descripcion,c.pg_id ,b.r_ruta  
                ) as w 
                where PERIODO =" . $periodo . "
                order by 1
;

            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getClientesConYSinGestionxFechaPCP($ejecutivo, $ruta, $fechaInicio, $fechaFinPeriodo, $periodo, $accion = 'Inicio Visita') {
//        var_dump($ejecutivo);die();
        $sql = "   
            select PROVINCIA,CANTON,PARROQUIA,TIPO ,CONTEO_CLIENTES FROM (            
                    select 
                        d.dcli_provincia as PROVINCIA
                        ,d.dcli_CANTON as CANTON
                        ,d.dcli_PARROQUIA as PARROQUIA
                        ,count (distinct(b.r_cod_cliente)) as CONTEO_CLIENTES
                        ,c.pg_descripcion AS FECHA_PERIODO
                        ,c.pg_id AS PERIODO 
                        ,'VISITADOS' AS TIPO
                    FROM tb_ejecutivo_ruta as a
                        inner join tb_ruta_mb as b
                            on a.er_ruta=b.r_ruta
                        inner join tb_periodo_gestion as c
                            on b.pg_id=c.pg_id
                        inner join tb_cliente_direccion as d
                            on b.r_cod_cliente=d.dcli_cliente
                    where 1=1
                        and a.er_usuario='" . $ejecutivo . "'
                        and b.r_cod_cliente in (
                            select h_cod_cliente 
                                from tb_historial_mb 
                                where 1=1 
                                    and convert(date,h_fecha) between '" . $fechaInicio . "' and '" . $fechaFinPeriodo . "'
                                    and h_accion='" . $accion . "'
                                    and h_usuario='" . $ejecutivo . "'
                            )
                        and b.r_ruta='" . $ruta . "'
                    group by d.dcli_provincia,d.dcli_CANTON,d.dcli_PARROQUIA,c.pg_descripcion,c.pg_id               
                    union 
                    select 
                        d.dcli_provincia as PROVINCIA
                        ,d.dcli_CANTON as CANTON
                        ,d.dcli_PARROQUIA as PARROQUIA
                        ,count (distinct(b.r_cod_cliente)) as CONTEO_CLIENTES
                        ,c.pg_descripcion AS FECHA_PERIODO 
                        ,c.pg_id AS PERIODO 
                        ,'NO VISITADOS' AS TIPO
                    FROM tb_ejecutivo_ruta as a
                        inner join tb_ruta_mb as b
                            on a.er_ruta=b.r_ruta
                        inner join tb_periodo_gestion as c
                            on b.pg_id=c.pg_id
                        inner join tb_cliente_direccion as d
                            on b.r_cod_cliente=d.dcli_cliente
                    where 1=1
                        and a.er_usuario='" . $ejecutivo . "'
                        and b.r_cod_cliente not in (
                            select h_cod_cliente 
                                from tb_historial_mb 
                                where 1=1 
                                    and convert(date,h_fecha) between '" . $fechaInicio . "' and '" . $fechaFinPeriodo . "'
                                    and h_accion='" . $accion . "'
                                    and h_usuario='" . $ejecutivo . "'
                            )
                        and b.r_ruta='" . $ruta . "'
                    group by d.dcli_provincia,d.dcli_CANTON,d.dcli_PARROQUIA,c.pg_descripcion,c.pg_id 
                ) as w 
                where PERIODO =" . $periodo . "
                order by 1
;

            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getPeriodosEnHistorial($fechaInicio, $fechaFin, $accion = 'Inicio Visita') {
        $sql = "   
            select 
                    distinct 
                    a.pg_id as id_periodo
                    ,b.pg_descripcion as nombre_periodo
                    ,b.pg_fecha_inicio fecha_inicio
                    ,b.pg_fecha_fin fecha_fin
                from tb_historial_mb as a
                    inner join tb_periodo_gestion as b
                        on a.pg_id=b.pg_id
                where 1=1 
                   and convert(date,a.h_fecha) between '" . $fechaInicio . "' and '" . $fechaFin . "'
                order by 1
                   
;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getDetalleClientesVisitadosxTipoUsrxUsrxFecha($VisitadoNoVisitado, $usuario, $fechaInicio, $fechaFin, $periodo, $accion = 'Inicio Visita') {
        $filtrarHistorial = '';
//        if ($tipoUsuario == 'E')

        $condicion = $VisitadoNoVisitado == 0 ? 'not' : '';
        $sql = "   
            select 
                    ROW_NUMBER() OVER(ORDER BY r_cod_cliente ASC) AS ITEM
                    ,er_ruta AS RUTA
                    ,er_usuario_nombre AS EJECUTIVO
                    ,r_cod_cliente AS CODIGOCLIENTE
                    ,r_nom_cliente AS CLIENTE
                    ,COUNT(r_cod_cliente) AS VISITAS
                from tb_ruta_mb as a
                    inner join tb_ejecutivo_ruta as b
                     on a.r_ruta=b.er_ruta
                where 1=1
                    and a.r_cod_cliente $condicion in (
                        select h_cod_cliente 
                            from tb_historial_mb 
                            where 1=1 
                                and convert(date,h_fecha) between '$fechaInicio ' and '$fechaFin'
                                and h_accion='$accion'
                                and h_usuario ='$usuario'
                    )
                    and a.pg_id =$periodo 
                    and b.er_usuario='$usuario'
            group by r_cod_cliente,r_nom_cliente,er_ruta,er_usuario_nombre
                order by 3, 2
                   
;";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getDetalleClientesVisitadosAcumulado($fechaInicio, $fechaFin, $usuario, $accion = 'Inicio Visita') {

        $sql = "EXEC [SP_VISITAS_ACUMULADAS_MES] '$fechaInicio','$fechaFin','$usuario';";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

}
