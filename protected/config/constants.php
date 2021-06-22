<?php

/**
 * Constantes ETIQUETAS
 */
define('PRUEBA_MAIL', false);
define('DBMS', 'sqlsrv'); //opciones mysql sqlsrv
define('MAIL', 'christian.araujo@tececab.com.ec');

define('EJECUTIVOS_REVISION_INDIVIDUAL', '(\'EZM\',\'EZMC\',\'EZT\',\'D\',\'ST\',\'SC\')');
define('PATH_FOLDER_ADJUNTOS', 'C:\archivos_adjuntos_mail\\');
define('LAYOUT_ADMIN_CATALOG', '//layouts/layout_admin_catalog');
define('LAYOUT_IMPORTAR', '//layouts/layout_importar');
define('LAYOUT_INDEX', '//layouts/main');
define('LAYOUT_FILTRO_GRID', '//layouts/main');

define('VALIDACION_PROMO', 'PROMOS');
define('VALIDACION_INVASION', 'INVAS');
define('VALIDACION_AUDITORIA', 'AUDIT');

define('TIPO_NOVEDAD_NO_COMPRA_CHIP', 'No compra chip');
define('TIPO_NOVEDAD_GENERAL', 'Incidente');

define('NUMERO_DECIMALES_RESULTADO', '0');

define('INICIAL_CLIENTES_MOVISTAR', 'TCQU');
define('INICIAL_CLIENTES_MOVISTAR_MANABI', 'TCMB');
define('INICIAL_CLIENTES_TUENTI', 'TU');
define('INICIAL_CLIENTES_TEMPORAL', 'TCTM');
define('INICIAL_CLIENTES_TEMPORAL_2', 'TMp');

define('OPERADOR_BETWEEN', 'BETWEEN');
define('OPERADOR_MAYOR_IGUAL', '>=');
define('OPERADOR_MENOR_IGUAL', '<=');
define('OPERADOR_IGUAL', '=');
define('OPERADOR_LIKE', 'LIKE');
define('OPERADOR_IN', 'IN');
define('OPERADOR_DIFERENTE', '!=');
define('NO_TECECAB', '*NO TECECAB*');


define('MINMETROSVISITAVALIDA', '10');
define('MAXMETROSVISITAVALIDA', '15');
define('ELEMENTOS_PAGINA', '[15,30,50,100]');
define('NRO_FILAS', '15');
define('ERROR', 0);
define('SUCCESS', 1);
define('NOTICE', 2);
define('MAXIMO_DIAS_REPORTE_HISTORIAL', 6);
define('COLUMNAS_RESUMEN_HISTORIAL', 16);
define('TIMEOUT_POST', 0);
define('MENSAJE_DEFAULT', '');
define('HORARIO_MAXIMO', '23:59:59');
define('CLASS_MENSAJE_SUCCESS', 'success');
define('CLASS_MENSAJE_NOTICE', 'notice');
define('CLASS_MENSAJE_ERROR', 'error');
define('INTERVALO_MONITOREO_SEC', 30);
define('INTERVALO_REFRESCO_AUTOMATICO', 60);
define('INTERVALO_REFRESCO_INMEDIATO', 1);
define('SISTEMA', 'sisven_2');
define('USUARIO_INVITADO', '2');
define('TIPOCOMENTARIOENLACEMAPA', 'Enlace Mapa');
define('TIPOCOMENTARIOJORNADA', 'Comentario Jornada');
define('PRECIO_UNITARIO_PRODUCTO_CHIP_MOVI', '1.1160');
define('HORA_INICIO_DIA', ' 00:00');
define('HORA_FIN_DIA', ' 23:59');

define('GRUPO_USUARIOS_SUPERVISION', '1,2');
define('GRUPO_USUARIOS_ADMIN', '\'QU17\',\'QU19\',\'QU21\',\'QU22\',\'QU26\',\'QU25\'');

define('GRUPO_EJECUTIVOS_ZONA_MOVI_ZMANABI', 'EZMM');
define('GRUPO_EJECUTIVOS_ZONA_MOVI_ZS', 'EZMS');
define('GRUPO_EJECUTIVOS_ZONA_MOVI_ZC', 'EZMCV');
define('GRUPO_EJECUTIVOS_ZONA_TUENTI', 'EZT');
define('GRUPO_SUPERVISORES_MOVI_ZS', 'SUPMS');
define('GRUPO_SUPERVISORES_MOVI_ZC', 'SUPMC');
define('GRUPO_SUPERVISORES_TUENTI', 'SUPT');
define('GRUPO_SERVICIO_CLIENTE', 'SC');
define('GRUPO_DESARROLLADORES', 'D');
define('GRUPO_TECNICOS', 'ST');
define('GRUPO_CANAL_DIGITAL', 'ECD');
define('GRUPO_ZONA_EXTERNO', 'EZE');
define('GRUPO_USR_TECECAB', 'TCC');
define('GRUPO_CHOFER_VAN', 'VAN');

define('RUTASNOREVISAR', '\'RZS 47\',\'RZS 39\',\'RZS 20\'');

define('_30DIAS', '30');
define('_60DIAS', '60');
define('_90DIAS', '90');

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
define('FORMATO_FECHA_LONG_3', 'Y-m-d G:i');
define('FORMATO_FECHA_LONG_4', 'Y-m-d G:i:s');
define('FORMATO_FECHA_LONG_5', 'd/m/Y G:i:s');
define('FORMATO_FECHA_LONG_6', 'd_m_Y-G_i_s');
define('FORMATO_FECHA_LONG_7', 'd/m/Y H:i:s:u');

define('FORMATO_FECHA', 'Y/m/d');
define('FORMATO_FECHA_2', 'd-m');
define('FORMATO_FECHA_3', 'Y-m-d');

define('SEMANAS_GESTION', '4');

define('CODIGO_COMENTARIO_CERRADOS', 'CERRADO');
define('CODIGO_COMENTARIO_GESTION_CAMPO', 'GESTION_EN_CAMPO_ABIERTO GESTION_EN_CAMPO_CERRADO LOCAL_ABIERTO NO_LOCALIZADO');
//define('CODIGO_COMENTARIO_GESTION_CAMPO_2', '\'GESTION_EN_CAMPO_ABIERTO\',\'GESTION_EN_CAMPO_CERRADO\',\'LOCAL_ABIERTO\',\'NO_LOCALIZADO\'');
define('CODIGO_COMENTARIO_GESTION_TELEFONO', 'GESTION_TELEFONICA_OK GESTION_TELEFONICA_FAIL');


define('FORMATO_HORA', 'H:i:s');
define('FORMATO_HORA_1', '%H:%i:%s');
define('FORMATO_HORA_3', '%Hh %im %ss');
define('FORMATO_HORA_2', 'H:i');

define('FORMATO_FECHA_BDD', '\'YYYY/MM/DD\'');
define('FORMATO_FECHA_BDD_LONG', '\'YYYY/MM/DD HH24:MI:SS\'');
define('FORMATO_NUMERO_ERROR', 'YmdGis');

define('TAMANIO_BLOQUE', 100);

/* End of file constants.php */
/* Location: ./application/config/constants.php */
