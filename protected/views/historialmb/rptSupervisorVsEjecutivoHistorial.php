<?php
//session_start();
$this->breadcrumbs = array('Comparacion Supervisor Vs Ejecutivo',);
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"ConfigurarGrid"'));
$this->pageTitle = 'Analisis supervisor vs ejecutivo'
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/RptSupervisorVsEjecutivoHistorial.js"; ?>"></script>

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
                            'Día inicio' => 'Dia inicio',
                            'Fin de visita' => 'Fin de visita',
                            'Día fin' => 'Dia fin',
                            'Nuevo cliente' => 'Nuevo cliente',
                            'Estatus' => 'Estatus'
                                )
//                                , array('empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
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
                            '08:00' => '08:00',
                            '09:00' => '09:00',
                            '10:00' => '10:00'
                                )
                                , array('options' => array('10:00' => array('selected' => true)))
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
                                ::normalizeUrl(array('RptSupervisorVsEjecutivoHistorial/revisarhistorial', 'render' => true)), array(
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
                        <?php echo CHtml::Button('Exportar Detalle Supervisor', array('id' => 'btnRepDetalleSupervisor', 'class' => 'btn btn-theme', 'disabled' => 'true')); ?>
                        <?php echo CHtml::Button('Exportar Detalle Ruta', array('id' => 'btnExcel', 'class' => 'btn btn-theme', 'disabled' => 'true')); ?>
                        <?php $this->endWidget(); ?>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>     
</section>

<div style="align-content:center; align-items: center">
    <div style="display: flex; justify-content: flex-start;" >
        <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
            <table id="tblGridSupervisores" class="table table-condensed"></table>
        </div>
        <div style="margin-left: 50px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
            <table id="tblGridRutas" class="table table-condensed"></table>
        </div>
    </div>
</div>
<br>
<br>

<table style="border: 1px solid black; width:100%">
    <tr style="border: 1px solid black;">
        <td style="border: 1px solid black; text-align:center; vertical-align:middle;"><strong>DATOS SUPERVISOR</strong></td>
        <td style="border: 1px solid black; text-align:center; vertical-align:middle;"><strong>DATOS EJECUTIVO</strong></td>
    </tr>
    <tr style="border: 1px solid black;">
        <td style="border: 1px solid black;">
            <div  style="margin-left: 20px;display: flex; justify-content: flex-start;">
                <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                    <table id="tblCumplimientoSupervisor" class="table table-condensed"></table>
                </div>
                <div style="margin-left: 20px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                    <table id="tblResumenVisitasValidasInvalidasSupervisor" class="table table-condensed"></table>
                </div>
            </div>
        </td>
        <td style="border: 1px solid black;">
            <div  style="display: flex; justify-content: flex-end">
                <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                    <table id="tblResumenVisitasValidasInvalidasEjecutivo" class="table table-condensed"></table>
                </div>
                <div style="margin-left: 10px" id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                    <table id="tblCumplimientoEjecutivo" class="table table-condensed"></table>
                </div>
            </div>
        </td>
    </tr>
    <tr style="border: 1px solid black;">
        <td style="border: 1px solid black;" >
            <div  style="display: flex; justify-content: flex-start;">
                <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                    <table id="tblVisitasSupervisor" class="table table-condensed"></table>                
                </div>
            </div>
        </td>
        <td style="border: 1px solid black;">
            <div  style="display: flex; justify-content: flex-end;">
                <div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
                    <table id="tblVisitasEjecutivo" class="table table-condensed"></table>                
                </div>
            </div>
        </td>
    </tr>
</table>
<br/>

<div id="grilla" class="_grilla panel panel-shadow" style="background-color: transparent">
    <table id="tblGridDetalle" class="table table-condensed"></table>
    <div id="pagGrid"> </div>
</div>

<!--<br/><h1>Mapa</h1>-->
<!--<div id="map"></div>-->

<?php // endif;    ?>

<script>

    function openMapsWindow()
    {
        var url = $("#d_enlaceMapa").val();
//        alert(url)
        if (url.length > 0)
            var win = window.open(url, '_blank');
        else
            alert('No existe un enlace de mapas para abrir')
    }

    var customLabel =
            {
                restaurant: {label: 'R'},
                bar: {label: 'B'}
            };


// -0.204788, -78.494610
//-0.205155, -78.493426
//-0.205226, -78.495739
    function initMap() {
        var uluru = {lat: -0.205226, lng: -78.495739};
//        var uluru2 = {lat: -0.204788, lng: -78.494610};
//        var uluru = {lat: -25.363, lng: 131.044};

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: uluru,
            panControl: true

        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }

    function initMap2() {

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: -0.205226, lng: -78.495739}
        });

        // Create an array of alphabetical characters used to label the markers.
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        var markers = locations.map(function (location, i) {
            return new google.maps.Marker
                    (
                            {
                                position: location,
                                label: labels[i % labels.length]
                            }
                    );
        });

        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
                {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    }
    var locations = [
//        {lat: -31.563910, lng: 147.154312},
//        {lat: -33.718234, lng: 150.363181},
//        {lat: -33.727111, lng: 150.371124},
//        {lat: -33.848588, lng: 151.209834},
//        {lat: -33.851702, lng: 151.216968},
//        {lat: -34.671264, lng: 150.863657},
//        {lat: -35.304724, lng: 148.662905},
//        {lat: -36.817685, lng: 175.699196},
//        {lat: -36.828611, lng: 175.790222},
//        {lat: -37.750000, lng: 145.116667},
//        {lat: -37.759859, lng: 145.128708},
//        {lat: -37.765015, lng: 145.133858},
//        {lat: -37.770104, lng: 145.143299},
//        {lat: -37.773700, lng: 145.145187},
//        {lat: -37.774785, lng: 145.137978},
//        {lat: -37.819616, lng: 144.968119},
//        {lat: -38.330766, lng: 144.695692},
//        {lat: -39.927193, lng: 175.053218},
//        {lat: -41.330162, lng: 174.865694},
//        {lat: -42.734358, lng: 147.439506},
//        {lat: -42.734358, lng: 147.501315},
//        {lat: -42.735258, lng: 147.438000},
//        {lat: -43.999792, lng: 170.463352}
        {lat: -0.205136, lng: -78.4957},
        {lat: -0.310308, lng: -78.5416},
        {lat: -0.310704, lng: -78.5416},
        {lat: -0.310276, lng: -78.5416},
        {lat: -0.311242, lng: -78.5432},
        {lat: -0.311379, lng: -78.5434},
        {lat: -0.311493, lng: -78.5441},
        {lat: -0.312119, lng: -78.5442},
        {lat: -0.311969, lng: -78.5444},
        {lat: -0.311362, lng: -78.5449},
        {lat: -0.311411, lng: -78.5452},
        {lat: -0.311262, lng: -78.5454},
        {lat: -0.311055, lng: -78.5457},
        {lat: -0.310766, lng: -78.5458},
        {lat: -0.311234, lng: -78.546}
    ]



</script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhiK7uebbisx_CB2FDABn9sRlti0YZqUM&callback=initMap2">
</script>