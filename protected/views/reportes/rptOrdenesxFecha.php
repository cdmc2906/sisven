<?php
/* @var $this TiemposGestionController */
$this->breadcrumbs = array(
    'Ordenes por fecha',
);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"ConsultarReporte"'));
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/RptOrdenesxFechaMD.js"; ?>"></script>

<div class="">
    <header class="">
        <h2><strong>Reporte Ordenes por fecha</strong></h2>
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
                    <table alignt="left"><tr>
                            <td>
                                <div>
                                    <?php echo $form->labelEx($model, 'fechaOrdenesInicio'); ?>
                                    <?php echo $form->textField($model, 'fechaOrdenesInicio', array('class' => 'txtfechaOrdenesInicio')) ?>
                                    <?php echo $form->error($model, 'fechaOrdenesInicio'); ?>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <?php echo $form->labelEx($model, 'fechaOrdenesFin'); ?>
                                    <?php echo $form->textField($model, 'fechaOrdenesFin', array('class' => 'txtfechaOrdenesFin')) ?>
                                    <?php echo $form->error($model, 'fechaOrdenesFin'); ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <div class="row buttons secccionBotones">
                <?php
                echo CHtml::ajaxSubmitButton('Consultar'
                        , CHtml::normalizeUrl(array('ReporteOrdenesxFecha/ConsultarReporte'
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
                            $("#tblGridMaestro").setGridParam({datatype: \'jsonstring\', datastr: datosResult}).trigger(\'reloadGrid\');
                            
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
                <?php // echo CHtml::Button('Exportar resumen a Excel', array('id' => 'btnExcel', 'class' => 'btn btn-theme')); ?>
            </div>

            <?php $this->endWidget(); ?>

        </div>
    </div>
</div>

<div id="resumenAnalisis">
    <section class="">
        <header class="">
        </header>
        <div class="">
            <?php $this->renderPartial('/shared/_bodygridMaestro'); ?>
        </div>
    </section>
</div>
<br><br>
<div id="detalleAnalisis" >
    <section class="">
        <header class="">
        </header>
        <div class="">
            <?php $this->renderPartial('/shared/_bodygridDetalle'); ?>
        </div>
    </section>
</div>
<?php echo CHtml::Button('Editar seleccion', array('id' => 'btnEditarFila', 'class' => 'btn btn-theme')); ?>
<?php // $this->renderPartial('/shared/_bodygrid'); ?>
<?php // $this->renderPartial('/shared/_dialog'); ?>
