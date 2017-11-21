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

    public function getHistorialxVendedorxFecha($accion = 'Inicio Visita', $fechagestion, $ejecutivo) {
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
                    AND DATE(H_FECHA) ='" . $fechagestion . "'
                    AND H_USUARIO='" . $ejecutivo . "'
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

    public function getHistorialxVendedorxFechaxHoraInicioxHoraFin($accion = 'Inicio Visita', $fechagestion, $horaInicio, $horaFin, $ejecutivo) {
        $fechaInicio = $fechagestion . ' ' . $horaInicio;
        $fechaFin = $fechagestion . ' ' . $horaFin;

        $sql = "
            SELECT 
                    -- DATE(H_FECHA) as FECHAVISITA
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
                ORDER BY H_FECHA ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        //var_dump($data);        die();
        $this->Close();
        return $data;
    }
    public function getHistorialxSupervisorxFechaxHoraInicioxHoraFin($accion = 'Inicio Visita', $fechagestion, $horaInicio, $horaFin, $ejecutivo,$ruta) {
        $fechaInicio = $fechagestion . ' ' . $horaInicio;
        $fechaFin = $fechagestion . ' ' . $horaFin;

        $sql = "
            SELECT 
                    -- DATE(H_FECHA) as FECHAVISITA
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
                    AND h_ruta='".$ruta."'
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
                    -- DATE(H_FECHA) as FECHAVISITA
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
             DATE_FORMAT(H_FECHA, '%H:%i') AS RESULTADO
                FROM tb_historial_mb
                WHERE 1=1
                    AND H_FECHA BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'
                    AND H_USUARIO='" . $ejecutivo . "'
                    AND H_ACCION='" . $accion . "'
                ORDER BY H_FECHA
                LIMIT 1;
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
             DATE_FORMAT(H_FECHA, '%H:%i') AS RESULTADO
                FROM tb_historial_mb
                WHERE 1=1
                    AND H_FECHA BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'
                    AND H_USUARIO='" . $ejecutivo . "'
                    AND H_ACCION='" . $accion . "'
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
                    AND DATE(H_FECHA)='" . $fecha . "'
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

    /**
     * 
     * @param type $accion
     * @param type $codigoejecutivo
     * @param type $fecha
     * @param type $ruta
     * @param type $horaInicio
     * @param type $horaFin
     * @return type
     */
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
            ,$accion = 'Inicio Visita'
            , $codigoCliente
            , $fechaInicio
            , $fechaFin
            , $horaInicio
            , $horaFin
            , $ruta) {
        $sql = "
              SELECT 
                   -- * -- count(distinct h_cod_cliente) as VISITASENRUTA
                   h_fecha
                   ,h_latitud AS LATITUDEJECUTIVO
                   ,h_longitud AS LONGITUDEJECUTIVO
                FROM tb_historial_mb
                WHERE 1=1
                    AND H_FECHA BETWEEN '".$fechaInicio."' AND '".$fechaFin."'
                    AND DATE_FORMAT(H_FECHA,'%H:%i') between '".$horaInicio."' AND '".$horaFin."'
                    AND H_USUARIO='".$codigoEjecutivo."'
                    AND H_ACCION='".$accion."'
                    AND H_RUTA='".$ruta."'
                    AND h_cod_cliente='".$codigoCliente."'
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
            select sum(rhd_valor) AS '" . $txt1 . "'
            from tb_resumen_historial_diario 
            where 1=1
            and date(rhd_fecha_historial)='" . $fecha . "' 
            and rhd_cod_ejecutivo='" . $codigoejecutivo . "'
            and rhd_parametro IN ('VISITAS-EFECTUADAS-EN-RUTA','VISITAS-FUERA-RUTA'); 
            ";
//        var_dump($sql1);die();
        $command = $this->connection->createCommand($sql1);
        $datos1 = $command->queryAll();
        $resultado [$txt1] = (isset($datos1[0])) ? intval($datos1[0][$txt1]) : 0;

        $sql2 = "
            select sum(rhd_valor) AS '" . $txt2 . "'
            from tb_resumen_historial_diario 
            where 1=1
            and date(rhd_fecha_historial)='" . $fecha . "' 
            and rhd_cod_ejecutivo='" . $codigoejecutivo . "'
            and rhd_parametro IN ('VISITAS-REPETIDAS');

            ";
        $command = $this->connection->createCommand($sql2);
        $datos2 = $command->queryAll();
        $resultado [$txt2] = (isset($datos2[0])) ? intval($datos2[0][$txt2]) : 0;

        $sql3 = "
            select sum(rhd_valor) AS '" . $txt3 . "'
            from tb_resumen_historial_diario 
            where 1=1
           and date(rhd_fecha_historial)='" . $fecha . "' 
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
