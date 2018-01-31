<?php

class ReportesModel extends DAOModel {

    public function getTotalOrdenesxFecha($datos, $grupoEjecutivos) {
        $hora_inicio = "09:00:00";
//        $hora_fin = "23:59:59";

        $fechaInicioA = $datos['fechaOrdenesInicio'];
        $fechaFinA = $datos['fechaOrdenesFin'];

        $fechaInicioB = $fechaInicioA . " " . $hora_inicio;
//        $fechaFinB = $fechaFinA . " " . $hora_fin;
        $fechaFinB = date('Y-m-d', strtotime($fechaFinA . ' + 1 days')) . ' 09:00';
        $sql = "
            SELECT
                    o_usuario AS CODIGOEJECUTIVO                
                    ,o_nom_usuario AS EJECUTIVO                
                    , CONVERT(sum(o_subtotal), decimal(6, 0)) AS TOTALPEDIDOS
                FROM tb_ordenes_mb
                WHERE 1 = 1
                    AND o_fch_creacion >= '" . $fechaInicioB . "'
                    AND o_fch_creacion<'" . $fechaFinB . "'	
                    AND o_usuario in(" . $grupoEjecutivos . ")	
                GROUP BY o_usuario
                ORDER BY o_usuario;";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        $this->Close();
        return $data;
    }

    public function getOrdenesxFecha($fechaInicio, $fechaFin) {
        $hora_inicio = "00:00:00";
        $hora_fin = "23:59:59";

        $fechaInicioA = $fechaInicio;
        $fechaFinA = $fechaFin;
        $fechaInicioB = $fechaInicioA . " " . $hora_inicio;
        $fechaFinB = $fechaFinA . " " . $hora_fin;

        $sql = "
        SELECT
                o_nom_usuario AS EJECUTIVO
                ,o_cod_cliente AS CLIENTE
                , CONVERT(o_subtotal, decimal(6, 0)) AS TOTALORDENES
                , DATE(o_fch_creacion) AS PERIODO
            FROM tb_ordenes_mb
            WHERE 1 = 1
                AND o_fch_creacion >= '" . $fechaInicioB . "'
                AND o_fch_creacion<'" . $fechaFinB . "'
			ORDER BY o_usuario;";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        $this->Close();
        return $data;
    }

    public function getOrdenesxEjecutivoxFecha($ejecutivo, $fechaInicio, $fechaFin) {
        $hora_inicio = "09:00:00";
//        $hora_fin = "23:59:59";


        $fechaInicioA = $fechaInicio;
        $fechaFinA = $fechaFin;
        $fechaInicioB = $fechaInicioA . " " . $hora_inicio;
//        $fechaFinB = $fechaFinA . " " . $hora_fin;

        $fechaFinB = date('Y-m-d', strtotime($fechaFinA . ' + 1 days')) . ' 09:00';

        $sql = "
        SELECT
                --  o_nom_usuario AS EJECUTIVO
                o_id as CODIGOORDEN
                ,o_codigo_mb as ORDEN
                ,o_cod_cliente AS COD_CLIENTE
                ,o_nom_cliente AS NOM_CLIENTE
                , CONVERT(o_subtotal, decimal(6, 0)) AS TOTALORDENES
                , DATE(o_fch_creacion) AS PERIODO
            FROM tb_ordenes_mb
            WHERE 1 = 1
                AND o_usuario='" . $ejecutivo . "'
                AND o_fch_creacion >= '" . $fechaInicioB . "'
                AND o_fch_creacion<'" . $fechaFinB . "'
			ORDER BY 1;";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        $this->Close();
        return $data;
    }

    public function getInicioJornadaxFecha($usuario, $fecha, $inicioJornada) {
//        var_dump($datos);die();
//        $fechaInicioA = $datos['fechaOrdenesInicio'];

        $sql = "
          SELECT
		H_FECHA AS FECHA
		,DATE_FORMAT(H_FECHA,'%H:%i:%s') AS HORA
                ,H_USUARIO_NOMBRE AS EJECUTIVO
            FROM tb_historial_mb 
            WHERE 1=1
                AND DATE(h_fecha) ='" . $fecha . "'
                AND TIME_FORMAT(h_fecha, '%H:%i') >='" . $inicioJornada . "'
		AND h_accion='Inicio visita'
		AND h_usuario='" . $usuario . "'
            ORDER BY h_fecha
            LIMIT 1;
        ";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        $this->Close();
        return $data;
    }

    public function getFinJornadaxUsuarioxFecha($usuario, $fecha, $finJornada) {
//        var_dump($datos);die();
//        $fechaInicioA = $datos['fechaOrdenesInicio'];

        $sql = "
          SELECT
		H_FECHA AS FECHA
		,DATE_FORMAT(H_FECHA,'%H:%i:%s') AS HORA
                ,H_USUARIO_NOMBRE AS EJECUTIVO
            FROM tb_historial_mb 
            WHERE 1=1
                AND DATE(h_fecha) ='" . $fecha . "'
                AND TIME_FORMAT(h_fecha, '%H:%i') <='" . $finJornada . "'
		AND h_accion='Fin de visita'
		AND h_usuario='" . $usuario . "'
            ORDER BY h_fecha desc
            LIMIT 1;
        ";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        $this->Close();
        return $data;
    }

