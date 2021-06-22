<?php
$pagina_nombre = 'Sin gestion por fecha';
$this->breadcrumbs = array($pagina_nombre => array('index'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker.css" />
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/datepicker3.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootstrap-datepicker.es.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/reporte/RptCliSinGestionxFecha.js"; ?>"></script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>

<?php if (Yii::app()->user->hasFlash('resultadoGuardar')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('resultadoGuardar'); ?>
    </div>
<?php else: ?>
    <div class=""></div>
<?php endif; ?>

<div class="box-solid">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Resumen Visitados/No visitados</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Resumen Acumulado visitas</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="btn-group">
                                        <button type="button" title="Filtrar" value="Filtrar" class="btn btn-default" data-toggle="modal" data-target="#modal-filtros">
                                            <i class="fa fa-filter"></i>
                                        </button>
                                    </div>
                                    <div class="modal fade" id="modal-filtros">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Filtros</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    $form = $this->beginWidget('CActiveForm', array('id' => 'frmLoad', 'enableClientValidation' => true, 'clientOptions' => array('validateOnSubmit' => true,), 'htmlOptions' => array("enctype" => "multipart/form-data"),));
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <i class="fa fa-user"></i>
                                                            <?php
                                                            echo $form->labelEx($model, 'tipoUsuario');
                                                            echo $form->dropDownList(
                                                                    $model
                                                                    , 'tipoUsuario'
                                                                    , array(
                                                                '' => 'Seleccione',
                                                                'T' => 'Todos',
                                                                'E' => 'Por Ejecutivo',
                                                                GRUPO_EJECUTIVOS_ZONA_MOVI_ZS => 'Ejecutivos Zona Movi',
                                                                GRUPO_EJECUTIVOS_ZONA_TUENTI => 'Ejecutivos Zona Tuenti',
                                                                GRUPO_SUPERVISORES_MOVI_ZS => 'Supervisores Movistar',
                                                                GRUPO_SUPERVISORES_TUENTI => 'Supervisores Tuenti',
                                                                GRUPO_SERVICIO_CLIENTE => 'Servicio Cliente',
                                                                GRUPO_DESARROLLADORES => 'Desarrolladores',
                                                                GRUPO_TECNICOS => 'Tecnico ',
                                                                    )
                                                                    , array('class' => 'form-control select2')
                                                            );
                                                            echo $form->error($model, 'tipoUsuario');
                                                            ?>
                                                        </div>
                                                        <div class="row" id="usuario_seleccionado" style="display: none">
                                                            <div class="col-md-6">
                                                                <i class="fa fa-user"></i>
                                                                <?php echo $form->labelEx($model, 'usuario'); ?>
                                                                <?php
                                                                $ejecutivo = EjecutivoModel::model()->findByAttributes(array('e_estado' => '1'));
                                                                $ejecutivos = EjecutivoModel::model()->findAllByAttributes(array('e_estado' => '1'));
                                                                $listaEjecutivos_ = CHtml::listData($ejecutivos, 'e_usr_mobilvendor', 'e_nombre');
                                                                echo $form->dropDownList(
                                                                        $model
                                                                        , 'usuario'
                                                                        , $listaEjecutivos_
                                                                        , array(
                                                                    'empty' => '(Seleccione un usuario)'
                                                                    , 'class' => 'form-control select2'
                                                                ));
                                                                ?>
                                                                <?php echo $form->error($model, 'usuario'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class ='row'>
                                                        <br/>
                                                        <div class="col-md-6">
                                                            <i class="fa fa-user"></i>
                                                            <?php
                                                            echo $form->labelEx($model, 'tipoFecha');
                                                            echo $form->dropDownList(
                                                                    $model
                                                                    , 'tipoFecha'
                                                                    , array(
                                                                '' => 'Seleccione una opcion',
                                                                'M' => 'Por mes',
                                                                'P' => 'Por periodo',
                                                                'R' => 'Rango fecha',
                                                                _30DIAS => 'Hace 30 dias',
                                                                _60DIAS => 'Hace 60 dias',
                                                                _90DIAS => 'Hace 90 dias',
                                                                    )
                                                                    , array('class' => 'form-control select2')
                                                            );
                                                            echo $form->error($model, 'tipoFecha');
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="row" id="seleccion_mes" style="display: none">
                                                        <br/>
                                                        <div class="col-md-6">
                                                            <i class="fa fa-user"></i>
                                                            <?php echo $form->labelEx($model, 'anio'); ?>
                                                            <?php
                                                            $criteria = new CDbCriteria();
                                                            $criteria->condition = 'pg_tipo=\'SEMANAL\'';
                                                            $criteria->distinct = true;
                                                            $criteria->select = 'pg_anio';

                                                            $aniosPeriodos = PeriodoGestionModel::model()->findAll($criteria);
                                                            $listaAniosPeriodo = CHtml::listData($aniosPeriodos, 'pg_anio', 'pg_anio');

                                                            echo $form->dropDownList(
                                                                    $model
                                                                    , 'anio'
                                                                    , $listaAniosPeriodo
                                                                    , array(
                                                                'empty' => '(Seleccione un anio)'
                                                                , 'class' => 'form-control select2'
//                                                            , 'options' => array($ejecutivo->e_usr_mobilvendor => array('selected' => true))
                                                                , 'onchange' => 'js:cargarMeses(this.value)'
                                                            ));
                                                            ?>
                                                            <?php echo $form->error($model, 'anio'); ?>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <i class="fa fa-user"></i>
                                                            <?php
                                                            echo $form->labelEx($model, 'mes');
                                                            ?>
                                                            <div  id ='div_mes_por_anio'></div>
                                                            <?php
                                                            echo $form->error($model, 'mes');
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="row" id="seleccion_periodo" style="display: none">
                                                        <br/>
                                                        <div class="col-md-6">
                                                            <i class="fa fa-user"></i>
                                                            <?php
                                                            echo $form->labelEx($model, 'periodo');
                                                            $periodos = PeriodoGestionModel::model()->findAllByAttributes(array('pg_tipo' => 'SEMANAL'), array('order' => 'pg_id DESC'));
                                                            $listaPeriodos = CHtml::listData($periodos, 'pg_id', 'pg_descripcion');
                                                            echo $form->dropDownList(
                                                                    $model
                                                                    , 'periodo'
                                                                    , $listaPeriodos
                                                                    , array(
                                                                'empty' => '(Seleccione un periodo)'
                                                                , 'class' => 'form-control select2'
                                                                    //                                            , 'onchange' => 'js:cargarParroquias(this.value)'
                                                            ));
                                                            echo $form->error($model, 'periodo');
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="row" id="seleccion_rango_fecha" style="display: none">
                                                        <br/>
                                                        <div class="col-md-6">
                                                            <i class="fa fa-calendar"></i>
                                                            <?php echo $form->labelEx($model, 'fechaInicioAnalisis'); ?>
                                                            <?php
                                                            echo $form->textField(
                                                                    $model
                                                                    , 'fechaInicioAnalisis'
                                                                    , array(
                                                                'class' => 'txtfechaInicioAnalisis form-control'));
                                                            ?>
                                                            <?php echo $form->error($model, 'fechaInicioAnalisis'); ?>
                                                        </div>

                                                        <!--                            </div>
                                                                                    <div class="row">-->
                                                        <div class="col-md-6">
                                                            <i class="fa fa-calendar"></i>
                                                            <?php echo $form->labelEx($model, 'fechaFinAnalisis'); ?>
                                                            <?php
                                                            echo $form->textField(
                                                                    $model
                                                                    , 'fechaFinAnalisis'
                                                                    , array(
                                                                'class' => 'txtfechaFinAnalisis form-control'));
                                                            ?>
                                                            <?php echo $form->error($model, 'fechaFinAnalisis'); ?>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <?php
                                                                echo CHtml::ajaxSubmitButton(
                                                                        'Analizar', CHtml
                                                                        ::normalizeUrl(array('RptCliSinGestionxFecha/AnalizarClientes', 'render' => true)), array(
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
                            GenerarResumenVisitas(datosResult);                            
                            GenerarResumenVisitasPCP(datosResult);    
                            $("#tblDetalleVisitados").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'detalleVisitados\']}).trigger(\'reloadGrid\');
                            $("#tblDetalleNoVisitados").setGridParam({datatype: \'jsonstring\', datastr: datosResult[\'detalleNoVisitados\']}).trigger(\'reloadGrid\');

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
                                                                        )
                                                                        , array('id' => 'btnGenerate'
                                                                    , 'class' => 'btn btn-block btn-success btn-sm'
                                                                    , "data-dismiss" => 'modal'
                                                                ));
                                                                ?>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php
                                                                echo CHtml::Button(
                                                                        'Limpiar'
                                                                        , array('id' => 'btnLimpiar'
                                                                    , 'class' => 'btn btn-block btn-primary btn-sm'
                                                                    , "data-dismiss" => 'modal'
                                                                ));
                                                                ?>
                                                            </div>
                                                            <?php $this->endWidget(); ?>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                            </div>
                                            <!-- /.FIN MODAL -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="table-responsive mailbox-messages">
                                    <div id="gridPivotResumenVisitas">
                                        <table id="tblResumenVisitas" class="table table-condensed"></table>
                                        <div id="pagtblResumenVisitas"> </div>
                                    </div>
                                    <br/>
                                    <div id="gridPivotResumenVisitasPCP">
                                        <table id="tblResumenVisitasPCP" class="table table-condensed"></table>
                                        <div id="pagtblResumenVisitasPCP"> </div>
                                    </div>
                                    <br/>
                                    <table id="tblDetalleVisitados" class="table table-condensed"></table>
                                    <div id="pagtblDetalleVisitados"> </div>
                                    <br/>
                                    <table id="tblDetalleNoVisitados" class="table table-condensed"></table>
                                    <div id="pagtblDetalleNoVisitados"> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab_2">
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="btn-group">
                                        <button 
                                            type="button" title="Filtrar" 
                                            value="Filtrar" 
                                            class="btn btn-default" 
                                            data-toggle="modal" 
                                            data-target="#modal-filtros_acum">
                                            <i class="fa fa-filter"></i>
                                        </button>
                                    </div>
                                    <div class="modal fade" id="modal-filtros_acum">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Filtros</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    $form = $this->beginWidget('CActiveForm'
                                                            , array('id' => 'frmLoad'
                                                        , 'enableClientValidation' => true
                                                        , 'clientOptions' => array('validateOnSubmit' => true,)
                                                        , 'htmlOptions' => array("enctype" => "multipart/form-data")
                                                            ,
                                                    ));
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <i class="fa fa-user"></i>
                                                            <?php
                                                            echo $form->labelEx($model, 'tipoEjecutivoAcum');
                                                            echo $form->dropDownList(
                                                                    $model
                                                                    , 'tipoEjecutivoAcum'
                                                                    , array(
                                                                '' => 'Seleccione',
                                                                'E' => 'Por Ejecutivo',
                                                                GRUPO_EJECUTIVOS_ZONA_MOVI_ZS => 'Ejecutivos Zona Movi',
                                                                GRUPO_EJECUTIVOS_ZONA_TUENTI => 'Ejecutivos Zona Tuenti',
                                                                GRUPO_SUPERVISORES_MOVI_ZS => 'Supervisores Movistar',
                                                                GRUPO_SUPERVISORES_TUENTI => 'Supervisores Tuenti',
                                                                GRUPO_SERVICIO_CLIENTE => 'Servicio Cliente',
                                                                GRUPO_DESARROLLADORES => 'Desarrolladores',
                                                                GRUPO_TECNICOS => 'Tecnico ',
                                                                    )
                                                                    , array('class' => 'form-control select2')
                                                            );
                                                            echo $form->error($model, 'tipoEjecutivoAcum');
                                                            ?>
                                                        </div>
                                                        <div class="row" id="usuario_seleccionado_acum" style="display: none">
                                                            <div class="col-md-6">
                                                                <i class="fa fa-user"></i>
                                                                <?php echo $form->labelEx($model, 'ejecutivoAcum'); ?>
                                                                <?php
                                                                $ejecutivo = EjecutivoModel::model()->findByAttributes(array('e_estado' => '1'));
                                                                $ejecutivos = EjecutivoModel::model()->findAllByAttributes(array('e_estado' => '1'));
                                                                $listaEjecutivos_ = CHtml::listData($ejecutivos, 'e_usr_mobilvendor', 'e_nombre');
                                                                echo $form->dropDownList(
                                                                        $model
                                                                        , 'ejecutivoAcum'
                                                                        , $listaEjecutivos_
                                                                        , array(
                                                                    'empty' => '(Seleccione un usuario)'
                                                                    , 'class' => 'form-control select2'
                                                                ));
                                                                ?>
                                                                <?php echo $form->error($model, 'ejecutivoAcum'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <br/>
                                                        <div class="col-md-6">
                                                            <i class="fa fa-user"></i>
                                                            <?php echo $form->labelEx($model, 'anioInicioAcum'); ?>
                                                            <?php
                                                            $criteria = new CDbCriteria();
                                                            $criteria->condition = 'pg_tipo=\'SEMANAL\'';
                                                            $criteria->distinct = true;
                                                            $criteria->select = 'pg_anio';

                                                            $aniosPeriodos = PeriodoGestionModel::model()->findAll($criteria);
                                                            $listaAniosPeriodo = CHtml::listData($aniosPeriodos, 'pg_anio', 'pg_anio');

                                                            echo $form->dropDownList(
                                                                    $model
                                                                    , 'anioInicioAcum'
                                                                    , $listaAniosPeriodo
                                                                    , array(
                                                                'empty' => '(Seleccione un anio)'
                                                                , 'class' => 'form-control select2'
//                                                            , 'options' => array($ejecutivo->e_usr_mobilvendor => array('selected' => true))
                                                                , 'onchange' => 'js:cargarMesesInicioAcum(this.value)'
                                                            ));
                                                            ?>
                                                            <?php echo $form->error($model, 'anioInicioAcum'); ?>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <i class="fa fa-user"></i>
                                                            <?php
                                                            echo $form->labelEx($model, 'mesInicioAcum');
                                                            ?>
                                                            <div  id ='div_mes_por_anio_inicio_acum'></div>
                                                            <?php
                                                            echo $form->error($model, 'mesInicioAcum');
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <br/>
                                                        <div class="col-md-6">
                                                            <i class="fa fa-user"></i>
                                                            <?php echo $form->labelEx($model, 'anioFinAcum'); ?>
                                                            <?php
                                                            $criteria = new CDbCriteria();
                                                            $criteria->condition = 'pg_tipo=\'SEMANAL\'';
                                                            $criteria->distinct = true;
                                                            $criteria->select = 'pg_anio';

                                                            $aniosPeriodos = PeriodoGestionModel::model()->findAll($criteria);
                                                            $listaAniosPeriodo = CHtml::listData($aniosPeriodos, 'pg_anio', 'pg_anio');

                                                            echo $form->dropDownList(
                                                                    $model
                                                                    , 'anioFinAcum'
                                                                    , $listaAniosPeriodo
                                                                    , array(
                                                                'empty' => '(Seleccione un anio)'
                                                                , 'class' => 'form-control select2'
//                                                            , 'options' => array($ejecutivo->e_usr_mobilvendor => array('selected' => true))
                                                                , 'onchange' => 'js:cargarMesesFinAcum(this.value)'
                                                            ));
                                                            ?>
                                                            <?php echo $form->error($model, 'anioFinAcum'); ?>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <i class="fa fa-user"></i>
                                                            <?php
                                                            echo $form->labelEx($model, 'mesFinAcum');
                                                            ?>
                                                            <div  id ='div_mes_por_anio_fin_acum'></div>
                                                            <?php
                                                            echo $form->error($model, 'mesFinAcum');
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <?php
                                                                echo CHtml::ajaxSubmitButton(
                                                                        'Analizar', CHtml
                                                                        ::normalizeUrl(
                                                                                array(
                                                                                    'RptCliSinGestionxFecha/AnalizarClientesAcumulado'
                                                                                    , 'render' => true
                                                                                )
                                                                        )
                                                                        , array(
                                                                    'dataType' => 'json',
                                                                    'type' => 'post',
                                                                    'beforeSend' => 'function() {blockUIOpen();}',
                                                                    'success' => 'function(data) {
                                                                        blockUIClose();
                                                                        setMensaje(data.ClassMessage, data.Message);
                                                                        if(data.Status==1){
                                                                            var datosResult = data.Result;
                                                                            $("#div-visitasMes").html("<table id=\"tblVisitasMes\" class=\"table table-condensed\"></table><div id=\"pagtblVisitasMes\"> </div>");
                                                                            crearReporteAcum(datosResult);
                                                                        } else{
                                                                            $.each(data, function(key, val) {
                                                                            $("#frmBankStat #"+key+"_em_").text(val);
                                                                            $("#frmBankStat #"+key+"_em_").show();
                                                                            });
                            }
                                                                        }',
                                                                    'error' => 'function(xhr,st,err) {blockUIClose();RedirigirError(xhr.status);}'
                                                                        )
                                                                        , array('id' => 'btnGenerateAcumulado'
                                                                    , 'class' => 'btn btn-block btn-success btn-sm'
                                                                    , "data-dismiss" => 'modal'
                                                                ));
                                                                ?>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php
                                                                echo CHtml::Button(
                                                                        'Limpiar'
                                                                        , array('id' => 'btnLimpiarAcum'
                                                                    , 'class' => 'btn btn-block btn-primary btn-sm'
                                                                    , "data-dismiss" => 'modal'
                                                                ));
                                                                ?>
                                                            </div>
                                                            <?php $this->endWidget(); ?>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                            </div>
                                            <!-- /.FIN MODAL -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box box-primary">
                                        <div class="box-body no-padding">
                                            <div id='div-visitasMes' class="table-responsive mailbox-messages">
                                                <table id="tblVisitasMes" class="table table-condensed"></table>
                                                <div id="pagtblVisitasMes"> </div>
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
</div>

