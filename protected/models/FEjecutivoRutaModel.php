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

    public function getTotalClientesxRutaxEjecutivoxDia($ejecutivo, $dia) {
        $sql = "
          select 
                count(b.r_cod_cliente) as TOTALCLIENTES
                from tb_ejecutivo_ruta as a
                inner join tb_ruta_mb as b
                on a.er_ruta=b.r_ruta
                where 1=1
                    and a.er_usuario='" . $ejecutivo . "'
                    --and a.er_semana_visitar='" . $semana . "' 
                    and a.er_dia_visitar=" . $dia . "
                    --and b.r_semana='" . $semana . "' 
                    and b.r_estatus=1
     ;  
                        ";
        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }
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
                    and b.r_semana='" . $semana . "' 
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
                    and b.r_semana='" . $semana . "' 
                    and b.r_estatus=1
                    and b.pg_id=" . $periodo . "
     ;  
";
//        Yii::log($sql, "error");
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

    public function getRutaGestionxEjecutivoxDia($ejecutivo, $dia) {
        $sql = "
            select 
                er_ruta as ruta
                from 
                tb_ejecutivo_ruta as a
                where 1=1
                    and a.er_usuario='" . $ejecutivo . "'
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

    public function getRutasAsignadasxEjecutivo($codigoEjecutivo, $periodo) {
        $sql = "
            select
                a.er_cod  as CODIGOUSUARIORUTA,
                c.zg_nombre_zona as ZONA,
                b.rg_id AS IDRUTA,
                a.er_ruta AS CODIGORUTA,
                a.er_ruta_nombre AS NOMBRERUTA,
                a.er_semana_visitar AS SEMANA,
                a.er_dia_visitar AS DIA,
                COUNT(DISTINCT d.r_cod_cliente) AS CLIENTESRUTA
              from 
                tb_ejecutivo_ruta as a
                inner join tb_ruta_gestion as b
                        on a.rg_id=b.rg_id
                inner join tb_ruta_mb as d
                        on a.er_ruta=d.r_ruta
                        and a.er_semana_visitar=d.r_semana
                        and a.er_dia_visitar=d.r_dia
                inner join tb_zonas_gestion as c
                        on b.zg_id=c.zg_id
            where 
                a.e_cod =" . $codigoEjecutivo . "
                and pg_id=" . $periodo . "
            group by 
                c.zg_nombre_zona,
                a.er_usuario,
                a.er_ruta,
                a.er_ruta_nombre,
                a.er_semana_visitar,
                a.er_dia_visitar,
                a.er_cod,
                b.rg_id
            order by 4,6,7
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

    public function getTotalClientesxEjecutivoxDiaxSemanaxLineaNegocio($codigoEjecutivo, $semana, $dia, $lineaNegocio = 'MOVZS') {
        $sql = "
        select 
                COUNT(*) as totalclientes
                ,er.er_ruta
                +'_S'+convert(varchar,er.er_semana_visitar)
                +'_D'+convert(varchar,er.er_dia_visitar)as ruta
            from
                tb_ejecutivo_ruta as er
                    inner join tb_ruta_mb as ruta
                    on er.er_ruta=ruta.r_ruta
                    and er.er_semana_visitar=ruta.r_semana
                    and er.er_dia_visitar=ruta.r_dia
            where 1=1
                and er.er_estado=1
                and er.er_semana_visitar=" . $semana . "
                and er.er_dia_visitar=" . $dia . "
                and er.er_usuario='" . $codigoEjecutivo . "'
                --and er.er_linea_negocio='" . $lineaNegocio . "'
                and ruta.r_estatus=1
                and ruta.pg_id = (select MAX(pg_id) from tb_periodo_gestion)
            group by er.er_ruta,er.er_semana_visitar,er.er_dia_visitar
            ;
            ";
        //    var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        //        var_dump(1);        die();
        //        var_dump($data);        die();
        $this->Close();
        return $data;
    }

}
