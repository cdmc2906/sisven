<?php
//session_start();
$this->breadcrumbs = array('Reemplazos ruta',);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"ConfigurarGrid"'));
$this->pageTitle = 'Reemplazo ruta'
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/RptReemplazoRuta.js"; ?>"></script>

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
                    <fieldset style="border:2px groove ;">
                        <legend style="border:1px solid green;">Filtros Fecha</legend>

                        <?php echo $form->labelEx($model, 'fechagestion'); ?>
                        <?php echo $form->textField($model, 'fechagestion', array('class' => 'txtfechagestion')) ?>
                        <?php echo $form->error($model, 'fechagestion'); ?>

                        <?php // echo $form->labelEx($model, 'fechaGestionEjecutivo'); ?>
                        <?php // echo $form->textField($model, 'fechaGestionEjecutivo', array('class' => 'txtFechaGestionEjecutivo')) ?>
                        <?php // echo $form->error($model, 'fechaGestionEjecutivo'); ?>

                    </fieldset>
                </div>
                <div style="margin-left: 50px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                    <fieldset style="border:2px groove ;">
                        <legend style="border:1px solid green;">Filtros Historial</legend>

                        <?php echo $form->labelEx($model, 'accionHistorial'); ?>
                        <?php
                        echo $form->dropDownList(
                                $model, 'accionHistorial'
                                , array(
                            'Inicio visita' => 'Inicio visita',
                            'Orden' => 'Orden',
                            'Forma' => 'Forma',
                            'Comentario' => 'Comentario',
                            'D�a inicio' => 'Dia inicio',
                            'Fin de visita' => 'Fin de visita',
                            'D�a fin' => 'Dia fin',
                            'Nuevo cliente' => 'Nuevo cliente',
                            'Estatus' => 'Estatus'
                                )
//                                    , array('empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                        );
                        ?>
                        <?php echo $form->error($model, 'accionHistorial'); ?>

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
                        <legend style="border:1px solid green;">Acciones</legend>
                        <?php
                        echo CHtml::ajaxSubmitButton(
                                'Revisar historial', CHtml
                                ::normalizeUrl(array('RptReemplazoRuta/RevisarHistorial', 'render' => true)), array(
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
                             
                            $("#tblGridSupervisores").setGridParam({datatype: \'jsonstring\', datastr: datosResult}).trigger(\'reloadGrid\');
                           
                            $("#tblGridSupervisores").val(datosResult);

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
                        <?php // echo CHtml::Button('Exportar Resumen', array('id' => 'btnExcelResumen', 'class' => 'btn btn-theme')); ?>
                        <?php $this->endWidget(); ?>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>     
</section>

<div style="display: flex; justify-content: flex-start;" >
    <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
        <table id="tblGridSupervisores" class="table table-condensed"></table>
    </div>
    <div style="margin-left: 50px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
        <table id="tblGridRutas" class="table table-condensed"></table>
    </div>
</div>
<br>

<div>
    <div>

        <div class="">
            <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                <table id="tblResumenGeneral" class="table table-condensed"></table>
            </div>
        </div>
    </div>
    <br>
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
    </div>
    <br>
    <div  style="display: flex; justify-content: flex-start;">
        <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
            <table id="tblResumenVentas" class="table table-condensed"></table>                
        </div>

    </div>
</div>
<br/>
<?php echo CHtml::Button('Exportar Resumen', array('id' => 'btnExcelResumen', 'class' => 'btn btn-theme')); ?>
<?php echo CHtml::Button('Exportar Detalle', array('id' => 'btnExcelDetalle', 'class' => 'btn btn-theme')); ?>
<?php // echo CHtml::Button('Exportar No Visitados', array('id' => 'btnExcelNoVisitados', 'class' => 'btn btn-theme')); ?>

<br>    
<!--<div id="grilla" class="_grilla">-->
<div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
    <table id="tblGridDetalle" class="table table-condensed"></table>
    <div id="pagGrid"> </div>
</div>

<br/><h1>Mapa</h1>
<div id="map"></div>
<div id="legend"><h3>Leyenda</h3></div>
<?php // endif;    ?>

<script>
    function initMap2() {

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: -0.205226, lng: -78.495739}
        });

    }
    function mostrarVisitasEnMapa() {

        var coordsClientes =<?php echo(json_encode(Yii::app()->session['coordenadasClientes'])); ?>;

        var coordsVisitas =<?php echo(json_encode(Yii::app()->session['coordenadasVisitas'])); ?>;

        var opcionesMapa = {
            zoom: 14, center: {lat: parseFloat(coordsVisitas[0].LATITUD), lng: parseFloat(coordsVisitas[0].LONGITUD)},
        }
        ;
        var mapa = new google.maps.Map(document.getElementById('map'), opcionesMapa);

        for (var iterador in coordsClientes) {
            var marcadorCliente = new google.maps.Marker({
                position: {lat: parseFloat(coordsClientes[iterador].LATITUD), lng: parseFloat(coordsClientes[iterador].LONGITUD)},
                map: mapa,
                title: coordsClientes[iterador].LABEL,
                label: coordsClientes[iterador].LABEL,
                icon: pinSymbol('#dd4b4b')
            });

            var marcadorVisitas = new google.maps.Marker({
                position: {lat: parseFloat(coordsVisitas[iterador].LATITUD), lng: parseFloat(coordsVisitas[iterador].LONGITUD)},
                map: mapa,
                title: coordsVisitas[iterador].LABEL,
                label: coordsVisitas[iterador].LABEL,
                icon: pinSymbol('#0288d1')
            });
        }
        var legend = document.getElementById('legend');
        var div = document.createElement('div');
        div.innerHTML = '\
    <div style="width:10px;height:10px;background-color: #dd4b4b"></div>CLIENTE \n\
    <br/><div style="width:10px;height:10px;background-color: #0288d1"></div>' + 'VISITA';
        legend.appendChild(div);

        mapa.controls[google.maps.ControlPosition.RIGHT_TOP].push(legend);
    }

    function pinSymbol(color) {
        return {
            path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z',
            fillColor: color,
            fillOpacity: 1,
            strokeColor: '#ffffff',
            strokeWeight: 2,
            scale: 1
        };
    }



</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuuHti_DAalAmyJGqZNBv71AcUBBmzcI0&callback=initMap2"></script>