<?php
/* @var $this SeguimientoUsuarioCursoController */
/* @var $model SeguimientoUsuarioCurso */

$this->breadcrumbs=array(
	'Seguimiento Usuario Cursos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SeguimientoUsuarioCurso', 'url'=>array('index')),
	array('label'=>'Create SeguimientoUsuarioCurso', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#seguimiento-usuario-curso-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Seguimiento Usuario Cursos</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'seguimiento-usuario-curso-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'id_curso',
		'id_usuario',
		'id_tipo_nota',
		'nota',
		'porcentaje',
		/*
		'descripcion',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
