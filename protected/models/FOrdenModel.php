<?php

/**
 * This is the model class for table "tb_asignacion".
 *
 * The followings are the available columns in table 'tb_asignacion':
 * @property integer $ID_ASIG
 * @property integer $ID_PRO
 * @property integer $ID_VEND
 * @property string $FECHAINGRESO_ASIG
 * @property integer $IDUSR_ASIF
 *
 * The followings are the available model relations:
 * @property TbVendedor $iDVEND
 * @property TbProducto $iDPRO
 */
class FOrdenModel extends DAOModel {
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
                    CAST(COALESCE(SUM(O_SUBTOTAL),0) AS int)AS CHIPS                          
                FROM tb_ordenes_mb 
                WHERE 1=1  
                    AND O_USUARIO='".$codEjecutivo."'
                    AND O_COD_CLIENTE='" . $codigo_cliente . "'
                    AND DATE(O_FCH_CREACION)='" . $fechaOrden . "';";

//        var_dump($sql);        die();
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
        $sqlFechaFinVisita = "
            SELECT
                    H_FECHA            
                FROM TB_HISTORIAL_MB
                WHERE H_ACCION='Fin de visita'
                    AND H_FECHA>='" . $fechaOrden . "'
                    AND H_COD_CLIENTE='TCQU190004'
                    AND H_USUARIO='QU19'
                ORDER BY H_FECHA 
                LIMIT 1;";

        $command = $this->connection->createCommand($sqlFechaFinVisita);
        $data1 = $command->queryAll();
//        if (count($data1) > 0) {
        if (false) {
            $sql = "
            SELECT 
                    CAST(COALESCE(SUM(O_SUBTOTAL),0) AS DECIMAL(6,2))AS CHIPS 
                FROM tb_ordenes_mb 
                WHERE 1=1  
                    AND O_COD_CLIENTE='" . $codigo_cliente . "'
                    AND O_FCH_CREACION  
                        between '" . $fechaOrden . "' 
                        and '" . $data1[0]['H_FECHA'] . "'
                ;";
        } else {
            $sql = "
            SELECT 
                    CAST(COALESCE(SUM(O_SUBTOTAL),0) AS DECIMAL(6,2))AS CHIPS 
                FROM tb_ordenes_mb 
                WHERE 1=1  
                    AND O_COD_CLIENTE='" . $codigo_cliente . "'
                    AND O_FCH_CREACION  
                        between '" . $fechaOrden . "' 
                        and addtime('" . $fechaOrden . "', '00:1:00')
                ;";
        }
        
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
