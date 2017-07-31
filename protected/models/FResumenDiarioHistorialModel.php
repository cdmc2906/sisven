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
                    rhd_codigo as codigo
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

}
