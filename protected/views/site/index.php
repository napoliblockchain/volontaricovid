<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;

if (Yii::app()->user->objUser['privilegi'] >5 ){
	if (Yii::app()->user->objUser['privilegi'] != 20 ){
		if (count($stores) >0){
			if (count($pos)>0){
				$this->renderPartial('_dashboard',array(
					'dataProvider'=>$dataProvider,
					'dataProviderTokens'=>$dataProviderTokens,
					'warningmessage'=>$warningmessage,
				));
			}else{
				$this->renderPartial('_dashboard-nopos');
			}
		}else{
			$this->renderPartial('_dashboard-nostores');
		}
	}else{
		$this->renderPartial('_dashboard',array(
			'dataProvider'=>$dataProvider,
			'dataProviderTokens'=>$dataProviderTokens,
			'warningmessage'=>$warningmessage,
		));
	}
}else{
	$this->renderPartial('_dashboard-minimal');
}

?>
