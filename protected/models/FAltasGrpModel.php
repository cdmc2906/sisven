<?php

/**

 */
class FAltasGrpModel extends DAOModel {

    public static function getFechaUltimaCarga() {
        $command1 = Yii::app()->db->createCommand("
      select 
                MAX(CONVERT(DATE,FECHA_HASTA))  ultimacarga
            from tececab.dbo.CHIP_ALTAS

");

        $resultado1 = $command1->queryRow();

        return $resultado1['ultimacarga'];
    }

    public function getAltasPorPeriodo($fechaInicio, $fechaFin) {
        $dataResultado = array();

        $sql = "EXEC SP_CHIP_GENERICO_ALTAS '" . $fechaInicio . "','" . $fechaFin . "',0";
        $this->connection = Yii::app()->db_grp;
        $command = $this->connection->createCommand($sql);
        $command->execute();

        $sql = "
            select 
                    B.[MIN]				
                    ,ISNULL( RIGHT('0' + RTRIM(DAY(FECHA_VARCHAR)), 2)+'-'+UPPER(left(DATENAME(MONTH,FECHA_VARCHAR),3)),'SIN_DATA')                          as FECHA_VARCHAR
                    ,B.CIUDAD AS CIUDAD			
                    ,ISNULL(TIPO_CLIENTE,'**SIN VENTA**') AS TIPO_CLIENTE
		FROM 
			ChGenericoAltas AS B 
		WHERE 
			B.FECHA_ALTA >='" . $fechaInicio . "' 
			AND B.FECHA_ALTA <= '" . $fechaFin . "'
                ORDER BY FECHA_VARCHAR
            
                ";
        // var_dump($sql);die();
        $this->connection = Yii::app()->db_grp;
        $command = $this->connection->createCommand($sql);
        $data1 = $command->queryAll();
        $dataResultado['detalleAltas'] = $data1;

        $sql = "
            select 
                    ISNULL(TIPO_CLIENTE,'**SIN VENTA**') AS TIPO_CLIENTE
                    ,COUNT(B.ICC) AS DIARIA
		FROM 
			ChGenericoAltas AS B 
		WHERE 
			B.FECHA_ALTA >='" . $fechaInicio . "' 
			AND B.FECHA_ALTA <= '" . $fechaFin . "'
                group by TIPO_CLIENTE
                ORDER BY 1
            
                ";
//        var_dump($sql);die();
        $this->connection = Yii::app()->db_grp;
        $command = $this->connection->createCommand($sql);
        $data2 = $command->queryAll();
        $dataResultado['altasDiarias'] = $data2;

        $sql = "
            select 
                    MIN(B.FECHA_VARCHAR) AS INICIO,                     
                    MAX(B.FECHA_VARCHAR) AS FIN
		FROM 
			ChGenericoAltas AS B 
		WHERE 
			B.FECHA_ALTA >='" . $fechaInicio . "' 
			AND B.FECHA_ALTA <= '" . $fechaFin . "'
            
                ";
//        var_dump($sql);die();
        $this->connection = Yii::app()->db_grp;
        $command = $this->connection->createCommand($sql);
        $data3 = $command->queryAll();
        $dataResultado['inicioFin'] = $data3;

        $sql = "
             select 
                    CHAR(39)+convert(varchar(25),B.MIN)AS 'MIN' 			
                    ,CODIGO_PLAN  AS 'PLAN'
                    ,B.FECHA_VARCHAR AS 'FECHA_ALTA'
                    ,B.CODIGO_VENDEDOR	
                    ,B.CIUDAD
                    ,CHAR(39)+convert(varchar(25),B.ICC) as 'ICC'
                    ,B.MES_ALTA			
                    ,B.MES_VENTA			
                    ,B.BODEGA
                    ,B.VENDEDOR			
                    ,B.CODIGO_CLIENTE		
                    ,B.NOMBRE_CLIENTE AS 'CLIENTE'
                    ,ISNULL(B.TIPO_CLIENTE,'SIN VENTA') AS TIPO_CLIENTE
                    ,ISNULL(C.tm_nombredestino,'SIN TRANSFERENCIA')  AS 'TRANSFERIDO_A'
                    ,ISNULL(CONVERT(VARCHAR(25),C.tm_fecha),'SIN TRANSFERENCIA') AS  'FECHA_TRANSFERENCIA'

		FROM 
			tececab.dbo.ChGenericoAltas AS B
                        LEFT OUTER JOIN tcc_control_ruta.dbo.tb_transferencia_movistar as C
                        on B.ICC=C.tm_icc
		WHERE 
			B.FECHA_ALTA >='" . $fechaInicio . "' 
			AND B.FECHA_ALTA <= '" . $fechaFin . "'
            
                ";
//        var_dump($sql);die();
        $this->connection = Yii::app()->db_grp;
        $command = $this->connection->createCommand($sql);
        $data4 = $command->queryAll();
        $dataResultado['detalleExportarAltas'] = $data4;

        $this->Close();
        return $dataResultado;
    }

    public function getAltasFueraZona($fechaInicio, $fechaFin) {
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
                    ,B.NOMBRE_CLIENTE AS CODIGO_CLIENTE
		FROM 
			ChGenericoAltasFueraZona AS B 
		WHERE 
			B.FECHA_ALTA >='" . $fechaInicio . "' 
			AND B.FECHA_ALTA <= '" . $fechaFin . "'
			AND B.TIPO_CLIENTE IS NOT NULL
                ORDER BY B.ANIO_DE_VENTA,B.MES_DE_VENTA 
                ";
//        var_dump($sql);die();
        $this->connection = Yii::app()->db_grp;
        $command = $this->connection->createCommand($sql);
//        var_dump($command);die();
//        var_dump($sql);die();
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getAltasFueraZonaPorTipoBodega($fechaInicio, $fechaFin, $tipoBodega) {
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
                    ,B.NOMBRE_CLIENTE AS CODIGO_CLIENTE
		FROM 
			ChGenericoAltasFueraZona AS B 
		WHERE 
			B.FECHA_ALTA >='" . $fechaInicio . "' 
			AND B.FECHA_ALTA <= '" . $fechaFin . "'
			AND B.TIPO_CLIENTE IS NOT NULL
                ORDER BY B.ANIO_DE_VENTA,B.MES_DE_VENTA 
                ";
//        var_dump($sql);die();
        $this->connection = Yii::app()->db_grp;
        $command = $this->connection->createCommand($sql);
//        var_dump($command);die();
//        var_dump($sql);die();
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    public function getAltasSinVentaPorPeriodo($fechaInicio, $fechaFin) {
        $sql = "EXEC SP_CHIP_GENERICO_ALTAS '" . $fechaInicio . "','" . $fechaFin . "',0";
        $this->connection = Yii::app()->db_grp;
        $command = $this->connection->createCommand($sql);
        $command->execute();

        $sql = "
            select 
                    CHAR(39)+convert(varchar(25),B.MIN) AS A_MIN
                    ,B.CIUDAD AS A_CIUDAD
                    ,CHAR(39)+convert(varchar(25),ISNULL(B.ICC,'SIN TX EN MOVISTAR')) AS A_ICC
                    , CHAR(39)+convert(varchar(25),ISNULL(A.tm_min,'SIN TX EN MOVISTAR')) AS TX_MIN
                    ,ISNULL(A.tm_nombredistribuidor,'SIN TX EN MOVISTAR') AS TX_ORIGEN
                    ,ISNULL(A.tm_nombredestino,'SIN TX EN MOVISTAR') AS TX_DESTINO
                    ,ISNULL(CONVERT(VARCHAR(20),A.tm_fecha),'SIN TX EN MOVISTAR') AS TX_FECHA
                    
                    ,ISNULL(CONVERT(VARCHAR(20),C.vm_distribuidor),'SIN TX EN MOVISTAR') AS VM_ORIGEN
                    ,ISNULL(CONVERT(VARCHAR(20),C.vm_nombredestino),'SIN TX EN MOVISTAR') AS VM_DESTINO
                    ,ISNULL(CONVERT(VARCHAR(20),C.vm_fecha),'SIN TX EN MOVISTAR') AS VM_FECHA
                    ,CHAR(39)+convert(varchar(25),ISNULL(CONVERT(VARCHAR(20),C.vm_min),'SIN TX EN MOVISTAR')) AS VM_MIN

                from 
                    tececab.dbo.ChGenericoAltas AS B
                    LEFT OUTER JOIN tcc_control_ruta.dbo.tb_transferencia_movistar AS A
                        ON A.tm_icc =B.ICC
                    LEFT OUTER JOIN tcc_control_ruta.dbo.tb_venta_movistar as C
                        on B.ICC=C.vm_icc
                WHERE 1=1
                    AND B.FECHA_ALTA >='" . $fechaInicio . "' 
                    AND B.FECHA_ALTA <= '" . $fechaFin . "'
                    AND B.TIPO_CLIENTE IS NULL
                ";
//        var_dump($sql);die();
        $this->connection = Yii::app()->db_grp;
        $command = $this->connection->createCommand($sql);
//        var_dump($command);die();
//        var_dump($sql);die();
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

}
