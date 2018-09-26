<?php

class FIndicadoresModel extends DAOModel {

    public function getCapilaridad($fechaInicio, $fechaFin, $idPeriodo) {
        $sql = "
            SELECT 
                    UPPER(I_BODEGA) AS VENDEDOR
                    ,i_numero_bodega AS CDGBODEGA
                    ,COUNT(DISTINCT I_CODIGO_GRUPO) AS CAPILARIDAD
                    ,COUNT(DISTINCT I_IMEI)AS VENTA
                    ,CONVERT(INT,D.P_VALOR_PRESUPUESTO) AS PRESUPUESTO
                    ,ISNULL(UPPER(left(DATENAME(DAY,MAX(A.i_fecha)),3))+'-'+UPPER(left(DATENAME(MONTH,MAX(A.i_fecha)),3)),'SIN_DATA')  as UVENTA
                FROM 
                    TB_INDICADORES AS A
                    INNER JOIN TB_EJECUTIVO AS C
                        ON A.I_NUMERO_BODEGA=C.E_ID_BODEGA_DELTA
                    INNER JOIN TB_PRESUPUESTO_VENTA AS D
                        ON D.P_CODIGO_VENDEDOR=C.E_USR_MOBILVENDOR
                WHERE 1=1
                    AND I_FECHA>='" . $fechaInicio . "' 
                    AND I_FECHA<='" . $fechaFin . "'
                    AND D.P_TIPO_PRESUPUESTO='CAPILARIDAD'
                    AND D.P_ESTADO_PRESUPUESTO=4
                    AND D.pg_id=" . $idPeriodo . "
                GROUP BY I_BODEGA,i_numero_bodega,P_VALOR_PRESUPUESTO
                ORDER BY 1
";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

    public function getSellIn($fechaInicio, $fechaFin, $idPeriodo) {
        $sql = "
            SELECT 
                    UPPER(I_BODEGA) AS VENDEDOR
                    ,COUNT(DISTINCT I_CODIGO_GRUPO) AS CAPILARIDAD
                    ,COUNT(DISTINCT I_IMEI)AS VENTA
                    ,CONVERT(INT,D.P_VALOR_PRESUPUESTO) AS PRESUPUESTO
                FROM 
                    TB_INDICADORES AS A
                    INNER JOIN TB_EJECUTIVO AS C
                        ON A.I_NUMERO_BODEGA=C.E_ID_BODEGA_DELTA
                    INNER JOIN TB_PRESUPUESTO_VENTA AS D
                        ON D.P_CODIGO_VENDEDOR=C.E_USR_MOBILVENDOR
                WHERE 1=1
                    AND I_FECHA>='" . $fechaInicio . "' 
                    AND I_FECHA<='" . $fechaFin . "'
                    AND D.P_TIPO_PRESUPUESTO='SELLIN (VENTA)'
                    AND D.P_ESTADO_PRESUPUESTO=4
                    AND D.pg_id=" . $idPeriodo . "
                GROUP BY I_BODEGA,P_VALOR_PRESUPUESTO
                ORDER BY 1
";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

    public function getCapilaridadDescartar($numeroBodegaDelta, $fechaInicio, $fechaFin) {
        $sql = "
            SELECT 
                    ISNULL(COUNT(DISTINCT i_codigo_grupo),0) AS DESCARTAR
                FROM 
                    TB_INDICADORES
                WHERE 1=1
                    AND I_FECHA>='" . $fechaInicio . "' 
                    AND I_FECHA<='" . $fechaFin . "' 
                    AND i_numero_bodega='" . $numeroBodegaDelta . "'  
                    AND i_codigo_grupo IN(
                                    select 
                                            i_codigo_grupo as tcqu
                                        from tb_indicadores
                                        where 1=1
                                                AND i_fecha>='" . $fechaInicio . "'  
                                                AND i_fecha<='" . $fechaFin . "'  
                                        group by i_codigo_grupo
                                        having COUNT(distinct i_numero_bodega) >1
                                    )
                GROUP BY i_numero_bodega,i_bodega
           ";
//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

    public function getDuplicado($fechaInicio, $fechaFin) {
        $sql = "
            select 
                    distinct COUNT(distinct i_bodega) as duplicado
                from tb_indicadores
                WHERE 1=1 
                    AND i_fecha>='" . $fechaInicio . "' 
                    AND i_fecha<='" . $fechaFin . "' 
                group by i_codigo_grupo
                having COUNT(distinct i_bodega)>1            
            ";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

}
