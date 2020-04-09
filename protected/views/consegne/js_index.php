<?php
$printURL = Yii::app()->createUrl('consegne/print');

$myList = <<<JS
    var printPdf = document.querySelector('.printPdf');
	var closePrintPdf = document.querySelector('.closePrintPdf');

	printPdf.addEventListener('click', function(){
		var win = window.open('{$printURL}', '_blank');
		if (win) {
		    //Browser has allowed it to be opened
		    win.focus();
		}
		window.location.href = window.location.href;
	});


JS;
Yii::app()->clientScript->registerScript('myList', $myList, CClientScript::POS_END);
?>
