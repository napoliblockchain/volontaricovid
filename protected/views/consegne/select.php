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
						<span class="card-title"><?php echo Yii::t('lang','Consegne');?></span>
					</div>
					<div class="card-body">
						<div class="table-responsive table--no-card ">
							<?php
							$this->widget('ext.selgridview.SelGridView', array(
								'id'=>'consegne-grid',
								'selectableRows' => 2, // valori sono 0,1,2
								//'hideHeader' => true,
								// 'htmlOptions' => array('class' => 'table table-borderless  table-data4 table-wallet ',
								// 						'style' => 'border: 0px;'
								// 					),
								// 'htmlOptions' => array('class' => 'table table-borderless  table-data4 table-wallet'),
								'htmlOptions' => array('class' => 'table table-wallet'),
							    'dataProvider'=>$dataProvider,
								// 'pager'=>array(
								// 	//'header'=>'Go to page:',
								// 	//'cssFile'=>Yii::app()->theme->baseUrl
								// 	'cssFile'=>Yii::app()->request->baseUrl."/css/yiipager.css",
								// 	'prevPageLabel'=>'<',
								// 	'nextPageLabel'=>'>',
								// 	'firstPageLabel'=>'<<',
								// 	'lastPageLabel'=>'>>',
								// ),
								'columns' => array(
									array(
									   'id'=>'consegneSelezionate',
									   'class'=>'CCheckBoxColumn',
									   'htmlOptions'=>array('style'=>'padding:0px 0px 0px 0px; margin:0px 0px 0px 0px;vertical-align:middle;'),
								    ),
									array(
										'name'=>Yii::t('lang','Data'),
										'type'=>'raw',
										'value' => 'CHtml::link(date("d/M/Y",$data->data), Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive)]) )',
										'htmlOptions'=>array('style'=>'vertical-align:middle;'),
									),




									array(
							            'name'=>'Cognome',
										'type' => 'raw',
										'value'=>'CHtml::link($data->cognome,Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive)]) )',
										'htmlOptions'=>array('style'=>'vertical-align:middle;'),
							        ),

                      array(
    							       'name'=>'Nome',
    									   'type' => 'raw',
    										'value'=>'CHtml::link($data->nome,Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive)]) )',
    										'htmlOptions'=>array('style'=>'vertical-align:middle;'),

    							        ),
                      array(
    										 'name'=>'Indirizzo',
    										 'type'=>'raw',
    										 'value'=>'CHtml::link($data->indirizzo,Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive),"tag"=>1]) )',
    									),
                      array(
                         'name'=>'Codice Fiscale',
                         'type' => 'raw',
                        'value'=>'CHtml::link($data->codfisc,Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive)]) )',
                        'htmlOptions'=>array('style'=>'vertical-align:middle;'),

                          ),


								)
							));
							?>

						</div>

					</div>
					<div class="card-footer">
						<?php if ($dataProvider->totalItemCount >0) { ?>
						<div class="form-group">
							<?php echo CHtml::submitButton(Yii::t('lang','Seleziona consegne'), array('class' => 'btn btn-primary ')); ?>
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
