<?php

class FVentasMovistarModel extends DAOModel {

    public function getVentasMes($fechaInicio, $fechaFin) {
        $sql = "
            SET LANGUAGE Spanish;  
            SELECT 
                    UPPER(B.I_BODEGA) AS BODEGA
                    ,COUNT(A.VM_ICC) AS CANTIDAD_MINES
                    ,ISNULL(UPPER(left(DATENAME(DAY,A.VM_FECHA),3))+'-'+UPPER(left(DATENAME(MONTH,A.VM_FECHA),3)),'SIN_DATA') AS FECHA_VENTA_MOVISTAR
                FROM TB_VENTA_MOVISTAR AS A
                    INNER JOIN TB_INDICADORES AS B
                        ON A.VM_ICC=B.I_IMEI
                WHERE 1=1
                    AND A.VM_FECHA>='".$fechaInicio."' 
                    AND A.VM_FECHA<='".$fechaFin."'
                GROUP BY B.I_BODEGA,A.VM_FECHA
            ";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

    public function getCapilaridad($fechaInicio, $fechaFin) {
        $sql = "
            SELECT 
                     VM_NOMBREDISTRIBUIDOR AS VENDEDOR
                    ,COUNT(DISTINCT VM_IDDESTINO)AS CAPILARIDAD
                    ,COUNT(DISTINCT VM_ICC)AS VENTA
                    ,CONVERT(INT,D.P_VALOR_PRESUPUESTO) AS PRESUPUESTO
                FROM 
                    TB_VENTA_MOVISTAR AS A
                    INNER JOIN TB_EJECUTIVO AS C
                        ON RIGHT(A.VM_DISTRIBUIDOR,4)=C.E_USR_MOBILVENDOR
                    INNER JOIN TB_PRESUPUESTO_VENTA AS D
                        ON D.P_CODIGO_VENDEDOR=C.E_USR_MOBILVENDOR
                WHERE 1=1
                    AND VM_FECHA>='".$fechaInicio."' 
                    AND VM_FECHA<='".$fechaFin."'
                    AND D.P_TIPO_PRESUPUESTO='CAPILARIDAD'
                    AND D.P_ESTADO_PRESUPUESTO=4
                GROUP BY VM_NOMBREDISTRIBUIDOR,VM_DISTRIBUIDOR,P_VALOR_PRESUPUESTO
                ORDER BY 1

            ";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

    public function getSellIn($fechaInicio, $fechaFin) {
        $sql = "
            SELECT 
                     VM_NOMBREDISTRIBUIDOR AS VENDEDOR
                    ,COUNT(DISTINCT VM_ICC)AS VENTA
                    ,CONVERT(INT,D.P_VALOR_PRESUPUESTO) AS PRESUPUESTO
                FROM 
                    TB_VENTA_MOVISTAR AS A
                    INNER JOIN TB_EJECUTIVO AS C
                        ON RIGHT(A.VM_DISTRIBUIDOR,4)=C.E_USR_MOBILVENDOR
                    INNER JOIN TB_PRESUPUESTO_VENTA AS D
                        ON D.P_CODIGO_VENDEDOR=C.E_USR_MOBILVENDOR
                WHERE 1=1
                    AND VM_FECHA>='".$fechaInicio."' 
                    AND VM_FECHA<='".$fechaFin."'
                    AND D.P_TIPO_PRESUPUESTO='SELLIN (VENTA)'
                    AND D.P_ESTADO_PRESUPUESTO=4
                GROUP BY VM_NOMBREDISTRIBUIDOR,VM_DISTRIBUIDOR,P_VALOR_PRESUPUESTO
                ORDER BY 1

            ";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

}
