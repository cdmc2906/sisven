<?php
$pagina_nombre = 'Carga Rutas Mobilvendor';
$this->breadcrumbs = array('Cargas Informacion', $pagina_nombre => array('index'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/carga/CargaRutasMb.js"; ?>"></script>
<?php if (Yii::app()->user->hasFlash('resultadoHistorial')): ?>
    <div class="flash-notice">
        <?php echo Yii::app()->user->getFlash('resultadoHistorial'); ?>
    </div>
<?php else: ?>
    <div class=""></div>
<?php endif; ?>

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
        'action' => Yii::app()->request->baseUrl . '/CargaRutasMb/SubirArchivo'
    ));
    ?>
    <div class="row">
        <?php
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
        $periodoAbierto = $resultado1['descripcion'];

        Yii::app()->session['idPeriodoAbierto'] = $resultado1['idperiodo'];
        Yii::app()->session['fechaInicioPeriodo'] = $resultado1['fechainicio'];
        Yii::app()->session['fechaFinPeriodo'] = $resultado1['fechafin'];

        $command = Yii::app()->db->createCommand('
                        select 
                                r_fch_ingreso AS fecha
                            from tb_ruta_mb 
                            order by r_fch_ingreso desc 
                            limit 1');
        $resultado = $command->queryRow();
        $ultimaFecha = DateTime::createFromFormat('Y-m-d H:i:s', $resultado['fecha'])->format(FORMATO_FECHA_LONG_2);
        ?>
        <div class="callout callout-success">
            <center>
                <h4><?php echo $form->labelEx($model, 'periodoAbierto'); ?></h4>
                <p> <b><?php echo $periodoAbierto; ?></b></p>
            </center>
        </div>
        <div class="callout callout-info">
            <center>
                <h4><?php echo $form->labelEx($model, 'fechaUltimaCarga'); ?></h4>
                <p>La ultima carga se realizo el <b><?php echo $ultimaFecha; ?></b></p>
            </center>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php
                echo $form->labelEx($model, 'rutaArchivo');
                echo $form->fileField($model, 'rutaArchivo');
                echo $form->error($model, 'rutaArchivo', array('errorCssClass' => 'form-group has-error'));

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
        </div>
    </div>
    <div class="row">
        <?php
        echo CHtml::submitButton('Cargar', array(
            'id' => 'btnCargar',
            'class' => 'btn btn-primary'));
        ?>              
        <?php
        echo CHtml::ajaxSubmitButton('Guardar', CHtml::normalizeUrl(
                        array(
                            'cargarutasmb/guardarRutas',
                            'render' => true)), array(
            'dataType' => 'json',
            'type' => 'post',
            'beforeSend' => 'function() {blockUIOpen();}',
            'success' => 'function(data) {
                        blockUIClose();
                        setMensaje(data.ClassMessage, data.Message);
                        if(data.Status==1){
                            var datosResult = data.Result;
                            //aler(datosResult);
                            $("#tblGridResumen").setGridParam({datatype: \'jsonstring\', datastr: datosResult}).trigger(\'reloadGrid\');
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
        ?>         
        <?php
        echo CHtml::Button('Limpiar', array('id' => 'btnLimpiar', 'class' => 'btn btn-danger'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

    <header class="">
        <h2><strong>Detalle archivo Rutas</strong></h2>
    </header>
    <div class="row">
        <?php $this->renderPartial('/shared/_bodygrid'); ?>
    </div>
</div>