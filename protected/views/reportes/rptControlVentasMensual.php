<?php
$this->breadcrumbs = array('Control Ventas Mensual',);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"ConfigurarGrid"'));
$this->pageTitle = 'Control Ventas Mensual';
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/reporte/RptResumenHistorialPorFecha.js"; ?>"></script>

<section class="">
    <header class="">
        <h2><strong>Control Ventas Mensual</strong></h2>
    </header>
    <div class="">
        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'frmLoad',
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
            ));
            ?>
            <div class="row">
                <div  style="display: flex; justify-content: flex-start;">
                    <div style="margin-left: 50px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                        <fieldset style="border:2px groove ;">
                            <legend style="border:1px solid green;">Filtros Fecha Usuario</legend>
                            <?php echo $form->labelEx($model, 'fechaInicioGestion'); ?>
                            <?php echo $form->textField($model, 'fechaInicioGestion', array('class' => 'txtFechaInicioGestion')); ?>
                            <?php echo $form->error($model, 'fechaInicioGestion'); ?>

                            <?php echo $form->labelEx($model, 'fechaFinGestion'); ?>
                            <?php echo $form->textField($model, 'fechaFinGestion', array('class' => 'txtFechaFinGestion')); ?>
                            <?php echo $form->error($model, 'fechaFinGestion'); ?>

                            <?php echo $form->labelEx($model, 'ejecutivo'); ?>
                            <?php
                            echo $form->dropDownList(
                                    $model, 'ejecutivo', array(
                                'QU25' => 'EDISON CALVACHE',
                                'QU26' => 'GIOVANA BONILLA',
                                'QU22' => 'JOSE CHAMBA',
                                'QU21' => 'JUAN CLAVIJO',
                                'QU17' => 'JHONNY PLUAS',
                                'QU19' => 'LUIS OJEDA'
                                    ), array(
                                'empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                            );
                            ?>
                            <?php echo $form->error($model, 'ejecutivo'); ?>
                        </fieldset>
                    </div>
                    <div style="margin-left: 50px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                        <fieldset style="border:2px groove ;">
                            <legend style="border:1px solid green;">Filtros tiempo</legend>
                            <?php
                            echo $form->labelEx($model, 'horaInicioGestion');
                            echo $form->dropDownList(
                                    $model, 'horaInicioGestion', array(
                                '08:00' => '08:00',
                                '09:00' => '09:00',
                                '10:00' => '10:00'
                                    )
                                    , array('options' => array('10:00' => array('selected' => true)))
                            );
                            echo $form->error($model, 'horaInicioGestion');
                            ?>
                            <?php
                            echo $form->labelEx($model, 'horaFinGestion');
                            echo $form->dropDownList(
                                    $model, 'horaFinGestion', array(
                                '23:59' => 'Sin limite',
                                '17:00' => '17:00',
                                '17:00' => '17:30',
                                '18:00' => '18:00',
                                '18:30' => '18:30',
                                '19:00' => '19:00',
                                '19:30' => '19:30',
                                '20:00' => '20:00',
                                '20:30' => '20:30',
                                '21:00' => '21:00',
                                '21:30' => '21:30',
                                '22:00' => '22:00',
                                '22:30' => '22:30',
                                '23:00' => '23:00',
                                '23:30' => '23:30',
                                    )
                            );

                            echo $form->error($model, 'horaFinGestion');
                            ?>
                        </fieldset>
                    </div>
                    <div style="margin-left: 50px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                        <fieldset style="border:2px groove ;">
                            <legend style="border:1px solid green;">Filtros presicion visita</legend>
                            <?php echo $form->labelEx($model, 'precisionVisita'); ?>
                            <?php
                            echo $form->dropDownList(
                                    $model, 'precisionVisitas'
                                    , array(
                                '0' => 'Sin limite',
                                '5' => '5 metros',
                                '10' => '10 metros',
                                '15' => '15 metros',
                                '20' => '20 metros',
                                '25' => '25 metros',
                                '50' => '50 metros',
                                '100' => '100 metros'
                                    )
//                                    , array('empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                            );
                            ?>
                            <?php echo $form->error($model, 'precisionVisitas'); ?>

                            <?php echo $form->labelEx($model, 'accionHistorial'); ?>
                            <?php
                            echo $form->dropDownList(
                                    $model, 'accionHistorial'
                                    , array(
                                'Inicio visita' => 'Inicio visita',
                                'Orden' => 'Orden',
                                'Forma' => 'Forma',
                                'Comentario' => 'Comentario',
                                'Día inicio' => 'Dia inicio',
                                'Fin de visita' => 'Fin de visita',
                                'Día fin' => 'Dia fin',
                                'Nuevo cliente' => 'Nuevo cliente',
                                'Estatus' => 'Estatus'
                                    )
//                                    , array('empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                            );
                            ?>
                            <?php echo $form->error($model, 'accionHistorial'); ?>
                        </fieldset>
                    </div>
                    <div style="margin-left: 50px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                        <fieldset style="border:2px groove ;">
                            <legend style="border:1px solid green;">Acciones</legend>

                            <?php
                            echo CHtml::ajaxSubmitButton(
                                    'Generar Reporte', CHtml
                                    ::normalizeUrl(array('RptResumenHistorialPorFecha/GenerarReporte', 'render' => true)), array(
                                'dataType' => 'json',
                                'type' => 'post',
                                'beforeSend' => 'function() {
                            blockUIOpen();
                            }',
                                'success' => 'function(data) {
                        
                        blockUIClose();
                        setMensaje(data.ClassMessage, data.Message);
                        if(data.Status==1){
                             var datosResult = data.Result;
                            $("#tblGrid").setGridParam({datatype: \'jsonstring\', datastr: datosResult}).trigger(\'reloadGrid\');
                        } else{
                            $.each(data, function(key, val) {
                            $("#frmBankStat #"+key+"_em_").text(val);
                            $("#frmBankStat #"+key+"_em_").show();
                            });
                            }
                        } ',
                                'error' => 'function(xhr,st,err) {
                            blockUIClose();
                            RedirigirError(xhr.status);
                        }'
                                    ), array('id' => 'btnGenerate', 'class' => 'btn btn-theme'));
                            ?>
                            <?php echo CHtml::Button('Limpiar', array('id' => 'btnLimpiar', 'class' => 'btn btn-theme')); ?>
                            <?php echo CHtml::Button('Exportar a Excel', array('id' => 'btnExcel', 'class' => 'btn btn-theme', 'disabled' => 'true')); ?>
                        </fieldset>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>     
    </div>    
</section>


