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
class FHistorialModel extends DAOModel {

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
        $sql = "
            SELECT 
                    " . FuncionesBaseDatos::convertToTime('sqlsrv', 'h_fecha') . "as HORAVISITA 
                    -- TIME_FORMAT(H_FECHA, '%H:%i:%s') as HORAVISITA 
                    ,h_id as IDHISTORIAL
                FROM tb_historial_mb
                WHERE 1=1
                    AND " . FuncionesBaseDatos::convertToDate('sqlsrv', 'h_fecha') . "='" . $fechagestion . "'
                    -- AND DATE(H_FECHA) ='" . $fechagestion . "'
                    AND H_USUARIO='" . $ejecutivo . "'
                    AND H_ACCION='" . $accion . "'
                    AND H_COD_CLIENTE='" . $codCliente . "'
                    AND H_ID>='" . $codigoHistorial . "'
                ORDER BY H_ID
                    ;
            ";
//        if ($codCliente == "TCQU180168"&&$codigoHistorial=="647061") {
//            var_dump($sql);
//            die();
//        }
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getHistorialxVendedorxFechaxHoraInicioxHoraFin($accion = 'Inicio Visita', $fechagestion, $horaInicio, $horaFin, $ejecutivo) {
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
                    ,h_id AS IDHISTORIAL
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

    public function getHistorialxVendedorxFechaxHoraInicioxHoraFinSemana($accion = 'Inicio Visita', $fechagestion, $horaInicio, $horaFin, $ejecutivo, $semana) {
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
             " . FuncionesBaseDatos::convertToTime('sqlsrv', 'H_FECHA') . "AS RESULTADO
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
             " . FuncionesBaseDatos::convertToTime('sqlsrv', 'H_FECHA') . "AS RESULTADO
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

    public function getCantidadVisitasxEjecutivoxFecha($accion = 'Inicio Visita', $codigoejecutivo, $fecha, $ruta) {
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

}
