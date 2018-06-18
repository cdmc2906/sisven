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
class FEjecutivoRutaModel extends DAOModel {
    /*
     * Obtiene el listado de mines vendidos por el vendedor segun la fecha.
     * 
     * El tipo de vendedor influye en los meses en los que se obtiene las ventas
     *  Vendedores (1) =Ventas 4 meses atrás de la fecha de calculo
     *  Mayoristas(2) = Ventas en el mes anterior al calculo de las comisiones
     */

    public $campoFechaOrdenes = 'o_fch_creacion';

    public function getTotalClientesxRutaxEjecutivoxDiaxSemana($ejecutivo, $dia, $semana) {
        $sql = "
          select 
                count(b.r_cod_cliente) as TOTALCLIENTES
                from 
                tb_ejecutivo_ruta as a
                inner join tb_ruta_mb as b
                on a.er_ruta=b.r_ruta
                where 1=1
                    and a.er_usuario='" . $ejecutivo . "'
                    and a.er_semana_visitar='" . $semana . "' 
                    and a.er_dia_visitar=" . $dia . "
                    and b.r_estatus=1
     ;  
                        ";
//        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }
    
    public function getTotalClientesxRutaxEjecutivoxDiaxSemanaxPeriodo($ejecutivo, $dia, $semana, $periodo) {
        $sql = "
             select 
                count(b.r_cod_cliente) as TOTALCLIENTES
                from 
                tb_ejecutivo_ruta as a
                inner join tb_ruta_mb as b
                on a.er_ruta=b.r_ruta
                where 1=1
                    and a.er_usuario='" . $ejecutivo . "'
                    and a.er_semana_visitar='" . $semana . "' 
                    and a.er_dia_visitar=" . $dia . "
                    and b.r_estatus=1
                and b.pg_id=" . $periodo . "
     ;  
";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getRutaGestionxEjecutivoxDiaxSemana($ejecutivo, $dia, $semana) {
        $sql = "
            select 
                er_ruta as ruta
                from 
                tb_ejecutivo_ruta as a
                where 1=1
                    and a.er_usuario='" . $ejecutivo . "'
                    and a.er_semana_visitar='" . $semana . "' 
                    and a.er_dia_visitar=" . $dia . "
     ;  
";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

}
