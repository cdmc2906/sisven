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
class ComisionModel extends DAOModel {
    /*
     * Obtiene el listado de mines vendidos por el vendedor segun la fecha.
     * 
     * El tipo de vendedor influye en los meses en los que se obtiene las ventas
     *  Vendedores (1) =Ventas 4 meses atrás de la fecha de calculo
     *  Mayoristas(2) = Ventas en el mes anterior al calculo de las comisiones
     */

    public function getMinesVentaxMesxVendedor($datos, $vendedor, $tipoVendedor) {
        $anio = $datos['anio'];

        if ($tipoVendedor == 1) {
            $diaInicio = 21;
            $diaFin = 20;
            if ($datos['mes'] >= 5) {
                $mesInicio = $datos['mes'] - 4;
                $mesFin = $datos['mes'] - 3;
                $anio = $anio;
            } else {
                $mesInicio = $datos['mes'] + 8;
                $mesFin = $datos['mes'] + 9;
                $anio = $anio - 1;
            }
            $fechaInicio = $anio . '/' . $mesInicio . '/' . $diaInicio;
            $fechaFin = $anio . '/' . $mesFin . '/' . $diaFin;
            $sql = "SELECT "
                    . "ID_PRO "
                    . "FROM TB_VENTA "
                    . "WHERE FECHA_VENT BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'"
                    . " AND ID_VEND=" . $vendedor . ";";
        } else if ($tipoVendedor == 2) {
            $sql = "SELECT ID_PRO "
                    . "FROM TB_VENTA "
                    . "WHERE MONTH(FECHA_VENT) =" . $datos['mes'] - 1 . " "
                    . "AND ID_VEND=" . $vendedor . ";";
        }
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getTotalesVentaxMesxVendedor($datos, $vendedor, $tipoVendedor) {
        $anio = $datos['anio'];
        if ($tipoVendedor == 1) {
            $diaInicio = 21;
            $diaFin = 20;

            if ($datos['mes'] >= 5) {
                $mesInicio = $datos['mes'] - 4;
                $mesFin = $datos['mes'] - 3;
                $año = $anio;
            } else {

                $mesInicio = $datos['mes'] + 8;
                $mesFin = $datos['mes'] + 9;
                $año = $anio - 1;
            }
            $fechaInicio = $año . '/' . $mesInicio . '/' . $diaInicio;
            $fechaFin = $año . '/' . $mesFin . '/' . $diaFin;

            $sql = "SELECT ID_PRO, "
                    . "COUNT(ID_PRO) AS CANTIDAD_VENDIDO, "
                    . "SUM(PRECIO_VENT) AS VALOR_VENTA "
                    . "FROM TB_VENTA "
                    . "WHERE "
                    . "FECHA_VENT BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "' "
                    . "AND ID_VEND=" . $vendedor . ";";
//            var_dump($sql);            die();
        } else if ($tipoVendedor == 2) {

            if ($datos['mes'] > 1) {
                $mes = $datos['mes'] - 1;
                $año = $datos['anio'];
            } else {
                $mesInicio = $datos['mes'] + 11;
                $año = $datos['anio'] - 1;
            }

            $sql = "SELECT "
                    . "COUNT(ID_PRO) AS CANTIDAD_VENDIDO, "
                    . "SUM(PRECIO_VENT) AS VALOR_VENTA "
                    . "FROM TB_VENTA "
                    . "WHERE MONTH(FECHA_VENT) =" . $mes . " "
                    . "AND YEAR(FECHA_VENT) =" . $año . " "
                    . "AND ID_VEND=" . $vendedor . ";";
        }
        //        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getConsumoxMin($idProducto, $mes) {
//        var_dump($mes);die();
        if ($mes['mes'] >= 5) {
            $mes1 = $mes['mes'] - 3;
            $mes2 = $mes['mes'] - 2;
        } else {
            $mes1 = $mes['mes'] + 9;
            $mes2 = $mes['mes'] + 10;
        }


        $sql = "SELECT SUM(VALORPAGO_CONS) FROM TB_CONSUMO "
                . "WHERE ID_PRO =" . $idProducto . ""
                . " AND ID_MES IN( " . $mes1 . "," . $mes2 . ");";
//        var_dump($sql);        die();

        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);die();
        $this->Close();
        return $data;
    }

    public function getConsumoxMes($mes) {
        if ($datos['mes'] >= 5) {
            $mes1 = $mes['mes'] - 3;
            $mes2 = $mes['mes'] - 2;
        } else {
            $mes1 = $mes['mes'] + 9;
            $mes2 = $mes['mes'] + 10;
        }

        $mes1 = $mes['mes'] - 3;
        $mes2 = $mes['mes'] - 2;

        $sql = "SELECT ID_PRO, SUM(VALORPAGO_CONS) FROM TB_CONSUMO "
                . "WHERE ID_MES IN( " . $mes1 . "," . $mes2 . ") GROUP BY ID_PRO;";
//        var_dump($sql);die();

        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);         die();
        $this->Close();
        return $data;
    }

    public function getComisionSegunRango($datos) {
//        var_dump($vendedor);        die();
//        $mesFin = $datos['mes'] - 3;
//        $fechaHoy = date('Y/m/d');
//        $año = date("Y", strtotime($fechaHoy));
//        $fechaInicio = $año . '/' . $mesInicio . '/' . $diaInicio;
//        $fechaFin = $año . '/' . $mesFin . '/' . $diaFin;
        $sql = "SELECT PORCENTAJE_RCOM FROM `tb_rango_comision` `t` WHERE " . $datos . " BETWEEN rangomin_rcom AND rangomax_rcom;";
//        var_dump($sql);die();

        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

}
