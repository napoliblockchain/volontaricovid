<div class="form">
<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'manage-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
));

// genero array
$listaQuartieri = CHtml::listData(Quartieri::model()->findAll(array('order'=>'descrizione ASC')), 'descrizione', 'descrizione');
$listaQuartieri[''] = '';
asort($listaQuartieri);

$listaMun = [
	'' => '',
	1 => 1,
	2 => 2,
	3 => 3,
	4 => 4,
	5 => 5,
	6 => 6,
	7 => 7,
	8 => 8,
	9 => 9,
	10 =>10
];


$listaDate = Yii::app()->controller->setDateArray(time());

$activeButton = [
    0 => '',    // consegnati
    1 => '',    // in consegna
    2 => '',    // in carico
    3 => '',    // tutti
];


$activeButton[0] = 'active';

$get = 0;
if (isset($_GET['typelist'])){
	$get = $_GET['typelist'];
	$activeButton[$get] = 'active';
}


$tag = [
	0 => 3,
	1 => 1,
	2 => 2,
	3 => 0
];

$url = Yii::app()->createUrl('consegne/select');

$myList = <<<JS
    lista = {
		cambia: function(){
			var data = $('#Consegne_data').val();
			var quartiere = $('#Consegne_quartiere').val();
			var municipalita = $('#Consegne_municipalita').val();

			var url = '{$url}' + "&Consegne[data]="+data+"&Consegne[quartiere]="+quartiere+"&Consegne[municipalita]="+municipalita;
			window.location.href = url;
	}

JS;

Yii::app()->clientScript->registerScript('myList', $myList);
?>

<div class='section__content section__content--p30'>
	<div class='container-fluid container-wallet'>
		<div class="row">
			<div class="col-lg-12">
				<div class="au-card au-card--no-shadow au-card--no-pad m-b-40 bg-ove rlay--semitransparent">
					<div class="card-header ">
						<i class="fa fa-truck"></i>
						<span class="card-title"><?php echo Yii::t('lang','Presa in carico ordini');?></span>
					</div>
					<div class="card-body">
						<div class="row form-group ">
							<div class="col col-sm-4">
								<?php echo $form->labelEx($model,'Data'); ?>
								<?php echo $form->dropDownList($model,'data',$listaDate,array('class'=>'form-control-sm','onchange'=>'lista.cambia();'));	?>
							</div>
							<div class="col col-sm-4">
								<?php echo $form->labelEx($model,'Municipalit&agrave;'); ?>
								<?php echo $form->dropDownList($model,'municipalita',$listaMun,array('class'=>'form-control-sm','onchange'=>'lista.cambia();'));	?>
							</div>
							<div class="col col-sm-4">
								<?php echo $form->labelEx($model,'Quartiere'); ?>
								<?php echo $form->dropDownList($model,'quartiere',$listaQuartieri,array('class'=>'form-control-sm','onchange'=>'lista.cambia();'));	?>
							</div>
						</div>
						<div class="table-responsive table--no-card ">
							<?php
							$this->widget('ext.selgridview.SelGridView', array(
								'id'=>'consegne-grid-gestore',
								'selectableRows' => 2, // valori sono 0,1,2
								'dataProvider'=>$model->search(),
								'columns' => array(
									array(
									   'id'=>'consegneSelezionate',
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
										'value' => 'CHtml::link(date("d M Y",$data->data), Yii::app()->createUrl("consegne/view",["id"=>crypt::Encrypt($data->id_archive),"tag"=>'.$tag[$get].']) )',
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
    									'value'=> 'Yii::app()->controller->maskAddress($data->indirizzo,$data->id_archive,1)',
										'htmlOptions'=>array('style'=>'text-align:center;'),
    								),
								)
							));
							?>

						</div>

					</div>
					<div class="card-footer">
						<?php if ($model->search()->totalItemCount >0) { ?>
						<div class="form-group">
							<?php echo CHtml::submitButton(Yii::t('lang','Prendi in carico'), array('class' => 'btn btn-primary')); ?>
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
