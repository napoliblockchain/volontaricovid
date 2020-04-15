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

if ($model->data == ''){
	$model->data = date('d/m/Y',time());
}else{
	$model->data = date('d/m/Y',$model->data);
}


$adulti = [1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10];
$bambini = [0,1,2,3,4,5,6,7,8,9,10];
?>

	<div class="row form-group">
		<div class="col col-md-3">
			<?php echo $form->labelEx($model,'data'); ?>
		</div>
		<div class="col-12 col-md-3">
			<?php echo $form->textField($model,'data',array('size'=>20,'maxlength'=>20,'placeholder'=>'Data','class'=>'form-control','readonly'=>!$model->isNewRecord)); ?>
			<?php echo $form->error($model,'data',array('class'=>'alert alert-sm alert-danger')); ?>
		</div>
	</div>

	<div class="row form-group">
		<div class="col col-md-3">
			<?php echo $form->labelEx($model,'codfisc'); ?>
		</div>
		<div class="col-12 col-md-6">
			<?php echo $form->textField($model,'codfisc',array('style' => 'text-transform: uppercase','size'=>16,'maxlength'=>16,'readonly'=>!$model->isNewRecord,'placeholder'=>'Codice Fiscale','class'=>'form-control','onkeyup'=>"validateCF(this.value)")); ?>
			<div><?php echo $form->error($model,'codfisc',array('class'=>'alert alert-danger alert-sm')); ?></div>
			<div id="cf_alert"></div>
		</div>
	</div>
	<div class="row form-group">
		<div class="col col-md-3">
			<?php echo $form->labelEx($model,'nome'); ?>
		</div>
		<div class="col-12 col-md-6">
			<?php echo $form->textField($model,'nome',array('style' => 'text-transform: uppercase','size'=>60,'maxlength'=>100,'placeholder'=>'Nome','class'=>'form-control')); ?>
			<?php echo $form->error($model,'nome',array('class'=>'alert alert-danger alert-sm')); ?>
		</div>
	</div>
	<div class="row form-group">
		<div class="col col-md-3">
			<?php echo $form->labelEx($model,'cognome'); ?>
		</div>
		<div class="col-12 col-md-6">
			<?php echo $form->textField($model,'cognome',array('style' => 'text-transform: uppercase','size'=>60,'maxlength'=>100,'placeholder'=>'Cognome','class'=>'form-control')); ?>
			<?php echo $form->error($model,'cognome',array('class'=>'alert alert-danger alert-sm')); ?>
		</div>
	</div>
	<div class="row form-group">
		<div class="col col-md-3">
			<?php echo $form->labelEx($model,'telefono'); ?>
		</div>
		<div class="col-12 col-md-6">
			<?php echo $form->textField($model,'telefono',array('size'=>50,'maxlength'=>50,'placeholder'=>'Telefono','class'=>'form-control','readonly'=>!$model->isNewRecord)); ?>
			<small class="text-primary"><i>Inserire il numero di telefono senza spazi nè altri segni.</i></small>
			<?php echo $form->error($model,'telefono',array('class'=>'alert alert-danger alert-sm')); ?>
		</div>
	</div>

	<div class="row form-group">
		<div class="col col-md-3">
			<?php echo $form->labelEx($model,'adulti'); ?>
		</div>
		<div class="col-12 col-md-3">
			<?php echo $form->dropDownList($model,'adulti',$adulti,array('class'=>'form-control-sm form-control'));	?>
		</div>
		<div class="col col-md-3">
			<?php echo $form->labelEx($model,'bambini'); ?>
		</div>
		<div class="col-12 col-md-3">
			<?php echo $form->dropDownList($model,'bambini',$bambini,array('class'=>'form-control-sm form-control'));	?>
		</div>
	</div>
	<div class="row form-group">
		<div class="col col-md-3">
			<?php echo $form->labelEx($model,'indirizzo'); ?>
		</div>
		<div class="col-12 col-md-9">
			<?php echo $form->textField($model,'indirizzo',array('style' => 'text-transform: uppercase','size'=>60,'maxlength'=>500,'placeholder'=>'Indirizzo','class'=>'form-control','onKeyPress'=>"validateAddress(event,this.value)")); ?>
			<small class="text-primary"><i>Premere il tasto [`INVIO`] per la lista degli indirizzi. Si consiglia di digitare almeno 4 caratteri.</i></small>
			<?php echo $form->error($model,'indirizzo',array('class'=>'alert alert-danger alert-sm')); ?>
			<?php echo "<div id='warningIndirizzo' class='alert alert-warning alert-sm' style='display:none;'></div>"; ?>
		</div>
	</div>
	<div class="row form-group">
		<div class="col col-md-3">
			<?php echo $form->labelEx($model,'civico'); ?>
		</div>
		<div class="col-12 col-md-3">
			<?php echo $form->textField($model,'civico',array('size'=>50,'maxlength'=>50,'placeholder'=>'Civico','class'=>'form-control')); ?>
		</div>
	</div>

	<div class="row form-group">
		<div class="col col-md-3">
			<?php echo $form->labelEx($model,'quartiere'); ?>
		</div>
		<div class="col-12 col-md-3">
			<?php echo $form->textField($model,'quartiere',array('class'=>'form-control-sm form-control','readonly'=>'true')); ?>
			<?php echo $form->error($model,'quartiere',array('class'=>'alert alert-danger alert-sm')); ?>
		</div>
		<div class="col col-md-3">
			<?php echo $form->labelEx($model,'municipalita'); ?>
		</div>
		<div class="col-12 col-md-3">
			<?php echo $form->textField($model,'municipalita',array('class'=>'form-control-sm form-control','readonly'=>'true')); ?>
			<?php echo $form->error($model,'municipalita',array('class'=>'alert alert-danger alert-sm')); ?>
		</div>
	</div>

	<div class="row form-group">
		<div class="col col-md-3">
			<?php echo $form->labelEx($model,'note'); ?>
		</div>
		<div class="col-12 col-md-9">
			<?php echo $form->textField($model,'note',array('style' => 'text-transform: uppercase','size'=>60,'maxlength'=>500,'placeholder'=>'Note','class'=>'form-control')); ?>
			<?php echo $form->error($model,'note',array('class'=>'alert alert-danger alert-sm')); ?>
		</div>
	</div>

	<?php echo $form->hiddenField($model,'trigger_alert',array('value'=>0)); ?>
	<p class="text-warning"><i>I campi con * sono obbligatori</i></p>
	<div class="form-group">
		<?php echo CHtml::submitButton(($model->isNewRecord ? 'Inserisci' : 'Conferma'), array('class' => 'btn btn-primary')); ?>
	</div>



<?php $this->endWidget(); ?>

</div><!-- form -->
