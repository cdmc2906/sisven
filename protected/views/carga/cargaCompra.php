<?php
$this->breadcrumbs = array('Carga Compra',);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/CargaCompra.js"; ?>"></script>

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
                'action' => Yii::app()->request->baseUrl . '/CargaCompra/SubirArchivo'
            ));
            ?>
            <div class="row">
                <div>
                    <?php echo $form->labelEx($model, 'fechaCompra'); ?>
                    <?php echo $form->textField($model, 'fechaCompra', array('class' => 'txtFecha')) ?>
                    <?php echo $form->error($model, 'fechaCompra'); ?>

                    <?php echo $form->labelEx($model, 'rutaArchivo'); ?>
                    <?php echo $form->fileField($model, 'rutaArchivo'); ?>
                    <?php echo $form->error($model, 'rutaArchivo'); ?>

                    <div>
                        <?php echo $form->labelEx($model, 'estadoId', array('class' => 'info')); ?>
                        <?php
                        $estados = EstadoModel::model()->findAll();
                        $listaEstados = CHtml::listData($estados, 'ID_EST', 'NOMBRE_EST');
                        echo $form->DropDownList($model, 'estadoId', $listaEstados, array('empty' => TEXT_OPCION_SELECCIONE));
                        ?>
                        <?php echo $form->error($model, 'estadoId'); ?>
                    </div>
                    <div>
                        <?php echo $form->labelEx($model, 'tipoProducto', array('class' => 'info')); ?>
                        <?php
                        $tipos = TipoProductoModel::model()->findAll();
                        $listaTipos = CHtml::listData($tipos, 'ID_TPRO', 'TIPO_TPRO');
                        echo $form->DropDownList($model, 'tipoProducto', $listaTipos, array('empty' => TEXT_OPCION_SELECCIONE));
                        ?>
                        <?php echo $form->error($model, 'tipoProducto'); ?>
                    </div>
                    <div>
                        <?php echo $form->labelEx($model, 'bodegaId', array('class' => 'info')); ?>
                        <?php
                        $bodegas = BodegaModel::model()->findAll();
                        $listaBodegas = CHtml::listData($bodegas, 'ID_BODEGA', 'NOMBRE_BODEGA');
                        echo $form->DropDownList($model, 'bodegaId', $listaBodegas, array('empty' => TEXT_OPCION_SELECCIONE));
                        ?>
                        <?php echo $form->error($model, 'bodegaId'); ?>
                    </div>
                </div>
            </div>

            <div class="">
                <?php echo CHtml::submitButton('Cargar', array('id' => 'btnCargar')); ?>
                <?php
                echo CHtml::ajaxSubmitButton('Guardar', CHtml::normalizeUrl(array('cargacompra/GuardarCompra', 'render' => true)), array(
                    'dataType' => 'json',
                    'type' => 'post',
                    'beforeSend' => 'function() {
                            blockUIOpen();
                            }',
                    'success' => 'function(data) {
                        blockUIClose();
                        setMensaje(data.ClassMessage, data.Message);
                        if(data.Status==1){
                            
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

<section class="">
    <header class="">
        <h2><strong>Detalle archivo de compra</strong></h2>
    </header>
    <div class="">
        <?php $this->renderPartial('/shared/_bodygrid'); ?>
    </div>
</section>