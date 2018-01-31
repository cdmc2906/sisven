<?php
$pagina_nombre = 'Revisar Mines';
$this->breadcrumbs = array($pagina_nombre => array('index'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/proceso/RevisarMines.js"; ?>"></script>

<?php if (Yii::app()->user->hasFlash('resultadoGuardar')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('resultadoGuardar'); ?>
    </div>
<?php else: ?>
    <div class=""></div>
<?php endif; ?>

<!--GRID RUTAS Y CLIENTES ASIGNADOS-->
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
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-3">
                <?php
                echo CHtml::submitButton('Buscar asignaciones', array(
                    'id' => 'btnBuscarAsignaciones',
                    'class' => 'btn btn-success'));
                ?>
            </div>
            <div class="col-md-3" align="right">
                <?php echo $form->labelEx($model, 'txtPrefijo', array('class' => 'control-label')); ?>
            </div>
            <div class="col-md-2">
                <?php
                echo CHtml::textField('txtPrefijo', ''
                        , array('id' => 'txtPrefijo'
//                    , 'width' => 10
                    , 'maxlength' => 5
                    , 'class' => 'form-control'
                ));
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="tblMinesAgente" class="table table-condensed"></table>
                <!--<div id="pagGridMinesAgente"> </div>--> 
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">     
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="col-md-6">
                            <?php
                            echo CHtml::ajaxSubmitButton(
                                    'Guardar', CHtml
                                    ::normalizeUrl(
                                            array(
                                                'RevisarMines/GuardarGestion'
                                                , 'render' => true)
                                    ), array(
                                'dataType' => 'json'
                                , 'type' => 'post'
                                , 'beforeSend' => 'function() {blockUIOpen();}'
                                , 'success' => 'function(data) {
                                            blockUIClose();
                                            setMensaje(data.ClassMessage, data.Message);
                                            if(data.Status==1){
                                                 var datosResult = data.Result;
                                                $("#tblMinesAgente").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'mines\']}).trigger(\'reloadGrid\');

                                                    if(datosResult[\'limpiar\']){
                                                    document.getElementById("RevisarMinesForm_pregunta1").value = "";
                                                    document.getElementById("RevisarMinesForm_pregunta1a").value = "";
                                                    document.getElementById("RevisarMinesForm_pregunta2").value = "";
                                                    document.getElementById("RevisarMinesForm_pregunta3").value = "";
                                                    document.getElementById("RevisarMinesForm_pregunta4").value = "";
                                                    
                                                    document.getElementById("divPregunta2").style.display = "none";
                                                    document.getElementById("divPregunta3").style.display = "none";
                                                    document.getElementById("divPregunta4").style.display = "none";
                                                    document.getElementById("divPregunta1a").style.display = "none";
                                                    
                                                    //document.getElementById("btnGenerate").disabled = true;
                                                    
                                                    document.getElementById("txtAvanceGestion").value = datosResult[\'contador\'];
                                                    document.getElementById("txtTelefonoConPrefijo").value = \'\';
                                                }
                                            } else{
                                                $.each(data, function(key, val) {
                                                $("#frmBankStat #"+key+"_em_").text(val);
                                                $("#frmBankStat #"+key+"_em_").show();
                                                });
                                                }
                                            } '
                                , 'error' => 'function(xhr,st,err) {
                                                blockUIClose();
                                                RedirigirError(xhr.status);
                                            }')
                                    , array(
                                'id' => 'btnGenerate'
                                , 'class' => 'btn btn-block btn-success btn-sm'
//                                    , 'disabled' => 'disabled'
                            ));
                            ?>
                        </div> 

                        <div class="col-md-6">
                            <?php
                            echo CHtml::Button(
                                    'Limpiar'
                                    , array('id' => 'btnLimpiar'
                                , 'class' => 'btn btn-block btn-primary btn-sm'));
                            ?>

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-solid">
                    <a><center><strong>GESTIONADOS</strong></center></a>
                    <input
                        style="
                        color: red; 
                        font-size: 19pt;
                        text-align:center;
                        "
                        class="form-control" 
                        disabled="true" 
                        type="text" 
                        name="txtAvanceGestion" id="txtAvanceGestion">
                </div>
            </div>


            <!--SECCION PREGUNTAS-->
            <div class="row"  style="display: none" id="divPreguntas" >
                <div class="col-md-12">
                    <!--SECCION PREGUNTAS-->
                    <div class="box box-primary">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <?php echo $form->labelEx($model, 'txtNumeroLlamar', array('class' => 'col-sm-5 control-label')); ?>                            
                                <div class="col-sm-2">
                                    <?php
                                    echo CHtml::textField('txtTelefonoConPrefijo', ''
                                            , array('id' => 'txtTelefonoConPrefijo'
                                        , 'width' => 25
                                        , 'maxlength' => 25
                                        , 'readonly' => 'readonly'
                                        , 'style' => 'font-size: 15pt; border:0'
                                    ));
                                    ?>
                                </div>
                            </div>
                            <!--PREGUNTA 1-->
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <?php echo $form->labelEx($model, 'pregunta1', array('class' => 'col-sm-5 control-label')); ?>
                                    <div class="col-sm-6">
                                        <?php
                                        echo $form->dropDownList(
                                                $model, 'pregunta1'
                                                , array(
                                            'Contactado' => 'Contactado',
                                            'No Contactado' => 'No Contactado'
                                                )
                                                , array(
                                            'empty' => TEXT_OPCION_SELECCIONE,
                                            'options' => array(0 => array('selected' => true)),
                                            'class' => 'form-control select2'
                                                )
                                        );
                                        ?>
                                        <div class="form-group has-error">
                                            <?php echo $form->error($model, 'pregunta1', array('class' => 'help-block')); ?>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!--PREGUNTA 1A-->
                            <div class="row" style="display: none" id="divPregunta1a">
                                <div class="form-group col-md-12">
                                    <?php echo $form->labelEx($model, 'pregunta1a', array('class' => 'col-sm-5 control-label')); ?>
                                    <div class="col-sm-6">
                                        <?php
                                        echo $form->dropDownList(
                                                $model, 'pregunta1a'
                                                , array(
                                            'Buzon_de_voz' => 'Buzon de voz',
                                            'Inactivo' => 'Inactivo',
                                            'No contesta' => 'No contesta',
                                                )
                                                , array(
                                            'empty' => TEXT_OPCION_SELECCIONE,
                                            'options' => array(0 => array('selected' => true)),
                                            'class' => 'form-control select2',
//                                    'disabled' => 'disabled',
                                                )
                                        );
                                        ?>
                                        <div class="form-group has-error">
                                            <?php echo $form->error($model, 'pregunta1a', array('class' => 'help-block')); ?>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!--PREGUNTA 2-->
                            <div class="row"  style="display: none" id="divPregunta2">
                                <div class="form-group col-md-12">
                                    <?php echo $form->labelEx($model, 'pregunta2', array('class' => 'col-sm-5 control-label')); ?>
                                    <div class="col-sm-6">
                                        <?php
                                        echo $form->dropDownList(
                                                $model, 'pregunta2'
                                                , array(
                                            'Movistar' => 'Movistar',
                                            'Tuenti' => 'Tuenti',
                                            'Claro' => 'Claro',
                                            'CNT' => 'CNT'
                                                )
                                                , array(
                                            'empty' => TEXT_OPCION_SELECCIONE,
                                            'options' => array(0 => array('selected' => true)),
                                            'class' => 'form-control select2',
//                                    'disabled' => 'disabled',
                                                )
                                        );
                                        ?>
                                        <div class="form-group has-error">
                                            <?php echo $form->error($model, 'pregunta2', array('class' => 'help-block')); ?>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!--PREGUNTA 3-->
                            <div class="row"  style="display: none" id="divPregunta3">
                                <div class="form-group col-md-12">
                                    <?php echo $form->labelEx($model, 'pregunta3', array('class' => 'col-sm-5 control-label')); ?>
                                    <div class="col-sm-6">
                                        <?php
                                        echo $form->textField($model, 'pregunta3', array('size' => 20, 'maxlength' => 20));
                                        ?>
                                        <div class="form-group has-error">
                                            <?php echo $form->error($model, 'pregunta3', array('class' => 'help-block')); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--PREGUNTA 4-->
                            <div class="row"  style="display: none" id="divPregunta4">
                                <div class="form-group col-md-12">
                                    <?php echo $form->labelEx($model, 'pregunta4', array('class' => 'col-sm-5 control-label')); ?>
                                    <div class="col-sm-6">
                                        <?php
                                        echo $form->textField($model, 'pregunta4', array('size' => 10, 'maxlength' => 10));
                                        ?>
                                        <div class="form-group has-error">
                                            <?php echo $form->error($model, 'pregunta4', array('class' => 'help-block')); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>


