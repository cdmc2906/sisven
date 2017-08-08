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

    public function getHistorialxVendedorxFecha($fechagestion, $ejecutivo) {
        $sql = "
           select 
                    date(h_fecha) as fechavisita
                    ,h_cod_cliente as codigocliente
                    ,h_nom_cliente as nombrecliente
                    ,h_ruta as rutavisita
                    ,h_latitud as latitud
                    ,h_longitud as longitud
                from tb_historial_mb
                where 1=1
                   and date(h_fecha) ='" . $fechagestion . "'
                    and h_usuario='" . $ejecutivo . "'
                    and h_accion='inicio visita'
                order by h_fecha ;

            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getHistorialxVendedorxFechaxHoraInicioxHoraFin($fechagestion, $horaInicio, $horaFin, $ejecutivo) {
//        $anio = $datos['anio'];
//        $horaInicio = '10:00';
        $fechaInicio = $fechagestion . ' ' . $horaInicio;
        $fechaFin = $fechagestion . ' ' . $horaFin;
//        var_dump($fechaInicio, $fechaFin);        die();
        $sql = "
            select 
                    date_format(h_fecha, '%y-%m-%d %h:%i') as FECHAVISITA
                    ,h_cod_cliente as CODIGOCLIENTE
                    ,h_nom_cliente as NOMBRECLIENTE
                    ,h_ruta as RUTAVISITA
                    ,h_latitud as LATITUD
                    ,h_longitud as LONGITUD
                from tb_historial_mb
                where 1=1
                    and h_fecha between '" . $fechaInicio . "' and '" . $fechaFin . "'
                    and h_usuario='" . $ejecutivo . "'
                    and h_accion='inicio visita'
                order by h_fecha
;
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getPrimeraVisitaxEjecutivoxFechaxHoraInicioxHoraFin($fechagestion, $horaInicio, $horaFin, $ejecutivo) {
        $fechaInicio = $fechagestion . ' ' . $horaInicio;
        $fechaFin = $fechagestion . ' ' . $horaFin;
        $sql = "
            select 
             date_format(h_fecha, '%h:%i') as RESULTADO
                from tb_historial_mb
                where 1=1
                    and h_fecha between '" . $fechaInicio . "' and '" . $fechaFin . "'
                    and h_usuario='" . $ejecutivo . "'
                    and h_accion='inicio visita'
                order by h_fecha
                limit 1;
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getUltimaVisitaxEjecutivoxFechaxHoraInicioxHoraFin($fechagestion, $horaInicio, $horaFin, $ejecutivo) {
        $fechaInicio = $fechagestion . ' ' . $horaInicio;
        $fechaFin = $fechagestion . ' ' . $horaFin;
        $sql = "
           select 
             date_format(h_fecha, '%h:%i') as RESULTADO
                from tb_historial_mb
                where 1=1
                    and h_fecha between '" . $fechaInicio . "' and '" . $fechaFin . "'
                    and h_usuario='" . $ejecutivo . "'
                    and h_accion='inicio visita'
                order by h_fecha desc
                limit 1
;
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getHistorialxVendedorxRangoFecha($fechaInicio, $fechaFin, $ejecutivo) {
//        $anio = $datos['anio'];
        $sql = "
            select 
                    date(h_fecha) as FECHAVISITA
                    ,h_cod_cliente as CODIGOCLIENTE
                    ,h_nom_cliente as NOMBRECLIENTE
                    ,h_ruta as RUTAVISITA
                    ,h_latitud as LATITUD
                    ,h_longitud as LONGITUD
                from tb_historial_mb
                where 1=1                    
                    and date(h_fecha) between '" . $fechaInicio . "' and '" . $fechaFin . "'
                    and h_usuario='" . $ejecutivo . "'
                    and h_accion='inicio visita'
                order by h_fecha
 ;
            ";
        var_dump($sql);
        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getHistorialxVendedorxRangoFechaxHoraInicioxHoraFin($fechaInicio, $horaInicio, $horaFin, $fechaFin, $ejecutivo) {
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
                    AND H_ACCION='Inicio visita'
                ORDER BY H_FECHA ;
            ";
        var_dump($sql);
        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getHistorialVisitaxEjecutivoxClientexFecha($codigoejecutivo, $codigocliente, $fecha) {
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
                    AND H_ACCION='Inicio visita'
                ORDER BY H_FECHA ;
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

}
