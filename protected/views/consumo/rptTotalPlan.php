<?php
/* @var $this TiemposGestionController */
$this->breadcrumbs = array(
    'Total Plan',
);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"ConsultarTotal"'));
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/RptTotalPlan.js"; ?>"></script>

<div class="">
    <header class="">
        <h2><strong>Reporte plan</strong></h2>
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
                        <?php echo $form->labelEx($model, 'fechaConsumoInicio'); ?>
                        <?php
                        $meses = MesModel::model()->findAll();
                        $listaMeses = CHtml::listData($meses, 'ID_MES', 'NOMBRE_MES');
                        echo $form->DropDownList($model, 'fechaConsumoInicio', $listaMeses, array('empty' => TEXT_OPCION_SELECCIONE));
                        ?>
                        <?php echo $form->error($model, 'fechaConsumoInicio'); ?>
                        <?php echo $form->labelEx($model, 'fechaConsumoFin'); ?>
                        <?php
                        $meses = MesModel::model()->findAll();
                        $listaMeses = CHtml::listData($meses, 'ID_MES', 'NOMBRE_MES');
                        echo $form->DropDownList($model, 'fechaConsumoFin', $listaMeses, array('empty' => TEXT_OPCION_SELECCIONE));
                        ?>
                        <?php echo $form->error($model, 'fechaConsumoFin'); ?>
                    </div>
                </div>
            </div>
            <br>
            <div class="row buttons secccionBotones">
                <?php
                echo CHtml::ajaxSubmitButton('Consultar', CHtml::normalizeUrl(array('ReporteTotalPlan/ConsultarTotal', 'render' => true)), array(
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
                <?php echo CHtml::Button('Exportar a Excel', array('id' => 'btnExcel', 'class' => 'btn btn-theme')); ?>
            </div>

            <?php $this->endWidget(); ?>

        </div>
    </div>
</div>
<?php $this->renderPartial('/shared/_bodygrid'); ?>
<?php $this->renderPartial('/shared/_dialog'); ?>
