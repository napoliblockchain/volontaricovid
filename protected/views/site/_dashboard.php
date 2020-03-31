	<div class="section__content section__content--p30">

		<div class="container-fluid">
			<div class="warning-message">
				<?php
				if (null !== $warningmessage)
					foreach ($warningmessage as $message)
						echo $message;
				?>
			</div>

			<?php
			if (Yii::app()->user->objUser['privilegi'] == 20){
				include ('template/richieste_iscrizione.php'); 
				include ('template/promemoria_scadenze.php');
			}
		 ?>


			<div class="row m-t-25">
				<?php include ('template/vendite_totali.php'); ?>
			</div>

			<div class="row m-t-25">

				<?php include ('template/euro_incassati.php'); ?>
				<?php include ('template/crypto_incassate.php'); ?>
				<?php include ('template/token_incassati.php'); ?>
				<?php include ('template/exchangebalance.php'); ?>
			</div>


			<!-- <div class="row m-t-25">
				<?php // include ('template/vendite_totali.php'); ?>
				<?php // include ('template/exchangebalance.php'); ?>
				<?php // include ('template/euro_incassati.php'); ?>
				<?php // include ('template/bitcoin_incassati.php'); ?>
				<?php //include ('template/token_incassati.php'); ?>

			</div> -->

			<?php echo Logo::footer(); ?>
		</div>
	</div>
