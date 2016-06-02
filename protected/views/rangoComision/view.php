<?php
/* @var $this RangoComisionController */
/* @var $model RangoComisionModel */

$this->breadcrumbs = array(
    'Rango Comision' => array('index'),
    $model->ID_RCOM,
);

$this->menu = array(
//	array('label'=>'Ver rangos', 'url'=>array('index')),
    array('label' => 'Ver rangos de comision', 'url' => array('admin')),
    array('label' => 'Crear', 'url' => array('create')),
    array('label' => 'Actualizar', 'url' => array('update', 'id' => $model->ID_RCOM)),
    array('label' => 'Eliminar', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID_RCOM), 'confirm' => 'Are you sure you want to delete this item?')),
);
?>

<h1>View RangoComisionModel #<?php echo $model->ID_RCOM; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'ID_RCOM',
        'RANGOMIN_RCOM',
        'RANGOMAX_RCOM',
        'PORCENTAJE_RCOM',
        'FECHAINGRESO_RCOM',
    ),
));
?>
