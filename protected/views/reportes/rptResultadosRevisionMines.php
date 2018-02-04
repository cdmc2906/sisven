<?php
$pagina_nombre = 'Resultados Revision Mines';
$this->breadcrumbs = array($pagina_nombre => array('index'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/reporte/RptResultadosRevisionMines.js"; ?>"></script>

<?php if (Yii::app()->user->hasFlash('resultadoGuardar')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('resultadoGuardar'); ?>
    </div>
<?php else: ?>
    <div class=""></div>
<?php endif; ?>

<div class="row">
    <!--COLUMNA BOTONES-->
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <div class="table-responsive mailbox-messages">
                    <?php
                    echo CHtml::submitButton(
                            'Buscar Cargas', array(
                        'id' => 'btnBuscarCargas'
                        , 'class' => 'btn btn-primary'
                    ));
                    ?>        
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <div class="table-responsive mailbox-messages">
                    <div class="col-md-3">
                        <?php
                        echo CHtml::submitButton(
                                'Resultados x Carga', array(
                            'id' => 'btnExportarResultados'
                            , 'class' => 'btn btn-success'
                            , 'disabled' => 'disabled'
                        ));
                        ?>        
                    </div>
                    <div class="col-md-3">
                        <?php
                        echo CHtml::submitButton(
                                'Mines sin Gestion', array(
                            'id' => 'btnExportarMinesSinGestion'
                            , 'class' => 'btn btn-success'
                            , 'disabled' => 'disabled'
                        ));
                        ?>        
                    </div>
                    <div class="col-md-3">
                        <?php
                        echo CHtml::submitButton(
                                'Resumen gestion', array(
                            'id' => 'btnExportarGestion'
                            , 'class' => 'btn btn-success'
                            , 'disabled' => 'disabled'
                        ));
                        ?>        
                    </div>
                    <div class="col-md-3">
                        <?php
                        echo CHtml::submitButton(
                                'Resumen resultados', array(
                            'id' => 'btnExportarResumenResultados'
                            , 'class' => 'btn btn-success'
                            , 'disabled' => 'disabled'
                        ));
                        ?>        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!--COLUMNA DATO-->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body no-padding">
                    <div class="table-responsive mailbox-messages">
                        <div class="col-md-6">

                            <div class="row">
                                <div class="col-md-12">
                                    <table id="tblCargas" class="table table-condensed"></table>
                                    <div id="pagTblCargas"> </div> 
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="tblResultados" class="table table-condensed"></table>
                                    <div id="pagTblResultados"> </div> 
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="tblGestionxAgente" class="table table-condensed"></table>
                                    <div id="pagtblGestionxAgente"> </div> 
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="tblTiempoGestionxAgente" class="table table-condensed"></table>
                                    <div id="pagtblTiempoGestionxAgente"> </div> 
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
