<?php
$this->breadcrumbs = array('Resumen semanal historial ejecutivo',);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"ConfigurarGrid"'));
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/RptResumenSemanalHistorial.js"; ?>"></script>

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
                    <table>
                        <tr>
                            <td>
                                <?php echo $form->labelEx($model, 'anio'); ?>
                                <?php
                                echo $form->dropDownList(
                                        $model, 'anio', array(
                                    '2017' => '2017',
                                    '2016' => '2016',
                                        ), array(
                                    'empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                                );
                                ?>
                                <?php echo $form->error($model, 'anio'); ?>

                            </td>
                            <td>
                                <?php echo $form->labelEx($model, 'mes'); ?>
                                <?php
                                echo $form->dropDownList(
                                        $model, 'mes', array(
                                    '1' => 'Enero',
                                    '2' => 'Febrero',
                                    '3' => 'Marzo',
                                    '4' => 'Abril',
                                    '5' => 'Mayo',
                                    '6' => 'Junio',
                                    '7' => 'Julio',
                                    '8' => 'Agosto',
                                    '9' => 'Septiembre',
                                    '10' => 'Octubre',
                                    '11' => 'Noviembre',
                                    '12' => 'Diciembre',
                                        ), array(
                                    'empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                                );
                                ?>
                                <?php echo $form->error($model, 'mes'); ?>

                            </td>
                            <td>
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
                            </td>

                        </tr>
                    </table>
                </div>
            </div>

            <div class="">
                <?php // echo CHtml::submitButton('Cargar', array('id' => 'btnCargar')); ?>
                <?php
                echo CHtml::ajaxSubmitButton(
                        'Revisar historial', CHtml
                        ::normalizeUrl(array('RptResumenSemanalHistorial/revisarhistorial', 'render' => true)), array(
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
                            $("#tblGrid").setGridParam(
                            {
                                datatype: \'jsonstring\', 
                                datastr: datosResult
                            }).trigger(\'reloadGrid\');
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
<h2><strong>Semana 1</strong></h2><br/>
<div ><!--<div id="grilla" class="_grilla">-->
    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
        <table id="tblGridSemana1" class="table table-condensed"></table>
        <div id="pagGrid"> </div>
    </div>
</div>
<br>
<div>
    <p> Observacion Supervision Semana 1:  </p>
    <textarea rows="4" cols="80">Ingrese su comentario.    </textarea> <br/>
    <?php echo CHtml::Button('Guardar comentario', array('id' => 'btsnExcel', 'class' => 'btn btn-theme')); ?>
</div>
<br><br>


<h2><strong>Semana 2</strong></h2><br/>
<div ><!--<div id="grilla" class="_grilla">-->
    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
        <table id="tblGridSemana2" class="table table-condensed"></table>
        <div id="pagGrid"> </div>
    </div>
</div>
<br>
<div>
    <p> Observacion Supervision Semana 2:  </p>
    <textarea rows="4" cols="80">Ingrese su comentario.    </textarea> <br/>
    <?php echo CHtml::Button('Guardar comentario', array('id' => 'btsnExcel', 'class' => 'btn btn-theme')); ?>
</div>
<br><br>


<h2><strong>Semana 3</strong></h2><br/>
<div ><!--<div id="grilla" class="_grilla">-->
    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
        <table id="tblGridSemana3" class="table table-condensed"></table>
        <div id="pagGrid"> </div>
    </div>
</div>
<br>
<div>
    <p> Observacion Supervision Semana 3:  </p>
    <textarea rows="4" cols="80">Ingrese su comentario.    </textarea> <br/>
    <?php echo CHtml::Button('Guardar comentario', array('id' => 'btsnExcel', 'class' => 'btn btn-theme')); ?>
</div>
<br><br>


<h2><strong>Semana 4</strong></h2><br/>
<div ><!--<div id="grilla" class="_grilla">-->
    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
        <table id="tblGridSemana4" class="table table-condensed"></table>
        <div id="pagGrid"> </div>
    </div>
</div>
<br>
<div>
    <p> Observacion Supervision Semana 4:  </p>
    <textarea rows="4" cols="80">Ingrese su comentario.    </textarea> <br/>
    <?php echo CHtml::Button('Guardar comentario', array('id' => 'btsnExcel', 'class' => 'btn btn-theme')); ?>
</div>
<br><br>


<h2><strong>Semana 5</strong></h2><br/>
<div ><!--<div id="grilla" class="_grilla">-->
    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
        <table id="tblGridSemana5" class="table table-condensed"></table>
        <div id="pagGrid"> </div>
    </div>
</div>
<br>
<div>
    <p> Observacion Supervision Semana 5:  </p>
    <textarea rows="4" cols="80">Ingrese su comentario.    </textarea> <br/>
    <?php echo CHtml::Button('Guardar comentario', array('id' => 'btsnExcel', 'class' => 'btn btn-theme')); ?>
</div>
<br><br>
