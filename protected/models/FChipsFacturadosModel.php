<?php

class FChipsFacturadosModel extends DAOModel {

    public function getChipsFacturadosNoTransferidos() {
        $sql = "
           select 
                -- date(i_fecha) as i_fecha
                ".FuncionesBaseDatos::convertToDate('sqlsrv', 'i_fecha')." as i_fecha
                ,i_bodega
                ,I_CODIGO_GRUPO
                ,I_NOMBRE_CLIENTE
                ,i_min
                ,i_imei 
                -- ,tm_numero_lote as tm_lote
            from tb_indicadores
                -- inner join tb_transferencia_movistar
                -- on  tb_indicadores.i_imei=tb_transferencia_movistar.tm_icc
            where 1=1
                AND i_imei not in 
                    (select vm_icc from tb_venta_movistar)
                AND i_estado_icc='ICC OK'
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
