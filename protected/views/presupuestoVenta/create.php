<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/proceso/IngresarPresupuesto.js"; ?>"></script>
<?php
/* @var $this PresupuestoVentaController */
/* @var $model PresupuestoVentaModel */

$this->breadcrumbs=array(
	'Presupuesto Venta Models'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar', 'url'=>array('index')),
	array('label'=>'Administrar', 'url'=>array('admin')),
);
?>

<h1>Nuevo Presupuesto Venta</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>