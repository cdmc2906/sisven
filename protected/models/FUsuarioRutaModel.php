<?php

class FUsuarioRutaModel extends DAOModel {

    public function getRutasAsignadasxUsuario($codigoUsuario) {
        $sql = "
            select 
                a.ur_id as CODIGOUSUARIORUTA
                ,d.zg_nombre_zona as ZONA
                ,a.rg_id as IDRUTA
                ,b.rg_cod_ruta_mb as CODIGORUTA
                ,b.rg_nombre_ruta as NOMBRERUTA
                ,count(c.r_cod_cliente) as CLIENTESRUTA
            from tb_usuario_ruta as a
                inner join tb_zonas_gestion as d
                    on a.ur_zona_gestion=d.zg_id
                inner join tb_ruta_gestion as b
                    on a.rg_id	=b.rg_id
                inner join tb_ruta_mb as c
                    on b.rg_cod_ruta_mb=c.r_ruta
            where a.iduser =" . $codigoUsuario . "
            group by 
                a.ur_zona_gestion
                ,a.rg_id
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
