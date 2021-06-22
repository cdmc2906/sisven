<?php
$pagina_nombre = 'Validacion chips ';
$this->breadcrumbs = array($pagina_nombre => array('index'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/proceso/ValidacionChip.js"; ?>"></script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<?php if (Yii::app()->user->hasFlash('resultadoValidacion')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('resultadoValidacion'); ?>
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
<div class="nav-tabs-custom">
    <div class="callout callout-info">
        <p>
            Compras (<strong><?php echo FComprasGrpModel::getFechaUltimaCarga(); ?>)</strong> * 
            Ventas (<strong><?php echo FVentasGrpModel::getFechaUltimaCarga(); ?>)</strong> * 
            Altas (<strong><?php echo FAltasGrpModel::getFechaUltimaCarga(); ?>)</strong> * 
            Transferencias Movistar (<strong><?php echo FTransferenciasMovistarModel::getFechaUltimaCarga(); ?>)</strong> * 
            Ventas Movistar (<strong><?php echo FVentasMovistarModel::getFechaUltimaCarga(); ?>)</strong>
        </p>
    </div>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Revision Chips</a></li>
        <!--<li><a href="#tab_2" data-toggle="tab">Reportes</a></li>-->
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <div class="row">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo $form->labelEx($model, 'tipoValidacion', array('class' => 'col-sm-12 control-label')); ?>
                            <?php
                            echo $form->dropDownList(
                                    $model, 'tipoValidacion'
                                    , array(
                                VALIDACION_INVASION => 'Invasion',
                                VALIDACION_PROMO => 'Promocion',
                                VALIDACION_AUDITORIA => 'Auditoria',
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
                                <?php echo $form->error($model, 'tipoValidacion', array('class' => 'help-block')); ?>
                            </div>
                        </div>

                        <div class="col-sm-6" id="promocion">
                            <?php echo $form->labelEx($model, 'promocion', array('class' => 'col-sm-12 control-label')); ?>
                            <?php
                            $criteria = new CDbCriteria;
                            $criteria->addCondition("pr_estado = 4");

                            $promociones = PromocionModel::model()->findAll($criteria);
                            $listaPromociones = CHtml::listData($promociones, 'pr_id', 'pr_nombre');
                            echo $form->dropDownList(
                                    $model, 'promocion', $listaPromociones, array(
                                'empty' => TEXT_OPCION_SELECCIONE,
                                'options' => array(0 => array('selected' => true)),
                                'class' => 'form-control select2',
//                                'disabled' => 'disabled',
                                    )
                            );
                            ?>
                            <div class="form-group has-error">
                                <?php echo $form->error($model, 'promocion', array('class' => 'help-block')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                                    'placeholder' => 'Ingrese los mines a validar'
                                    , 'rows' => 2
                                    , 'class' => 'form-control'
                                    , 'style' => 'resize: none;'
                                ));
                                ?>
                            </div>
                        </div>
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
                                    'placeholder' => 'Ingrese los ICC a validar'
                                    , 'rows' => 2
                                    , 'class' => 'form-control'
                                    , 'style' => 'resize: none;'
                                ));
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">     
                            <div class="row" >
                                <?php echo $form->labelEx($model, 'operadora', array('class' => 'col-sm-12 control-label')); ?>
                                <div class="col-sm-12">
                                    <?php
                                    echo $form->dropDownList(
                                            $model, 'operadora'
                                            , array(
                                        'MOVISTAR' => 'MOVISTAR',
                                        // 'TUENTI' => 'TUENTI',
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
                                        <?php echo $form->error($model, 'operadora', array('class' => 'help-block')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php echo $form->labelEx($model, 'reportadoPor', array('class' => 'col-sm-12 control-label')); ?>
                                <div class="col-sm-12">
                                    <?php
                                    $accountStatus = array(
                                        'EJECUTIVO' => 'EJECUTIVO'
                                        , 'CLIENTE' => 'CLIENTE');
                                    echo $form->radioButtonList(
                                            $model
                                            , 'reportadoPor'
                                            , $accountStatus, array('separator' => '    '));
                                    ?>
                                    <div class="form-group has-error">
                                        <?php
                                        echo $form->error(
                                                $model
                                                , 'reportadoPor'
                                                , array('class' => 'help-block'));
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="ejecutivoReporta">
                                <?php echo $form->labelEx($model, 'ejecutivoReporta', array('class' => 'col-sm-12 control-label')); ?>
                                <div class="col-sm-12">
                                    <?php
                                    echo $form->dropDownList(
                                            $model, 'ejecutivoReporta'
                                            , array(
                                        'QU65' => 'GUILCAZO VLADIMIR',
                                        'QU19' => 'OJEDA LUIS',
                                        'QU58' => 'LOPEZ CESAR',
                                        'QU17' => 'PLUAS JHONNY',
                                        'QU75' => 'CHALUISA KATHERINE',
                                        'QU74' => 'BURGOS LUIS',
                                        'QU53' => 'MEJIA PATRICIO',
                                        'QU73' => 'CORDERO CHRISTIAN',
                                        'QU22' => 'CHAMBA JOSE',
                                        'QU61' => 'QUISHPE CRISTINA',
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
                                        <?php echo $form->error($model, 'ejecutivoReporta', array('class' => 'help-block')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="row">
                                <?php echo $form->labelEx($model, 'codigoLocal', array('class' => 'col-sm-12 control-label')); ?>
                                <div class="col-sm-12">
                                    <?php
                                    echo $form->textField(
                                            $model
                                            , 'codigoLocal'
                                            , array('size' => 20, 'maxlength' => 20,
                                        'class' => 'txtCodigoLocal form-control'));
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
                            <div class="row">
                                <?php echo $form->labelEx($model, 'reportadoVia', array('class' => 'col-sm-12 control-label')); ?>
                                <div class="col-sm-12">
                                    <?php
                                    echo $form->dropDownList(
                                            $model, 'reportadoVia'
                                            , array(
                                        'WHATSAPP' => 'WHATSAPP',
                                        'LLAMADA' => 'LLAMADA',
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
                                        <?php echo $form->error($model, 'reportadoVia', array('class' => 'help-block')); ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">    
                            <?php
                            echo CHtml::ajaxSubmitButton(
                                    'Validar', CHtml
                                    ::normalizeUrl(
                                            array(
                                                'ValidacionChip/RevisarChips'
                                                , 'render' => true)
                                    ), array(
                                'dataType' => 'json'
                                , 'type' => 'post'
                                , 'beforeSend' => 'function() {blockUIOpen();}'
                                , 'success' => 'function(data) {
//                                            alert(data.toSource());                                            
                                            setMensaje(data.ClassMessage, data.Message);
                                            if(data.Status==1){
                                                var datosResult = data.Result;
                                                alert(datosResult[\'resultado\']);
                                                $("#tblMinesAgente").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'validos\']}).trigger(\'reloadGrid\');
                                                document.getElementById("btnGuardarValidacion").disabled = false;                                                
                                                blockUIClose();
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
//                                    , 'disabled' => 'disabled'
                            ));
                            ?>
                        </div> 
                        <div class="col-md-4">    
                            <?php
                            echo CHtml::Button(
                                    'Guardar'
                                    , array('id' => 'btnGuardarValidacion'
                                , 'class' => 'btn btn-block btn-success btn-sm'
                                , 'disabled' => 'disabled'
                                    )
                            );
                            ?>
                        </div>
                        <div class="col-md-4">    
                            <?php
                            echo CHtml::Button(
                                    'Limpiar'
                                    , array('id' => 'btnLimpiar'
                                , 'class' => 'btn btn-block btn-primary btn-sm'));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <table id="tblMinesAgente" class="table table-condensed"></table>
                        <div id="pagGridMinesAgente"> </div> 
                    </div>
                    <textarea 
                        readonly class="form-control" 
                        rows="1" 
                        style="resize: none;"
                        id="iccCopiar">
                    </textarea>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_2">
            <!--TODO-->
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

<script>
    function copiarTexto() {
        /* Get the text field */
        var copyText = document.getElementById("iccCopiar");
        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

        /* Copy the text inside the text field */
        document.execCommand("copy");
        /* Alert the copied text */
        //        alert("Datos copiados: \n\r" + copyText.value);
        alert("Datos copiados");
    }
</script>