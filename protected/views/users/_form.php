<?php
$type = [0=>'Volontario',20=>'Gestore'];

?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>



		<div class="form-group">
			<?php echo $form->labelEx($model,'Seleziona tipo utente'); ?>
			<?php echo $form->dropDownList($model,'type',$type,array('class'=>'form-control'));	?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email',array('size'=>100,'readonly'=>!$model->isNewRecord,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'email',array('class'=>'alert alert-danger')); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'name'); ?>
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>250,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'name',array('class'=>'alert alert-danger')); ?>
		</div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'surname'); ?>
			<?php echo $form->textField($model,'surname',array('size'=>60,'maxlength'=>250,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'surname',array('class'=>'alert alert-danger')); ?>
		</div>

		<?php if ($model->isNewRecord) : ?>
		<div class="form-group">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->textField($model,'password',array('size'=>60,'maxlength'=>250,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'password',array('class'=>'alert alert-danger')); ?>
		</div>
		<?php endif ?>

			<?php echo $form->hiddenField($model,'status_activation_code'); ?>


	<div class="form-group">
		<?php echo CHtml::submitButton(($model->isNewRecord ? 'Inserisci' : 'Salva'), array('class' => 'btn btn-primary')); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->
