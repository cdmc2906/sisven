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
class FVentasGrpModel extends DAOModel {

    public static function getFechaUltimaCarga() {
        $command1 = Yii::app()->db->createCommand("
        select 
            MAX(CONVERT(DATE,FECHA_INGRESO)) as ultimacarga
            from tececab.dbo.CHIP_VENTAS 
");

        $resultado1 = $command1->queryRow();

        return $resultado1['ultimacarga'];
    }
}
