<?php
/* @var $this StoresController */
/* @var $model Stores */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'consegne-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
));
if ($model->isNewRecord){
	$model->data = date('d/m/Y',time());
}else{
	$model->data = WebApp::data_it($model->data);
}
$adulti = [1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10];
$bambini = [0,1,2,3,4,5,6,7,8,9,10];
?>

<div class="form-group">
	<?php echo $form->labelEx($model,'data'); ?>
	<?php echo $form->textField($model,'data',array('size'=>20,'maxlength'=>20,'placeholder'=>'Data','class'=>'form-control')); ?>
	<?php echo $form->error($model,'data',array('class'=>'alert alert-danger')); ?>
</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'codfisc'); ?>
		<?php echo $form->textField($model,'codfisc',array('style' => 'text-transform: uppercase','size'=>16,'maxlength'=>16,'placeholder'=>'Codice Fiscale','class'=>'form-control')); ?>
		<?php echo $form->error($model,'codfisc',array('class'=>'alert alert-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'adulti'); ?>
		<?php echo $form->dropDownList($model,'adulti',$adulti,array('class'=>'form-control'));	?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'bambini'); ?>
		<?php echo $form->dropDownList($model,'bambini',$bambini,array('class'=>'form-control'));	?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'indirizzo'); ?>
		<?php echo $form->textField($model,'indirizzo',array('style' => 'text-transform: uppercase','size'=>60,'maxlength'=>500,'placeholder'=>'Indirizzo','class'=>'form-control')); ?>
		<?php echo $form->error($model,'indirizzo',array('class'=>'alert alert-danger')); ?>
	</div>





	<div class="form-group">
		<?php echo CHtml::submitButton(($model->isNewRecord ? 'Inserisci' : 'Salva'), array('class' => 'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->