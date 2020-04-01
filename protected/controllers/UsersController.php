<?php

class UsersController extends Controller
{
	public function init()
	{
		if (isset(Yii::app()->user->objUser) && Yii::app()->user->objUser['facade'] != 'dashboard'){
			Yii::app()->user->logout();
			$this->redirect(Yii::app()->homeUrl);
		}
	}
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
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
					'index', // mostra elenco soci
					'view', //visualizza dettagli socio
					'create', //crea manualmente un socio
					'update', //modifica socio
					'disable', //disattiva socio
				),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel(crypt::Decrypt($id)),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Users;
		// echo "<pre>".print_r($_POST,true)."</pre>";
		// exit;

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			// echo "<pre>".print_r($model->attributes,true)."</pre>";
			// exit;

			// issue #41
			// Quando creo utenti con carica Presidente, Vice Presidente, Tesoriere, Segretario, questi devono
			// essere Amministratori, inoltre non possono essere commercianti.
			// quindi:

			if ($model->id_carica <=4)
				$model->id_users_type = 3; // AMMINISTRATORE
			else{
				$model->id_users_type = 5; // (SOCIO)
			}


			$savedModel = $_POST['Users'];
			$savedPassword = $model->password;
			$model->password = CPasswordHelper::hashPassword($model->password);

			//if ($_POST['Users']['send_mail'] == 1){
				$model->activation_code = md5($model->password);
			//	$model->status_activation_code = 0;
			//}else{
				//l'utente nasce già attivo se non c'è il flag alla mail
			//	$model->activation_code = 0;
				$model->status_activation_code = 0;
			//}
			//echo "<pre>".print_r($_POST,true)."</pre>";
			// echo "<pre>".print_r($model->attributes,true)."</pre>";
			// exit;

			if($model->save()){
				if ($_POST['Users']['send_mail'] == 1){
					NMail::SendMail('users',crypt::Encrypt($model->id_user),$model->email,$savedPassword,$model->activation_code);
				}
				$this->redirect(array('view','id'=>crypt::Encrypt($model->id_user)));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			//'userSettings'=>$userSettings,
		));
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel(crypt::Decrypt($id));
		#echo "<pre>".print_r($_POST,true)."</pre>";
		#exit;

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];

			if($model->save()){
				$this->redirect(array('view','id'=>crypt::Encrypt($model->id_user)));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}




	/**
	 * Mostra gli utenti approvati e slo quelli ATTVI, cioè che hanno un pagamento valido!
	 */
	public function actionIndex()
	{
		// carico la lista delle transazioni bitcoin
		$dataProvider=new CActiveDataProvider('Users', array(
				//'criteria'=>$criteria,
		));


		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


}
