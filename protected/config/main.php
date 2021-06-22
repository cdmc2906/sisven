<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'TECECAB - SISVEN',
    'language' => 'es',
    'sourceLanguage' => 'en',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.cruge.components.*',
        'application.modules.cruge.extensions.crugemailer.*',
        'application.extensions.PHPExcel.excel',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '1234',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1', '10.130.1.68'),
        ),
        'cruge' => array(
            'tableprefix' => 'cruge_',
            // para que utilice a protected.modules.cruge.models.auth.CrugeAuthDefault.php
            //
            // en vez de 'default' pon 'authdemo' para que utilice el demo de autenticacion alterna
            // para saber mas lee documentacion de la clase modules/cruge/models/auth/AlternateAuthDemo.php
            //
            'availableAuthMethods' => array('default'),
            'availableAuthModes' => array('username', 'email'),
            // url base para los links de activacion de cuenta de usuario
            'baseUrl' => 'http://coco.com/',
            // NO OLVIDES PONER EN FALSE TRAS INSTALAR
            'debug' => false,
            'rbacSetupEnabled' => false,
            'allowUserAlways' => false,
            // MIENTRAS INSTALAS..PONLO EN: false
            // lee mas abajo respecto a 'Encriptando las claves'
            //
            'useEncryptedPassword' => false,
            // Algoritmo de la función hash que deseas usar
            // Los valores admitidos están en: http://www.php.net/manual/en/function.hash-algos.php
            'hash' => 'md5',
            // Estos tres atributos controlan la redirección del usuario. Solo serán son usados si no
            // hay un filtro de sesion definido (el componente MiSesionCruge), es mejor usar un filtro.
            //  lee en la wiki acerca de:
            //   "CONTROL AVANZADO DE SESIONES Y EVENTOS DE AUTENTICACION Y SESION"
            //
            // ejemplo:
            //		'afterLoginUrl'=>array('/site/welcome'),  ( !!! no olvidar el slash inicial / )
            //		'afterLogoutUrl'=>array('/site/page','view'=>'about'),
            //
            'afterLoginUrl' => array('/site/index'),
//            'afterLoginUrl' => null,
            'afterLogoutUrl' => null,
            'afterSessionExpiredUrl' => null,
            // manejo del layout con cruge.
            //
//            'loginLayout' => '//layouts/column2',
            'loginLayout' => '//layouts/main_login',
//            'registrationLayout' => '//layouts/column2',
            'registrationLayout' => '//layouts/main_login',
//            'activateAccountLayout' => '//layouts/column2',
            'activateAccountLayout' => '//layouts/main_login',
//            'editProfileLayout' => '//layouts/column2',
            'editProfileLayout' => '//layouts/main_login',
            'resetPasswordLayout' => '//layouts/main_login',
            // en la siguiente puedes especificar el valor "ui" o "column2" para que use el layout
            // de fabrica, es basico pero funcional.  si pones otro valor considera que cruge
            // requerirá de un portlet para desplegar un menu con las opciones de administrador.
            //
            'generalUserManagementLayout' => 'ui',
//            'generalUserManagementLayout' => 'layouts/main_login',
            // permite indicar un array con los nombres de campos personalizados, 
            // incluyendo username y/o email para personalizar la respuesta de una consulta a: 
            // $usuario->getUserDescription(); 
            'userDescriptionFieldsArray' => array('email'),
        ),
        'notifyii',
    ),
    // application components
    'components' => array(
        //
        //  IMPORTANTE:  asegurate de que la entrada 'user' (y format) que por defecto trae Yii
        //               sea sustituida por estas a continuación:
        //
        
        'clientScript' => array(
            'scriptMap' => array(
//        'jquery.js'=>false,
                'jquery.min.js' => false,
            )
        ),
        'user' => array(
            'allowAutoLogin' => true,
            'class' => 'application.modules.cruge.components.CrugeWebUser',
            'loginUrl' => array('/cruge/ui/login'),
        ),
        'authManager' => array(
            'class' => 'application.modules.cruge.components.CrugeAuthManager',
        ),
        'crugemailer' => array(
            'class' => 'application.modules.cruge.components.CrugeMailer',
            'mailfrom' => 'sisven@tececab.com.ec',
            'subjectprefix' => 'SISVEN - ',
            'debug' => true,
        ),
        'format' => array(
            'datetimeFormat' => "d M, Y h:m:s a",
        ),
//        'user' => array(
//            // enable cookie-based authentication
//            'allowAutoLogin' => true,
//        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
//            'urlSuffix' => '.jsp',
            'caseSensitive' => true,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        // database settings are configured in database.php
        'db' => require(dirname(__FILE__) . '/database.php'),
//        'db_conn' => array(
//            'connectionString' => 'sqlsrv:server=localhost;database=tcc_control_ruta',
//            'username' => 'sa',
//            'password' => 'Admin2016..',
//            'charset' => 'utf8',
//        ),
//        
        'db_conn' => array(
            // uncomment the following lines to use a PostgreSQL database
            'class' => 'CDbConnection',
            'connectionString' => 'sqlsrv:server=10.130.1.17;database=tcc_control_ruta',
            'username' => 'sa',
            'password' => 'GrpMetro"==)',
            'charset' => 'utf8'
        ),
        'db_grp' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'sqlsrv:server=10.130.1.17;database=tececab',
            'username' => 'sa',
            'password' => 'GrpMetro"==)',
            'charset' => 'utf8'
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
//        'log' => array(
//            'class' => 'CLogRouter',
//            'routes' => array(
//                array(
//                    'class' => 'CFileLogRoute',
//                    'levels' => 'trace,log',
//                    'categories' => 'system.db.CDbCommand',
//                    'logFile' => 'db.log',
//                ),
//            ),
//        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error',
                ),
