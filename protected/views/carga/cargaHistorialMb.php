<?php
$pagina_nombre = 'Carga Historial Mobilvendor';
$this->breadcrumbs = array('Cargas Informacion', $pagina_nombre => array('index'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/carga/CargaHistorialMb.js"; ?>"></script>
<?php if (Yii::app()->user->hasFlash('resultadoHistorial')): ?>
    <div class="flash-notice">
        <?php echo Yii::app()->user->getFlash('resultadoHistorial'); ?>
    </div>
<?php else: ?>
    <div class=""></div>
<?php endif; ?>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'frmLoad',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array("enctype" => "multipart/form-data"),
        'action' => Yii::app()->request->baseUrl . '/CargaHistorialMb/SubirArchivo'
    ));
    ?>
    <div class="row">
        <?php
        $periodoAbierto = FPeriodoGestionModel::getPeriodoActivoNotificacion();
        if ($periodoAbierto != '') :
            ?>
            <div class="callout callout-info">
                <center>
                    <p>Periodo semanal abierto : <b><?php echo $periodoAbierto; ?>
                        </b></p>
                </center>
            </div>
        <?php else: ?>
            <div class="callout callout-danger">
                <center>
                    <p><b>** NO EXISTE PERIODO SEMANAL ABIERTO **</b></p>
                </center>
            </div>
        <?php endif; ?>
        <div class="col-md-3">
            <div class="form-group">
                <?php
                echo $form->labelEx($model, 'rutaArchivo');
                echo $form->fileField($model, 'rutaArchivo');
                echo $form->error($model, 'rutaArchivo', array('errorCssClass' => 'form-group has-error'));

                echo $form->labelEx($model, 'delimitadorColumnas');
                echo $form->dropDownList(
                        $model, 'delimitadorColumnas', array(
                    ';' => 'Punto y Coma',
                    ',' => 'Coma'
                        ), array(
                    'empty' => TEXT_OPCION_SELECCIONE,
                    'options' => array(0 => array('selected' => true)),
                    'class' => 'form-control select2 '
                        )
                );

                echo $form->error($model, 'delimitadorColumnas'); //, array('class' => 'form-group has-error'));            
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <?php
        echo CHtml::submitButton('Cargar', array(
            'id' => 'btnCargar',
            'class' => 'btn btn-primary'));
        ?>        &nbsp        
        <?php
        echo CHtml::ajaxSubmitButton('Guardar', CHtml::normalizeUrl(
                        array(
                            'cargahistorialmb/guardarHistorial',
                            'render' => true)), array(
            'dataType' => 'json',
            'type' => 'post',
            'beforeSend' => 'function() {blockUIOpen();}',
            'success' => 'function(data) {
                                    blockUIClose();
                                    setMensaje(data.ClassMessage, data.Message);
                                    if(data.Status==1){
                                        var datosResult = data.Result;
                                        $("#tblGrid").jqGrid("clearGridData", true).trigger("reloadGrid");
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
                ), array('id' => 'btnGenerate', 'class' => 'btn btn-success'));
        ?>        &nbsp        
        <?php
        echo CHtml::Button('Limpiar', array('id' => 'btnLimpiar', 'class' => 'btn btn-danger'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

    <header class="">
        <h2><strong>Detalle archivo Historial</strong></h2>
    </header>
    <div class="row">
        <?php $this->renderPartial('/shared/_bodygrid'); ?>
    </div>
</div>