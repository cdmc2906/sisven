<?php

class FValidacionChipModel extends DAOModel {

    /**
     * 
     * @param type $minValidar Min sin el cero del inicio
     * @return type Datos del min
     */
    public function getDatosChipsXMin(
    $tipoValidacion
    , $minValidarOriginal
    , $fechaActivacion
    , $estadoValidacion = ''
    , $operadora
    , $codigoLocal
    , $reportadoPor
    , $ejecutivoReporta = ''
    , $reportadoVia
    , $fechaProceso
    ) {
        $largomin = strlen($minValidarOriginal);
        switch ($largomin) {
            case 9:
                $minValidar = $minValidarOriginal;
                break;
            default:
                $minValidar = substr($minValidarOriginal, 1, 9);
                break;
        };

        $conWildcard = strpos($minValidar, '%');
        $condicion = ' ';
        $condicion = $condicion . ($conWildcard === false ? "= CHAR(39)+'" . $minValidar . "'" : " LIKE '" . $minValidar . "'");
        $dato = ($conWildcard === false ? $minValidarOriginal : trim($minValidarOriginal . '%'));
        $sql = "
            SELECT 
                '" . $tipoValidacion . "' AS TIPO
                ,'VM' AS SUBTIPO
                , '" . $dato . "' AS MIN_ICC
                , '" . $fechaActivacion . "' AS CAMPO_VALIDA
                , '" . $estadoValidacion . "' AS RESULTADO_VALIDA
                , '" . $operadora . "' AS PROMO_OPERADORA
                , '" . $codigoLocal . "' AS PROMO_CODIGO_LOCAL
                , '" . $reportadoPor . "' AS PROMO_REPORTADO_POR
                , '" . $ejecutivoReporta . "' AS PROMO_EJECUTIVO_REPORTA
                , '" . $reportadoVia . "' AS PROMO_REPORTA_VIA
                , '" . $fechaProceso . "' AS FECHA_REVISION
                , * 
                FROM 
                tececab.dbo.V_CHIPS_COMPRA_ALTA_VENTA_13 AS A
                WHERE A.COMPRA_MIN " . $condicion . "
            ;";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);        die();
        $this->Close();
        return $data;
    }

    /**
     * 
     * @param type $iccValidar ICC a validar
     * @return type Datos del ICC
     */
    public function getDatosChipsXICC(
    $tipoValidacion
    , $iccValidar
    , $fechaActivacion
    , $estadoValidacion = ''
    , $operadora
    , $codigoLocal
    , $reportadoPor
    , $ejecutivoReporta = ''
    , $reportadoVia
    , $fechaProceso
    ) {

        $conWildcard = strpos($iccValidar, '%');
        $condicion = ' ';
        $condicion = $condicion . ($conWildcard === false ? "= CHAR(39)+'" . $iccValidar . "'" : " LIKE '" . $iccValidar . "'");
        $dato = ($conWildcard === false ? $iccValidar : trim($iccValidar . '%'));
        $sql = "
            SELECT 
            '" . $tipoValidacion . "' AS TIPO
                ,'VI' AS SUBTIPO
                ,'" . $dato . "' AS MIN_ICC
                ,'" . $fechaActivacion . "' AS CAMPO_VALIDA
                ,'" . $estadoValidacion . "' AS RESULTADO_VALIDA
                ,'" . $operadora . "' AS PROMO_OPERADORA
                ,'" . $codigoLocal . "' AS PROMO_CODIGO_LOCAL
                ,'" . $reportadoPor . "' AS PROMO_REPORTADO_POR
                ,'" . $ejecutivoReporta . "' AS PROMO_EJECUTIVO_REPORTA
                ,'" . $reportadoVia . "' AS PROMO_REPORTA_VIA
                ,'" . $fechaProceso . "' AS FECHA_REVISION
                    
            ,* 
                FROM 
                tececab.dbo.V_CHIPS_COMPRA_ALTA_VENTA_13 AS A
                WHERE A.COMPRA_ICC " . $condicion . "
                ;";

//        var_dump($sql);        die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);         die();
        $this->Close();
        return $data;
    }

    public function getAltasporMIN($minICC) {
        $sql = "
         /*  select 
                    CONVERT(DATE,FECHA_ALTA) AS FECHA_ALTA 
                FROM
                    tececab.dbo.CHIP_COMPRA as a
                WHERE 1=1
                    and a.MIN like '%" . $minICC . "'
                ORDER BY FECHA_COMPRA DESC*/
                
  select 
 ISNULL(CONVERT(DATE,FECHA_ALTA),'') AS FECHA_ALTA 
 FROM tececab.dbo.CHIP_COMPRA as a 
 WHERE 1=1 and a.MIN like '%" . $minICC . "'  
 ORDER BY FECHA_COMPRA DESC,FECHA_ALTA
 
                ;";

//        var_dump($sql);         die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);         die();
        $this->Close();
        return $data;
    }
    public function getAltasporICC($ICC) {
        $sql = "
         /*  select 
                    CONVERT(DATE,FECHA_ALTA) AS FECHA_ALTA 
                FROM
                    tececab.dbo.CHIP_COMPRA as a
                WHERE 1=1
                    and a.MIN like '%" . $ICC . "'
                ORDER BY FECHA_COMPRA DESC*/
                
  select 
 ISNULL(CONVERT(DATE,FECHA_ALTA),'') AS FECHA_ALTA 
 FROM tececab.dbo.CHIP_COMPRA as a 
 WHERE 1=1 and a.ICC like '%" . $ICC . "'  
 ORDER BY FECHA_COMPRA DESC,FECHA_ALTA
 
                ;";

//        var_dump($sql);         die();
        $command = $this->connection->createCommand($sql);
        $data = $command->queryAll();
//        var_dump($data);         die();
        $this->Close();
        return $data;
    }

}
