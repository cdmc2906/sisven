<?php

/**
 * Constantes ETIQUETAS
 */
define('HOME_PRINCIPAL', '192.168.10.15:9090');
define('MINMETROSVISITAVALIDA', '10');
define('MAXMETROSVISITAVALIDA', '15');
define('ELEMENTOS_PAGINA', '[15,30,50,100]');
define('NRO_FILAS', '15');
define('ERROR', 0);
define('SUCCESS', 1);
define('NOTICE', 2);
define('TIMEOUT_POST', 0);
define('MENSAJE_DEFAULT', '');
define('HORARIO_MAXIMO', '23:59:59');
define('CLASS_MENSAJE_SUCCESS', 'success');
define('CLASS_MENSAJE_NOTICE', 'notice');
define('CLASS_MENSAJE_ERROR', 'error');
define('INTERVALO_MONITOREO_SEC', 30);
define('INTERVALO_REFRESCO_AUTOMATICO', 60);

define('GRUPO_USUARIOS_SUPERVISION', '1,2');
define('GRUPO_USUARIOS_ADMIN', '\'QU17\',\'QU19\',\'QU21\',\'QU22\',\'QU26\',\'QU25\'');


define('GRUPO_EJECUTIVOS_ZONA', '\'QU17\',\'QU19\',\'QU21\',\'QU22\',\'QU26\',\'QU25\'');
define('GRUPO_SUPERVISORES', '\'QU20\',\'QU39\',\'QU47\'');
define('GRUPO_SERVICIO_CLIENTE', '\'QU23\',\'QU24\'');
define('GRUPO_TODOS', '\'QU17\',\'QU19\',\'QU21\',\'QU22\',\'QU26\',\'QU25\',\'QU23\',\'QU24\',\'QU20\',\'QU39\',\'QU47\'');

define('COPYRIGHT', 'TECECAB');
define('LEYENDA_COPYRIGHT', 'Todos los derechos reservados &copy;');

/* Combos */
define('VALUE_OPCION_SELECCIONE', 'seleccione');
define('VALUE_OPCION_TODOS', 'todos');
define('TEXT_OPCION_SELECCIONE', '--Seleccione--');
define('TEXT_OPCION_TODOS', '--Todos--');

define('CLAVE_ENCRIPTACION_DATOS', 'claveSecreta');
define('CLAVE_ENCRIPTACION_ARCHIVOS', 'claveSecretaArchivos');

/* UBICACION ARCHIVOS ENCRIPTADOS */
define('CLAVE_ENCRIPTACION', 'claveSecreta');
define('IV_ENCRIPTACION', '1234658');
define('RUTA_ARCHIVO_CLAVE', 'E:\confBddEtiquetas\firma_segura.conf');
define('RUTA_ARCHIVO_CONEXION', 'E:\confBddEtiquetas\\');

/* Clases setFlash */
define('FLASH_SUCCESS', 'success');
define('FLASH_ERROR', 'error');
define('FLASH_NOTICE', 'notice');

define('FORMATO_FECHA_LONG', 'Y/m/d G:i:s');
define('FORMATO_FECHA_LONG_2', 'Y/m/d G:i');
define('FORMATO_FECHA', 'Y/m/d');
define('FORMATO_FECHA_2', 'd-m');
define('FORMATO_FECHA_BDD', '\'YYYY/MM/DD\'');
define('FORMATO_FECHA_BDD_LONG', '\'YYYY/MM/DD HH24:MI:SS\'');
define('FORMATO_NUMERO_ERROR', 'YmdGis');

define('TAMANIO_BLOQUE', 100);

/* End of file constants.php */
/* Location: ./application/config/constants.php */
