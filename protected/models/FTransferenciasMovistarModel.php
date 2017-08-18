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
class FTransferenciasMovistarModel extends DAOModel {

    public function getDatosMinxICC($iccBuscar) {
        $sql = "
           select 
                tm_nombredestino
                ,tm_fecha 
            from tb_transferencia_movistar 
            where tm_icc ='" . $iccBuscar . "';
            ";
//        var_dump($sql);die();   
        $command = $this->connection->createCommand($sql);
        
        $data = $command->queryAll();
        $this->Close();
        return $data;
    }

}
