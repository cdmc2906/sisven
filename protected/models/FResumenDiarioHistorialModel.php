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
class FResumenDiarioHistorialModel extends DAOModel {
    /*
     * Obtiene el listado de mines vendidos por el vendedor segun la fecha.
     * 
     * El tipo de vendedor influye en los meses en los que se obtiene las ventas
     *  Vendedores (1) =Ventas 4 meses atrás de la fecha de calculo
     *  Mayoristas(2) = Ventas en el mes anterior al calculo de las comisiones
     */

    public function getCantidadResumenxVendedorxFecha($fechagestion, $ejecutivo) {
//        $anio = $datos['anio'];
        $sql = "
            select 
                    count(*) as  registrosResumen
                from tb_resumen_historial_diario
                where 1=1
                    and rhd_fecha_historial='" . $fechagestion . "'
                    and rhd_cod_ejecutivo='" . $ejecutivo . "';
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getItemResumenxVendedorxFecha($fechagestion, $ejecutivo) {
//        $anio = $datos['anio'];
        $sql = "
            select 
                    rhd_fecha_historial
                    ,rhd_cod_ejecutivo
                from tb_resumen_historial_diario
                where 1=1
                    and rhd_fecha_historial='" . $fechagestion . "'
                    and rhd_cod_ejecutivo='" . $ejecutivo . "';
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getCumplimientoxVendedorxFecha($fechagestion, $ejecutivo) {
//        $anio = $datos['anio'];
        $sql = "
            select 
                    rhd_valor as cumplimiento
                from tb_resumen_historial_diario
                where 1=1
                    and rhd_fecha_historial='" . $fechagestion . "'
                    and rhd_cod_ejecutivo='" . $ejecutivo . "';
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getItemResumenxVendedorxRangoFechaxSemana($fechaInicioGestion, $fechaFinGestion, $ejecutivo, $semana) {
        $sql = "
            select 
                    rhd_fecha_historial,
                    rhd_parametro,
                    rhd_valor,
                    rhd_semana,
                    rhd_observacion_supervisor
                from tb_resumen_historial_diario
                where 1=1
                    and rhd_fecha_historial between '" . $fechaInicioGestion . "' and '" . $fechaFinGestion . "'
                    and rhd_semana=" . $semana . "
                    and rhd_cod_ejecutivo='" . $ejecutivo . "';
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getDatosRevisionesEjecutivo($fechaInicioGestion, $fechaFinGestion, $ejecutivo) {
        $sql = "
            select distinct date(drh_fecha_ruta) as fecha_gestion 
                from tb_detalle_revision_historial 
                where 1=1 
                    and drh_fecha_ruta between '" . $fechaInicioGestion . "' and '" . $fechaFinGestion . "'
                    and drh_codigo_ejecutivo ='" . $ejecutivo . "'
                order by drh_fecha_ruta 
                ;";
//           var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getValoresRevisionesEjecutivo($fechaHistorial, $parametro, $ejecutivo) {
//        var_dump($fechaHistorial);die();
        $sql = "
            select 
                    rhd_valor as valor
                from tb_resumen_historial_diario 
                where 1=1
                    and date(rhd_fecha_historial) ='" . $fechaHistorial . "'
                    and rhd_parametro ='" . $parametro . "'
                    and rhd_cod_ejecutivo='" . $ejecutivo . "'
                    ;
            ";
//        $sql = "
//            select 
//                    rhd_fecha_historial
//                    ,rhd_parametro
//                    ,rhd_valor
//                from tb_resumen_historial_diario 
//                where 1=1
//                    and rhd_fecha_historial between '" . $fechaInicioGestion . "' and '" . $fechaFinGestion . "'
//                    and rhd_cod_ejecutivo='" . $ejecutivo . "'
//                    ;
//            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

}
