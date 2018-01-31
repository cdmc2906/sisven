<?php
$pagina_nombre = 'Revision Mines Desconocidos';
$this->breadcrumbs = array('Cargas Informacion', $pagina_nombre => array('index'));
$this->renderPartial('/shared/_blockUI');
$this->renderPartial('/shared/_headgrid', array('metodo' => '"VerDatosArchivo"'));
$this->pageTitle = $pagina_nombre;
?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/carga/CargaRevisaMinesDesconocidos.js"; ?>"></script>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'frmLoad',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array("enctype" => "multipart/form-data"),
        'action' => Yii::app()->request->baseUrl . '/RevisaMinesDesconocidos/SubirArchivo'
    ));
    ?>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'rutaArchivo'); ?>
                <?php echo $form->fileField($model, 'rutaArchivo'); ?>
                <?php echo $form->error($model, 'rutaArchivo'); ?>

                <?php echo $form->labelEx($model, 'delimitadorColumnas'); ?>
                <?php
                echo $form->dropDownList(
                        $model, 'delimitadorColumnas', array(
                    ';' => 'Punto y Coma',
                    ',' => 'Coma'
                        ), array(
                    'empty' => TEXT_OPCION_SELECCIONE, 'options' => array(0 => array('selected' => true)))
                );
                ?>
                <?php echo $form->error($model, 'delimitadorColumnas'); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <?php
        echo CHtml::submitButton('Revisar', array(
            'id' => 'btnRevisar',
            'class' => 'btn btn-primary'));
        ?>
        <?php
        echo CHtml::Button('Exportar Resultado', array(
            'id' => 'btnExcel',
            'class' => 'btn btn-warning'));
        ?>
        <?php
        echo CHtml::Button('Limpiar', array(
            'id' => 'btnLimpiar',
            'class' => 'btn btn-danger'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

    <header class="">
        <h2><strong>Detalle mines desconocidos</strong></h2>
    </header>

    <div class="row">
        <?php $this->renderPartial('/shared/_bodygrid'); ?>
    </div>
</div>