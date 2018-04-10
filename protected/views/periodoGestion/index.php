<?php
/* @var $this PeriodoGestionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Periodo Gestion Models',
);

$this->menu=array(
	array('label'=>'Create PeriodoGestionModel', 'url'=>array('create')),
	array('label'=>'Manage PeriodoGestionModel', 'url'=>array('admin')),
);
?>

<h1>Periodo Gestion Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
