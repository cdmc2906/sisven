<?php
$this->breadcrumbs = array('Revision ruta',);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"ConfigurarGrid"'));
$this->pageTitle = 'Revision ruta';
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/reporte/RptRevisionRuta.js"; ?>"></script>

<?php if (Yii::app()->user->hasFlash('resultadoGuardar')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('resultadoGuardar'); ?>
    </div>
<?php else: ?>
    <div class=""></div>
<?php endif; ?>

<div class="row">
    <div class="col-md-3">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'frmLoad',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array("enctype" => "multipart/form-data"),
        ));
        ?>

        <div class="mailbox-controls">
            <div class="btn-group">
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
                        )
                        , array('id' => 'btnGenerate'
                    , 'class' => 'btn btn-block btn-primary btn-sm'));
                ?>
                <?php
                echo CHtml::Button(
                        'Limpiar'
                        , array('id' => 'btnLimpiar'
                    , 'class' => 'btn btn-block btn-primary btn-sm'));
                ?>
                <?php
                echo CHtml::Button(
                        'Exportar a Excel', array('id' => 'btnExcel'
                    , 'class' => 'btn btn-block btn-warning btn-sm', 'disabled' => 'true'));
                ?>
            </div>
        </div>

        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Fecha / Ejecutivo</h3>
                <!--<div class="box-tools">-->
                    <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>                    </button>-->
                <!--</div>-->
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li>
                        <a href="#">
                            <i class="fa fa-calendar"></i>
                            <?php echo $form->labelEx($model, 'fechagestion'); ?>
                            <?php echo $form->textField($model, 'fechagestion', array('class' => 'txtfechagestion')) ?>
                            <?php echo $form->error($model, 'fechagestion'); ?>

                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-calendar"></i>


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
                            <?php $this->endWidget(); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <div class="table-responsive mailbox-messages">
                    <div class="">
                        <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                            <h2><strong>Resultado Analisis</strong></h2>
                            <div class="">
                                <?php $this->renderPartial('/shared/_bodygrid'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>