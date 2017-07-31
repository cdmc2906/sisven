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
class FDetalleDiarioHistorialModel extends DAOModel {
    /*
     * Obtiene el listado de mines vendidos por el vendedor segun la fecha.
     * 
     * El tipo de vendedor influye en los meses en los que se obtiene las ventas
     *  Vendedores (1) =Ventas 4 meses atrás de la fecha de calculo
     *  Mayoristas(2) = Ventas en el mes anterior al calculo de las comisiones
     */

    public function getCantidadDetallexVendedorxFecha($fechagestion, $ejecutivo) {
//        $anio = $datos['anio'];
        $sql = "
            select 
                    count(*) as registrosDetalle
                from tb_detalle_historial_diario
                where 1=1
                    and rh_fecha_ruta='" . $fechagestion . "'
                    and rh_codigo_vendedor='" . $ejecutivo . "';
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getItemDetallexVendedorxFecha($fechagestion, $ejecutivo) {
//        $anio = $datos['anio'];
        $sql = "
            select 
                    rh_id as codigo
                from tb_detalle_historial_diario
                where 1=1
                    and rh_fecha_ruta='" . $fechagestion . "'
                    and rh_codigo_vendedor='" . $ejecutivo . "';
            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

}
