<?php

class FRutaEjecutivoModel extends DAOModel {

    public function getCantidadRutasAsignadasXEjecutivoXFechaInicioFechaFin($ejecutivo, $fechaInicio, $fechaFinPeriodo) {
        $sql = "
            select COUNT(*) as cantidad_rutas
                from tb_ejecutivo_ruta as a
                    inner join tb_ruta_mb as b
                        on a.er_ruta=b.r_ruta
                where 1=1 
                    and er_usuario='" . $ejecutivo . "' 
                    and er_estado =1
                    and b.pg_id in  (
                            select 
                                distinct pg_id 
                            from tb_historial_mb as c 
                            where 1=1 
                                and convert(date,c.h_fecha) between '" . $fechaInicio . "' and '" . $fechaFinPeriodo . "')
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
