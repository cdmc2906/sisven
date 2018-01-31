<?php

class FNovedadesClienteModel extends DAOModel {

    public function getEstadosNovedadesxCliente($codigoCliente) {
        $sql = "
           SELECT 
                    c.est_id as idestado
                    ,c.est_nombre as estado
                    ,count(ncli_estado) as cantidad 
                FROM tb_novedad_cliente as a
                    inner join tb_cliente as b
                            on a.cli_codigo=b.cli_codigo
                    inner join tb_estado as c
                            on a.ncli_estado=c.est_id
                where 1=1
                    and b.cli_codigo_cliente='TCQU210002'
                    and c.est_id not in (3,7)
                group by ncli_estado
                order by ncli_estado
                ;
                /*
                    3->Eliminada
                    4->Ingresada
                    5->Asignada
                    6->Solucionada
                    7->Cerrada
                */
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump(1);        die();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }
    
    public function getHistorialNovedadesxCliente($codigoCliente) {
        $sql = "
           select
                    a.ncli_id as IDNOVEDAD
                    ,date(a.ncli_fecha_ingreso) as FECHAINGRESO
                    ,d.nov_descripcion as NOVEDAD
                    ,a.ncli_observacion as DETALLENOVEDAD
                    ,f.est_nombre as ESTADO
                    ,IFNULL(c.username,'SIN ASIGNAR') as RESPONSABLE
                    ,''  as DESIGNACION
                    ,IFNULL(date(g.snov_fecha_solucion),'SIN SOLUCION') as FECHASOLUCION
                    ,IFNULL(g.snov_solucion,'SIN SOLUCION') as SOLUCION
                from 
                    tb_novedad_cliente as a
                    left join tb_asignacion_novedad as b
                            on a.ncli_id = b.ncli_id
                    left join cruge_user as c
                            on b.iduser=c.iduser
                    left join tb_solucion_novedad as g
                            on a.ncli_id=g.ncli_id
                    inner join tb_novedades as d
                            on a.nov_id=d.nov_id
                    inner join tb_cliente as e
                            on a.cli_codigo=e.cli_codigo
                    inner join tb_estado as f
                            on a.ncli_estado=f.est_id
                where 1=1
                    and e.cli_codigo_cliente='".$codigoCliente."'
                order by a.ncli_fecha_modifica desc;
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
