<?php

class FVentasMovistarModel extends DAOModel {

    public static function getFechaUltimaCarga() {
        $command1 = Yii::app()->db->createCommand("
        select 
                MAX(CONVERT(DATE,vm_fecha_ingreso)) as ultimacarga
            from tcc_control_ruta.dbo.tb_venta_movistar
");

        $resultado1 = $command1->queryRow();

        return $resultado1['ultimacarga'];
    }
    public function getVentasMes($fechaInicio, $fechaFin) {
        $sql = "
            SET LANGUAGE Spanish;  
            SELECT 
                    UPPER(A.vm_nombredistribuidor) AS BODEGA
                    ,COUNT(A.VM_ICC) AS CANTIDAD_MINES
                    ,ISNULL(UPPER(left(DATENAME(DAY,A.VM_FECHA),3))+'-'+UPPER(left(DATENAME(MONTH,A.VM_FECHA),4)),'SIN_DATA') AS FECHA_VENTA_MOVISTAR
                FROM TB_VENTA_MOVISTAR AS A
                WHERE 1=1
                    AND A.VM_FECHA>='" . $fechaInicio . "' 
                    AND A.VM_FECHA<='" . $fechaFin . "'
                GROUP BY A.vm_nombredistribuidor,A.VM_FECHA
            ";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

    public function getCapilaridad($fechaInicio, $fechaFin, $idPeriodo) {
        $sql = "
            SELECT 
                     VM_NOMBREDISTRIBUIDOR AS VENDEDOR
                    ,VM_DISTRIBUIDOR AS CDGVENDEDOR
                    ,COUNT(DISTINCT VM_IDDESTINO)AS CAPILARIDAD
                    ,COUNT(DISTINCT VM_ICC)AS VENTA
                    ,CONVERT(INT,D.P_VALOR_PRESUPUESTO) AS PRESUPUESTO
                    ,ISNULL(UPPER(left(DATENAME(DAY,MAX(A.vm_fecha)),3))+'-'+UPPER(left(DATENAME(MONTH,MAX(A.vm_fecha)),3)),'SIN_DATA')  as UVENTA
                FROM 
                    TB_VENTA_MOVISTAR AS A
                    INNER JOIN TB_EJECUTIVO AS C
                        ON RIGHT(A.VM_DISTRIBUIDOR,4)=C.E_USR_MOBILVENDOR
                    INNER JOIN TB_PRESUPUESTO_VENTA AS D
                        ON D.P_CODIGO_VENDEDOR=C.E_USR_MOBILVENDOR
                WHERE 1=1
                    AND VM_FECHA>='" . $fechaInicio . "' 
                    AND VM_FECHA<='" . $fechaFin . "'
                    AND D.P_TIPO_PRESUPUESTO='CAPILARIDAD'
                    AND D.P_ESTADO_PRESUPUESTO=4
                    AND D.pg_id=" . $idPeriodo . "
                GROUP BY VM_NOMBREDISTRIBUIDOR,VM_DISTRIBUIDOR,P_VALOR_PRESUPUESTO
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
                    AND VM_FECHA>='" . $fechaInicio . "' 
                    AND VM_FECHA<='" . $fechaFin . "'
                    AND D.P_TIPO_PRESUPUESTO='SELLIN (VENTA)'
                    AND D.P_ESTADO_PRESUPUESTO=4
                    AND D.pg_id=" . $idPeriodo . "
                GROUP BY VM_NOMBREDISTRIBUIDOR,P_VALOR_PRESUPUESTO
                ORDER BY 1

            ";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

    public function getCapilaridadDescartar($codigoMovistarEjecutivo, $fechaInicio, $fechaFin) {
        $sql = "
             SELECT 
                    ISNULL(COUNT(DISTINCT VM_IDDESTINO),0) AS DESCARTAR
                FROM 
                    TB_VENTA_MOVISTAR AS A
                WHERE 1=1
                    AND VM_FECHA>='" . $fechaInicio . "' 
                    AND VM_FECHA<='" . $fechaFin . "' 
                    AND vm_distribuidor='" . $codigoMovistarEjecutivo . "' 
                    AND vm_iddestino IN(
                                    select 
                                            vm_iddestino as tcqu
                                        from tb_venta_movistar
                                        where 1=1
                                                AND vm_fecha>='" . $fechaInicio . "' 
                                                AND vm_fecha<='" . $fechaFin . "' 
                                        group by vm_iddestino
                                        having COUNT(distinct vm_distribuidor) >1
                                    )
                GROUP BY VM_NOMBREDISTRIBUIDOR,VM_DISTRIBUIDOR


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
                distinct COUNT(distinct vm_distribuidor) as duplicado
            from tb_venta_movistar
            WHERE 1=1 
                AND vm_fecha>='" . $fechaInicio . "' 
                AND vm_fecha<='" . $fechaFin . "' 
                 
            group by vm_iddestino
            having COUNT(distinct vm_distribuidor)>1            
            ";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();

        $this->Close();
        return $data;
    }

    public function getDatosVentaxICC($iccBuscar) {
        $sql = "
           select
                vm_iddestino
                ,vm_nombredestino
                ,vm_fecha 
            from tcc_control_ruta.dbo.tb_venta_movistar 
            where vm_icc ='" . $iccBuscar . "';
            ";
//        var_dump($sql);die();   
        $command = $this->connection->createCommand($sql);

        $data = $command->queryAll();
        $this->Close();
        return $data;
    }

}
