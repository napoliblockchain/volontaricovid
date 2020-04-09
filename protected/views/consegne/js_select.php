<?php
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
