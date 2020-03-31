<?php
$this->widget('zii.widgets.CMenu', array(
		'encodeLabel' => false,
		//'htmlOptions' => array('class' => 'nav'),

		'items' => array(
			array(
				'label'=>'<span class="glyphicon glyphicon-log-out"></span>',
				'url'=>array('/site/logout'),
			),
		),
	));
?>
