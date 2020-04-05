<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;


		$this->renderPartial('_dashboard',array(
			'dataProvider'=>$dataProvider,
		));

?>
