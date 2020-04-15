<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'consegne-form',
	'enableAjaxValidation'=>false,
));
$viewName = 'Consegna';

if (!(isset($_GET['tag'])))
	$tag = 0;
else
	$tag = $_GET['tag'];

$nuovoURL = Yii::app()->createUrl('consegne/create');
$modifyURL = Yii::app()->createUrl('consegne/update',array("id"=>crypt::Encrypt($model->id_archive),"tag"=>$tag));
$deliveryURL = Yii::app()->createUrl('consegne/delivery',array("id"=>crypt::Encrypt($model->id_archive)));
$assegnaURL = Yii::app()->createUrl('consegne/assign',array("id"=>crypt::Encrypt($model->id_archive)));
$restituisciURL = Yii::app()->createUrl('consegne/restituisci',array("id"=>crypt::Encrypt($model->id_archive)));
$rispedisciURL = Yii::app()->createUrl('consegne/delivery2nd',array("id"=>crypt::Encrypt($model->id_archive)));

//$NOdeliveryURL = Yii::app()->createUrl('consegne/deliveryError',array("id"=>crypt::Encrypt($model->id_archive)));
$deleteURL = Yii::app()->createUrl('consegne/delete',array("id"=>crypt::Encrypt($model->id_archive)));

$motivi = [4=>'Non trovato',5=>'Rifiutato'];

$stati = [
	0 => 'Ordine inserito',
	1 => 'Ordine in carico all\'operatore',
	2 => 'Ordine in consegna',
	3 => 'Ordine consegnato',
	4 => 'Utente non trovato',
	5 => 'L\'utente ha rifiutato la consegna'
];

?>
<div class='section__content section__content--p30'>
<div class='container-fluid'>
	<div class="row">
		<div class="col-lg-12">
			<div class="au-card au-card--no-shadow au-card--no-pad m-b-40 bg-overlay--semitransparent">
				<div class="card-header ">
					<i class="fas fa-list"></i>
					<span class="card-title">Dettagli Ordine</span>
				</div>
				<div class="card-body">
					<div class="table-responsive table--no-card ">
						<?php $this->widget('zii.widgets.CDetailView', array(
							'data'=>$model,
							'attributes'=>array(
								array(
									'label'=>'Data inserimento',
									'value'=>date("d/m/Y",$model->data),
								),
								array(
									'label'=>'Codice Fiscale',
									'value'=>$model->codfisc,
								),
								'nome',
								'cognome',
								'telefono',
								'indirizzo',
								'civico',
								'quartiere',
								'municipalita',
								'note',
								'adulti',
								'bambini',
								array(
									'label'=>'Data consegna',
									'value'=>($model->time_consegnato <> 0) ? date("d/m/Y",$model->time_consegnato) : "",
								),
								[
									'label'=>'',
									'value'=>'',
								],
								array(
									'label'=>'Stato Ordine',
									'value'=>$stati[$model->in_consegna],
								),
							),
						));
						?>
					</div>
				</div>
				<div class="card-footer">
					<div class="row">
						<div class="col-md-6">
							<div class="overview-wrap">
								<h2 class="title-1">
									<?php if ($model->id_volontario == 0 && $model->in_consegna < 2){	?>
										<!-- <a href="<?php //echo $assegnaURL;?>">
											<button type="button" class="btn btn-warning">Assegna a me stesso</button>
										</a> -->
										<a href="<?php echo $nuovoURL;?>">
											<button type="button" class="btn btn-primary">Inserisci nuovo</button>
										</a>

									<?php } ?>

									<?php	if ($model->in_consegna == 0):	?>
										<a href="<?php echo $modifyURL;?>">
											<button type="button" class="btn btn-secondary">Modifica</button>
										</a>
										<?php	if (Yii::app()->user->objUser['privilegi'] > 0):	?>
											<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DELETEmediumModal">Elimina</button>
										<?php endif ?>
									<?php endif ?>
									<?php	if ($model->in_consegna == 1):	?>
										<a href="<?php echo $restituisciURL;?>">
											<button type="button" class="btn btn-warning">Rimetti in lista</button>
										</a>
									<?php endif ?>
									<?php	if ($model->in_consegna == 2):	?>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mediumModal">Consegna</button>
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#NOTmediumModal">Mancata Consegna</button>
									<?php endif ?>



									<?php	if ($model->in_consegna == 4):	?> <!-- NON TROVATI -->
										<a href="<?php echo $rispedisciURL;?>">
											<button type="button" class="btn btn-warning">Nuova spedizione</button>
										</a>
									<?php endif ?>
								</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php echo Logo::footer(); ?>
</div>
</div>

<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mediumModalLabel">Conferma Consegna</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Sei sicuro di voler confermare questa <?php echo $viewName;?>?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
				<a href="<?php echo $deliveryURL;?>">
					<button type="button" class="btn btn-primary">Conferma</button>
				</a>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="NOTmediumModal" tabindex="-1" role="dialog" aria-labelledby="NOTmediumModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="NOTmediumModalLabel">MANCATA Consegna</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Seleziona il motivo della mancata consegna</p>
				<?php echo $form->dropDownList($model,'mancataConsegna',$motivi,array('class'=>'form-control'));	?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
				<!-- <a href="<?php //echo $NOdeliveryURL;?>"> -->
					<button type="submit" class="btn btn-danger">Conferma</button>
				<!-- </a> -->
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="DELETEmediumModal" tabindex="-1" role="dialog" aria-labelledby="DELETEmediumModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="DELETEmediumModalLabel">Elimina Ordine</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Sei sicuro di voler eliminare quest'ordine?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
				<a href="<?php echo $deleteURL;?>">
					<button type="button" class="btn btn-danger">Conferma</button>
				</a>
			</div>
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
