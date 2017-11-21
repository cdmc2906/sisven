<?php
/* @var $this TiemposGestionController */
$this->breadcrumbs = array(
    'Revision de horas trabajadas por fecha',
);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"ConsultarReporte"'));
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/RptInicioFinJornadaxFecha.js"; ?>"></script>

<style> 
    /*PERMITE QUE EL CONTENIDO DE LAS CELDAS HAGAN WRAPPING --COMENTARIOS*/
    .ui-jqgrid tr.jqgrow td {
        white-space: normal !important;
        height:auto;
        vertical-align:text-top;
        padding-top:2px;
    }
</style>
<?php if (Yii::app()->user->hasFlash('resultadoGuardar')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('resultadoGuardar'); ?>
    </div>
<?php else: ?>
    <div class=""></div>
<?php endif; ?>
<div class="">
    <header class="">
        <h2><strong>Revision de horas trabajadas por fecha</strong></h2>
    </header>

    <div class="">    
        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'frmReporte',
                'enableAjaxValidation' => false,
                'enableClientValidation' => true
            ));
            ?>
            <div  style="display: flex; justify-content: flex-start;">
                <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                    <fieldset style="border:2px groove ;">
                        <legend style="border:1px solid green;">Filtros Fecha y Tipo</legend>

                        <?php echo $form->labelEx($model, 'fechaInicioFinJornadaInicio'); ?>
                        <?php echo $form->textField($model, 'fechaInicioFinJornadaInicio', array('class' => 'txtfechaInicioFinJornadaInicio')); ?>
                        <?php echo $form->error($model, 'fechaInicioFinJornadaInicio'); ?>
                        <?php
                        echo $form->labelEx($model, 'tipoUsuario');
                        echo $form->dropDownList(
                                $model, 'tipoUsuario', array(
                            '1' => 'Ejecutivos',
                            '2' => 'Supervisores',
                            '3' => 'Servicio Cliente',
                            '0' => 'Todos')
//                                        , array(
//                                    'empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                        );
                        echo $form->error($model, 'tipoUsuario');
                        ?>
                    </fieldset>
                </div>
                <div style="margin-left: 50px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                    <fieldset style="border:2px groove ;">
                        <legend style="border:1px solid green;">Filtros Inicio/Fin</legend>

                        <?php
                        echo $form->labelEx($model, 'horaInicioGestion');
                        echo $form->dropDownList(
                                $model, 'horaInicioGestion', array(
                            '06:00' => '06:00',
                            '07:00' => '07:00',
                            '08:00' => '08:00',
                            '09:00' => '09:00',
                            '10:00' => '10:00',
                            '11:00' => '11:00',
                            '12:00' => '12:00'
                                )
                                //, array("disabled" => "disabled",)
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
                        <legend style="border:1px solid green;">Acciones</legend>
                        <?php
                        echo CHtml::ajaxSubmitButton('Consultar'
                                , CHtml::normalizeUrl(array('ReporteInicioFinJornadaxFecha/ConsultarReporte', 'render' => true))
                                , array(
                            'dataType' => 'json',
                            'type' => 'post',
                            'beforeSend' => 'function() {blockUIOpen();}',
                            'success' => 'function(data) {
                                //alert(data.toSource());
                                blockUIClose();
                            
                                if(data.Status==1){
                            var datosResult = data.Result;
                            
                            //alert(datosResult.toSource());
                            // $("#tblGrid").setGridParam({datatype: \'jsonstring\', datastr: datosResult}).trigger(\'reloadGrid\');
                            $("#tblGrid").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'infoJornada\']}).trigger(\'reloadGrid\');
                            $("#tblGridDetalle").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'infoVisitas\']}).trigger(\'reloadGrid\');
                            
                        } else{
                            $.each(data, function(key, val) {
                            $("#frmReporte #"+key+"_em_").text(val);
                            $("#frmReporte #"+key+"_em_").show();
                            });
                            }
                        } ',
                            'error' => 'function(xhr,st,err) {
                            blockUIClose();
                            alert(err);
                        }'
                                ), array('id' => 'btnGenerar', 'class' => 'btn btn-theme'));
                        ?><br/>
                        <?php echo CHtml::Button('Limpiar', array('id' => 'btnLimpiar', 'class' => 'btn btn-theme')); ?><br/>
                        <?php echo CHtml::Button('Exportar a Excel', array('id' => 'btnExcel', 'class' => 'btn btn-theme')); ?><br/>
                        <?php // echo CHtml::Button('Guardar Datos', array('id' => 'btnGuardar', 'class' => 'btn btn-theme')); ?>

                        <?php $this->endWidget(); ?>
                    </fieldset>
                </div>
            </div>
        </div>
        <?php $this->renderPartial('/shared/_bodygrid'); ?>
        <?php // echo CHtml::Button('Editar', array('id' => 'btnEditarRegistro', 'class' => 'btn btn-theme')); ?>
        <?php // echo CHtml::button('Guardar', array('submit' => array('ReporteInicioFinJornadaxFecha/GuardarRevision'),'id' => 'btnGuardarRegistro', 'class' => 'btn btn-theme')); ?>          
        <?php // echo CHtml::Button('Guardar', array('id' => 'btnGuardarRegistro', 'class' => 'btn btn-theme')); ?>
        <?php // echo CHtml::Button('Cancelar', array('id' => 'btnCancelar', 'class' => 'btn btn-theme')); ?>
        <?php $this->renderPartial('/shared/_dialog'); ?>

        <!--<div id="grilla" class="_grilla">-->
        <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
            <table id="tblGridDetalle" class="table table-condensed"></table>
            <div id="pagGridDetalle"> </div>
        </div>

