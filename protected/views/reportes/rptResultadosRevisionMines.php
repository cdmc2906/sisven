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

<!--GRID RUTAS Y CLIENTES ASIGNADOS-->
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <div class="row">
                    <div class="col-md-4">
                        <?php
                        echo CHtml::submitButton('Buscar Cargas', array(
                            'id' => 'btnBuscarCargas',
                            'class' => 'btn btn-success'));
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <table id="tblCargas" class="table table-condensed"></table>
                        <div id="pagTblCargas"> </div> 
                    </div>

                    <div class="col-md-8">
                        <table id="tblResultados" class="table table-condensed"></table>
                        <div id="pagTblResultados"> </div> 
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-6">
                        <table id="tblGestionxAgente" class="table table-condensed"></table>
                        <div id="pagtblGestionxAgente"> </div> 
                    </div>
                    <div class="col-md-6">
                        <table id="tblTiempoGestionxAgente" class="table table-condensed"></table>
                        <div id="pagtblTiempoGestionxAgente"> </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>