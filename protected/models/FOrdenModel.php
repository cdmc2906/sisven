<?php

class FOrdenModel extends DAOModel {

    public static function getFechaUltimaCarga() {
        $command1 = Yii::app()->db->createCommand("
           select MAX(o_fch_ingreso) as ultimacarga from tb_ordenes_mb");

        $resultado1 = $command1->queryRow();
        $ultimacarga = $resultado1['ultimacarga'];

        return $ultimacarga;
    }

    public function getFechaUltimaCompraxCliente($codigo_cliente) {
        $sql = "
            select date(a.o_fch_creacion) as fechaultimaventa
                from tb_ordenes_mb as a
                where 1=1
                    and a.o_cod_cliente='TCQU210002'
                order by a.o_fch_creacion desc
                limit 1;
            ";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

    /*
     * Búsqueda del total de chips vendidos a cliente por fecha por ejecutivo
     * 1.- obtiene la fecha de la ultima visita
     * 2.- de no tener fin la ultima visita se obtiene 
     * los pedidos un minutos despues de la orden
     * 
     */

    public function getChipsxClientexEjecutivoxFecha($codigo_cliente, $codEjecutivo, $fechaOrden) {
        $sql = "
            SELECT
                    CAST(COALESCE(SUM(O_SUBTOTAL/" . PRECIO_UNITARIO_PRODUCTO_CHIP_MOVI . "),0) AS int)AS CHIPS                          
                FROM tb_ordenes_mb 
                WHERE 1=1  
                    AND O_USUARIO='" . $codEjecutivo . "'
                    AND O_COD_CLIENTE='" . $codigo_cliente . "'
                    AND " . FuncionesBaseDatos::convertToDate('sqlsrv', 'O_FCH_CREACION') . "='" . $fechaOrden . "';";
//                    AND DATE(O_FCH_CREACION)='" . $fechaOrden . "';";
//        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

    /*
     * Búsqueda del total de chips vendidos a cliente por fecha
     * 1.- obtiene la fecha de la ultima visita
     * 2.- de no tener fin la ultima visita se obtiene 
     * los pedidos un minutos despues de la orden
     * 
     */

    public function getChipsxClientexFecha($codigo_cliente, $fechaOrden) {

        $sql = "
            SELECT 
                    CAST(COALESCE(SUM(O_SUBTOTAL/" . PRECIO_UNITARIO_PRODUCTO_CHIP_MOVI . "),0) AS DECIMAL(6,2))AS CHIPS 
                FROM tb_ordenes_mb 
                WHERE 1=1  
                    AND O_COD_CLIENTE='" . $codigo_cliente . "'
                    AND O_FCH_CREACION  
                        between '" . $fechaOrden . HORA_INICIO_DIA . "' 
                        AND '" . $fechaOrden . HORA_FIN_DIA . "' 
                ;";
        //          var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        $this->Close();
        return $data;
    }

    public function getActualizarOrden($idOrden, $codigoOrden, $nuevaIvaBase, $nuevaIvaValor, $nuevoSubtotal, $nuevoImpuestos, $nuevoTotal, $usuarioMod, $fechaMod) {
        $sql = "
           UPDATE tb_ordenes_mb
           SET  
                o_iva_12_base='" . $nuevaIvaBase . "'
                ,o_iva_12_valor='" . $nuevaIvaValor . "'
                ,o_subtotal='" . $nuevoSubtotal . "'
                ,o_impuestos='" . $nuevoImpuestos . "'
                ,o_total='" . $nuevoTotal . "'
                ,o_fch_modificacion='" . $fechaMod . "'
                ,o_usr_ing_mod='" . $usuarioMod . "'
                       
           WHERE o_codigo_mb='" . $codigoOrden . "'
               AND o_id='" . $idOrden . "';
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql)->execute();
//        var_dump($command);die();

        $data = $command;
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getEliminarOrden($idOrden, $codigoOrden) {
        $sql = "
           DELETE FROM tb_ordenes_mb
           WHERE o_codigo_mb='" . $codigoOrden . "'
               AND o_id='" . $idOrden . "';
            ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql)->execute();
//        var_dump($command);die();
        $data = $command;
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

}
