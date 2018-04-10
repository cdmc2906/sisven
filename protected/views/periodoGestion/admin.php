<?php
/* @var $this PeriodoGestionController */
/* @var $model PeriodoGestionModel */

$this->breadcrumbs = array(
    'Periodo Gestion Models' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List PeriodoGestionModel', 'url' => array('index')),
    array('label' => 'Create PeriodoGestionModel', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#periodo-gestion-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Periodo Gestion Models</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'periodo-gestion-model-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
//		'pg_id',
        'pg_descripcion',
        'pg_fecha_inicio',
        'pg_fecha_fin',
        'pg_estado',
        'pg_tipo',
        'pg_fecha_ingreso',
        'pg_fecha_modificacion',
        'pg_cod_usuario_ing_mod',
        /**/
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{view}',
        ),
    ),
));
?>
