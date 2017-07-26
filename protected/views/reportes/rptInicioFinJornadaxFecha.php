<?php
/* @var $this TiemposGestionController */
$this->breadcrumbs = array(
    'Inicio Fin Jornada Rango (7am - 6pm)',
);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"ConsultarReporte"'));
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/RptInicioFinJornadaxFecha.js"; ?>"></script>

<div class="">
    <header class="">
        <h2><strong>Reporte Inicio Fin Jornada Rango (7am - 6pm) por fecha</strong></h2>
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

            <div class="row">
                <div class="col-lg-4">
                    <div>
                        <div>
                            <?php echo $form->labelEx($model, 'fechaInicioFinJornadaInicio'); ?>
                            <?php echo $form->textField($model, 'fechaInicioFinJornadaInicio', array('class' => 'txtfechaInicioFinJornadaInicio')) ?>
                            <?php echo $form->error($model, 'fechaInicioFinJornadaInicio'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row buttons secccionBotones">
                <?php
                echo CHtml::ajaxSubmitButton('Consultar'
                        , CHtml::normalizeUrl(array('ReporteInicioFinJornadaxFecha/ConsultarReporte'
                            , 'render' => true)), array(
                    'dataType' => 'json',
                    'type' => 'post',
                    'beforeSend' => 'function() {
                            blockUIOpen();
                            }',
                    'success' => 'function(data) {
                        blockUIClose();
                        if(data.Status==1){
                            var datosResult = data.Result;
//                            alert(datosResult.toSource());
                            $("#tblGrid").setGridParam({datatype: \'jsonstring\', datastr: datosResult}).trigger(\'reloadGrid\');
                            
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
                ?>
                <?php echo CHtml::Button('Limpiar', array('id' => 'btnLimpiar', 'class' => 'btn btn-theme')); ?>
                <?php echo CHtml::Button('Exportar resumen a Excel', array('id' => 'btnExcel', 'class' => 'btn btn-theme')); ?>
            </div>

            <?php $this->endWidget(); ?>

        </div>
    </div>
</div>
<?php $this->renderPartial('/shared/_bodygrid'); ?>
<?php $this->renderPartial('/shared/_dialog'); ?>
