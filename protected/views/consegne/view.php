<?php
/* @var $this StoresController */
/* @var $model Stores */
$viewName = 'Consegna';

if (!(isset($_GET['tag'])))
	$tag = 0;
else
	$tag = 1;


?>
<div class='section__content section__content--p30'>
<div class='container-fluid'>
	<div class="row">
		<div class="col-lg-12">
			<div class="au-card au-card--no-shadow au-card--no-pad m-b-40 bg-overlay--semitransparent">
				<div class="card-header ">
					<i class="fas fa-list"></i>
					<span class="card-title">Dettagli <?php echo $viewName;?></span>
				</div>
				<div class="card-body">
					<div class="table-responsive table--no-card ">
						<?php $this->widget('zii.widgets.CDetailView', array(
							//'htmlOptions' => array('class' => 'table table-borderless table-striped '),
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
								'note',
								'adulti',
								'bambini',
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
									<?php
										$modifyURL = Yii::app()->createUrl('consegne/update',array("id"=>crypt::Encrypt($model->id_archive),"tag"=>$tag));
										$deliveryURL = Yii::app()->createUrl('consegne/delivery',array("id"=>crypt::Encrypt($model->id_archive)));
										$assegnaURL = Yii::app()->createUrl('consegne/assign',array("id"=>crypt::Encrypt($model->id_archive)));

									?>
									<a href="<?php echo $modifyURL;?>">
										<button type="button" class="btn btn-secondary">Modifica</button>
									</a>
									<?php
									if ($tag == 1){
										?>
									<button type="button" class="btn btn-success" data-toggle="modal" data-target="#mediumModal">Consegna</button>
								<?php }
								if ($model->id_volontario == 0){
									?>
									<a href="<?php echo $assegnaURL;?>">
										<button type="button" class="btn btn-warning">Assegna a me stesso</button>
									</a>
							<?php } ?>
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
					<button type="button" class="btn btn-primary btn-danger">Conferma</button>
				</a>
			</div>
		</div>
	</div>
</div>
