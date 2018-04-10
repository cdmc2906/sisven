<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="IE=edge width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" http-equiv="X-UA-Compatible">

        <!-- Favicons -->
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/ico/favicon.ico">

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jqGrid/css/ui.jqgrid.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/redmond/jquery-ui-1.10.4.custom.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/template/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/template/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/template/bower_components/Ionicons/css/ionicons.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/template/bower_components/jvectormap/jquery-jvectormap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/template/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/template/dist/css/skins/_all-skins.min.css">


        <style>
            /*INICIO ESTILOS PARA LOS ELEMENTOS DEL MAPA*/
            #map {
                width: 100%;
                height: 400px;
            }
            /* Optional: Makes the sample page fill the window. */
            /*html, body {height: 100%;margin: 0;padding: 0;}*/
            #legend {
                font-family: Arial, sans-serif;
                background: #fff;
                padding: 10px;
                margin: 10px;
                border: 1px solid #6e9fef;
                /*width: 100px;*/
            }
            #legend h3 {
                margin-top: 0;
            }
            #legend img {
                vertical-align: middle;
            }/*FIN ESTILOS PARA LOS ELEMENTOS DEL MAPA*/
        </style>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.ui.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
        <?php
        $verMenuRevision = false;
        $verMenusAdmin = false;
        $verMenusCallCenter = false;
        $verMenusGerencia = false;

        if (Yii::app()->user->id == 1 ||
                Yii::app()->user->id == 3 ||
                Yii::app()->user->id == 4 ||
                Yii::app()->user->id == 5 ||
                Yii::app()->user->id == 6 ||
                Yii::app()->user->id == 7 ||
                Yii::app()->user->id == 8 ||
                Yii::app()->user->id == 9 ||
                Yii::app()->user->id == 10
        )
            $verMenuRevision = true;

        if (Yii::app()->user->id == 1 ||
                Yii::app()->user->id == 3 ||
                Yii::app()->user->id == 8 ||
                Yii::app()->user->id == 9
        )
            $verMenusAdmin = true;

        if (Yii::app()->user->id == 1 ||
                Yii::app()->user->id == 3 ||
                Yii::app()->user->id == 12 ||
                Yii::app()->user->id == 13
        )
            $verMenusCallCenter = true;

        if (Yii::app()->user->id == 10
        )
            $verMenusGerencia = true;
        ?>
        <div class="wrapper">
            <header class="main-header">
                <a href="" class="logo">
                    <span class="logo-mini"><b>S</b></span>
                    <span class="logo-lg"><b>SISVEN</b></span>
                </a>
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Ocultar menu</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/usuario.jpg" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo Yii::app()->user->name; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/usuario.jpg" class="img-circle" alt="User Image">
                                        <p>
                                            <?php echo Yii::app()->user->name; ?>
                                            <!--<small>Member since Nov. 2012</small>-->
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-right">
                                            <?php
                                            $this->widget('zii.widgets.CMenu', array(
                                                'items' => array(
                                                    array(
                                                        'label' => 'Ingresar'
                                                        , 'url' => Yii::app()->user->ui->loginUrl
                                                        , 'visible' => Yii::app()->user->isGuest
                                                        , 'itemOptions' => array('class' => 'btn btn-default btn-flat'),
                                                    ),
                                                    array(
                                                        'label' => 'Salir (' . Yii::app()->user->name . ')'
                                                        , 'url' => Yii::app()->user->ui->logoutUrl
                                                        , 'visible' => !Yii::app()->user->isGuest
                                                        , 'itemOptions' => array('class' => 'btn btn-default btn-flat'),
                                                    ),
                                                ),
//                                                'htmlOptions' => array('class' => 'pull-right'),
                                            ));
                                            ?>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>

                </nav>
            </header>

            <aside class="main-sidebar">
                <section class="sidebar">
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">MENU PRINCIPAL</li>
                        <!--                        <li class="active treeview menu-open">
                                                    <a href="">
                                                        <i class="fa fa-th"></i> <span>INICIO</span>
                                                    </a>
                                                </li>-->
                        <?php if ($verMenusAdmin) { ?>
                            <!--CATALOGOS-->
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-tasks"></i>
                                    <span>Catalogos</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-circle-o"></i>Mobilvendor
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <?php
                                        $this->widget('zii.widgets.CMenu', array(
                                            'items' => array(
                                                array(
                                                    'label' => 'Historial Mb'
                                                    , 'url' => array('/HistorialMb/admin')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Ordenes Mb'
                                                    , 'url' => array('/OrdenesMb/admin')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Rutas Mb'
                                                    , 'url' => array('/RutasMb/admin')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                            ),
                                            'linkLabelWrapper' => 'i',
                                            'linkLabelWrapperHtmlOptions' => array('class' => 'fa'),
                                            'htmlOptions' => array('class' => 'treeview-menu'),
                                        ));
                                        ?>

                                    </li>

                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-circle-o"></i>Movistar
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <?php
                                        $this->widget('zii.widgets.CMenu', array(
                                            'items' => array(
                                                array(
                                                    'label' => 'Ventas'
                                                    , 'url' => array('/VentaMovistar/admin')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Transferencias'
                                                    , 'url' => array('/TransferenciaMovistar/admin')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                            ),
                                            'linkLabelWrapper' => 'i',
                                            'linkLabelWrapperHtmlOptions' => array('class' => 'fa'),
                                            'htmlOptions' => array('class' => 'treeview-menu'),
                                        ));
                                        ?>

                                    </li>

                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-circle-o"></i>Deltamontero
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <?php
                                        $this->widget('zii.widgets.CMenu', array(
                                            'items' => array(
                                                array(
                                                    'label' => 'Indicadores'
                                                    , 'url' => array('/Indicadores/admin')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                            ),
                                            'linkLabelWrapper' => 'i',
                                            'linkLabelWrapperHtmlOptions' => array('class' => 'fa'),
                                            'htmlOptions' => array('class' => 'treeview-menu'),
                                        ));
                                        ?>
                                    </li>
                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-circle-o"></i>Sisven
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <?php
                                        $this->widget('zii.widgets.CMenu', array(
                                            'items' => array(
                                                array(
                                                    'label' => 'Clientes'
                                                    , 'url' => array('/Cliente/admin')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Periodo Gestion'
                                                    , 'url' => array('/PeriodoGestion/admin')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Presupuesto venta'
                                                    , 'url' => array('/PresupuestoVenta/admin')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Zonas Gestion'
                                                    , 'url' => array('/ZonasGestion/admin')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Ruta Gestion'
                                                    , 'url' => array('/RutaGestion/admin')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Roles usuarios'
                                                    , 'url' => array('/Rol/admin')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Usuario Rol'
                                                    , 'url' => array('/UsuarioRol/admin')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Usuario Ruta'
                                                    , 'url' => array('/UsuarioRuta/admin')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Mines Validacion'
                                                    , 'url' => array('/MinesValidacion/admin')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Revision Mines'
                                                    , 'url' => array('/RevisionMines/admin')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                            ),
                                            'linkLabelWrapper' => 'i',
                                            'linkLabelWrapperHtmlOptions' => array('class' => 'fa'),
                                            'htmlOptions' => array('class' => 'treeview-menu'),
                                        ));
                                        ?>
                                    </li>
                                </ul>
                            </li>
                        <?php } if ($verMenusAdmin) { ?>
                            <!--CARGAS INFORMACION-->
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa  fa-upload"></i>
                                    <span>Cargas Informacion</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-circle-o"></i>Mobilvendor
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <?php
                                        $this->widget('zii.widgets.CMenu', array(
                                            'items' => array(
                                                array(
                                                    'label' => 'Historial Mb'
                                                    , 'url' => array('/CargaHistorialMb/index')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Ordenes Mb'
                                                    , 'url' => array('/CargaOrdenesMb/index')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Rutas Mb'
                                                    , 'url' => array('/CargaRutasMb/index')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Coordenadas'
                                                    , 'url' => array('/CargaCoordenadasClientes/index')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                            ),
                                            'linkLabelWrapper' => 'i',
                                            'linkLabelWrapperHtmlOptions' => array('class' => 'fa'),
                                            'htmlOptions' => array('class' => 'treeview-menu'),
                                        ));
                                        ?>

                                    </li>

                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-circle-o"></i>Movistar
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <?php
                                        $this->widget('zii.widgets.CMenu', array(
                                            'items' => array(
                                                array(
                                                    'label' => 'Ventas'
                                                    , 'url' => array('/CargaVentasMovistar/index')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Transferencias'
                                                    , 'url' => array('/CargaTransferenciasMovistar/index')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                            ),
                                            'linkLabelWrapper' => 'i',
                                            'linkLabelWrapperHtmlOptions' => array('class' => 'fa'),
                                            'htmlOptions' => array('class' => 'treeview-menu'),
                                        ));
                                        ?>

                                    </li>

                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-circle-o"></i>Deltamontero
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <?php
                                        $this->widget('zii.widgets.CMenu', array(
                                            'items' => array(
                                                array(
                                                    'label' => 'Indicadores'
                                                    , 'url' => array('/CargaIndicador/index')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                            ),
                                            'linkLabelWrapper' => 'i',
                                            'linkLabelWrapperHtmlOptions' => array('class' => 'fa'),
                                            'htmlOptions' => array('class' => 'treeview-menu'),
                                        ));
                                        ?>
                                    </li>
                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-circle-o"></i>Call Center
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <?php
                                        $this->widget('zii.widgets.CMenu', array(
                                            'items' => array(
                                                array(
                                                    'label' => 'Mines Validacion'
                                                    , 'url' => array('/CargaMinesValidacion/index')
                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                            ),
                                            'linkLabelWrapper' => 'i',
                                            'linkLabelWrapperHtmlOptions' => array('class' => 'fa'),
                                            'htmlOptions' => array('class' => 'treeview-menu'),
                                        ));
                                        ?>
                                    </li>
                                </ul>
                            </li>
                        <?php } if ($verMenusGerencia || $verMenusAdmin || $verMenuRevision) { ?>
                            <!--PROCESOS-->
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-cogs"></i>
                                    <span>Procesos</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-circle-o"></i>Analisis Rutas
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <?php
                                        $this->widget('zii.widgets.CMenu', array(
                                            'items' => array(
                                                array(
                                                    'label' => 'Analisis Diario'
                                                    , 'url' => array('/RptResumenDiarioHistorial/')
//                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Reemplazo ruta'
                                                    , 'url' => array('/RptReemplazoRuta/')
//                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Resumen semanal'
                                                    , 'url' => array('/RptResumenHistorialPorFecha/')
//                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Supervisor vs Ejecutivo'
                                                    , 'url' => array('/RptSupervisorVsEjecutivoHistorial/')
//                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Revision ruta'
                                                    , 'url' => array('/RevisionRuta/')
//                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                            ),
                                            'linkLabelWrapper' => 'i',
                                            'linkLabelWrapperHtmlOptions' => array('class' => 'fa'),
                                            'htmlOptions' => array('class' => 'treeview-menu'),
                                        ));
                                        ?>

                                    </li>


                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-circle-o"></i>Otros
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <?php
                                        $this->widget('zii.widgets.CMenu', array(
                                            'items' => array(
                                                array(
                                                    'label' => 'Factura-Transferencia'
                                                    , 'url' => array('/ReporteChipsFacturadosTransferidos/')
//                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                                array(
                                                    'label' => 'Mines Desconocidos'
                                                    , 'url' => array('/CargaMinesDesconocidos/')
//                                                    , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                                ),
                                            ),
                                            'linkLabelWrapper' => 'i',
                                            'linkLabelWrapperHtmlOptions' => array('class' => 'fa'),
                                            'htmlOptions' => array('class' => 'treeview-menu'),
                                        ));
                                        ?>

                                    </li>
                                </ul>
                            </li>
                        <?php } if ($verMenusGerencia || $verMenusAdmin) { ?>
                            <!--REPORTES-->
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-area-chart"></i>
                                    <span>Reportes</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>

                                <?php
                                $this->widget('zii.widgets.CMenu', array(
                                    'items' => array(
                                        array(
                                            'label' => 'Reporte Ordenes'
                                            , 'url' => array('/ReporteOrdenesxFecha/index')
//                                            , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                        ),
                                        array(
                                            'label' => 'Reporte Jornada'
                                            , 'url' => array('/ReporteInicioFinJornadaxFecha/index')
//                                            , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                        ),
                                    ),
//                                'linkLabelWrapper' => 'i',
//                                'linkLabelWrapperHtmlOptions' => array('class' => 'fa'),
                                    'htmlOptions' => array('class' => 'treeview-menu'),
                                ));
                                ?>
                            </li> 

                        <?php } if ($verMenusCallCenter || $verMenusAdmin) { ?>
                            <!--CALL CENTER-->
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa  fa-headphones"></i>
                                    <span>Call Center</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <?php
                                $this->widget('zii.widgets.CMenu', array(
                                    'items' => array(
                                        array(
                                            'label' => 'Asignar Ruta Agente'
                                            , 'url' => array('/AsignarRutaAgente/')
                                            , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                        ),
                                        array(
                                            'label' => 'Gestionar Clientes'
                                            , 'url' => array('/GestionarClientesAsignados/')
//                                            , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                        ),
                                        array(
                                            'label' => 'Revisar Mines'
                                            , 'url' => array('/Revisarmines/')
                                            , 'visible' => $verMenusCallCenter
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                        ),
                                        array(
                                            'label' => 'Reporte Resultados'
                                            , 'url' => array('/RptResultadosRevisionMines/')
                                            , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'fa fa-circle-o'),
                                        ),
                                    ),
//                                'linkLabelWrapper' => 'i',
//                                'linkLabelWrapperHtmlOptions' => array('class' => 'fa'),
                                    'htmlOptions' => array('class' => 'treeview-menu'),
                                ));
                                ?>
                            </li> 
                        <?php } if ($verMenusAdmin) { ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-bolt"></i>
                                    <span>Administracion</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <?php
                                $this->widget('zii.widgets.CMenu', array(
                                    'items' => array(
                                        array(
                                            'label' => 'Administrar Usuarios'
                                            , 'url' => Yii::app()->user->ui->userManagementAdminUrl
                                            , 'visible' => $verMenusAdmin
//                                        , 'itemOptions' => array('class' => 'btn btn-default btn-flat'),
                                        ),
                                    ),
                                    'htmlOptions' => array('class' => 'treeview-menu'),
                                ));
                                ?>
                            </li>
                        <?php } ?>
                    </ul>
                </section>
            </aside>

            <div class="content-wrapper">

                <?php if (isset($this->breadcrumbs)): ?>
                    <?php $this->widget('zii.widgets.CBreadcrumbs', array('links' => $this->breadcrumbs,)); ?> 
                <?php endif ?>

                <section class="content"> 
                    <?php
                    $flashMessages = Yii::app()->user->getFlashes();
                    echo '<div id="ulMensajesUsuarios" class="displayNone">';
                    echo '<ul  class="flashes">';
                    foreach ($flashMessages as $key => $message) {
                        echo '<li><div class="flash-' . $key . '">' . $message . "</div></li>\n";
                    }
                    echo '</ul>';
                    echo '</div>';
                    if ($flashMessages) {
                        Yii::app()->clientScript->registerScript('_HideEffect', 'hideEffect();', CClientScript::POS_READY);
                    }
                    ?>
                    <?php echo $content; ?>
                </section>
            </div>

        </section>
    </div>
    <footer class="main-footer">
        <strong>
            Copyright &copy; <?php echo date('Y'); ?> Tececab S.A.  - Todos los derechos reservados. <?php echo Yii::powered(); ?></strong>
    </footer>
    <div class="control-sidebar-bg"></div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/utils.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jqGrid/js/jquery.jqGrid.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jqGrid/js/i18n/grid.locale-es.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/js/jqueryblockUI.js"></script>


<!--<script type="text/javascript" src="<?php // echo Yii::app()->request->baseUrl;                                       ?>/assets/template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->
<!--<script type="text/javascript" src="<?php // echo Yii::app()->request->baseUrl;                                       ?>/assets/template/bower_components/fastclick/lib/fastclick.js"></script>-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/template/dist/js/adminlte.min.js"></script>
<!--<script type="text/javascript" src="<?php // echo Yii::app()->request->baseUrl;                                       ?>/assets/template/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>-->
</body>
</html>
