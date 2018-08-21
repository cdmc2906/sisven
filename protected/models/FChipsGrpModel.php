<?php

class FChipsGrpModel extends DAOModel {

    public static function getUsuarios() {
        $command1 = Yii::app()->db_grp->createCommand("
            select * 
            from CHIP_BASE_COMISION
            where icc ='8959300620515783190'");

        $resultado1 = $command1->queryRow();
//                var_dump($resultado1);die();
        $ultimacarga = $resultado1;

        return $ultimacarga;
    }

    
}
