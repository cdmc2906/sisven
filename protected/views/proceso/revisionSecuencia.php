<?php
$pagina_nombre = 'Revision secuencia diario';
$this->breadcrumbs = array($pagina_nombre => array('index'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/proceso/RevisionSecuencia.js"; ?>"></script>

<div class="callout callout-info">
    <center>
        <p>Periodo semanal abierto : <b><?php
                unset(Yii::app()->session['idPeriodoAbierto']);
                unset(Yii::app()->session['fechaInicioPeriodo']);
                unset(Yii::app()->session['fechaFinPeriodo']);
                unset(Yii::app()->session['itemsFueraPeriodo']);

                $command1 = Yii::app()->db->createCommand('
            SELECT 
                pg_id as idperiodo,
                pg_fecha_inicio as fechainicio,
                pg_fecha_fin as fechafin,
                pg_descripcion as descripcion
            FROM tcc_control_ruta.tb_periodo_gestion
            WHERE 
            pg_estado=1
            and pg_tipo=\'SEMANAL\';');
                $resultado1 = $command1->queryRow();
//        var_dump($resultado1);die();
                $periodoAbierto = '('.$resultado1['idperiodo'].')'.$resultado1['descripcion'];

                Yii::app()->session['idPeriodoAbierto'] = $resultado1['idperiodo'];
                Yii::app()->session['fechaInicioPeriodo'] = $resultado1['fechainicio'];
                Yii::app()->session['fechaFinPeriodo'] = $resultado1['fechafin'];


                echo $periodoAbierto;
                ?></b></p>
    </center>
</div>

<div class="row">
    <div class="col-md-3">
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

        <div class="mailbox-controls">
            <div class="btn-group">
                <?php
                echo CHtml::ajaxSubmitButton(
                        'Revisar historial', CHtml
                        ::normalizeUrl(array('revisionSecuencia/revisarhistorial', 'render' => true)), array(
                    'dataType' => 'json',
                    'type' => 'post',
                    'beforeSend' => 'function() {blockUIOpen();}',
                    'success' => 'function(data) {
                        
                        blockUIClose();
                        setMensaje(data.ClassMessage, data.Message);
                        if(data.Status==1){
                             var datosResult = data.Result;
                           
                                $("#tblResumenGeneral").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'resumenRevisionSecuencia\']}).trigger(\'reloadGrid\');
                                $("#tblGridRuta").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'revisionRuta\']}).trigger(\'reloadGrid\');
                           
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
                        , array('id' => 'btnGenerate'
                    , 'class' => 'btn btn-block btn-success btn-sm'));
                ?>
                <?php
                echo CHtml::Button(
                        'Limpiar'
                        , array('id' => 'btnLimpiar'
                    , 'class' => 'btn btn-block btn-primary btn-sm'));
                ?>
                <?php
//                echo CHtml::button(
//                        'Guardar Revision'
//                        , array(
//                    'id' => 'btnGuardar'
//                    , 'class' => 'btn btn-block btn-info btn-sm'
//                    , 'disabled' => 'disabled'
//                    , 'submit' => array('rptResumenDiarioHistorial/GuardarRevision')));
                ?>          
            </div>
        </div>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Fecha / Ejecutivo</h3>
                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li>
                        <a href="#">
                            <i class="fa fa-user-circle"></i>
                            <?php
                            echo $form->labelEx($model, 'ejecutivo');
                            echo $form->dropDownList(
                                    $model, 'ejecutivo', array(
                                '' => TEXT_OPCION_SELECCIONE,
                                'QU25' => 'EDISON CALVACHE',
                                'QU26' => 'GIOVANA BONILLA',
                                'QU22' => 'JOSE CHAMBA',
                                'QU21' => 'JUAN CLAVIJO',
                                'QU17' => 'JHONNY PLUAS',
                                'QU19' => 'LUIS OJEDA')
                            );
                            echo $form->error($model, 'ejecutivo');
                            ?>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-calendar"></i>
                            <?php echo $form->labelEx($model, 'fechagestion'); ?>
                            <?php echo $form->textField($model, 'fechagestion', array('class' => 'txtfechagestion')) ?>
                            <?php echo $form->error($model, 'fechagestion'); ?>
                        </a>
                    </li>

                    <li><a href="#">
                            <i class="fa  fa-clock-o"></i>
                            <?php echo $form->labelEx($model, 'semanaRevision'); ?>
                            <?php
                            echo $form->dropDownList(
                                    $model, 'semanaRevision'
                                    , array(
                                '1' => 'Semana 1',
                                '2' => 'Semana 2',
                                '3' => 'Semana 3',
                                '4' => 'Semana 4'
                                    )
//                                    , array('empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                            );
                            ?>
                            <?php echo $form->error($model, 'semanaRevision'); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="box box-solid collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">Inicio/Fin Gestion</h3>
                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding" style="display: none;">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#">
                            <i class="fa  fa-clock-o"></i>
                            <?php echo $form->labelEx($model, 'horaInicioGestion'); ?>

                            <?php
                            echo $form->dropDownList(
                                    $model, 'horaInicioGestion', array(
                                '08:00' => '08:00',
                                '09:00' => '09:00',
                                '10:00' => '10:00'
                                    )
                                    , array('options' => array('08:00' => array('selected' => true)))
                            );
                            echo $form->error($model, 'horaInicioGestion');
                            ?>
                        </a>
                    </li>
                    <li><a href="#">
                            <i class="fa  fa-clock-o"></i>
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
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="box box-solid collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">Acciones</h3>
                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding" style="display: none;">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#">
                            <i class="fa  fa-clock-o"></i>
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
                        </a>
                    </li>
                    <li><a href="#">
                            <i class="fa  fa-clock-o"></i>
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
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>

    <div class="col-md-9">
        <div class="col-md-7">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="row">
                        <table id="tblResumenGeneral" class="table table-condensed"></table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="row">
                        <table id="tblGridRuta" class="table table-condensed"></table>
                        <div id="pagGridRuta"> </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="box box-primary">
                <div class="row">
                    <div class="form-group col-sm-3"><?php echo $form->labelEx($model, 'campo0'); ?></div>
                    <div class="form-group col-sm-9">
                        <?php
                        echo CHtml::textField('campo0', ''
                                , array('id' => 'campo0'
                            , 'width' => 10
                            , 'maxlength' => 10
                            , 'readonly' => 'readonly'
                            , 'class' => 'form-control'
                        ));
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-3"><?php echo $form->labelEx($model, 'campo1'); ?></div>
                    <div class="form-group col-sm-3">
                        <?php
                        echo CHtml::textField('campo1', ''
                                , array('id' => 'campo1'
                            , 'width' => 10
                            , 'maxlength' => 10
                            , 'readonly' => 'readonly'
                            , 'class' => 'form-control'
                        ));
                        ?>
                    </div>
                    <div class="form-group col-sm-3"><?php echo $form->labelEx($model, 'campo2'); ?></div>
                    <div class="form-group col-sm-3">
                        <?php
                        echo CHtml::textField('campo2', ''
                                , array('id' => 'campo2'
                            , 'width' => 10
                            , 'maxlength' => 10
                            , 'readonly' => 'readonly'
                            , 'class' => 'form-control'
                        ));
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-3"><?php echo $form->labelEx($model, 'campo4'); ?></div>
                    <div class="form-group col-sm-3">
                        <?php
                        echo CHtml::textField('campo2', ''
                                , array('id' => 'campo2'
                            , 'width' => 10
                            , 'maxlength' => 10
                            , 'readonly' => 'readonly'
                            , 'class' => 'form-control'
                        ));
                        ?>
                    </div>
                    <div class="form-group col-sm-3"><?php echo $form->labelEx($model, 'campo5'); ?></div>
                    <div class="form-group col-sm-3">
                        <?php
                        echo CHtml::textField('campo2', ''
                                , array('id' => 'campo2'
                            , 'width' => 10
                            , 'maxlength' => 10
                            , 'readonly' => 'readonly'
                            , 'class' => 'form-control'
                        ));
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-3"><?php echo $form->labelEx($model, 'campo6'); ?></div>
                    <div class="form-group col-sm-3">
                        <?php
                        echo CHtml::textField('campo6', ''
                                , array('id' => 'campo6'
                            , 'width' => 10
                            , 'maxlength' => 10
                            , 'readonly' => 'readonly'
                            , 'class' => 'form-control'
                        ));
                        ?>
                    </div>
                    <div class="form-group col-sm-3"><?php echo $form->labelEx($model, 'campo7'); ?></div>
                    <div class="form-group col-sm-3">
                        <?php
                        echo CHtml::textField('campo7', ''
                                , array('id' => 'campo7'
                            , 'width' => 10
                            , 'maxlength' => 10
                            , 'readonly' => 'readonly'
                            , 'class' => 'form-control'
                        ));
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-3"><?php echo $form->labelEx($model, 'campo3'); ?></div>
                    <div class="form-group col-sm-3">
                        <?php
                        echo CHtml::textField('campo3', ''
                                , array('id' => 'campo3'
                            , 'width' => 10
                            , 'maxlength' => 10
                            , 'readonly' => 'readonly'
                            , 'class' => 'form-control'
                        ));
                        ?>
                    </div>
                    <div class="form-group col-sm-3"><?php echo $form->labelEx($model, 'campo8'); ?></div>
                    <div class="form-group col-sm-3">
                        <?php
                        echo CHtml::textField('campo8', ''
                                , array('id' => 'campo8'
                            , 'width' => 10
                            , 'maxlength' => 10
                            , 'readonly' => 'readonly'
                            , 'class' => 'form-control'
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <!--PREGUNTA 1-->
                <div class="row form-group">
                    <div class="col-sm-4"><?php echo $form->labelEx($model, 'pregunta1'); ?></div>
                    <div class="col-sm-8">
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
                    </div>
                    <div class="form-group has-error">
                        <?php echo $form->error($model, 'pregunta1', array('class' => 'help-block')); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-4"><?php echo $form->labelEx($model, 'pregunta2'); ?></div>
                    <div class="col-sm-8">
                        <?php
                        echo CHtml::textField('pregunta2', ''
                                , array('id' => 'pregunta2'
                            , 'width' => 25
                            , 'maxlength' => 25
                        ));
                        ?>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="row">
                    <table id="tblGridHistorial" class="table table-condensed"></table>
                </div>
            </div>
        </div>
    </div>


</div>



<script>
    function setComentarioSupervisor($comentario) {
        //        alert($valor);
        $("#RptResumenDiarioHistorialForm_comentarioSupervision").val($comentario);
    }
    function setEnlaceMapa($enlace) {
        //        alert($valor);
        $("#RptResumenDiarioHistorialForm_enlaceMapa").val($enlace);
    }
    function openMapsWindow() {
        var url = $("#d_enlaceMapa").val();
        //        alert(url)
        if (url.length > 0)
            var win = window.open(url, '_blank');
        else
            alert('No existe un enlace de mapas para abrir')
    }

    var estiloMapa = [
        {
            featureType: 'water',
            stylers: [
                {color: '#19a0d8'}
            ]
        }, {
            featureType: 'administrative',
            elementType: 'labels.text.stroke',
            stylers: [
                {color: '#ffffff'},
                {weight: 6}
            ]
        }, {
            featureType: 'administrative',
            elementType: 'labels.text.fill',
            stylers: [
                {color: '#e85113'}
            ]
        }, {
            featureType: 'road.highway',
            elementType: 'geometry.stroke',
            stylers: [
                {color: '#efe9e4'},
                {lightness: -40}
            ]
        }, {
            featureType: 'transit.station',
            stylers: [
                {weight: 9},
                {hue: '#e85113'}
            ]
        }, {
            featureType: 'road.highway',
            elementType: 'labels.icon',
            stylers: [
                {visibility: 'off'}
            ]
        }, {
            featureType: 'water',
            elementType: 'labels.text.stroke',
            stylers: [
                {lightness: 100}
            ]
        }, {
            featureType: 'water',
            elementType: 'labels.text.fill',
            stylers: [
                {lightness: -100}
            ]
        }, {
            featureType: 'poi',
            elementType: 'geometry',
            stylers: [
                {visibility: 'on'},
                {color: '#f0e4d3'}
            ]
        }, {
            featureType: 'road.highway',
            elementType: 'geometry.fill',
            stylers: [
                {color: '#efe9e4'},
                {lightness: -25}
            ]
        }
    ];
    function initMap2() {

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            styles: estiloMapa,
            mapTypeControl: false,
            center: {lat: -0.205226, lng: -78.495739}
        });
        //        mapa.controls[google.maps.ControlPosition.RIGHT_TOP].pop(legend);

    }

    function mostrarVisitasEnMapa2(coordsClientes, coordsVisitas) {
        //        alert(coordsClientes);
        //        alert(coordsVisitas);
        var opcionesMapa = {
            zoom: 14,
            styles: estiloMapa,
            center: {lat: parseFloat(coordsVisitas[0].LATITUD), lng: parseFloat(coordsVisitas[0].LONGITUD)},
        }
        ;
        var mapa = new google.maps.Map(document.getElementById('map'), opcionesMapa);

        for (var iterador in coordsClientes) {
            //                        alert(coordsClientes[iterador].LATITUD);
            var marcadorCliente = new google.maps.Marker({
                position: {lat: parseFloat(coordsClientes[iterador].LATITUD), lng: parseFloat(coordsClientes[iterador].LONGITUD)},
                map: mapa,
                title: coordsClientes[iterador].LABEL,
                label: coordsClientes[iterador].LABEL,
                icon: pinSymbol('#dd4b4b')
            });
            //            alert(coordsVisitas[iterador].LATITUD);
            var marcadorVisitas = new google.maps.Marker({

                position: {lat: parseFloat(coordsVisitas[iterador].LATITUD), lng: parseFloat(coordsVisitas[iterador].LONGITUD)},
                map: mapa,
                title: coordsVisitas[iterador].LABEL,
                label: coordsVisitas[iterador].LABEL,
                icon: pinSymbol('#0288d1')
            });
        }
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