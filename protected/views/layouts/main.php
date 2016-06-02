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
//                        array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                        array('label' => 'Empresa', 'url' => array('/empresa/index'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Sucursales', 'url' => array('/sucursal/index'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Tipo de Clientes', 'url' => array('/tipocliente/index'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Tipos de Producto', 'url' => array('/tipoproducto/index'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Estados', 'url' => array('/estado/index'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Bodegas', 'url' => array('/bodega/index'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Productos', 'url' => array('/producto/index'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Clientes', 'url' => array('/cliente/index'), 'visible' => !Yii::app()->user->isGuest),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->
            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Rango Comision', 'url' => array('/rangocomision/index'), 'visible' => !Yii::app()->user->isGuest),    
                        array('label' => 'Tipo Vendedor', 'url' => array('/tipovendedor/index'), 'visible' => !Yii::app()->user->isGuest),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->
            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Carga Indicadores', 'url' => array('/cargaindicador/index'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Carga Consumo', 'url' => array('/cargaconsumo/index'), 'visible' => !Yii::app()->user->isGuest),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Reporte Totales por fecha', 'url' => array('/reportetotalplan/'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Reporte Ventas por mes', 'url' => array('/reporteventasxmes/'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Reporte Ventas por vendedor', 'url' => array('/reporteventasxvendedor/'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Reporte Ventas y consumos por mes', 'url' => array('/reporteventasconsumosxmes/'), 'visible' => !Yii::app()->user->isGuest),
                    ),
                ));
                ?>
            </div><!-- mainmenu -->
             <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Calculo comisiones', 'url' => array('/calculocomision/'), 'visible' => !Yii::app()->user->isGuest),
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
                            , 'visible' => !Yii::app()->user->isGuest),
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
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
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
                Yii::app()->clientScript->registerScript(
                        '_HideEffect', 'hideEffect();', CClientScript::POS_READY
                );
            }
            ?>

            <?php echo $content; ?>

            <div class="clear"></div>

            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> Tececab S.A.<br/>
                Todos los derechos reservados.<br/>
                <?php echo Yii::powered(); ?>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
