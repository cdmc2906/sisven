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

    public static function getFechaUltimaCarga() {
        $command1 = Yii::app()->db->createCommand("
         select  
                MAX(CONVERT(DATE,tm_fecha_ingreso))  as ultimacarga
            from tcc_control_ruta.dbo.tb_transferencia_movistar
");

        $resultado1 = $command1->queryRow();

        return $resultado1['ultimacarga'];
    }

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

    public function getLotexICC($iccBuscar) {
        $sql = "
            select 
                tm_numero_lote 
                from tb_transferencia_movistar 
                where tm_icc='" . $iccBuscar . "';
                
            ";
//        var_dump($sql);die();   

        $command = $this->connection->createCommand($sql);

        $data = $command->queryAll();
        $this->Close();
        return $data;
    }

}
