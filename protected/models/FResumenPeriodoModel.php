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
class FResumenPeriodoModel extends DAOModel {

    public function getResumenxPeriodo($idPeriodo) {
        $sql = "
        select b.e_nombre as EJECUTIVO
           ,rhd_fecha_historial AS FECHA
           ,rhd_parametro AS PARAMETRO
           ,rhd_valor AS VALOR
        from tb_resumen_historial_diario as a
            inner join tb_ejecutivo as b
                on a.rhd_cod_ejecutivo=b.e_usr_mobilvendor
        where 1=1
            and a.pg_id=" . $idPeriodo . " 
        
        ;
            ";
//        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

}
