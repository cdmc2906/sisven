<?php

class ReportesModel extends DAOModel {

    public function getTotalPlan($datos) {
        $sql = "select 
                plan_cons as nombre_plan, 
                count(min_cons) as total_min, 
                FORMAT(sum(valorpago_cons),2) as total_pago
                from tb_consumo 
                -- where FECHACONSUMO_CONS between '" . $datos['fechaConsumoInicio'] . "' and '" . $datos['fechaConsumoFin'] . "'
                where ID_MES between '" . $datos['fechaConsumoInicio'] . "' and '" . $datos['fechaConsumoFin'] . "'
                group by plan_cons";
//        var_dump($sql); die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        $this->Close();
        return $data;
    }

    public function getConsumoxFecha($datos) {
        $sql = "SELECT 
                PLAN_CONS AS PLAN,
                MIN_CONS AS MIN,
                CONTRATO_CONS AS CONTRATO,
                CODIGOVENDEDOR_CONS AS CODIGO_VENDEDOR,
                VENDEDOR_CONS AS VENDEDOR,
                date(FECHACONSUMO_CONS) AS FECHA_CONSUMO,
                CONVERT(VALORPAGO_CONS ,DECIMAL(10,4)) AS VALOR_PAGO,
                date(FECHAINGRESO_CONS) AS FECHA_INGRESO,
                OBSERVACION_CONS AS OBSERVACION,
                USERNAME AS SUBIDO_POR
                FROM TB_CONSUMO
                INNER JOIN cruge_user on tb_consumo.IDUSR_CONS =cruge_user.IDUSER
                WHERE FECHACONSUMO_CONS ='" . $datos['fechaConsumo'] . "';";
//        var_dump($sql); die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        $this->Close();
        return $data;
//        var_dump($data);die();
    }

    public function getVentasxMes($datos) {
//        var_dump($datos);die();
//        $sql = "/*CANTIDAD DE CHIPS VENDIDOS Y CON CONSUMO POR MES*/
//                select 
//                v.id_vend as CODIGO_VENDEDOR, 
//                ve.nombre_vend AS VENDEDOR, 
//                count(v.id_pro) AS VENTAS_MES
//                from 
//                tb_consumo as c inner join tb_venta as v on c.id_pro=v.id_pro
//                inner join tb_vendedor as ve on v.id_vend =ve.id_vend
//                where c.id_mes =" . $datos['mes'] .
//                " and MONTH(v.fecha_vent)=" . $datos['mes'] .
//                " group by v.id_vend ;";
//                
        $sql = "select 
                v.id_vend as CODIGO_VENDEDOR, 
                ve.nombre_vend AS VENDEDOR, 
                count(v.id_pro) AS VENTAS_MES
                from 
                tb_venta as v 
                inner join tb_vendedor as ve on v.id_vend =ve.id_vend
                where MONTH(v.fecha_vent)=" . $datos['mes'] . " group by v.id_vend ;";
//        var_dump($sql); die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        $this->Close();
        return $data;
//        var_dump($data);die();
    }

    public function getVentasConsumosxMes($datos) {
        $sql = "
            SELECT 
            VE.NOMBRE_VEND AS VENDEDOR, 
            COUNT(V.ID_PRO) AS VENTAS, 
            COUNT(C.ID_PRO) AS CONSUMO 
            FROM TB_VENTA AS V
            LEFT OUTER JOIN TB_CONSUMO AS C ON V.ID_PRO=C.ID_PRO
            INNER JOIN TB_VENDEDOR AS VE ON V.ID_VEND=VE.ID_VEND
            WHERE MONTH(V.FECHA_VENT) =" . $datos['mes'] . "
            GROUP BY V.ID_VEND";
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        $this->Close();
        return $data;
//        var_dump($data);die();
    }

    public function getVentasxVendedor($datos) {
        $sql = "select 
                CONCAT(m.ABREVIACION_mes,' - ',year(date(v.fecha_vent))) as MES ,
                    count(*) AS 'CHIPS VENDIDOS', 
                    ve.nombre_vend AS VENDEDOR
                    from tb_venta as v
                    inner join  tb_vendedor as ve on v.id_vend=ve.id_vend
                    inner join tb_mes as m on MONTH(date(v.fecha_vent)) =m.id_mes
                    where v.id_vend =" . $datos['vendedor'] . " group by 1 order by v.fecha_vent;";
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        $this->Close();
        return $data;
    }

    public function getComisionesxMes($datos) {
        $sql = "SELECT 
                    VE.NOMBRE_VEND AS VENDEDOR, 
                    COUNT(V.ID_PRO) AS VENTAS, 
                    COUNT(C.ID_PRO) AS CONSUMO , 
                    FORMAT(SUM(C.VALORPAGO_CONS),2) AS VALOR_CONSUMIDO,
                    FORMAT((COUNT(C.ID_PRO)/COUNT(V.ID_PRO))*100,2) AS PORCENTAJE,
                    FORMAT(
                    (
                    SELECT PORCENTAJE_RCOM
                    FROM TB_RANGO_COMISION 
                    WHERE 
                    RANGOMIN_RCOM <= (COUNT(C.ID_PRO)/COUNT(V.ID_PRO))*100 AND 
                    RANGOMAX_RCOM >= (COUNT(C.ID_PRO)/COUNT(V.ID_PRO))*100
                    )*SUM(C.VALORPAGO_CONS)
                    ,2) 
                    AS COMISION
                    FROM TB_VENTA AS V
                    LEFT OUTER JOIN TB_CONSUMO AS C ON V.ID_PRO=C.ID_PRO
                    INNER JOIN TB_VENDEDOR AS VE ON V.ID_VEND=VE.ID_VEND
                    WHERE MONTH(V.FECHA_VENT) =" . $datos['mes'] . "
                    GROUP BY V.ID_VEND;";
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        $this->Close();
        return $data;
    }

}
