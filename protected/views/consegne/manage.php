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

$url = Yii::app()->createUrl('consegne/manage');

$myList = <<<JS
    lista = {
		cambia: function(val){
            var url = '{$url}' + "&typelist="+val;

           lista.btnClass(val);
           // AGGIORNA yiiGridView in ajax
           $.fn.yiiGridView.update('consegne-grid-gestore', {
               type: 'GET',
               url: url,
               success: function() {
                   $('#consegne-grid-gestore').yiiGridView('update',{
                       url: url
                   });
               }
           });
       },
       btnClass: function(val){
           $('.btn').removeClass("active");
           $('.btn-'+val).addClass("active");
       }
	}


JS;
Yii::app()->clientScript->registerScript('myList', $myList);

$activeButton = [
    0 => '',    // consegnati
    1 => '',    // in consegna
    2 => '',    // in carico
    3 => '',    // tutti

];


$activeButton[0] = 'active';

if (isset($_GET['typelist']))
    $activeButton[$_GET['typelist']] = 'active';


?>
<div class='section__content section__content--p30'>
	<div class='container-fluid container-wallet'>
		<div class="row">
			<div class="col-lg-12">
				<div class="au-card au-card--no-shadow au-card--no-pad m-b-40 bg-ove rlay--semitransparent">
					<div class="card-header ">
						<i class="fa fa-truck"></i>
						<span class="card-title"><?php echo Yii::t('lang','Gestione Consegne');?></span>
					</div>
					<div class="card-body">
						<span>
								<button title='Consegnati' type='button' class='btn-0 btn btn-outline-info btn-sm <?php echo $activeButton[0]; ?>' onclick='lista.cambia(0);'>Consegnati</button>
								<button title='In consegna' type='button' class='btn-1 btn btn-outline-info btn-sm <?php echo $activeButton[1]; ?>' onclick='lista.cambia(1);'>In consegna</button>
								<button title='In carico' type='button' class='btn-2 btn btn-outline-info btn-sm <?php echo $activeButton[2]; ?>' onclick='lista.cambia(2);'>In carico</button>
								<button title='Tutti' type='button' class='btn-3 btn btn-outline-info btn-sm <?php echo $activeButton[3]; ?>' onclick='lista.cambia(3);'>Tutti</button>
						</span>
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

				</div>
			</div>
		</div>
			<?php echo Logo::footer(); ?>
	</div>
</div>






<?php $this->endWidget(); ?>
</div><!-- form -->
