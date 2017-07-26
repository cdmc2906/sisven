<?php
$this->breadcrumbs = array('Revision ruta',);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"ConfigurarGrid"'));
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/RevisionRuta.js"; ?>"></script>

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
//                'action' => Yii::app()->request->baseUrl . '/CargaConsumo/SubirArchivo'
            ));
            ?>
            <div class="row">
                <div>

                    <?php echo $form->labelEx($model, 'fechagestion'); ?>
                    <?php echo $form->textField($model, 'fechagestion', array('class' => 'txtfechagestion')) ?>
                    <?php echo $form->error($model, 'fechagestion'); ?>

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
                </div>
            </div>

            <div class="">
                <?php // echo CHtml::submitButton('Cargar', array('id' => 'btnCargar')); ?>
                <?php
                echo CHtml::ajaxSubmitButton(
                        'Revisar ruta', CHtml
                        ::normalizeUrl(array('Revisionruta/revisarruta', 'render' => true)), array(
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
                <?php echo CHtml::Button('Exportar a Excel', array('id' => 'btnExcel', 'class' => 'btn btn-theme')); ?>
            </div>


            <?php $this->endWidget(); ?>

        </div>
    </div>     
</section>
<br><br>
<div id="comisionVendedor" >
    <section class="">
        <header class="">
            <h2><strong>Resultado Analisis</strong></h2>
        </header>
        <div class="">
            <?php $this->renderPartial('/shared/_bodygrid'); ?>
        </div>
    </section>
</div>

<div id="comisionMayorista" hidden="true" >
    <section class="">
        <header class="">
            <h2><strong>Comisiones Mayoristas</strong></h2>
        </header>
        <div class="">
            <?php $this->renderPartial('/shared/_bodygrid'); ?>
        </div>
    </section>
</div>