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
class FChipsTransferidosModel extends DAOModel {

    public function getChipsNoFacturadosTransferidos() {
//        $anio = $datos['anio'];
//        var_dump(2);die();
        $sql = "
           select 
                date(VM_FECHA) as VM_FECHA
                ,VM_NOMBREDISTRIBUIDOR
                ,VM_IDDESTINO
                ,VM_NOMBREDESTINO
                ,vm_icc
                ,vm_min
            from tb_venta_movistar
            where vm_icc not in (select i_imei from tb_indicadores);
            ";
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }
}
