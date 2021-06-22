<?php
$pagina_nombre = 'Consulta chips ';
$this->breadcrumbs = array($pagina_nombre => array('index'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/proceso/ConsultaChip.js"; ?>"></script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>

<?php if (Yii::app()->user->hasFlash('resultadoValidacion')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('resultadoValidacion'); ?>
    </div>
<?php else: ?>
    <div class=""></div>
<?php endif; ?>

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
<div id="formulario-consulta">
    <div class="col-md-6">   

        <div class="row">
            <div class="col-md-12">
                <input id="usuario" disabled="disabled"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">  
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'codigoLocal', array('class' => 'col-sm-12 control-label')); ?>
                            <?php
                            echo $form->textArea(
                                    $model
                                    , 'codigoLocal'
                                    , array(
                                'placeholder' => 'Ingrese el codigo del local'
                                , 'rows' => 1
                                , 'class' => 'form-control'
                                , 'style' => 'resize: none;'
                                , 'autocomplete' => "off"
                                , 'style' => "text-transform: uppercase"
                            ));
                            ?>
                            <div class="form-group has-error">
                                <?php
                                echo $form->error(
                                        $model
                                        , 'codigoLocal'
                                        , array('class' => 'help-block'));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php
                            echo $form->labelEx(
                                    $model
                                    , 'icc'
                                    , array('class' => 'col-sm-12 control-label'));
                            ?>
                            <?php
                            echo $form->textArea(
                                    $model
                                    , 'icc'
                                    , array(
                                'placeholder' => 'Ingrese el/los ICC(es) a validar'
                                , 'rows' => 4
                                , 'class' => 'form-control'
                                , 'style' => 'resize: none;'
                            ));
                            ?>
                            <div class="form-group has-error">
                                <?php
                                echo $form->error(
                                        $model
                                        , 'icc'
                                        , array('class' => 'help-block'));
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <?php
                            echo $form->labelEx(
                                    $model
                                    , 'min'
                                    , array('class' => 'col-sm-12 control-label'));
                            ?>
                            <?php
                            echo $form->textArea(
                                    $model
                                    , 'min'
                                    , array(
                                'placeholder' => 'Ingrese el/los MIN(es) a validar'
                                , 'rows' => 4
                                , 'class' => 'form-control'
                                , 'style' => 'resize: none;'
                            ));
                            ?>
                            <div class="form-group has-error">
                                <?php
                                echo $form->error(
                                        $model
                                        , 'min'
                                        , array('class' => 'help-block'));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-3"> 
                <?php
                echo CHtml::ajaxSubmitButton(
                        'Validar', CHtml
                        ::normalizeUrl(
                                array(
                                    'ConsultaChip/RevisarChips'
                                    , 'render' => true)
                        ), array(
                    'dataType' => 'json'
                    , 'type' => 'post'
                    , 'beforeSend' => 'function() {blockUIOpen();}'
                    , 'success' => 'function(data) {
                                            setMensaje(data.ClassMessage, data.Message);
                                            if(data.Status==1){
                                                var datosResult = data.Result;
                                                alert(datosResult[\'mensaje\']);
                                                document.getElementById("iccCopiar").value = datosResult[\'mensaje\'];
                                                document.getElementById("btnCopiar").disabled = false;                                                
                                                blockUIClose();

//                                              alert(datosResult[\'respuesta\']);
//                                              $("#tblMinesAgente").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'validos\']}).trigger(\'reloadGrid\');
//                                              document.getElementById("btnGuardarValidacion").disabled = false;                                                
//                                              document.getElementById("iccCopiar").value = datosResult[\'respuesta\'];

                                            } else{
                                                blockUIClose();
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
                    'id' => 'btnValidar'
                    , 'class' => 'btn btn-block btn-info btn-sm'
                ));
                ?>
            </div>
            <div class="col-md-3"> 
                <?php
                echo CHtml::Button(
                        'Limpiar'
                        , array('id' => 'btnLimpiar'
                    , 'class' => 'btn btn-block btn-primary btn-sm'));
                ?>
            </div>
            <div class="col-md-3"> 
                <?php
                echo CHtml::Button(
                        'Copiar Resultado'
                        , array('id' => 'btnCopiar'
                    , 'disabled' => 'disabled'
                    , 'class' => 'btn btn-block btn-success btn-sm'));
                ?>
            </div>
            <div class="col-md-3"> 
                <?php
                echo CHtml::Button(
                        'Salir'
                        , array('id' => 'btnSalir'
//                    , 'disabled' => 'disabled'
                    , 'class' => 'btn btn-block btn-danger btn-sm'));
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <textarea 
            readonly class="form-control" 
            rows="13" 
            style="resize: vertical;"
            id="iccCopiar">
        </textarea>
    </div>
</div>

<div id="login" class="login-box">
    <div class="login-box-body">
        <div class="form-group">
            <?php echo $form->labelEx($model, 'codigoAcceso', array('class' => 'col-sm-12 control-label')); ?>
            <?php
            echo $form->textField(
                    $model
                    , 'codigoAcceso'
                    , array(
                'placeholder' => 'Ingrese su codigo de acceso'
                , 'class' => 'form-control'
                , 'style' => 'resize: none;'
                , 'autocomplete' => "off"
            ));
            ?>
            <div class="form-group has-error">
                <?php
                echo $form->error(
                        $model
                        , 'codigoAcceso'
                        , array('class' => 'help-block'));
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"> 
                <?php
                echo CHtml::Button(
                        'Ingresar'
                        , array('id' => 'btnValidarAcceso'
                    , 'class' => 'btn btn-block btn-primary btn-sm'));
                ?>
            </div>
        </div>
        </form>

    </div>
</div>
<?php $this->endWidget(); ?>