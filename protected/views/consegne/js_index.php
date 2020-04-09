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
		setTimeout(function(){
			window.location.href = window.location.href;
		}, 1500);

	});


JS;
Yii::app()->clientScript->registerScript('myList', $myList, CClientScript::POS_END);
?>
