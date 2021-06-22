<?php

class FConsultasChipModel extends DAOModel {

    public $campoFechaOrdenes = 'o_fch_creacion';

    public static function getFechaUltimaCarga() {
        $command1 = Yii::app()->db->createCommand("
           select MAX(r_fch_ingreso) as ultimacarga from tb_ruta_mb");

        $resultado1 = $command1->queryRow();
        $ultimacarga = $resultado1['ultimacarga'];
// var_dump  ($ultimacarga);die();
        return $ultimacarga;
//        var_dump($sql);        die();
//         $command = $this->connection->createCommand($sql);
//         $data = $command->queryAll();
// //        var_dump($data);        die();
//         $this->Close();
//         return $data;
    }

    public function getDatosChips($tipoValidacion, $valor) {
        $condicion = ' ';
        $condicion = ($tipoValidacion == 'icc') ? "compra.ICC ='" . $valor . "';" : "compra.MIN ='" . $valor . "'";
//CHAR(39)+
        $sql = "
                select 
                compra.CDG_COMPRA as COMPRA_CDG_COMPRA
                ,compra.MIN as COMPRA_MIN
                ,compra.ICC AS COMPRA_ICC
                ,CONVERT(DATE,compra.FECHA_COMPRA) AS COMPRA_FECHA_COMPRA
                ,compra.MIN2 AS COMPRA_MIN593
                ,CONVERT(DATE,compra.FECHA_ALTA) AS COMPRA_FECHA_ALTA
                ,compra.MESCOMPRA AS COMPRA_MESCOMPRA
                ,compra.YEARCOMPRA AS COMPRA_YEARCOMPRA

                ,txmovistar.tm_icc AS TXMOVISTAR_ICC
                ,txmovistar.tm_min AS TXMOVISTAR_MIN
                ,CONVERT(DATE,txmovistar.tm_fecha) AS TXMOVISTAR_FECHA
                ,txmovistar.tm_iddistribuidor AS TXMOVISTAR_ID_DISTRI
                ,txmovistar.tm_nombredistribuidor AS TXMOVISTAR_NMB_DISTRI
                ,txmovistar.tm_iddestino AS TXMOVISTAR_ID_DESTINO
                ,UPPER(txmovistar.tm_nombredestino) AS TXMOVISTAR_NMB_DESTINO

                ,vtmovistar.vm_icc AS VTMOVISTAR_ICC
                ,vtmovistar.vm_min AS VTMOVISTAR_MIN
                ,CONVERT(DATE,vtmovistar.vm_fecha) AS VTMOVISTAR_FECHA
                ,vtmovistar.vm_distribuidor AS VTMOVISTAR_ID_DISTRI
                ,vtmovistar.vm_nombredistribuidor AS VTMOVISTAR_NMB_DISTRI
                ,vtmovistar.vm_iddestino AS VTMOVISTAR_ID_DESTINO
                ,UPPER(vtmovistar.vm_nombredestino) AS VTMOVISTAR_NMB_DESTINO

                ,ventas.MIN AS VENTAS_MIN
                ,ventas.IMEI AS VENTAS_IMEI
                ,ventas.MIN2 AS VENTAS_MIN593
                ,CONVERT(DATE,ventas.FECHA) AS VENTAS_FECHA
                ,ventas.NUMERO_BODEGA AS VENTAS_NUMERO_BODEGA
                ,UPPER(ventas.BODEGA) AS VENTAS_BODEGA
                ,ventas.NUMERO_SERIE AS VENTAS_NUMERO
                ,ventas.NUMERO_FACTURA AS VENTAS_NUMERO_FACTURA
                ,UPPER(ventas.NOMBRE_CLIENTE) AS VENTAS_NOMBRE_CLIENTE
                ,ventas.RUC AS VENTAS_RUC
                ,ventas.CODIGO_GRUPO AS VENTAS_CODIGO
                ,ventas.ESTADO AS VENTAS_ESTADO

                --,altas.MIN as ALTAS_MIN 
                ,+altas.ICC as ALTAS_ICC
                ,CONVERT(DATE,altas.FECHA_ALTA) AS ALTAS_FECHA_ALTA
                ,altas.CIUDAD AS ALTAS_CIUDAD
                ,altas.MESALTA AS ALTAS_MESALTA
                ,altas.YEARALTA AS ALTAS_YEARALTA
                FROM 
                tececab.dbo.CHIP_COMPRA as compra
                left outer join tececab.dbo.CHIP_ALTAS as altas
                on compra.ICC=altas.icc
                left outer join tececab.dbo.CHIP_VENTAS as ventas
                on compra.icc=ventas.imei
                left outer join tcc_control_ruta.dbo.tb_transferencia_movistar as txmovistar
                on compra.ICC=txmovistar.tm_icc
                left outer join tcc_control_ruta.dbo.tb_venta_movistar as vtmovistar
                on compra.ICC=vtmovistar.vm_icc
                where 1=1
                and " . $condicion . "
            ;";

//        var_dump($sql);  
//        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

}