    public function getTotalesOrdenesxFecha($datos) {
//        var_dump($datos);die();
        $hora_inicio = "00:00:00";
        $hora_fin = "23:59:59";

        $fechaInicioA = $datos['fechaOrdenesInicio'];
        $fechaFinA = $datos['fechaOrdenesFin'];
        $fechaInicioB = $fechaInicioA . " " . $hora_inicio;
        $fechaFinB = $fechaFinA . " " . $hora_fin;

//        var_dump($fechaFinB);die();
        $sql = " 
        SELECT
                o_nom_usuario AS EJECUTIVO
                , CONVERT(SUM(o_subtotal), decimal(6, 0)) AS TOTALORDENES
                , DATE(o_fch_creacion) AS PERIODO
            FROM tb_ordenes_mb
            WHERE 1 = 1
                AND o_fch_creacion >= '" . $fechaInicioB . "'
                AND o_fch_creacion<'" . $fechaFinB . "'
            GROUP BY o_nom_usuario;";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        $this->Close();
        return $data;
    }

    public function getTotalPlan($datos) {
        $sql = "select
        plan_cons as nombre_plan,
        count(min_cons) as total_min,
        FORMAT(sum(valorpago_cons), 2) as total_pago
        from tb_consumo
        --where FECHACONSUMO_CONS between '" . $datos['fechaConsumoInicio'] . "' and '" . $datos['fechaConsumoFin'] . "'
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
        CONVERT(VALORPAGO_CONS, DECIMAL(10, 4)) AS VALOR_PAGO,
        date(FECHAINGRESO_CONS) AS FECHA_INGRESO,
        OBSERVACION_CONS AS OBSERVACION,
        USERNAME AS SUBIDO_POR
        FROM TB_CONSUMO
        INNER JOIN cruge_user on tb_consumo.IDUSR_CONS = cruge_user.IDUSER
        WHERE FECHACONSUMO_CONS = '" . $datos['fechaConsumo'] . "';
        ";
//        var_dump($sql); die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        $this->Close();
        return $data;
//        var_dump($data);die();
    }

    public function getVentasxMes($datos) {
//        var_dump($datos);die();
//        $sql = "/* CANTIDAD DE CHIPS VENDIDOS Y CON CONSUMO POR MES */
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

    public function getUsuariosGestionxFecha($fechaGestion, $accionRevisar, $grupoEjecutivosRevisar, $horaInicio, $horaFin) {
        $fechaInicio = $fechaGestion . ' ' . $horaInicio;
        $fechaFin = $fechaGestion . ' ' . $horaFin;

        $sql = "
            select 
                    h_usuario as CODIGOEJECUTIVO
                    ,h_usuario_nombre as SUPERVISOR
                    ,count(h_cod_cliente) as VISITAS
                from tb_historial_mb 
                where 1=1
                    AND h_fecha BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'
                    and  h_accion='" . $accionRevisar . "'
                    and h_usuario in (" . $grupoEjecutivosRevisar . ")	
                group by 
                    h_usuario
                order by 1;";
//        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        $this->Close();
        return $data;
    }

    public function getGestionxUsuarioxFecha($usuario, $fechaGestion, $accionRevisar, $horaInicio, $horaFin) {
        $fechaInicio = $fechaGestion . ' ' . $horaInicio;
        $fechaFin = $fechaGestion . ' ' . $horaFin;
        $sql = "
            select 
                    h_usuario as CODIGOSUPERVISOR
                    ,case left(right(h_ruta,4),1)
                        when '-' then right(h_ruta,3)
                        else h_ruta end as CODIGOEJECUTIVO
                    ,h_ruta as RUTACOMPLETA
                    ,h_ruta as RUTAEJECUTIVO
                    ,case left(right(h_ruta,4),1)
                        when '-' then left(right(h_ruta,5),1)
                        else h_ruta end as RUTA
                    ,count(h_cod_cliente) as VISITAS
                from tb_historial_mb 
                where 1=1
                    -- and date(h_fecha)='" . $fechaGestion . "'
                    AND h_fecha BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'
                    and  h_accion='" . $accionRevisar . "'
                    and h_usuario = '" . $usuario . "'	
                group by 
                    h_usuario
                    ,h_ruta
                order by VISITAS DESC;";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        $this->Close();
//        var_dump($data);die();
        return $data;
    }

    public function getUsersPorRol($rol) {

        $sql = "
            SELECT 
                    a.iduser AS CODIGOAGENTE
                    ,b.usrl_nombre_usuario AS NOMBREAGENTE
                FROM cruge_user as a
                inner join  tb_usuario_rol as b
                    on a.iduser  =b.iduser
                where b.r_id=" . $rol . "
                order by 1;";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
        $this->Close();
//        var_dump($data);die();
        return $data;
    }

}
