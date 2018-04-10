<?php

class FCargasInformacionModel extends DAOModel {

    /**
     * Obtiene los mines asignados al agente
     * 
     * @param type $codigoUsuario Id del usuario logeado
     * @return type Respuesta de datos de bdd
     */
    public function getNumeroUltimaCarga() {

        $sql = "select max(cir_codigo) as ultimacarga FROM tb_carga_informacion_revision;";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getDatosCargas() {

        $sql = "
        select 	
                a.cir_codigo as CARGA
                , DATE_FORMAT(a.cir_fecha_ingreso,\"%Y\-%m-%d %H:%i\") AS FECHA
                , a.cir_registros_cargados as REGISTROS
                , b.est_nombre as ESTADO
            from tb_carga_informacion_revision as a
                inner join tb_estado as b
                    on a.cir_estado =b.est_id
            order by a.cir_nombre
;
            ;";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getDatosPeriodosCargas() {

        $sql = "
            select 
                month(cir_fecha_ingreso) as IDMES
                ,ELT(DATE_FORMAT(cir_fecha_ingreso,'%m'),
                    'Enero','Febrero','Marzo',
                    'Abril','Mayo','Junio',
                    'Julio','Agosto','Septiembre',
                    'Octubre','Noviembre','Diciembre') as MES
                ,count(*) as CARGAS
                ,sum(cir_registros_cargados) as REGISTROS
            from tb_carga_informacion_revision
            group by month(cir_fecha_ingreso);
            ;";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getDatosCargasxMes($mes) {

        $sql = "
        select 	
                a.cir_codigo as CARGA
                , DATE_FORMAT(a.cir_fecha_ingreso,\"%Y\-%m-%d %H:%i\") AS FECHA
                , a.cir_registros_cargados as REGISTROS
                , b.est_nombre as ESTADO
            from tb_carga_informacion_revision as a
                inner join tb_estado as b
                    on a.cir_estado =b.est_id
            where month(a.cir_fecha_ingreso)=" . $mes . "
            order by a.cir_nombre
            ;";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getFechaCargaxCarga($numeroCarga) {

        $sql = "
        select 	
                -- DATE_FORMAT(a.cir_fecha_ingreso,\"%Y\-%m-%d %H:%i\") AS FECHA
                date(a.cir_fecha_ingreso) AS FECHA
            from tb_carga_informacion_revision as a
            where a.cir_codigo=" . $numeroCarga . "
            ;";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

}
