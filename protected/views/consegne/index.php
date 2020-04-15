<div class="form">
<?php
include ('js_index.php');


$form=$this->beginWidget('CActiveForm', array(
	'id'=>'index-form',
	'enableAjaxValidation'=>false,
));

$actionURL = Yii::app()->createUrl('consegne/select');
$consegnaURL = Yii::app()->createUrl('consegne/tutti');

(Yii::app()->user->objUser['privilegi'] > 0) ? $visible = true : $visible = false;



?>
<!-- <div class="row alert-warning">
	<?php
	// $row = 1;
	// if (($handle = fopen("felice.csv", "r")) !== FALSE) {
	//     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	// 		$array[] = $data[0];
	//     }
	//     fclose($handle);
	// }
	// foreach ($array as $t){
	// 	$riga = explode(";",$t);
	// 	//$tmpdata = explode("/",$riga[1]);
	// 	//$timestamp = strtotime('2020-'.$tmpdata[1].'-'.$tmpdata[0]);
	// 	$sql[] = "UPDATE dali_archive SET time_consegnato=0, in_consegna=4, consegnato=0, telefono='".$riga[3]."' WHERE id_archive=$riga[0] ;";
	// }
	// foreach ($sql as $s)
	// 	echo "<br>".$s;
	//
	// exit;
	?>
</div> -->

