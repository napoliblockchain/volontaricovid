<?php
/* @var $this MerchantsController */
/* @var $dataProvider CActiveDataProvider */
?>

<div class='section__content section__content--p30'>
	<div class='container-fluid'>
		<div class="row">
			<div class="col-lg-12">
				<div class="au-card au-card--no-shadow au-card--no-pad m-b-40 bg-overlay--semitransparent">
					<div class="card-header ">
						<i class="fas fa-list"></i>
						<span class="card-title">Lista Consegne</span>
						<div class="float-right">
							<?php $actionURL = Yii::app()->createUrl('consegne/create'); ?>
							<a href="<?php echo $actionURL;?>">
								<button class="btn alert-primary text-light img-cir" style="padding:2.5px; width:30px; height:30px;">
									<i class="fa fa-plus"></i></button>
							</a>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive table--no-card m-b-40">

							<?php $this->widget('zii.widgets.grid.CGridView', array(
								'htmlOptions' => array('class' => 'table table-wallet'),
							    'dataProvider'=>$dataProvider,
								'columns' => array(
									// ),
						 		array(
										 'name'=>'Data',
										 'type'=>'raw',
							 		 'value'=> 'WebApp::data_it($data->data)',
								  ),
									array(
									   'name'=>'Codice Fiscale',
									   'type'=>'raw',
									   'value' => '$data->codfisc',
									),
									// array(
							    //    'name'=>'Indirizzo',
									// 	'type'=>'raw',
									// 	'value' => '$data->indirizzo',
							    //      ),
									 array(
									   'name'=>'',
									   'value' => '',
									),
								)
							));
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo Logo::footer(); ?>
	</div>
</div>
