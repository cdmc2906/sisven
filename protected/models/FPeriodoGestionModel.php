<?php

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
    
    public function getFechaInicioPrimerPeriodo() {
        $sql = "
            select 
                top 1 
                    pg_fecha_inicio as FECHA_INICIO
            from tb_periodo_gestion 
            order by pg_id;";
//   var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public static function getPeriodoActivoNotificacion() {
        unset(Yii::app()->session['idPeriodoAbierto']);
        unset(Yii::app()->session['fechaInicioPeriodo']);
        unset(Yii::app()->session['fechaFinPeriodo']);

        unset(Yii::app()->session['itemsFueraPeriodo']);

        $command1 = Yii::app()->db->createCommand("
          SELECT 
                pg_id as idperiodo,
                pg_fecha_inicio as fechainicio,
                pg_fecha_fin as fechafin,
                pg_descripcion as descripcion
            FROM tb_periodo_gestion
            WHERE 
            pg_estado=1
            and pg_tipo='SEMANAL';
            ");

        $resultado1 = $command1->queryRow();
//                var_dump($resultado1);die();
        $periodoAbierto = '';

        if ($resultado1) {

            $periodoAbierto = '(' . $resultado1['idperiodo'] . ') ' . $resultado1['descripcion'];

            Yii::app()->session['idPeriodoAbierto'] = $resultado1['idperiodo'];
            Yii::app()->session['fechaInicioPeriodo'] = $resultado1['fechainicio'];
            Yii::app()->session['fechaFinPeriodo'] = $resultado1['fechafin'];
        }

        return $periodoAbierto;
    }

}
