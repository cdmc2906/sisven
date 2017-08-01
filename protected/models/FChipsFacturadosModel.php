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
class FChipsFacturadosModel extends DAOModel {

    public function getChipsFacturadosNoTransferidos() {
//        $anio = $datos['anio'];
//        var_dump(2);die();
        $sql = "
           select 
                date(i_fecha) as i_fecha
                ,i_bodega
                ,I_CODIGO_GRUPO
                ,I_NOMBRE_CLIENTE
                ,i_min
                , i_imei 
            from tb_indicadores
            where 1=1
                AND i_imei not in 
                    (select vm_icc from tb_venta_movistar)
                AND i_estado_icc='ICC OK'
                ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }
}
