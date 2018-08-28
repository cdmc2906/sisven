<?php
$pagina_nombre = 'Carga Transferencias Movistar';
$this->breadcrumbs = array('Cargas Informacion', $pagina_nombre => array('index'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/carga/CargaTransferenciasMovistar.js"; ?>"></script>
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
        'action' => Yii::app()->request->baseUrl . '/CargaTransferenciasMovistar/SubirArchivo'
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

        <div align="center">
            <?php echo $form->labelEx($model, 'fechaUltimaCarga'); ?>
            <?php
            $command = Yii::app()->db->createCommand('
                        SELECT top 1
                        ' . FuncionesBaseDatos::convertToDate('sqlsrv', 'tm_fecha') . '  as fecha
                            FROM tb_transferencia_movistar
                            order by tm_fecha desc
                            ');
            $resultado = $command->queryRow();
            $ultimaFecha = DateTime::createFromFormat('Y-m-d', $resultado['fecha'])->format(FORMATO_FECHA);

            echo $form->textField($model, 'fechaUltimaCarga'
                    , array(
                'value' => $ultimaFecha
                , 'class' => 'txtUltimaCarga'
                , 'disabled' => 'disabled'
                , 'style' => 'text-align:center; color:orange; width:150px; height:30px; font-size:22px')
            )
            ?>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'rutaArchivo'); ?>
                <?php echo $form->fileField($model, 'rutaArchivo'); ?>
                <?php echo $form->error($model, 'rutaArchivo'); ?>

                <?php echo $form->labelEx($model, 'delimitadorColumnas'); ?>
                <?php
                echo $form->dropDownList(
                        $model, 'delimitadorColumnas', array(
                    ';' => 'Punto y Coma',
                    ',' => 'Coma'
                        ), array(
                    'empty' => TEXT_OPCION_SELECCIONE
                    , 'options' => array(0 => array('selected' => true))
                    , 'class' => 'form-control select2 '
                        )
                );
                ?>
                <?php echo $form->error($model, 'delimitadorColumnas'); ?>
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
                            'cargaTransferenciasMovistar/GuardarTransferenciasMovistar'
                            , 'render' => true)), array(
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
                            //alert(datosResult.toSource());
                            $("#tblGrid").trigger(\'reloadGrid\');                            
                            $("#tblGridChipsDuplicadosVentaMovistar").setGridParam({datatype: \'jsonstring\', datastr: datosResult}).trigger(\'reloadGrid\');
                            
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

</div>

<header class="">
    <h2><strong>Datos archivo transferencias</strong></h2>
</header>
<div class="row">
    <?php $this->renderPartial('/shared/_bodygrid'); ?>
</div>