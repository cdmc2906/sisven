<?php

// This is the database connection configuration.
return array(
    //'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
    // uncomment the following lines to use a MySQL database
//	'connectionString' => 'mysql:host=localhost;dbname=tcc_control_ruta',
//	'connectionString' => 'mysql:host=10.130.1.9;dbname=tcc_control_ruta',
//	'emulatePrepare' => true,
//	'username' => 'root',
//	'password' => 'admin123',
//	'charset' => 'utf8',

    'connectionString' => 'sqlsrv:server=10.130.1.67;database=tcc_control_ruta',
    'username' => 'sa',
    'password' => 'Admin2016..',
    'charset' => 'utf8'
);
