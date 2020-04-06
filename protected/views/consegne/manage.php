<div class="form">
<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'consegne-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
));


?>
<div class='section__content section__content--p30'>
	<div class='container-fluid container-wallet'>
		<div class="row">
			<div class="col-lg-12">
				<div class="au-card au-card--no-shadow au-card--no-pad m-b-40 bg-ove rlay--semitransparent">
					<div class="card-header ">
						<i class="zmdi zmdi-comment-text"></i>
						<span class="card-title"><?php echo Yii::t('lang','Gestione Consegne');?></span>
					</div>
					<div class="card-body">
						<div class="table-responsive table--no-card ">
							<?php
							$this->widget('ext.selgridview.SelGridView', array(
								'id'=>'consegne-grid-gestore',
								'selectableRows' => 0, // valori sono 0,1,2
								//'htmlOptions' => array('class' => 'table table-borderless table-data3'),
								'dataProvider'=>$model->search(),
	 							'filter'=>$model,
								'columns' => array(
									// array(
									//    'id'=>'consegneSelezionate',
									//    'class'=>'CCheckBoxColumn',
									//    'htmlOptions'=>array('style'=>'padding:0px 0px 0px 0px; margin:0px 0px 0px 0px;vertical-align:middle;'),
								  // ),
									array(
									 'name'=>'id_volontario',
									 'type'=>'raw',
									 'value'=>'($data->id_volontario <> 0 ) ? Users::model()->findByPk($data->id_volontario)->email : ""',
									 'filter' => CHtml::listData(Users::model()->findAll(array('order'=>'email ASC')), 'id_user', function($items) {
											return $items->email;
									 })

									),
									array(

										'name'=>Yii::t('lang','data'),
										'type'=>'raw',
										'value' => 'CHtml::link(date("d/M/Y",$data->data), Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive)]) )',
										'htmlOptions'=>array('style'=>'vertical-align:middle;'),
										'filter'=>false,
									),
									'quartiere',
									'municipalita',
									'indirizzo',
									'codfisc',
									'cognome',
									'nome',
                  // array(
    							// 	'name'=>'indirizzo',
    							// 	'type'=>'raw',
    							// 	'value'=>'CHtml::link($data->indirizzo,Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive),"tag"=>1]) )',
									// 	  'filter'=>$model->search(),
    							// ),
                  // array(
                  //   'name'=>'codfisc',
                  //   'type' => 'raw',
                  //   'value'=>'CHtml::link($data->codfisc,Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive)]) )',
                  //   'htmlOptions'=>array('style'=>'vertical-align:middle;'),
									// 	  'filter'=>true
                  // ),
									// array(
							    //   'name'=>'cognome',
									// 	'type' => 'raw',
									// 	'value'=>'CHtml::link($data->cognome,Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive)]) )',
									// 	'htmlOptions'=>array('style'=>'vertical-align:middle;'),
									// 	 'filter'=>true
							    // ),
                  // array(
							    // 	'name'=>'nome',
									//   'type' => 'raw',
									// 	'value'=>'CHtml::link($data->nome,Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive)]) )',
    							// 	'htmlOptions'=>array('style'=>'vertical-align:middle;'),
									// 	  'filter'=>true
					        // ),
								)
							));
							?>

						</div>

					</div>
					<div class="card-footer">
						<?php if ($model->search()->totalItemCount >0) { ?>
						<div class="form-group">
							<?php echo CHtml::submitButton(Yii::t('lang','Prendi in carico'), array('class' => 'btn btn-primary ')); ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
			<?php echo Logo::footer(); ?>
	</div>
</div>






<?php $this->endWidget(); ?>
</div><!-- form -->
