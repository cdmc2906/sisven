<?php
/* @var $this OrdenesMbController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array('Ordenes Mobilvendor',);

$this->menu = array(
    array('label' => 'Ingresar Orden', 'url' => array('create')),
    array('label' => 'Administrar Ordenes', 'url' => array('admin')),
);
?>

<h1>Ordenes</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
