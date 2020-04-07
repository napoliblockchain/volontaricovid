<?php
$viewName = 'Operatore';

$idUserCrypted = crypt::Encrypt($model->id_user);

$modifyURL = Yii::app()->createUrl('users/update').'&id='.$idUserCrypted;
$pwdchangeURL = Yii::app()->createUrl('users/changepwd').'&id='.$idUserCrypted;
$deleteURL = Yii::app()->createUrl('users/disable').'&id='.$idUserCrypted;

?>
<div class='section__content section__content--p30'>
<div class='container-fluid'>
	<div class="row">
		<div class="col-lg-12">
			<div class="au-card au-card--no-shadow au-card--no-pad m-b-40 bg-overlay--semitransparent">
				<div class="card-header ">
					<i class="fas fa-users"></i>
					<span class="card-title">Dettagli Operatore</span>
				</div>
				<div class="card-body">

					<div class="table-responsive table--no-card ">
						<?php $this->widget('zii.widgets.CDetailView', array(
							//'htmlOptions' => array('class' => 'table table-borderless table-striped '),
							'data'=>$model,
							'attributes'=>array(
								'surname',
								'name',
								'email',
							),
						));
						?>
					</div>
				</div>
				<div class="card-footer">
					<div class="row">
						<div class="col-md-6">
							<a href="<?php echo $modifyURL;?>">
								<button type="button" class="btn btn-secondary">Modifica</button>
							</a>
							<a href="<?php echo $pwdchangeURL;?>">
								<button type="button" class="btn btn-warning">Cambia password</button>
							</a>
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#scrollmodalModello">Elimina</button>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo Logo::footer(); ?>
</div>




<!-- ELIMINA USER -->
<div class="modal fade" id="scrollmodalModello" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabelModello" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="scrollmodalLabelModello">Elimina Volontario</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
						<p>
						L'utente verrà disabilitato dal sistema e non potrà più utilizzarlo.
						Sei sicuro di voler proseguire?
					</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
				<a href="<?php echo $deleteURL;?>">
					<?php echo CHtml::Button('Conferma', array('class' => 'btn btn-primary ')); ?>
				</a>
			</div>
		</div>
	</div>
</div>
