<?php

class FRevisionMinesModel extends DAOModel {

    /**
     * Obtiene los mines asignados al agente
     * 
     * @param type $codigoUsuario Id del usuario logeado
     * @return type Respuesta de datos de bdd
     */
    public function getResultadosxCarga($codigoCarga) {
        $sql = "
                select 
                    b.nombreUsuario as AGENTE
                    ,date(c.miva_fecha) as FECHA_INDICADOR
                    ,concat(CHAR(39),a.rmva_min) as MIN
                    ,concat(CHAR(39),a.rmva_icc) as ICC
                    ,a.rmva_numero_revision as REVISION
                    ,c.miva_vendedor as VENDEDOR
                    ,a.rmva_fecha_gestion as FECHAGESTION
                    ,a.rmva_resultado_llamad as RESULTADO
                    ,a.rmva_motivo_no_contado as MOTIVONC
                    ,a.rmva_operadora as OPERADORA
                    ,a.rmva_lugar_compra as LUGARCOMPRA
                    ,ROUND(a.rmva_precio, 1)  as PRECIO
                    ,CASE a.rmva_motivo_no_contado 
                           WHEN a.rmva_motivo_no_contado =\"Inactivo\" THEN \"Activo\"
                           ELSE \"Inactivo\" END as ESTADO
                    ,day(a.rmva_fecha_gestion) as DIA
                    ,hour(a.rmva_fecha_gestion) as HORA 
                from tb_revision_mines as a
                    inner join cruge_user as b
                        on a.iduser=b.iduser
                    inner join tb_mines_validacion as c
                        on a.rmva_icc=c.miva_imei
                where 1=1 
                    and a.rmva_carga=" . $codigoCarga . "
                order by a.rmva_fecha_gestion
                   ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }
    
    public function getResultadosxPeriodo($mes) {
        $sql = "
                select 
                    d.cir_codigo as CARGA
                    ,b.nombreUsuario as AGENTE
                    ,date(c.miva_fecha) as FECHA_INDICADOR
                    ,concat(CHAR(39),a.rmva_min) as MIN
                    ,concat(CHAR(39),a.rmva_icc) as ICC
                    ,a.rmva_numero_revision as REVISION
                    ,c.miva_vendedor as VENDEDOR
                    ,a.rmva_fecha_gestion as FECHAGESTION
                    ,a.rmva_resultado_llamad as RESULTADO
                    ,a.rmva_motivo_no_contado as MOTIVONC
                    ,a.rmva_operadora as OPERADORA
                    ,a.rmva_lugar_compra as LUGARCOMPRA
                    ,ROUND(a.rmva_precio, 1)  as PRECIO
                    ,CASE a.rmva_motivo_no_contado 
                           WHEN a.rmva_motivo_no_contado =\"Inactivo\" THEN \"Activo\"
                           ELSE \"Inactivo\" END as ESTADO
                    ,day(a.rmva_fecha_gestion) as DIA
                    ,hour(a.rmva_fecha_gestion) as HORA 
                from tb_revision_mines as a
                    inner join tb_carga_informacion_revision as d
                            on a.rmva_carga=d.cir_codigo
                    inner join cruge_user as b
                        on a.iduser=b.iduser
                    inner join tb_mines_validacion as c
                        on a.rmva_icc=c.miva_imei
                where 1=1 
                    and month(d.cir_fecha_ingreso)=" . $mes . "
                order by a.rmva_fecha_gestion
                   ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getFechaUltimaGestionxUsuarioxCarga($idUsuario, $numeroCarga) {
        $sql = "
                select 
                    date(rmva_fecha_gestion) as FECHA
                    from tb_revision_mines
                    where 1=1
                    and iduser=" . $idUsuario . "
                    and rmva_carga=" . $numeroCarga . "
                    order by rmva_fecha_gestion desc
                    limit 1
;
                   ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getUltimaGestionxIcc($iccmin) {
        $sql = "
               select 
                    rmva_estado_revision 
                from 
                    tb_revision_mines
                where 1=1
                    and rmva_icc='" . $iccmin . "'
                order by rmva_numero_revision desc
                limit 1;

            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getCantidadGestionxUsuarioxCargaxAgrupadoFecha($codigoUsuario, $numeroCarga) {
        $sql = "
            select 
                count(*) as cantidad
                ,date(rmva_fecha_gestion) as fecha
            from tb_revision_mines as a
            where 1=1
                and iduser=" . $codigoUsuario . "
                and rmva_carga=" . $numeroCarga . "
            group by date(rmva_fecha_gestion)
            ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getCantidadGestionxUsuarioxCargaxAgrupadoHora($codigoUsuario, $numeroCarga) {
        $sql = "
            select 
                count(*) as cantidad
                ,CAST(date_format(rmva_fecha_gestion,\"%H\")AS UNSIGNED) as hora
            from tb_revision_mines as a
            where 1=1
                and iduser=" . $codigoUsuario . "
                and rmva_carga=" . $numeroCarga . "
            group by date_format(rmva_fecha_gestion,\"%H\")
            ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getFechasGestionxCarga($numeroCarga) {
        $sql = "
            select distinct date(rmva_fecha_gestion) as fecha
            from tb_revision_mines as a
            where 1=1
            and rmva_carga=" . $numeroCarga . "
            ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getHorasGestionxCarga($numeroCarga) {
        $sql = "
            select distinct cast(date_format(rmva_fecha_gestion,'%H') as unsigned) as hora
            from tb_revision_mines as a
            where 1=1
            and rmva_carga=" . $numeroCarga . "
            order by 1            
            ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getUsuariosGestionxCarga($numeroCarga) {
        $sql = "
            select 
                    distinct a.iduser as idusuario
                    ,b.nombreUsuario as nombreusuario
                from tb_revision_mines as a
                    inner join cruge_user	as b
                        on a.iduser=b.iduser
                where 1=1
                    and rmva_carga=" . $numeroCarga . "
            ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

}
