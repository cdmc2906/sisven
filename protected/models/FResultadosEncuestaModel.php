<?php

class FResultadosEncuestaModel extends DAOModel {

    public function getEstadoAnteriorEncuestaxCliente($codigoCliente) {
        $sql = "
           select a.renc_resultado as resultado
                from 
                    tb_resultados_encuesta as a
                    inner join tb_cliente as b
                        on a.cli_codigo=b.cli_codigo
                where 1=1
                    and b.cli_codigo_cliente='".$codigoCliente."'
                    and a.encp_id=1 -- 1 ES EL ID DE LA PREGUNTA 1 (ESTADO LLAMADA) ASIGNADA A LA ENCUESTA 1
                order by a.renc_fecha_ingreso desc
                limit 1
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
