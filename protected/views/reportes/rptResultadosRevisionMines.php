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
                                'Resultados x Periodo', array(
                            'id' => 'btnExportarResultadosxPeriodo'
                            , 'class' => 'btn btn-success'
                            , 'disabled' => 'disabled'
                        ));
                        ?>        
                    </div>
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
                                'Resumen gestion x fecha x hora', array(
                            'id' => 'btnExportarGestion'
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
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body no-padding">
                    <div class="table-responsive mailbox-messages">
                        <div class="row">
                            <div class="col-md-6">
                                <table id="tblPeriodosCargas" class="table table-condensed"></table>
                                <div id="pagtblPeriodosCargas"> </div> 
                            </div>
                            <div class="col-md-6">
                                <table id="tblCargas" class="table table-condensed"></table>
                                <div id="pagTblCargas"> </div> 
                            </div>
                        </div>

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
                        <div class="row">
                            <div class="col-md-12">
                                <table id="tblResultados" class="table table-condensed"></table>
                                <div id="pagTblResultados"> </div> 
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body no-padding">
                    <div class="table-responsive mailbox-messages">
                        <div class="col-md-9">
                            <table id="tblReasignacion" class="table table-condensed"></table>
                            <div id="pagTblReasignacion"> </div> 
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <strong>Seleccione el agente para reasignar</strong>
                            </div>

                            <div class="row">
                                <?php
                                $sql = "
                                SELECT 
                                a.iduser AS CODIGOAGENTE
                                ,b.usrl_nombre_usuario AS NOMBREAGENTE
                                FROM cruge_user as a
                                inner join  tb_usuario_rol as b
                                on a.iduser  =b.iduser
                                where b.r_id=1
                                ;";

                                $connection = Yii::app()->db;
                                $connection->active = true;
                                $command = $connection->createCommand($sql);

                                $agentesReasignar = $command->queryAll();
                                $connection->active = FALSE;
                                $listaEjecutivos = CHtml::listData($agentesReasignar, 'CODIGOAGENTE', 'NOMBREAGENTE');
                                echo CHtml::dropDownList(
                                        'agenteReasignar'
                                        , $listaEjecutivos
                                        , $listaEjecutivos
                                        , array('empty' => '(Seleccione el ejecutivo)', 'disabled' => 'disabled')
                                );

//                                echo $form->error($model, 'agenteReasignar');
                                ?>
                            </div>
                            <br>
                            <div class="row">
                                <?php
                                echo CHtml::submitButton(
                                        'Reasignar', array(
                                    'id' => 'btnReasignar'
                                    , 'class' => 'btn btn-success'
                                    , 'disabled' => 'disabled'
                                ));
                                ?>    
                            </div>
                            <?php // $this->endWidget(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
