<?php
$this->breadcrumbs = array('Calculo comisiones',);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"ConfigurarGrid"'));
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/CalculoComision.js"; ?>"></script>

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
                    <?php echo $form->labelEx($model, 'anio'); ?>
                    <?php
                    echo $form->dropDownList(
                            $model, 'anio', array(
                        '2016' => '2016',
                        '2015' => '2015',
                        '2014' => '2014',
                        '2013' => '2013',
                        '2012' => '2012',
                        '2011' => '2011'
                            ), array(
                        'empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                    );
                    ?>
                    <?php echo $form->error($model, 'anio'); ?>


                    <?php echo $form->labelEx($model, 'mes'); ?>
                    <?php
                    $meses = MesModel::model()->findAll();
                    $listaMeses = CHtml::listData($meses, 'ID_MES', 'NOMBRE_MES');
                    echo $form->DropDownList($model, 'mes', $listaMeses, array('empty' => TEXT_OPCION_SELECCIONE));
                    ?>
                    <?php echo $form->error($model, 'mes'); ?>

                    <?php echo $form->labelEx($model, 'tipoVendedor'); ?>
                    <?php
                    $tiposVendedores = TipoVendedorModel::model()->findAllByAttributes(array('ID_EST' => 1));
                    $listaTiposVendedores = CHtml::listData($tiposVendedores, 'ID_TVE', 'NOMBRE_TVE');
                    echo $form->DropDownList($model, 'tipoVendedor', $listaTiposVendedores, array('empty' => TEXT_OPCION_SELECCIONE));
                    ?>
                    <?php echo $form->error($model, 'tipoVendedor'); ?>
                </div>
            </div>

            <div class="">
                <?php // echo CHtml::submitButton('Cargar', array('id' => 'btnCargar')); ?>
                <?php
                echo CHtml::ajaxSubmitButton(
                        'Generar Comision', CHtml
                        ::normalizeUrl(array('CalculoComision/CalcularComisiones', 'render' => true)), array(
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
            <h2><strong>Comisiones Vendedores</strong></h2>
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