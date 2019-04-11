<?php

class FZonasGestionModel extends DAOModel {

    public function getInformacionZonasXPeriodo($idPeriodo) {
        $sql = "
            SELECT 
                    b.zg_tipo_zona as TIPOZONA,
                    b.ZG_ID as CODIGOZONA,
                    b.ZG_NOMBRE_ZONA as NOMBREZONA,
                    b.ZG_NOMB_EJECUTIVO_ASIGNADO AS EJECUTIVO,
                    COUNT(distinct a.RG_ID) as CANTIDADRUTAS,
                    count(c.r_cod_cliente)  as CANTIDADCLIENTES
                FROM tb_ruta_gestion as a
                    inner join tb_zonas_gestion as b
                        on a.zg_id=b.zg_id
                    inner join tb_ruta_mb as c
                        on a.rg_cod_ruta_mb=c.r_ruta
                WHERE 1=1
                    and c.pg_id=" . $idPeriodo . "
                    --and c.pg_id=28
                GROUP by
                    b.zg_tipo_zona,
                    b.zg_id,
                    b.ZG_NOMBRE_ZONA,
                    b.ZG_NOMB_EJECUTIVO_ASIGNADO
                ORDER BY 1,2
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
