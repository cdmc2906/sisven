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
class FPeriodoGestionModel extends DAOModel {

    public function getPeriodos() {
        $sql = "
           SELECT 
                year(pg_fecha_inicio) AS ANIO
                ,CASE MONTH(pg_fecha_inicio) 
                    WHEN 1 THEN 'Ene'
                    WHEN 2 THEN 'Feb'
                    WHEN 3 THEN 'Mar'
                    WHEN 4 THEN 'Abr'
                    WHEN 5 THEN 'May'
                    WHEN 6 THEN 'Jun'
                    WHEN 7 THEN 'Jul'
                    WHEN 8 THEN 'Ago'
                    WHEN 9 THEN 'Sep'
                    WHEN 10 THEN 'Oct'
                    WHEN 11 THEN 'Nov'
                    ELSE 'Dic'
                    END
                    AS MES
                ,pg_id as ID
                ,pg_descripcion as PERIODO
                ,date(pg_fecha_inicio) AS INICIO 
                ,date (pg_fecha_fin) AS FIN
                ,b.est_nombre AS ESTADO

                FROM tb_periodo_gestion as a
                    inner join tb_estado as b
                    on a.pg_estado =b.est_id
                WHERE 1=1 
                   and pg_tipo='SEMANAL' 
;

            ";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

}
