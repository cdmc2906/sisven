<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FuncionesBaseDatos
 *
 * @author caraujo
 */
class FuncionesBaseDatos {

    /**
     * 
     * @param type $dbms Gestor de base de datos a usar
     * @param type $fecha Fecha para convertir
     * @return type resultado de conversion a tipo fecha yyy-mm-dd
     */
    public static function convertToDate($dbms, $fecha) {
        switch ($dbms) {
            case 'mysql':
                return 'date(' . $fecha . ')';
                break;
            case 'sqlsrv':
                return 'convert(date,' . $fecha . ')';
                break;
        }
    }

    /**
     * @param type $dbms Gestor de base de datos a usar
     * @param type $fecha Fecha para convertir
     * @return type resultado de conversion a tipo tiempo hh:mm
     */
    public static function convertToTimeHHMMSS($dbms, $fecha) {
        switch ($dbms) {
            case 'mysql':
                return "TIME_FORMAT(' . $fecha . ', '%H:%i:%s'))";
                break;
            case 'sqlsrv':
                return 'CONVERT(VARCHAR(8), CAST(' . $fecha . ' AS TIME), 108)';
//                return 'convert(date,' . $fecha . ')';
                break;
        }
    }

    public static function convertToDecimal($dbms, $campo, $cantidadDigitos, $cantidadDecimales) {
        switch ($dbms) {
            case 'mysql':
                return " CONVERT($campo, decimal($cantidadDigitos, $cantidadDecimales)";
                break;
            case 'sqlsrv':
                return " CONVERT(DECIMAL($cantidadDigitos,$cantidadDecimales),$campo) ";
                break;
        }
    }

    /**
     * @param type $dbms Gestor de base de datos a usar
     * @param type $fecha Fecha para convertir
     * @return type resultado de conversion a tipo date y tiempo YYYYmmdd HHMM
     */
    public static function convertToDateTimeYYYYMMDDHHMM($dbms, $fecha) {
        switch ($dbms) {
            case 'mysql':
                return "DATE_FORMAT(" . $fecha . ", '%Y-%m-%d %H:%i') ";
                break;
            case 'sqlsrv':
                return 'CONVERT(VARCHAR(16),' . $fecha . ')';
                break;
        }
    }

    /**
     * @param type $dbms Gestor de base de datos a usar
     * @param type $fecha Fecha para convertir
     * @return type resultado de conversion a tipo date y tiempo YYYYmmdd HHMM
     */
    public static function convertToDateTimeYYYYMMDDHHMMSS($dbms, $fecha) {
        switch ($dbms) {
            case 'mysql':
                return "DATE_FORMAT(" . $fecha . ", '%Y-%m-%d %H:%i') ";
                break;
            case 'sqlsrv':
                return 'CONVERT(VARCHAR(19),' . $fecha . ')';
                break;
        }
    }

    /**
     * @param type $dbms Gestor de base de datos a usar
     * @param type $fecha Fecha para convertir
     * @return type resultado de conversion a tipo date y tiempo YYYYmmdd HHMM
     */
    public static function isnull($dbms) {
        switch ($dbms) {
            case 'mysql':
                return 'IFNULL';
                break;
            case 'sqlsrv':
                return 'ISNULL';
                break;
        }
    }

}