<div class='section__content section__content--p30'>
	<div class='container-fluid'>
		<div class="row">
			<div class="col-lg-12">
				<div class="au-card au-card--no-shadow au-card--no-pad m-b-40 bg-overlay--semitransparent">
					<div class="card-header ">
						<i class="fa fa-inbox"></i>
						<span class="card-title">Ordini presi in carico</span>
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
								//'htmlOptions' => array('class' => 'table table-wallet'),
								//'id'=>'incarico',
								'id'=>'consegne-grid-incarico',

							    'dataProvider'=>$dataProvider,
								//'filter'=>$model,
								'columns' => array(
									// array(
									//  'name'=>'Operatore',
 									//  'type'=>'raw',
									//  'value'=>'Users::model()->findByPk($data->id_volontario)->email',
									//  'visible' => $visible,
									//
									// ),
									// array(
									//
									// ),

									array(
										'name'=>'id_archive',
										'value'=>'$data->id_archive',
										'htmlOptions'=>array('style'=>'text-align:center;width:60px;'),
									),
						 			array(
										'name'=>'data',
										'type'=>'raw',
										'value' => 'CHtml::link(date("d M Y",$data->data), Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive),"tag"=>2]) )',
										'htmlOptions'=>array('style'=>'text-align:center;'),
								  	),
									array(
										'name'=>'municipalita',
										'type'=>'raw',
										'value'=>'$data->municipalita',
										'htmlOptions'=>array('style'=>'text-align:center;'),
									),
									array(
										'name'=>'quartiere',
										'type'=>'raw',
										'value'=>'$data->quartiere',
										'htmlOptions'=>array('style'=>'text-align:center;'),
									),
									array(
										'name'=>'adulti',
										'header'=>'Qta',
										'type'=>'raw',
										'value'=>'"A:".$data->adulti." / N:".$data->bambini',
										'htmlOptions'=>array('style'=>'text-align:center;'),
									),
									array(
										 'name'=>'indirizzo',
										 'header'=>'Indirizzo',
										 'type'=>'raw',
										 'value'=> 'Yii::app()->controller->maskAddress($data->indirizzo." ".$data->civico,$data->id_archive,2)',
										 'htmlOptions'=>array('style'=>'text-align:center;'),
									),
									// array(
									// 	//'name' => '',
									// 	'value'=>'',
									// ),

								)
							));
							?>
						</div>
					</div>
					<div class="card-footer">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mediumModal">
							<i class="fa fa-print"></i> <?php echo Yii::t('lang','CREA BOLLA');?>
						</button>
					</div>
				</div>
			</div>

			<div class="col-lg-12">
				<div class="au-card au-card--no-shadow au-card--no-pad m-b-40 bg-overlay--semitransparent">
					<div class="card-header ">
						<i class="fa fa-truck"></i>
						<span class="card-title">Ordini in consegna</span>
					</div>
					<div class="card-body">
						<div class="table-responsive table--no-card">

							<?php
							$this->widget('ext.selgridview.SelGridView', array(
								'id'=>'consegne-grid-gestore',
								'selectableRows' => 2, // valori sono 0,1,2
								'dataProvider'=>$dataSpedite,
								'columns' => array(
									array(
									   'id'=>'consegneEffettuate',
									   'class'=>'CCheckBoxColumn',
									   'htmlOptions'=>array('style'=>'padding:0px 0px 0px 0px; margin:0px 0px 0px 0px;vertical-align:middle;'),
								  	),
									array(
										'name'=>'id_archive',
										'value'=>'$data->id_archive',
										'htmlOptions'=>array('style'=>'text-align:center;width:60px;'),
									),
									array(
										'name'=>Yii::t('lang','data'),
										'type'=>'raw',
										'value' => 'CHtml::link(date("d M Y",$data->data), Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive),"tag"=>1]) )',
										'htmlOptions'=>array('style'=>'text-align:center;'),
									),
									array(
										'name'=>'municipalita',
										//'header'=>'Qta',
										'type'=>'raw',
										'value'=>'$data->municipalita',
										'htmlOptions'=>array('style'=>'text-align:center;'),
									),
									array(
										'name'=>'quartiere',
										//'header'=>'Qta',
										'type'=>'raw',
										'value'=>'$data->quartiere',
										'htmlOptions'=>array('style'=>'text-align:center;'),
									),
									array(
										'name'=>'adulti',
										'header'=>'Qta',
										'type'=>'raw',
										'value'=>'"A:".$data->adulti." / N:".$data->bambini',
										'htmlOptions'=>array('style'=>'text-align:center;'),
									),

									array(
    									'name'=>'indirizzo',
    									'type'=>'raw',
    									'value'=> 'Yii::app()->controller->maskAddress($data->indirizzo." ".$data->civico,$data->id_archive,1)',
										'htmlOptions'=>array('style'=>'text-align:center;'),
    								),
								)
							));

							// $this->widget('zii.widgets.grid.CGridView', array(
							// 	//'htmlOptions' => array('class' => 'table table-wallet'),
							// 	//'id'=>'inconsegna',
							// 	'id'=>'consegne-grid-gestore',
							//     'dataProvider'=>$dataSpedite,
							// 	//'filter'=>$model,
							// 	'columns' => array(
							// 		array(
							// 			'name'=>'id_archive',
							// 			'value'=>'$data->id_archive',
							// 			'htmlOptions'=>array('style'=>'text-align:center;width:60px;'),
							// 		),
						 	// 		array(
							// 			'name'=>'data',
							// 			'type'=>'raw',
							// 			'value' => 'CHtml::link(date("d/M/Y",$data->data), Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive),"tag"=>1]) )',
							// 			'htmlOptions'=>array('style'=>'text-align:center;'),
							// 	  	),
							//
							// 		array(
							// 			'name'=>'municipalita',
							// 			'type'=>'raw',
							// 			'value'=>'$data->municipalita',
							// 			'htmlOptions'=>array('style'=>'text-align:center;'),
							// 		),
							// 		array(
							// 			'name'=>'quartiere',
							// 			'type'=>'raw',
							// 			'value'=>'$data->quartiere',
							// 			'htmlOptions'=>array('style'=>'text-align:center;'),
							// 		),
							// 		array(
							// 		'name'=>'adulti',
							// 		'header'=>'Qta',
							// 		'type'=>'raw',
							// 		'value'=>'"A:".$data->adulti." / N:".$data->bambini',
							// 		'htmlOptions'=>array('style'=>'text-align:center;'),
							// 	),
							// 		array(
							// 			 'name'=>'indirizzo',
							// 			 'header'=>'Indirizzo',
							// 			 'type'=>'raw',
							// 			 'value'=> 'Yii::app()->controller->maskAddress($data->indirizzo,$data->id_archive,1)',
							// 			 'htmlOptions'=>array('style'=>'text-align:center;'),
							// 		),
							// 		// array(
							// 		// 	//'name' => '',
							// 		// 	'value'=>'',
							// 		// ),
							//
							// 	)
							// ));
							?>
						</div>
					</div>
					<div class="card-footer">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#consegnaModal">
							<i class="fa fa-check"></i> <?php echo Yii::t('lang','Consegna tutti');?>
						</button>
						<button type="button" class="btn btn-info " data-toggle="modal" data-target="#consegnaAlcuniModal">
							<i class="fas fa-tasks"></i> <?php echo Yii::t('lang','Consegna selezionati');?>
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
				<h5 class="modal-title" id="mediumModalLabel">Stampa Bolla di consegna</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Tutte le richieste prese in carico verranno messe in consegna. Vuoi proseguire?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
				<button type="button" class="btn btn-danger printPdf">Conferma</button>
			</div>
		</div>
	</div>
</div>
<!-- consegna tutti -->
<div class="modal fade" id="consegnaModal" tabindex="-1" role="dialog" aria-labelledby="consegnaModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="consegnaModalLabel">Consegna ordini</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Sono stati consegnati tutti gli ordini della lista?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" style="min-width:70px;">No</button>
				<a href="<?php echo $consegnaURL;?>" tar get="_blank">
					<button type="button" class="btn btn-primary" style="min-width:70px;">Si</button>
				</a>
			</div>
		</div>
	</div>
</div>
<!-- consegna selezionati -->
<div class="modal fade" id="consegnaAlcuniModal" tabindex="-1" role="dialog" aria-labelledby="consegnaAlcuniModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg " role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="consegnaAlcuniModalLabel">Consegna ordini selezionati</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Sono stati consegnati gli ordini selezionti della lista?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" style="min-width:70px;">No</button>
				<?php echo CHtml::submitButton(Yii::t('lang','Si'), array('class' => 'btn btn-primary','style'=>'min-width:70px;')); ?>
			</div>
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
