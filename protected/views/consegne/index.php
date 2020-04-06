<?php
/* @var $this MerchantsController */
/* @var $dataProvider CActiveDataProvider */

$actionURL = Yii::app()->createUrl('consegne/select');
$printURL = Yii::app()->createUrl('consegne/print');
$consegnaURL = Yii::app()->createUrl('consegne/tutti');

(Yii::app()->user->objUser['privilegi'] > 0) ? $visible = true : $visible = false;
?>

<div class='section__content section__content--p30'>
	<div class='container-fluid'>
		<div class="row">
			<div class="col-lg-12">
				<div class="au-card au-card--no-shadow au-card--no-pad m-b-40 bg-overlay--semitransparent">
					<div class="card-header ">
						<i class="fas fa-list"></i>
						<span class="card-title">Pacchi presi in carico</span>
						<div class="float-right">
							<a href="<?php echo $actionURL;?>">
								<button class="btn alert-primary text-light img-cir" style="padding:2.5px; width:30px; height:30px;">
									<i class="fa fa-plus"></i></button>
							</a>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive table--no-card">

							<?php $this->widget('zii.widgets.grid.CGridView', array(
								'htmlOptions' => array('class' => 'table table-wallet'),
								'id'=>'incarico',
							    'dataProvider'=>$dataProvider,
								'columns' => array(
									// array(
									//  'name'=>'Operatore',
 									//  'type'=>'raw',
									//  'value'=>'Users::model()->findByPk($data->id_volontario)->email',
									//  'visible' => $visible,
									//
									// ),
						 		array(
									 'name'=>'Data',
									 'type'=>'raw',
									 'value' => 'CHtml::link(date("d/M/Y",$data->data), Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive),"tag"=>2]) )',
								  ),
									'quartiere',
									'municipalita',

									// array(
									//    'name'=>'Cognome',
									//    'type'=>'raw',
									//    'value'=>'CHtml::link($data->cognome,Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive),"tag"=>2]) )',
									// ),
									// array(
									// 	 'name'=>'Nome',
									// 	 'type'=>'raw',
									// 	 'value'=>'CHtml::link($data->nome,Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive),"tag"=>2]) )',
									// ),
									array(
										 'name'=>'Indirizzo',
										 'type'=>'raw',
										 'value'=>'CHtml::link($data->indirizzo,Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive),"tag"=>2]) )',
									),
									array(
										'name' => '',
										'value'=>'',
									),

								)
							));
							?>
						</div>
					</div>
					<div class="card-footer">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mediumModal">
							<i class="fa fa-print"></i> <?php echo Yii::t('lang','Stampa lista di consegna');?>
						</button>
					</div>
				</div>
			</div>

			<div class="col-lg-12">
				<div class="au-card au-card--no-shadow au-card--no-pad m-b-40 bg-overlay--semitransparent">
					<div class="card-header ">
						<i class="fas fa-list"></i>
						<span class="card-title">Pacchi in consegna</span>
					</div>
					<div class="card-body">
						<div class="table-responsive table--no-card">

							<?php $this->widget('zii.widgets.grid.CGridView', array(
								'htmlOptions' => array('class' => 'table table-wallet'),
								'id'=>'inconsegna',
							    'dataProvider'=>$dataSpedite,
								'columns' => array(
									// array(
									//  'name'=>'Operatore',
									//  'type'=>'raw',
									//  'value'=>'Users::model()->findByPk($data->id_volontario)->email',
									//  'visible' => $visible,
									//
									// ),
						 		array(
									 'name'=>'Data',
									 'type'=>'raw',
									 'value' => 'CHtml::link(date("d/M/Y",$data->data), Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive),"tag"=>1]) )',
								  ),

									// array(
									//    'name'=>'Cognome',
									//    'type'=>'raw',
									//    'value'=>'CHtml::link($data->cognome,Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive),"tag"=>1]) )',
									// ),
									// array(
									// 	 'name'=>'Nome',
									// 	 'type'=>'raw',
									// 	 'value'=>'CHtml::link($data->nome,Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive),"tag"=>1]) )',
									// ),
									'quartiere',
									'municipalita',
									array(
										 'name'=>'Indirizzo',
										 'type'=>'raw',
										 'value'=>'CHtml::link($data->indirizzo,Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive),"tag"=>1]) )',
									),
									array(
										'name' => '',
										'value'=>'',
									),

								)
							));
							?>
						</div>
					</div>
					<div class="card-footer">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#consegnaModal">
							<i class="fa fa-check"></i> <?php echo Yii::t('lang','Consegna tutti');?>
						</button>
					</div>
				</div>
			</div>

		</div>

	<?php echo Logo::footer(); ?>
	</div>
</div>
<!-- Richiesta stampa -->
<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mediumModalLabel">Stampa Lista di consegna</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Tutte le richieste prese in carico verranno messe in consegna. Vuoi proseguire?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
				<a href="<?php echo $printURL;?>" tar get="_blank">
					<button type="button" class="btn btn-primary btn-danger">Conferma</button>
				</a>
			</div>
		</div>
	</div>
</div>
<!-- consegna tutti -->
<div class="modal fade" id="consegnaModal" tabindex="-1" role="dialog" aria-labelledby="consegnaModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="consegnaModalLabel">Consegna pacchi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Sono stati consegnati tutti i pacchi della lista?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<a href="<?php echo $consegnaURL;?>" tar get="_blank">
					<button type="button" class="btn btn-primary btn-danger">Si</button>
				</a>
			</div>
		</div>
	</div>
</div>