//                array(
//                    'class'=>'CEmailLogRoute',
//                    'levels'=>'error, warning, info',
//                    'emails'=>'christian.araujo@tececab.com.ec',
//                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'mensajeExcepcion' => 'Se ha generado un error en el sistema.',
        'adminEmail' => 'webmaster@example.com',
        'accioniniciovisita' => 'Inicio visita',
        'ivadoce' => '0.12',
        'ivaincdoce' => '1.12',
        'archivosConsumo' => 'C:\carga_mobilvendor\consumo' . date('YmdHs') . '.csv',
        'archivosCompra' => 'C:\carga_mobilvendor\compra' . date('YmdHs') . '.csv',
//        'archivosIndicadores' => 'C:\carga_mobilvendor\indicador' . date(FORMATO_FECHA_LONG_6) . '.csv',
//        'archivosIndicadores' => 'C:\carga_mobilvendor\indicador' . date(FORMATO_FECHA_LONG_6) ,
        'archivosIndicadores' => 'C:\carga_mobilvendor\\' . date(FORMATO_FECHA_LONG_6).'_' ,
        'archivosHistorialMb' => 'C:\carga_mobilvendor\historial' . date('YmdHs') . '.csv',
        'archivosMinesValidacion' => 'C:\carga_mobilvendor\minesValidacion' . date('YmdHs') . '.csv',
        'archivosOrdenesMb' => 'C:\carga_mobilvendor\ordenes' . date('YmdHs') . '.csv',
        'archivosRutasMb' => 'C:\carga_mobilvendor\rutas' . date('YmdHs') . '.csv',
        'archivosVentasMovistar' => 'C:\carga_mobilvendor\ventasMovistar' . date('YmdHs') . '.csv',
        'archivosTransferenciasMovistar' => 'C:\carga_mobilvendor\transferenciasMovistar' . date('YmdHs') . '.csv',
        'archivosStockMovistar' => 'C:\carga_mobilvendor\stockMovistar' . date('YmdHs') . '.csv',
        'archivosClientes' => 'C:\carga_mobilvendor\clientes' . date('YmdHs') . '.csv',
        'archivosDireccionClientes' => 'C:\carga_mobilvendor\direccionClientes' . date('YmdHs') . '.csv',
//        
    ),
);
