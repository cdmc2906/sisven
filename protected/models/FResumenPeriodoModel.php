<?php

class FResumenPeriodoModel extends DAOModel {

    public function getResumenxPeriodo($idPeriodo) {
        $sql = "
        select b.e_nombre as EJECUTIVO
           ,rhd_fecha_historial AS FECHA
           ,rhd_parametro AS PARAMETRO
           ,rhd_valor AS VALOR
        from tb_resumen_historial_diario as a
            inner join tb_ejecutivo as b
                on a.rhd_cod_ejecutivo=b.e_usr_mobilvendor
        where 1=1
            and a.pg_id=" . $idPeriodo . " 
        
        ;
            ";
//        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getResumenAltasxPeriodoMensual($fechaInicio, $fechaFin) {
        $sql = "EXEC SP_CHIP_GENERICO_ALTAS_FUERA_ZONA '" . $fechaInicio . "','" . $fechaFin . "',0;";
        $this->connection = Yii::app()->db_grp;
        $command = $this->connection->createCommand($sql);
        $command->execute();

        $sql = "
             select 
                   ISNULL(B.TIPO_CLIENTE,'**SIN VENTA**') AS TIPO
                    ,COUNT(DISTINCT B.CIUDAD) AS CIUDADES
                    ,COUNT(DISTINCT  B.MIN) AS ALTAS
		FROM 
			tececab.dbo.ChGenericoAltasFueraZona AS B 
		WHERE 
			B.FECHA_ALTA >='" . $fechaInicio . "' 
			AND B.FECHA_ALTA <= '" . $fechaFin . "'
			AND B.TIPO_CLIENTE IS NOT NULL
                GROUP BY B.TIPO_CLIENTE
                ORDER BY 1
                ";
//        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getResumenAltasxPeriodoMensualxTipoBodega($fechaInicio, $fechaFin, $tipoBodega) {
        $sql = "EXEC SP_CHIP_GENERICO_ALTAS_FUERA_ZONA '" . $fechaInicio . "','" . $fechaFin . "',0;";
        $this->connection = Yii::app()->db_grp;
        $command = $this->connection->createCommand($sql);
        $command->execute();

        $sql = "
            select 
                    UPPER(B.BODEGA) AS BODEGA
                    ,B.NUMERO_BODEGA AS NUMBODEGA
                    ,COUNT(DISTINCT  B.MIN) AS ALTAS
                    ,COUNT(DISTINCT B.CIUDAD) AS CIUDADES
		FROM 
			tececab.dbo.ChGenericoAltasFueraZona AS B 
		WHERE 
			B.FECHA_ALTA >='" . $fechaInicio . "' 
			AND B.FECHA_ALTA <= '" . $fechaFin . "'
			AND B.TIPO_CLIENTE ='" . $tipoBodega . "'
                GROUP BY B.BODEGA,B.NUMERO_BODEGA
                ORDER BY 1             
                ";
//        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getResumenAltasxPeriodoMensualxBodega($fechaInicio, $fechaFin, $bodega) {
        $sql = "EXEC SP_CHIP_GENERICO_ALTAS_FUERA_ZONA '" . $fechaInicio . "','" . $fechaFin . "',0;";
        $this->connection = Yii::app()->db_grp;
        $command = $this->connection->createCommand($sql);
        $command->execute();

        $sql = "
           select 
                     B.[MIN]				
                    ,ISNULL( RIGHT('0' + RTRIM(DAY(B.FECHA_VARCHAR)), 2)+'-'+UPPER(left(DATENAME(MONTH,B.FECHA_VARCHAR),3)),'SIN_DATA')                          as FECHA_VARCHAR
                    ,B.CIUDAD AS CIUDAD			
                    ,B.TIPO_CLIENTE AS TIPO_CLIENTE
                    ,B.MES_VENTA AS MES_VENTA
                    ,B.VENDEDOR AS VENDEDOR
                    ,ISNULL(B.CODIGO_CLIENTE,'SIN_CODIGO') +'-'+B.NOMBRE_CLIENTE AS CLIENTE
		FROM 
			ChGenericoAltasFueraZona AS B 
		WHERE 
			B.FECHA_ALTA >='" . $fechaInicio . "' 
			AND B.FECHA_ALTA <= '" . $fechaFin . "'
			AND B.BODEGA ='" . $bodega . "'
                ORDER BY B.ANIO_DE_VENTA,B.MES_DE_VENTA      
                ";
//        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }
    
    public function getResumenAltasxPeriodoMensualxBodegaMail($fechaInicio, $fechaFin, $bodega) {
        $sql = "EXEC SP_CHIP_GENERICO_ALTAS_FUERA_ZONA '" . $fechaInicio . "','" . $fechaFin . "',0;";
        $this->connection = Yii::app()->db_grp;
        $command = $this->connection->createCommand($sql);
        $command->execute();

        $sql = "
           select 
                    B.VENDEDOR AS VENDEDOR
                    ,ISNULL(B.CODIGO_CLIENTE,'SIN_CODIGO')  AS CODIGO_CLIENTE
                    ,B.NOMBRE_CLIENTE AS NOMBRE_CLIENTE
                    ,B.CIUDAD AS CIUDAD			
                    ,CHAR(39)+convert(varchar(25),B.[MIN]) as MIN				
                    ,CHAR(39)+convert(varchar(25),B.[ICC]) as ICC
                    ,ISNULL( RIGHT('0' + RTRIM(DAY(B.FECHA_VARCHAR)), 2)+'-'+UPPER(left(DATENAME(MONTH,B.FECHA_VARCHAR),3)),'SIN_DATA')                          as FECHA_ALTA
                    ,B.MES_VENTA AS MES_VENTA
		FROM 
			tececab.dbo.ChGenericoAltasFueraZona AS B 
		WHERE 
			B.FECHA_ALTA >='" . $fechaInicio . "' 
			AND B.FECHA_ALTA <= '" . $fechaFin . "'
			AND B.BODEGA ='" . $bodega . "'
                ORDER BY B.ANIO_DE_VENTA,B.MES_DE_VENTA,B.CODIGO_CLIENTE,B.CIUDAD,B.MIN,B.ICC    
                ";
//        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data['excelAdjunto'] = $command->queryAll();
        
        
         $sql = "
           select 
                        COUNT(DISTINCT B.CIUDAD) AS CIUDADES			
                FROM 
                    tececab.dbo.ChGenericoAltasFueraZona AS B 
		WHERE 
			B.FECHA_ALTA >='" . $fechaInicio . "' 
			AND B.FECHA_ALTA <= '" . $fechaFin . "'
			AND B.BODEGA ='" . $bodega . "'
                ";
//        var_dump($sql);die();
        $command = $this->connection->createCommand($sql);
        $data['ciudades'] = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

}
