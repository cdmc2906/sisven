<?php
$pagina_nombre = 'Carga Clientes';
$this->breadcrumbs = array('Cargas Informacion', $pagina_nombre => array('index'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/carga/CargaClientes.js"; ?>"></script>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'frmLoad',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array("enctype" => "multipart/form-data"),
    'action' => Yii::app()->request->baseUrl . '/cargaClientes/SubirArchivo'
        ));
?>
<div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-solid">
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
                                <p><?php echo $form->labelEx($model, 'fechaUltimaCarga'); ?>
                                    <b><?php echo $ultimaFecha; ?></b></p>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div class="row">
                <?php
                echo $form->labelEx($model, 'rutaArchivo');
                echo $form->fileField($model, 'rutaArchivo');
                echo $form->error($model, 'rutaArchivo', array('errorCssClass' => 'form-group has-error'));
                echo "<br />";
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
            <br />
            <div class="row">
                <?php
                echo CHtml::submitButton('Cargar', array(
                    'id' => 'btnCargar',
                    'class' => 'btn btn-primary'));
                ?>        &nbsp        
                <?php
                echo CHtml::ajaxSubmitButton('Guardar', CHtml::normalizeUrl(
                                array(
                                    'CargaClientes/GuardarClientes',
                                    'render' => true)), array(
                    'dataType' => 'json',
                    'type' => 'post',
                    'beforeSend' => 'function() {blockUIOpen();}',
                    'success' => 'function(data) {
                        blockUIClose();
                        setMensaje(data.ClassMessage, data.Message);
                        if(data.Status==1){
                            var datosResult = data.Result;
                            //alert(datosResult);                            
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
        </div>
    </div> 
    <?php $this->endWidget(); ?>
    <div class="col-md-8">
        <div class="box box-primary">
            <div id="divTblClientes" class="_grilla panel panel-shadow" style="background-color: transparent; margin-left: 10px">
                <table id="tblClientes" class="table table-condensed"></table>
                <div id="pagtblClientes"> </div>
            </div>
        </div>
    </div>
</div>
