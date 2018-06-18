<?php
$pagina_nombre = 'Carga Coordenadas Clientes';
$this->breadcrumbs = array('Cargas Informacion', $pagina_nombre => array('index'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/carga/CargaCoordenadasClientes.js"; ?>"></script>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'frmLoad',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array("enctype" => "multipart/form-data"),
        'action' => Yii::app()->request->baseUrl . '/cargaCoordenadasClientes/SubirArchivo'
    ));
    ?>
    <div class="row">
        <?php
        $command = Yii::app()->db->createCommand('
                        SELECT TOP 1
                        cli_fecha_modificacion as fecha 
                            FROM tb_cliente 
                            order by cli_fecha_modificacion desc 
                            ;');
        $resultado = $command->queryRow();
        $ultimaFecha = DateTime::createFromFormat('Y-m-d H:i:s', $resultado['fecha'])->format(FORMATO_FECHA_LONG_2);
        ?>

        <div class="callout callout-info">
            <center>
                <h4><?php echo $form->labelEx($model, 'fechaUltimaCarga'); ?></h4>
                <p>La ultima carga se realizo el <b><?php echo $ultimaFecha; ?></b></p>
            </center>
        </div>
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
                            'CargaCoordenadasClientes/GuardarCoordenadasClientes',
                            'render' => true)), array(
            'dataType' => 'json',
            'type' => 'post',
            'beforeSend' => 'function() {blockUIOpen();}',
            'success' => 'function(data) {
                        blockUIClose();
                        setMensaje(data.ClassMessage, data.Message);
                        if(data.Status==1){
                            var datosResult = data.Result;
                            $("#tblGridResumen").setGridParam({datatype: \'jsonstring\', datastr: datosResult}).trigger(\'reloadGrid\');
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
        echo CHtml::Button('Limpiar', array('id' =>
            'btnLimpiar',
            'class' => 'btn btn-danger'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

    <header class="">
        <h2><strong>Detalle archivo coordenadas</strong></h2>
    </header>
    <div class="row">
        <?php $this->renderPartial('/shared/_bodygrid'); ?>
    </div>
</div>