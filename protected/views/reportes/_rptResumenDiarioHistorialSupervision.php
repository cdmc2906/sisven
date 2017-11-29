<?php
//session_start();
$this->breadcrumbs = array('Resumen diario historial supervision',);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"ConfigurarGrid"'));
$this->pageTitle = 'Analisis reemplazo ruta'
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/RptResumenDiarioHistorialSupervision.js"; ?>"></script>

<?php if (Yii::app()->user->hasFlash('resultadoGuardar')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('resultadoGuardar'); ?>
    </div>
<?php else: ?>
    <div class=""></div>
<?php endif; ?>
<section class="">
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
            <div  style="display: flex; justify-content: flex-start;">
                <div style="margin-left: 50px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                    <?php // echo $form->hiddenField($model, 'comentarioSupervision'); ?>
                    <?php // echo $form->hiddenField($model, 'enlaceMapa'); ?>

                    <fieldset style="border:2px groove ;">
                        <legend style="border:1px solid green;">Filtros fecha/ejecutivo</legend>

                        <?php echo $form->labelEx($model, 'fechagestion'); ?>
                        <?php echo $form->textField($model, 'fechagestion', array('class' => 'txtfechagestion')) ?>
                        <?php echo $form->error($model, 'fechagestion'); ?>

                        <?php
                        echo $form->labelEx($model, 'supervisor');
                        echo $form->dropDownList(
                                $model, 'supervisor', array(
                            'QU39' => 'MARCELO FALCONI',
                            'QU20' => 'RENAN GUAMAN',
                            'QU47' => 'CHRISTIAN SALAS',
                            'QU44' => 'JUAN CARLOS SALAZAR'
                                ), array('empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                        );
                        echo $form->error($model, 'supervisor');
                        ?>
                    </fieldset>
                </div>
                <div style="margin-left: 50px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                    <fieldset style="border:2px groove ;">
                        <legend style="border:1px solid green;">Filtros Ejecutivo</legend>
                        <?php
                        echo $form->labelEx($model, 'ejecutivoSupervisar');
                        echo $form->dropDownList(
                                $model, 'ejecutivoSupervisar', array(
                            'QU25' => 'EDISON CALVACHE',
                            'QU26' => 'GIOVANA BONILLA',
                            'QU22' => 'JOSE CHAMBA',
                            'QU21' => 'JUAN CLAVIJO',
                            'QU17' => 'JHONNY PLUAS',
                            'QU19' => 'LUIS OJEDA',
                                ), array(
                            'empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                        );
                        echo $form->error($model, 'ejecutivoSupervisar');
                        ?>
                        <?php
                        echo $form->labelEx($model, 'rutaSupervisar');
                        echo $form->dropDownList(
                                $model, 'rutaSupervisar', array(
                            'R1' => 'Ruta Lunes',
                            'R2' => 'Ruta Martes',
                            'R3' => 'Ruta Miercoles',
                            'R4' => 'Ruta Jueves',
                            'R5' => 'Ruta Viernes',
                                ), array(
                            'empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                        );
                        echo $form->error($model, 'rutaSupervisar');
                        ?>
                    </fieldset>
                </div>
                <div style="margin-left: 50px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                    <fieldset style="border:2px groove ;">
                        <legend style="border:1px solid green;">Filtros tiempo</legend>
                        <?php
                        echo $form->labelEx($model, 'horaInicioGestion');
                        echo $form->dropDownList(
                                $model, 'horaInicioGestion', array(
                            '10:00' => '10:00'
                                )
                                //, array("disabled" => "disabled",)
                        );

                        echo $form->error($model, 'horaInicioGestion');
                        ?>
                        <?php
                        echo $form->labelEx($model, 'horaFinGestion');
                        echo $form->dropDownList(
                                $model, 'horaFinGestion', array(
                            '23:59' => 'Sin limite',
                            '17:00' => '17:00',
                            '17:00' => '17:30',
                            '18:00' => '18:00',
                            '18:30' => '18:30',
                            '19:00' => '19:00',
                            '19:30' => '19:30',
                            '20:00' => '20:00',
                            '20:30' => '20:30',
                            '21:00' => '21:00',
                            '21:30' => '21:30',
                            '22:00' => '22:00',
                            '22:30' => '22:30',
                            '23:00' => '23:00',
                            '23:30' => '23:30',
                                )
                        );

                        echo $form->error($model, 'horaFinGestion');
                        ?>
                    </fieldset>
                </div>
                <div style="margin-left: 50px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                    <fieldset style="border:2px groove ;">
                        <legend style="border:1px solid green;">Filtros Historial</legend>
                        <?php echo $form->labelEx($model, 'precisionVisita'); ?>
                        <?php
                        echo $form->dropDownList(
                                $model, 'precisionVisitas'
                                , array(
                            '0' => 'Sin limite',
                            '5' => '5 metros',
                            '10' => '10 metros',
                            '15' => '15 metros',
                            '20' => '20 metros',
                            '25' => '25 metros',
                            '50' => '50 metros',
                            '100' => '100 metros'
                                )
//                                    , array('empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                        );
                        ?>
                        <?php echo $form->error($model, 'precisionVisitas'); ?>
                        <?php echo $form->labelEx($model, 'accionHistorial'); ?>
                        <?php
                        echo $form->dropDownList(
                                $model, 'accionHistorial'
                                , array(
                            'Inicio visita' => 'Inicio visita',
                            'Orden' => 'Orden',
                            'Forma' => 'Forma',
                            'Comentario' => 'Comentario',
                            'Día inicio' => 'Dia inicio',
                            'Fin de visita' => 'Fin de visita',
                            'Día fin' => 'Dia fin',
                            'Nuevo cliente' => 'Nuevo cliente',
                            'Estatus' => 'Estatus'
                                )
//                                    , array('empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                        );
                        ?>
                        <?php echo $form->error($model, 'accionHistorial'); ?>
                    </fieldset>
                </div>
                <div style="margin-left: 50px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                    <fieldset style="border:2px groove ;">
                        <legend style="border:1px solid green;">Acciones</legend>

                        <?php
                        echo CHtml::ajaxSubmitButton(
                                'Revisar historial', CHtml
                                ::normalizeUrl(array('rptResumenDiarioHistorialSupervision/revisarhistorial', 'render' => true)), array(
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
                             //console.log(JSON.stringify(datosResult[\'detalle\']));
                             //console.log(datosResult.toSource());
                            $("#tblGridDetalle").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'detalle\']}).trigger(\'reloadGrid\');
                            $("#tblResumenGeneral").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenGeneral\']}).trigger(\'reloadGrid\');
                            $("#tblResumenVisitas").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenVisitas\']}).trigger(\'reloadGrid\');
                            $("#tblResumenVisitasValidasInvalidas").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenVisitasValidasInvalidas\']}).trigger(\'reloadGrid\');
                            $("#tblPrimeraUltimaVisita").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenPrimeraUltima\']}).trigger(\'reloadGrid\');
                            $("#tblResumenVentas").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenVentas\']}).trigger(\'reloadGrid\');
                           
                            $("#d_comentariosSupervision").val(datosResult[\'comentarioSupervisor\']);;

                            $("#RptResumenDiarioHistorialForm_enlaceMapa").val(datosResult[\'enlaceMapa\']);
                            $("#d_enlaceMapa").val(datosResult[\'enlaceMapa\']);


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
                        }'), array('id' => 'btnGenerate', 'class' => 'btn btn-theme'));
                        ?>
                        <br>
                        <?php echo CHtml::Button('Limpiar', array('id' => 'btnLimpiar', 'class' => 'btn btn-theme')); ?>
                        <br>
                        <?php echo CHtml::button('Guardar Revision', array('submit' => array('rptResumenDiarioHistorial/GuardarRevision'))); ?>          
                        <br>
                        <?php echo CHtml::Button('Exportar Resumen', array('id' => 'btnExcelResumen', 'class' => 'btn btn-theme')); ?>
                        <?php $this->endWidget(); ?>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>     
</section>

<div>
    <div>

        <div class="">
            <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                <table id="tblResumenGeneral" class="table table-condensed"></table>
            </div>
        </div>
    </div><br>
    <div  style="display: flex; justify-content: flex-start;">
        <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
            <table id="tblResumenVisitas" class="table table-condensed"></table>
        </div>
        <div style="margin-left: 50px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
            <table id="tblResumenVisitasValidasInvalidas" class="table table-condensed"></table>
        </div>
        <div style="margin-left: 50px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
            <table id="tblPrimeraUltimaVisita" class="table table-condensed"></table>
        </div>
    </div><br>
    <div  style="display: flex; justify-content: flex-start;">
        <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
            <table id="tblResumenVentas" class="table table-condensed"></table>                
        </div>

    </div>
</div>
<br/>
<div>
    <div  style="display: flex; justify-content: flex-start;">
        <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
            <h1>Comentarios anteriores:</h1>
            <br/>
            <?php
            echo CHtml::textArea('d_comentariosSupervision', '', array(
                'placeholder' => 'Ingrese el comentario'
                , 'readonly' => TRUE
                , 'disabled' => TRUE
                , 'id' => 'd_comentariosSupervision'
                , 'cols' => 50
                , 'rows' => 5
                , 'maxlength' => 100)
            );
            ?>      
        </div>

        <div  style="margin-left: 50px"  id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
            <h1>Comentario del supervisor de zona:</h1>
            <br/>
            <?php
            echo CHtml::textArea('d_comentarioSupervision', '', array(
                'placeholder' => 'Ingrese un nuevo comentario'
                , 'readonly' => false
                , 'onblur' => 'setComentarioSupervisor(document.getElementById(\'d_comentarioSupervision\').value)'
                , 'id' => 'd_comentarioSupervision', 'cols' => 50, 'rows' => 2, 'maxlength' => 200)
            );
            ?>      
        </div>

    </div>
</div>
<br>

<div>
    <h1>Enlace mapa</h1>
    <?php
    echo CHtml::textField('d_enlaceMapa', '', array(
        'placeholder' => 'Ingrese el enlace'
        , 'size' => '125px'
        , 'onblur' => 'setEnlaceMapa(document.getElementById(\'d_enlaceMapa\').value)'
        , 'id' => 'd_enlaceMapa'
        , 'maxlength' => 500)
    );
    ?>    
    <?php // echo CHtml::Button('Abrir enlace', array('id' => 'btnAbrirEnlace', 'class' => 'btn btn-theme')); ?>
    <?php // echo CHtml::link('Abrir Enlace', 'https://www.google.com/maps/d/',array('target' => '_blank'));?>
    <?php // echo CHtml::Button('Abrir enlace', array('id' => 'btnAbrirEnlace', 'class' => 'btn btn-theme')); ?>

    <?php echo CHtml::Button("Abrir enlace", array('id' => 'btnAbrirEnlace', 'class' => 'btn btn-theme', 'title' => "Abrir enlace de mapa en google maps", 'onclick' => 'js:openMapsWindow();')); ?>

</div>

<br/> <?php echo CHtml::Button('Exportar Detalle', array('id' => 'btnExcel', 'class' => 'btn btn-theme')); ?>

<br>    
<!--<div id="grilla" class="_grilla">-->
<div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
    <table id="tblGridDetalle" class="table table-condensed"></table>
    <div id="pagGrid"> </div>
</div>
<?php // endif;   ?>

<script>
    function setComentarioSupervisor($comentario) {
//        alert($valor);
        $("#RptResumenDiarioHistorialForm_comentarioSupervision").val($comentario);
    }
    function setEnlaceMapa($enlace) {
//        alert($valor);
        $("#RptResumenDiarioHistorialForm_enlaceMapa").val($enlace);
    }
    function openMapsWindow()
    {
        var url = $("#d_enlaceMapa").val();
//        alert(url)
        if (url.length > 0)
            var win = window.open(url, '_blank');
        else
            alert('No existe un enlace de mapas para abrir')
    }
</script>