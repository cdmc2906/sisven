<?php

class FRutasGestionModel extends DAOModel {

    public function getRutaxZona($codigoZona, $codigoUsuario, $idPeriodo, $tipoUsuario) {
        if ($tipoUsuario == 1)
            $sql = "
           select  
                    a.rg_id as IDRUTA
                    ,a.rg_cod_ruta_mb as CODIGORUTA
                    ,a.rg_nombre_ruta as NOMBRERUTA
                    ,b.r_semana as SEMANA
                    ,count(b.r_cod_cliente) as CLIENTESRUTA
                from tb_ruta_gestion as a
                    inner join tb_ruta_mb as b
                        on a.rg_cod_ruta_mb=b.r_ruta
                where 1=1
                    and a.zg_id=" . $codigoZona . "
                    and a.rg_id not in (select rg_id from tb_usuario_ruta where iduser =" . $codigoUsuario . ") 
                    and b.pg_id =" . $idPeriodo . "
                    --and b.pg_id =28
                group by 
                        a.rg_id,
                        a.rg_cod_ruta_mb,
                        a.rg_nombre_ruta,
                        b.r_semana
                ORDER BY CODIGORUTA,SEMANA
                ;
            ";
        elseif ($tipoUsuario == 2)
            $sql = "
                
                select  
                        a.rg_id as IDRUTA
                        ,a.rg_cod_ruta_mb as CODIGORUTA
                        ,a.rg_nombre_ruta as NOMBRERUTA
                        ,b.r_semana as SEMANA
                        ,b.r_dia as DIA
                        ,count(b.r_cod_cliente) as CLIENTESRUTA
                    from 
                        tb_ruta_gestion as a
                            inner join tb_ruta_mb as b
                                on a.rg_cod_ruta_mb=b.r_ruta
                    where 1=1
                        and a.zg_id=" . $codigoZona . "
                        and convert(varchar(10),a.rg_id)+convert(varchar(10),b.r_semana)not in 
                        (select convert(varchar(10),rg_id)+convert(varchar(10),er_semana_visitar) from tb_ejecutivo_ruta where e_cod =" . $codigoUsuario . ") 
                        and b.pg_id =" . $idPeriodo . "
                        --and b.pg_id =28
                    group by 
                            a.rg_id,
                            a.rg_cod_ruta_mb,
                            a.rg_nombre_ruta,
                            b.r_semana,
                            b.r_dia
                    ORDER BY CODIGORUTA,SEMANA,DIA
                ;
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump(1);        die();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

}
