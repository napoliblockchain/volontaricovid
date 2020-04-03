<?php
/* @var $this MerchantsController */
/* @var $dataProvider CActiveDataProvider */
$actionURL = Yii::app()->createUrl('consegne/select');
$printURL = Yii::app()->createUrl('consegne/print');
?>

<div class='section__content section__content--p30'>
	<div class='container-fluid'>
		<div class="row">
			<div class="col-lg-12">
				<div class="au-card au-card--no-shadow au-card--no-pad m-b-40 bg-overlay--semitransparent">
					<div class="card-header ">
						<i class="fas fa-list"></i>
						<span class="card-title">Lista Pacchi in Consegna</span>
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
							    'dataProvider'=>$dataProvider,
								'columns' => array(
						 		array(
									 'name'=>'Data',
									 'type'=>'raw',
									 'value' => 'CHtml::link(date("d/M/Y",$data->data), Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive),"tag"=>1]) )',
								  ),

									array(
									   'name'=>'Cognome',
									   'type'=>'raw',
									   'value'=>'CHtml::link($data->cognome,Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive),"tag"=>1]) )',
									),
									array(
										 'name'=>'Nome',
										 'type'=>'raw',
										 'value'=>'CHtml::link($data->nome,Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive),"tag"=>1]) )',
									),
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
						<a href="<?php echo $printURL;?>" target="_blank">
							<button type="button" class="btn btn-primary">Stampa lista di consegna</button>
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php echo Logo::footer(); ?>
	</div>
</div>
