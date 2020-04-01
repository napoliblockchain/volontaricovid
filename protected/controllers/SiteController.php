<?php
class SiteController extends Controller
{
	public function init()
	{

	}

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(
					'index', //pagina iniziale: fa il redirect a login
					'login', //pagina di login
					'logout', //si scollega dall'applicazione e redirect a login

				),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(
					'dash', // pagina dashboard dopo aver effettuato il login
				),
				'users'=>array('@'),
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->redirect(array('site/login'));
	}

	public function actionDash()
	{
		// se sei guest vai a login
		if (Yii::app()->user->isGuest){
			Yii::app()->user->logout();
			$this->redirect(array('site/index'));
		}
		// se non è impostata la variabile objUser vai a login
		if (!(isset(Yii::app()->user->objUser))) {
			Yii::app()->user->logout();
			$this->redirect(array('site/index'));
		}else{
			$this->redirect(array('consegne/index'));
		}

		// // inizializzo i criteri di ricerca
		// $criteria=new CDbCriteria();
		// $criteria->compare('id_user',Yii::app()->user->objUser['id_user'],false);
		//
		// // carico la lista delle transazioni bitcoin
		// $dataProvider=new CActiveDataProvider('Consegne', array(
		// 		'criteria'=>$criteria,
		// ));
		//
		// $this->render('index',array(
		// 	'dataProvider'=>$dataProvider,
		// ));
	}


	/**
	* Displays the login page
	*/
	public function actionLogin()
	{
		$model=new LoginForm;
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			$model->reCaptcha=$_POST['reCaptcha'];

			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(array('site/dash')); // per correggere errore con pwa che non fa il redirect dopo il login
		}

		if (!isset(Yii::app()->user->objUser)){
			$this->layout='//layouts/column_login';
			$this->render('login',array('model'=>$model)); // display the login form if not connected or validated user
		}else {
			$this->redirect(array('site/dash'));
		}
	}


	/**
	* Logs out the current user and redirect to homepage.
	*/
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(array('site/index'));
	}

}
