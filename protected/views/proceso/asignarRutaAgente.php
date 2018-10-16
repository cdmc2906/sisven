<?php
$pagina_nombre = 'Asignar Ruta Agente';
$this->breadcrumbs = array($pagina_nombre => array('index'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/proceso/AsignarRutaAgente.js"; ?>"></script>

<?php if (Yii::app()->user->hasFlash('resultadoGuardar')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('resultadoGuardar'); ?>
    </div>
<?php else: ?>
    <div class=""></div>
<?php endif; ?>

<div class="row">
    <!--    <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body no-padding">
   
                    
                </div>
            </div>
        </div>-->

    <div class="col-md-3">
        <!--<div class="box box-primary">-->
        <!--<div class="box-body no-padding">-->

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
        <div  style="display: flex; justify-content: flex-start;">
            <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                <div class="btn-group">
                    <?php
                    echo $form->labelEx($model, 'tipoUsuario');
                    echo $form->dropDownList(
                            $model, 'tipoUsuario', array(
                        '0' => TEXT_OPCION_SELECCIONE,
                        '1' => 'Agente Call Center',
                        '2' => 'Ejecutivo Ventas',
                            )
                    );
                    echo $form->error($model, 'tipoUsuario');
                    ?>
                </div>
            </div>
            <!--<br/>-->
            <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                <?php
                echo CHtml::ajaxSubmitButton(
                        'Cargar Usuarios', CHtml
                        ::normalizeUrl(array('asignarRutaAgente/cargarUsuarios', 'render' => true)), array(
                    'dataType' => 'json',
                    'type' => 'post',
                    'beforeSend' => 'function() {blockUIOpen();}',
                    'success' => 'function(data) {
                        blockUIClose();
                        setMensaje(data.ClassMessage, data.Message);
                        if(data.Status==1){
                             var datosResult = data.Result;
                            $("#tblAgentes").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'usuarios\']}).trigger(\'reloadGrid\');
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
                        }')
                        , array('id' => 'btnCargarUsuarios'
                    , 'class' => 'btn btn-block btn-success btn-sm'));
                ?>

            </div>
        </div>
        <?php $this->endWidget(); ?>
        <!--</div>-->
        <!--</div>-->
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <div class="table-responsive mailbox-messages">                 
                    <div  style="display: flex; justify-content: flex-start;">
                        <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                            <table id="tblAgentes" class="table table-condensed"></table>
                            <div id="pagGridAgentes"> </div>
                        </div>
                        <div style="margin-left: 10px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                            <table id="tblZonasGestion" class="table table-condensed"></table>
                            <div id="pagGridZonasGestion"> </div>
                        </div>
                        <div style="margin-left: 10px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                            <table id="tblRutasGestion" class="table table-condensed"></table>
                            <div id="pagGridRutasGestion"> </div>
                            <?php
//                            echo CHtml::submitButton('Asignar Seleccion', array(
//                                'id' => 'btnAsignarRuta',
//                                'class' => 'btn btn-success'));
                            ?>
                        </div>
                    </div>
                    <div>
                        <table id="tblRutasAgente" class="table table-condensed"></table>
                        <div id="pagGridRutasAgente"> </div> 
                        <?php
//                        echo CHtml::submitButton('Eliminar Seleccion', array(
//                            'id' => 'btnQuitarRuta',
//                            'class' => 'btn btn-warning'));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>