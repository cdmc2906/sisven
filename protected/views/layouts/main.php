<?php
/* @var $this Controller */
ini_set('max_execution_time', 600); //300 seconds = 5 minutes
?>
<!DOCTYPE html>
<html lang="es">
    <head>
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
//                        array('label' => 'Inicio', 'url' => array('/site/contact')),
////                        array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
//                        array('label' => 'Empresa', 'url' => array('/empresa/index'), 'visible' => !Yii::app()->user->isGuest),
//                        array('label' => 'Sucursales', 'url' => array('/sucursal/index'), 'visible' => !Yii::app()->user->isGuest),
//                        array('label' => 'Tipo de Clientes', 'url' => array('/tipocliente/index'), 'visible' => !Yii::app()->user->isGuest),
//                        array('label' => 'Tipos de Producto', 'url' => array('/tipoproducto/index'), 'visible' => !Yii::app()->user->isGuest),
//                        array('label' => 'Estados', 'url' => array('/estado/index'), 'visible' => !Yii::app()->user->isGuest),
//                        array('label' => 'Bodegas', 'url' => array('/bodega/index'), 'visible' => !Yii::app()->user->isGuest),
//                        array('label' => 'Productos', 'url' => array('/producto/index'), 'visible' => !Yii::app()->user->isGuest),
//                        array('label' => 'Clientes', 'url' => array('/cliente/index'), 'visible' => !Yii::app()->user->isGuest),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->
            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
//                        array('label' => 'Rango Comision', 'url' => array('/rangocomision/index'), 'visible' => !Yii::app()->user->isGuest),    
//                        array('label' => 'Tipo Vendedor', 'url' => array('/tipovendedor/index'), 'visible' => !Yii::app()->user->isGuest),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->
            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
//                        array('label' => 'Carga Indicadores', 'url' => array('/cargaindicador/index'), 'visible' => !Yii::app()->user->isGuest),
//                        array('label' => 'Carga Consumo', 'url' => array('/cargaconsumo/index'), 'visible' => !Yii::app()->user->isGuest),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
//                        array('label' => 'Reporte Totales por fecha', 'url' => array('/reportetotalplan/'), 'visible' => !Yii::app()->user->isGuest),
//                        array('label' => 'Reporte Ventas por mes', 'url' => array('/reporteventasxmes/'), 'visible' => !Yii::app()->user->isGuest),
//                        array('label' => 'Reporte Ventas por vendedor', 'url' => array('/reporteventasxvendedor/'), 'visible' => !Yii::app()->user->isGuest),
//                        array('label' => 'Reporte Ventas y consumos por mes', 'url' => array('/reporteventasconsumosxmes/'), 'visible' => !Yii::app()->user->isGuest),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
//                        array('label' => 'Reporte Totales por fecha', 'url' => array('/reportetotalplan/'), 'visible' => !Yii::app()->user->isGuest),
                    ),
                ));
                ?>
            </div><!--mainmenu--> 
            <div id="mainmenu">
                <?php
                $verMenuRevision = false;
                $verMenusAdmin = false;
//                var_dump(Yii::app()->user->id);die();

                if (Yii::app()->user->id == 1 || Yii::app()->user->id == 3 || Yii::app()->user->id == 4 || Yii::app()->user->id == 5 || Yii::app()->user->id == 6 || Yii::app()->user->id == 7 || Yii::app()->user->id == 8 || Yii::app()->user->id == 9|| Yii::app()->user->id == 10)
                    $verMenuRevision = true;
                if (Yii::app()->user->id == 1 || Yii::app()->user->id == 3 || Yii::app()->user->id == 8 || Yii::app()->user->id == 9)
                    $verMenusAdmin = true;
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
//                        array('label' => 'Admin Historial', 'url' => array('/HistorialMb/admin'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Admin Ordenes', 'url' => array('/OrdenesMb/admin'), 'visible' => $verMenusAdmin),
                        array('label' => 'Admin Ruta', 'url' => array('/RutasMb/admin'), 'visible' => $verMenusAdmin),
//                        array('label' => 'Admin Rangos cumplimiento', 'url' => array('/RangoCumplimiento/admin'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Admin Ventas Movistar', 'url' => array('/VentaMovistar/admin'), 'visible' => $verMenusAdmin),
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
                        array('label' => 'Admin Transferencias Movistar', 'url' => array('/TransferenciaMovistar/admin'), 'visible' => $verMenusAdmin),
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
                        array('label' => 'Revision Mines Desconocidos', 'url' => array('/RevisaMinesDesconocidos/index'), 'visible' => $verMenusAdmin),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Reporte Ordenes', 'url' => array('/ReporteOrdenesxFecha/'), 'visible' => $verMenusAdmin),
                        array('label' => 'Reporte Inicio Fin Jornada', 'url' => array('/ReporteInicioFinJornadaxFecha/'), 'visible' => $verMenuRevision),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Resumen diario historial', 'url' => array('/RptResumenDiarioHistorial/'), 'visible' => $verMenuRevision),
                        array('label' => 'Resumen diario historial superv.', 'url' => array('/RptResumenDiarioHistorialSupervision/'), 'visible' => $verMenusAdmin),
//                        array('label' => 'Resumen semanal historial', 'url' => array('/RptResumenSemanalHistorial/'), 'visible' => $verMenuRevision),
                        array('label' => 'Revision ruta', 'url' => array('/RevisionRuta/'), 'visible' => $verMenuRevision),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Administrar Usuarios'
                            , 'url' => Yii::app()->user->ui->userManagementAdminUrl
                            , 'visible' => $verMenusAdmin),
                        array('label' => 'Ingresar'
                            , 'url' => Yii::app()->user->ui->loginUrl
                            , 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Salir (' . Yii::app()->user->name . ')'
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
