<?php
class BackendController extends Controller
{

	public function init()
	{
		Yii::app()->language = ( isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'it' );
		Yii::app()->sourceLanguage = ( isset($_COOKIE['langSource']) ? $_COOKIE['langSource'] : 'it_it' );

		new JsTrans('js',Yii::app()->language); // javascript translation

		if (isset(Yii::app()->user->objUser) && Yii::app()->user->objUser['facade'] <> 'dashboard'){
			Yii::app()->user->logout();
			$this->redirect(Yii::app()->homeUrl);
		}
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(
					'index', // leggo e creo html per le consegne
				),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{

		$criteria = new CDbCriteria();

		if (Yii::app()->user->objUser['privilegi'] == 0)
			$criteria->compare('id_volontario',Yii::app()->user->objUser['id_user'],false);

		// carico la lista delle consegne
		$dataProvider=new CActiveDataProvider('Consegne', array(
			'criteria'=>$criteria,
		));

		$iterator = new CDataProviderIterator($dataProvider);
		$consegnati = 0;
		$inconsegna = 0;
		$incarico = 0;
		if (isset($iterator)){
			foreach($iterator as $item) {
				if ($item->consegnato == 1){
					$consegnati++;
					continue;
				}
				if ($item->in_consegna == 2){
					$inconsegna++;
					continue;
				}
				if ($item->in_consegna == 1){
					$incarico++;
					continue;
				}
			}
		}

		$response['consegnati'] = $consegnati;
		$response['inconsegna'] = $inconsegna;
		$response['incarico'] = $incarico;

		echo CJSON::encode($response,true);
	}
}
