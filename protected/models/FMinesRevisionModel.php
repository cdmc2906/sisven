<?php

class FMinesRevisionModel extends DAOModel {

    public function getMinesxUsuario($codigoUsuario) {
        $sql = '';
        if ($codigoUsuario == 1) {
            $sql = "
            SELECT 
                    a.miva_id as IDMIN
                    ,a.miva_imei as IMEI
                    ,a.miva_min as MIN
                    ,a.miva_vendedor as VENDEDOR
                FROM tb_mines_validacion as a
                where 1=1
                    and a.miva_estado in( 8,13) -- CARGADO,REPROCESAR
                    ;
        ";
        } else {
            $sql = "
            SELECT 
                    a.miva_id as IDMIN
                    ,a.miva_imei as IMEI
                    ,a.miva_min as MIN
                    ,a.miva_vendedor as VENDEDOR
                FROM tb_mines_validacion as a
                where 1=1
                    and a.iduser=" . $codigoUsuario . "
                    and a.miva_estado in( 8,13) -- CARGADO,REPROCESAR
                    ;
            ";
        }
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getMinesSinGestionarxCarga($numeroCarga) {
        $sql = "
            SELECT 
                    concat(CHAR(39),a.miva_min) as MIN
                    ,concat(CHAR(39),a.miva_imei) as ICC
                    ,miva_vendedor as VENDEDOR
                    ,miva_estado as CODIGO_ESTADO
                    ,b.est_nombre as ESTADO
                    ,c.nombreUsuario as AGENTE_ASIGNADO
                FROM tb_mines_validacion as a
                inner join tb_estado as b
                on a.miva_estado=b.est_id
                inner join cruge_user as c
                on a.iduser=c.iduser
                where 1=1
                and a.cir_id=".$numeroCarga."
                and a.miva_estado in (8,13) -- ESTADOS CARGADO, REPROCESAR
                ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getCantidadMinesSinGestionarxUsuario($codigoUsuario) {
        $sql = '';
        if ($codigoUsuario == 1) {
            $sql = "
            SELECT 
                count(*) as asignados
                FROM tb_mines_validacion as a
                where 1=1
                    and a.miva_estado in (8,13) -- ESTADOS CARGADO, REPROCESAR
                    ;
            ";
        } else {
            $sql = "
            SELECT 
                    count(*) as asignados
                FROM tb_mines_validacion as a
                where 1=1
                    and a.iduser=" . $codigoUsuario . "
                    and a.miva_estado in (8,13) -- ESTADOS CARGADO, REPROCESAR
                    ;
            ";
        }
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getCantidadMinesAsignadosxUsuario($codigoUsuario) {
        $sql = '';
        if ($codigoUsuario == 1) {
            $sql = "
            SELECT 
                count(*) as asignados
                FROM tb_mines_validacion as a
                where 1=1
                    and a.miva_estado in (8,9) -- ESTADOS CARGADO
                    ;
            ";
        } else {
            $sql = "
            SELECT 
                    count(*) as asignados
                FROM tb_mines_validacion as a
                where 1=1
                    and a.iduser=" . $codigoUsuario . "
                    and a.miva_estado in (8,9) -- ESTADOS CARGADO
                    ;
            ";
        }
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getCantidadMinesGestionadosxUsuario($codigoUsuario) {
        $sql = "";
        if ($codigoUsuario == 1) {
            $sql = "
            SELECT 
                    count(*) as gestionados
                FROM tb_mines_validacion as a
                where 1=1
                    and a.miva_estado in (9) -- ESTADOS GESTIONADO
                    ;
        ";
        } else {
            $sql = "
            SELECT 
                    count(*) as gestionados
                FROM tb_mines_validacion as a
                where 1=1
                    and a.iduser=" . $codigoUsuario . "
                    and a.miva_estado in (9) -- ESTADOS GESTIONADO
                    ;
        ";
        }
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getCantidadMinesAsignadosxUsuarioxCarga($codigoUsuario, $numeroCarga) {
        $agregadosOriginal = 0;
        $sqlAsignados = "
            SELECT 
                    count(*) as asignados
                FROM tb_mines_validacion as a
                where 1=1
                    and a.iduser=" . $codigoUsuario . "
                    and a.miva_estado_reasignacion=0
                    and a.miva_carga=" . $numeroCarga . "
                    ;
            ";
//        var_dump($sqlAsignados);        die();
        $command = $this->connection->createCommand($sqlAsignados);
        $data1 = $command->queryAll();
        $agregadosOriginal = intval($data1[0]['asignados']);

        $eliminados = 0;
        $sqlEliminados = "
            SELECT 
                    count(*) as desasignados
                FROM tb_mines_validacion as a
                where 1=1
                    and a.miva_estado_reasignacion=1
                    and a.miva_usario_reasignado=" . $codigoUsuario . "
                    and a.miva_carga=" . $numeroCarga . "
                    ;
            ";
//        var_dump($sqlEliminados);        die();
        $command = $this->connection->createCommand($sqlEliminados);
        $data2 = $command->queryAll();
        $eliminados = intval($data2[0]['desasignados']);

//        var_dump($agregadosOriginal,$eliminados);        die();
        $this->Close();
        return $agregadosOriginal + $eliminados;
    }

    public function getCantidadMinesReAsignadosxUsuarioxCarga($codigoUsuario, $numeroCarga) {
        $agregados = 0;
        $sqlAgregados = "
                select count(*) as agregados
                    from tb_mines_validacion 
                    where 1=1
                        and miva_estado_reasignacion=1
                        and miva_carga =" . $numeroCarga . "
                        and iduser=" . $codigoUsuario . "
;
            ";
//        var_dump($sqlAgregados);die();
        $agregados = $this->connection->createCommand($sqlAgregados)->queryAll()[0]['agregados'];

        $desasignados = 0;
        $sqlDesasignados = "
                select count(*) as eliminados
                    from tb_mines_validacion 
                    where 1=1
                        and miva_estado_reasignacion=1
                        and miva_carga =" . $numeroCarga . "
                        and miva_usario_reasignado=" . $codigoUsuario . "
;
            ";
//        var_dump($sqlDesasignados);die();
        $desasignados = $this->connection->createCommand($sqlDesasignados)->queryAll()[0]['eliminados'];
//            var_dump($agregados - $desasignados);die();
        $this->Close();

        return ($agregados - $desasignados);
    }

    public function getCantidadMinesGestionadosxUsuarioxCarga($codigoUsuario, $numeroCarga) {
//        $sql = "
//             select count(rmva_id) as gestionados
//                from tb_revision_mines
//                where iduser=" . $codigoUsuario . "
//                    and rmva_carga=" . $numeroCarga . "
//                    and rmva_numero_revision=1
//                    ;
//            ";
        $sql = "
             select count(miva_id) as gestionados
                from tb_mines_validacion
                where iduser=" . $codigoUsuario . "
                    and cir_id=" . $numeroCarga . "
                    and miva_estado in (9,14)
                    ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getNumeroUltimaCarga() {

        $sql = "
            SELECT max(cir_codigo) as ultimacarga
            FROM tb_carga_informacion_revision
            ;";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getUsuariosxCarga($numeroCarga) {

        $sql = "
            select 
                distinct a.iduser as codigo 
                ,b.nombreUsuario as nombreusuario
            from tb_mines_validacion as a
            inner join cruge_user as b
            on a.iduser =b.iduser
            where miva_carga=" . $numeroCarga . "
 union distinct 
            select 
                distinct a.miva_usario_reasignado codigo 
                ,b.nombreUsuario as nombreusuario
            from tb_mines_validacion as a
            inner join cruge_user as b
            on a.miva_usario_reasignado =b.iduser
            where 1=1
            and a.miva_carga=" . $numeroCarga . "
            and a.miva_usario_reasignado is not null
;";

//        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

}
