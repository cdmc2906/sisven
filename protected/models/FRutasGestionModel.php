<?php

class FRutasGestionModel extends DAOModel {

    public function getRutaxZona($codigoZona, $codigoUsuario) {
        $sql = "
           select  
                    a.rg_id as IDRUTA
                    ,a.rg_cod_ruta_mb as CODIGORUTA
                    ,a.rg_nombre_ruta as NOMBRERUTA
                    ,count(b.r_cod_cliente) as CLIENTESRUTA
                from tb_ruta_gestion as a
                    inner join tb_ruta_mb as b
                        on a.rg_cod_ruta_mb=b.r_ruta
                where 1=1
                    and a.zg_id=" . $codigoZona . "
                    and a.rg_id not in (select rg_id from tb_usuario_ruta where iduser =" . $codigoUsuario . ") 
                    group by 
                        a.rg_id
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
