<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
));

$settings = Settings::load();
$reCaptcha2PublicKey = $settings->reCaptcha2PublicKey;

$iscriviti = <<<JS
	$(".informativa_link").click(function(){
		$( ".informativa" ).toggle(750);
	});

	$("#LoginForm_informativa_trigger").click(function(){
		if ( $( "#LoginForm_informativa_trigger" ).prop( "checked" ) )
			$( "#LoginForm_informativa_trigger" ).val(1);
		else
			$( "#LoginForm_informativa_trigger" ).val(0);
	});


	// chiede di installare la webapop sul desktop
	var accediButton = document.querySelector('#accedi-button');
	function openSaveOnDesktop() {
	  //createPostArea.style.display = 'block';
	  if (deferredPrompt) {
	    deferredPrompt.prompt();

	    deferredPrompt.userChoice.then(function(choiceResult) {
	      console.log(choiceResult.outcome);

	      if (choiceResult.outcome === 'dismissed') {
	        console.log('User cancelled installation');
	      } else {
	        console.log('User added to home screen');
	      }
	    });

	    deferredPrompt = null;
	  }
	}
	accediButton.addEventListener('click', openSaveOnDesktop);
JS;

Yii::app()->clientScript->registerScript('iscriviti', $iscriviti);

?>
<div class="login-wrap">

	<div class="login-content">
		<div class="login-logo">
			<?php Logo::login(); ?>
		</div>
		<div class="form-group">
			<strong>
				<center>Login</center>
			</strong>
		</div>

		<div class="login-form">
				<div class="form-group">
					<!-- <label>Email Address</label> -->
					<div class="input-group">
              <div class="input-group-addon">
              <!-- <i class="fa fa-envelope"></i> -->
							<img style="height:25px;" src="css/images/ic_account_circle.svg">
              </div>
						<?php echo $form->textField($model,'username',array('placeholder'=>'Username','class'=>'form-control','style'=>'height:45px;')); ?>

					</div>
					<?php echo $form->error($model,'username',array('class'=>'alert alert-danger')); ?>
				</div>
				<div class="form-group">
					<!-- <label>Password</label> -->
					<div class="input-group">
                        <div class="input-group-addon">
                            <!-- <i class="fa fa-asterisk"></i> -->
							<img style="height:25px;" src="css/images/ic_vpn_key.svg">
                        </div>
						<?php echo $form->passwordField($model,'password',array('placeholder'=>'Password','class'=>'form-control','style'=>'height:45px;')); ?>

                    </div>
					<?php echo $form->error($model,'password',array('class'=>'alert alert-danger')); ?>
				</div>
				<div class="form-group">
					<?php
					$form->widget('application.extensions.reCaptcha2.SReCaptcha', array(
	        				'name' => 'reCaptcha', //is requred
	        				'siteKey' => $reCaptcha2PublicKey, //Yii::app()->params['reCaptcha2PublicKey'], //is requred
	        				'model' => $form,
							'lang' => 'it-IT',
							// 'theme'=>'light',
							// 'size'=>'compact',
	        				//'attribute' => 'reCaptcha' //if we use model name equal attribute or customize attribute
						)
					);

					?>
					<?php echo $form->error($model,'reCaptcha',array('class'=>'alert alert-danger')); ?>
				</div>


				<div class="form-group">
					<div class="informativa_contenitore">
						<?php echo $form->checkBox($model,'informativa_trigger',array('value'=>0,'checked'=>'')); ?>
	                    Confermo di aver letto l'<span class="informativa_link text-danger">Informativa per gli utenti.</span>
						<div class="informativa text-primary" style="display:none;">
						<?php include ('informativa.html'); ?>
						</div>
					</div>
				</div>

				<?php echo CHtml::submitButton('Accedi', array('class' => 'au-btn au-btn--block au-btn--blue m-b-20','id'=>'accedi-button')); ?>


				<div class="row">
					<div class="col" style="text-align:center;">
						<img class='login-sponsor' src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/logocomune.png" alt="" >
					</div>
					<div class="col" style="text-align:center;">
						<img class='login-sponsor' width="150" height="150" src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/comunedinapoli.png" alt="" sizes="(max-width: 150px) 100vw, 150px">
					</div>
				</div>
				<?php echo Logo::footer(); ?>
		</div>

	</div>
</div>
<?php $this->endWidget(); ?>
