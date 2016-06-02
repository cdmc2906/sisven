<?php
/* @var $this EmpresaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Empresa Models',
);

$this->menu=array(
	array('label'=>'Create EmpresaModel', 'url'=>array('create')),
	array('label'=>'Manage EmpresaModel', 'url'=>array('admin')),
);
?>

<h1>Empresa Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
