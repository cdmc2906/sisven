<!DOCTYPE html>
<html lang="es">
    <head>
        <style>
            /*INICIO ESTILOS PARA LOS ELEMENTOS DEL MAPA*/
            #map {
                width: 100%;
                height: 400px;
            }
            /* Optional: Makes the sample page fill the window. */
            html, body {height: 100%;margin: 0;padding: 0;}
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

        <!-- Meta information -->
        <meta charset="iso-8859-1">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.ui.min.js"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/redmond/jquery-ui-1.10.4.custom.min.css"/>

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.4.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/utils.js"></script>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
        <div class="container" id="page">
            <div id="header">
                <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
            </div><!-- header -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Inicio', 'url' => array('/site/index')),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->

            <div id="mainmenu">
                <?php
                $verMenuRevision = false;
                $verMenusAdmin = false;

                if (Yii::app()->user->id == 1 || Yii::app()->user->id == 3 || Yii::app()->user->id == 4 || Yii::app()->user->id == 5 || Yii::app()->user->id == 6 || Yii::app()->user->id == 7 || Yii::app()->user->id == 8 || Yii::app()->user->id == 9 || Yii::app()->user->id == 10)
                    $verMenuRevision = true;
                if (Yii::app()->user->id == 1 || Yii::app()->user->id == 3 || Yii::app()->user->id == 8 || Yii::app()->user->id == 9)
                    $verMenusAdmin = true;
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Admin Historial', 'url' => array('/HistorialMb/admin'), 'visible' => $verMenusAdmin),
                        array('label' => 'Admin Ordenes', 'url' => array('/OrdenesMb/admin'), 'visible' => $verMenusAdmin),
                        array('label' => 'Admin Ruta', 'url' => array('/RutasMb/admin'), 'visible' => $verMenusAdmin),
                        array('label' => 'Admin Ventas Movistar', 'url' => array('/VentaMovistar/admin'), 'visible' => $verMenusAdmin),
                        array('label' => 'Admin Transferencias Movistar', 'url' => array('/TransferenciaMovistar/admin'), 'visible' => $verMenusAdmin),
                        array('label' => 'Admin Indicadores', 'url' => array('/Indicadores/admin'), 'visible' => $verMenusAdmin),
                        array('label' => 'Admin Clientes', 'url' => array('/Cliente/admin'), 'visible' => $verMenusAdmin),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Admin Comentarios Ofi', 'url' => array('/ComentarioOficina/admin'), 'visible' => $verMenusAdmin),
                        array('label' => 'Admin Comentarios Supervisor', 'url' => array('/ComentarioSupervision/admin'), 'visible' => $verMenusAdmin),
                        array('label' => 'Admin Presupuestos Venta', 'url' => array('/PresupuestoVenta/admin'), 'visible' => $verMenusAdmin),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Carga Historial', 'url' => array('/CargaHistorialMb/index'), 'visible' => $verMenusAdmin),
                        array('label' => 'Carga Ordenes', 'url' => array('/CargaOrdenesMb/index'), 'visible' => $verMenusAdmin),
                        array('label' => 'Carga Rutas', 'url' => array('/CargaRutasMb/index'), 'visible' => $verMenusAdmin),
                        array('label' => 'Carga Coordenadas', 'url' => array('/CargaCoordenadasClientes/index'), 'visible' => $verMenusAdmin),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Carga Ventas Movistar', 'url' => array('/CargaVentasMovistar/index'), 'visible' => $verMenusAdmin),
                        array('label' => 'Carga Transferencias Movistar', 'url' => array('/CargaTransferenciasMovistar/index'), 'visible' => $verMenusAdmin),
                        array('label' => 'Carga Indicadores', 'url' => array('/CargaIndicador/index'), 'visible' => $verMenusAdmin),
                        array('label' => 'Reporte Factura-Transferencia', 'url' => array('/ReporteChipsFacturadosTransferidos/index'), 'visible' => $verMenusAdmin),
                        array('label' => 'Revision Mines Desconocidos', 'url' => array('/CargaMinesDesconocidos/index'), 'visible' => $verMenusAdmin),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Reporte Ordenes', 'url' => array('/ReporteOrdenesxFecha/'), 'visible' => $verMenuRevision),
                        array('label' => 'Reporte Jornada', 'url' => array('/ReporteInicioFinJornadaxFecha/'), 'visible' => $verMenuRevision),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Analisis ejecutivos', 'url' => array('/RptResumenDiarioHistorial/'), 'visible' => $verMenuRevision),
                        array('label' => 'Analisis reemplazo ruta', 'url' => array('/RptReemplazoRuta/'), 'visible' => $verMenusAdmin),
                        array('label' => 'Analisis supervisor vs ejecutivo', 'url' => array('/RptSupervisorVsEjecutivoHistorial/'), 'visible' => $verMenusAdmin),
                        array('label' => 'Resumen semanal historial', 'url' => array('/RptResumenHistorialPorFecha/'), 'visible' => $verMenuRevision),
                        array('label' => 'Revision ruta', 'url' => array('/RevisionRuta/'), 'visible' => $verMenuRevision),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->
            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Control ventas mensual', 'url' => array('/RptControlVentasMensual/'), 'visible' => $verMenuRevision),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array(
                            'label' => 'Administrar Usuarios'
                            , 'url' => Yii::app()->user->ui->userManagementAdminUrl
                            , 'visible' => $verMenusAdmin),
                        array(
                            'label' => 'Ingresar'
                            , 'url' => Yii::app()->user->ui->loginUrl
                            , 'visible' => Yii::app()->user->isGuest),
                        array(
                            'label' => 'Salir (' . Yii::app()->user->name . ')'
                            , 'url' => Yii::app()->user->ui->logoutUrl
                            , 'visible' => !Yii::app()->user->isGuest),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->


            <?php if (isset($this->breadcrumbs)): ?>
                <?php $this->widget('zii.widgets.CBreadcrumbs', array('links' => $this->breadcrumbs,)); ?><!-- breadcrumbs -->
            <?php endif ?>
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

            <div class="clear"></div>
            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> Tececab S.A.<br/>
                Desarrollo Ing. Christian Araujo Y.<br/>
                Todos los derechos reservados.<br/>
                <?php echo Yii::powered(); ?>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
