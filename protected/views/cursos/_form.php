<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cursos-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<div id="form_curso">
	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'state_curso',array('class'=>'span5','maxlength'=>8)); ?>

	<?php echo $form->textFieldRow($model,'id_docente',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'idmateria',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'nombre_curso',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textAreaRow($model,'descripcion_curso',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'fecha_registro',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fecha_cierre',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>
</div>
<?php $this->endWidget(); ?>
