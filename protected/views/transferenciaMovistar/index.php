<?php
/* @var $this TransferenciaMovistarController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Transferencia Movistar Models',
);

$this->menu=array(
	array('label'=>'Create TransferenciaMovistarModel', 'url'=>array('create')),
	array('label'=>'Manage TransferenciaMovistarModel', 'url'=>array('admin')),
);
?>

<h1>Transferencia Movistar Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
