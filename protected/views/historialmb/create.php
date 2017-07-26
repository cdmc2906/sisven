<?php
/* @var $this HistorialMbControllerController */
/* @var $model HistorialMbModel */

$this->breadcrumbs = array(
    'Historial' => array('index'),
    'Ingresar item',
);

$this->menu = array(
//	array('label'=>'List HistorialMbModel', 'url'=>array('index')),
    array('label' => 'Administracion Historial', 'url' => array('admin')),
);
?>

<h1>Ingresar item Historial</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>