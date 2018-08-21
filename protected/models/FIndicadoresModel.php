<?php

class FIndicadoresModel extends DAOModel {
   
    public function getCapilaridad($fechaInicio,$fechaFin) {
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
                    AND I_FECHA>='".$fechaInicio."' 
                    AND I_FECHA<='".$fechaInicio."'
                    AND D.P_TIPO_PRESUPUESTO='CAPILARIDAD'
                    AND D.P_ESTADO_PRESUPUESTO=4
                GROUP BY I_BODEGA,P_VALOR_PRESUPUESTO
                ORDER BY 1
";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }
    
    public function getSellIn($fechaInicio,$fechaFin) {
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
                    AND I_FECHA>='".$fechaInicio."' 
                    AND I_FECHA<='".$fechaInicio."'
                    AND D.P_TIPO_PRESUPUESTO='SELLIN (VENTA)'
                    AND D.P_ESTADO_PRESUPUESTO=4
                GROUP BY I_BODEGA,P_VALOR_PRESUPUESTO
                ORDER BY 1
";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }
}
