<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'img-videos-sonido-form',
        'action' => Yii::app()->getBaseUrl(true).'/ImgVideosSonido/create',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'validateOnChange'=>false,
            'validateOnType'=>false,
            'afterValidate' => 'js:saveForm'
        ),
));
?>

<p class="help-block">Los campos marcados <span class="required">*</span> son requeridos.</p>

<?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldRow  ($model,'nombre',array('class'=>'span5')); ?>

        <?php echo $form->dropDownListRow($model,'type',array('video'=>'Video','img'=>'Imagen'),array('class'=>'span5','maxlength'=>6,'onchange'=>'change($(this))')); ?>
        
        <div id="multimedia">
        <?php if($model->type == 'video'){?>

        <?php echo $form->textFieldRow($model,'url',array('class'=>'span5','maxlength'=>100,'data-toggle'=>"tooltip", 'data-placement'=>"top",'title'=>"Debe agregar una ruta unicamente de vimeo.")); ?>

        <?php }else if($model->type == 'img'){ ?>  

        <?php echo $form->fileFieldRow($model, 'url',array('class'=>'span5 ','maxlength'=>100,'style'=>'',)); ?>
        
        <?php } ?>
	
        </div>

        <?php echo $form->dropDownListRow($model, 'state_img_videos', array('true' => 'Activo', 'false' => 'Inactivo'), array('class' => 'span5', 'data-placement' => 'right', 'maxlength' => 8)); ?>

	<?php echo $form->textAreaRow($model,'descripcion',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php $model->idUsiario=  Yii::app()->user->id; echo $form->hiddenField($model,'idUsiario',array('class'=>'span5','value')); ?>
        
        <?php echo CHtml::hiddenField('ImgVideosSonidoContenidos[contenidos_id]', $Contenidomodel->id); ?>
<?php if (!isset($cursoSeccion)) { ?>
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
</div>
<?php } ?>
<?php $this->endWidget(); ?>
