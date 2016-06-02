<?php
$this->breadcrumbs = array('Carga Consumos',);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/CargaConsumo.js"; ?>"></script>

<section class="">
    <div class="">
        <div class="form">

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'frmLoad',
//                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array("enctype" => "multipart/form-data"),
                'action' => Yii::app()->request->baseUrl . '/CargaConsumo/SubirArchivo'
            ));
            ?>
            <div class="row">
                <div>
                    <?php echo $form->labelEx($model, 'mesConsumo', array('class' => 'info')); ?>
                    <?php
                    $meses = MesModel::model()->findAll();
                    $listaMeses = CHtml::listData($meses, 'ID_MES', 'NOMBRE_MES');
                    echo $form->DropDownList($model, 'mesConsumo', $listaMeses, array('empty' => TEXT_OPCION_SELECCIONE));
                    ?>
                    <?php echo $form->error($model, 'mesConsumo'); ?>

                    <?php echo $form->labelEx($model, 'rutaArchivo'); ?>
                    <?php echo $form->fileField($model, 'rutaArchivo'); ?>
                    <?php echo $form->error($model, 'rutaArchivo'); ?>
                </div>
            </div>

            <div class="">
                <?php echo CHtml::submitButton('Cargar', array('id' => 'btnCargar')); ?>
                <?php // echo CHtml::button('Guardar', array('submit' => array('cargaConsumo/GuardarConsumo'))); ?>
                <?php
                echo CHtml::ajaxSubmitButton(
                        'Guardar', CHtml
                        ::normalizeUrl(array('cargaConsumo/GuardarConsumo', 'render' => true)), array(
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
                        
                          $("#tblGridMinesDesconocidos").setGridParam({datatype: \'jsonstring\', datastr: datosResult}).trigger(\'reloadGrid\');
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

            </div>

            <?php $this->endWidget(); ?>

        </div>
    </div>     
</section>
<br><br>
<section class="">
    <header class="">
        <h2><strong>Resultado</strong></h2>
    </header>
    <div class="">
        <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
            <table id="tblGridMinesDesconocidos" class="table table-condensed"></table>
            <div id="pagGridMinesDesconocidos"> </div>
        </div>
    </div>
</section>
<br>
<div class="row buttons secccionBotones">
    <?php echo CHtml::Button('Exportar a Excel', array('id' => 'btnExcel', 'class' => 'btn btn-theme')); ?>
</div>