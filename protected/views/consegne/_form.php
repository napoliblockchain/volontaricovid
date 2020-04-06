<?php
/* @var $this StoresController */
/* @var $model Stores */
/* @var $form CActiveForm */

?>
<?php include ('js_checkCF.php'); ?>
<?php include ('js_checkAddress.php'); ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'consegne-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
));
$model->data = date('d/m/Y',time());
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
		<?php echo $form->textField($model,'codfisc',array('style' => 'text-transform: uppercase','size'=>16,'maxlength'=>16,'placeholder'=>'Codice Fiscale','class'=>'form-control','onkeyup'=>"validateCF(this.value)")); ?>
		<?php echo $form->error($model,'codfisc',array('class'=>'alert alert-danger')); ?>
		<div id="cf_alert"></div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome',array('style' => 'text-transform: uppercase','size'=>60,'maxlength'=>100,'placeholder'=>'Nome','class'=>'form-control')); ?>
		<?php echo $form->error($model,'nome',array('class'=>'alert alert-danger')); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'cognome'); ?>
		<?php echo $form->textField($model,'cognome',array('style' => 'text-transform: uppercase','size'=>60,'maxlength'=>100,'placeholder'=>'Cognome','class'=>'form-control')); ?>
		<?php echo $form->error($model,'cognome',array('class'=>'alert alert-danger')); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>50,'maxlength'=>50,'placeholder'=>'Telefono','class'=>'form-control')); ?>
		<?php echo $form->error($model,'telefono',array('class'=>'alert alert-danger')); ?>
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
		<?php echo $form->textField($model,'indirizzo',array('style' => 'text-transform: uppercase','size'=>60,'maxlength'=>500,'placeholder'=>'Indirizzo','class'=>'form-control','onKeyPress'=>"validateAddress(event,this.value)")); ?>
		<p class="text-primary"><i>Premere il tasto [`INVIO`] per la lista degli indirizzi. Digitare almeno 4 caratteri.</i></p>
		<?php echo $form->error($model,'indirizzo',array('class'=>'alert alert-danger')); ?>
		<?php echo "<div id='warningIndirizzo' class='alert alert-warning' style='display:none;'></div>"; ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'quartiere'); ?>
		<?php echo $form->textField($model,'quartiere',array('class'=>'form-control','readonly'=>'true')); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'municipalita'); ?>
		<?php echo $form->textField($model,'municipalita',array('class'=>'form-control','readonly'=>'true')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'note'); ?>
		<?php echo $form->textField($model,'note',array('style' => 'text-transform: uppercase','size'=>60,'maxlength'=>500,'placeholder'=>'Note','class'=>'form-control')); ?>
		<?php echo $form->error($model,'note',array('class'=>'alert alert-danger')); ?>
	</div>

	<?php echo $form->hiddenField($model,'trigger_alert',array('value'=>0)); ?>





	<div class="form-group">
		<?php echo CHtml::submitButton(($model->isNewRecord ? 'Inserisci' : 'Modifica'), array('class' => 'btn btn-primary')); ?>
	</div>



<?php $this->endWidget(); ?>

</div><!-- form -->
