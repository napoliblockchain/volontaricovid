<?php

class ConsegneController extends Controller
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
			// array('allow',  // allow all users to perform 'index' and 'view' actions
			// 	'actions'=>array('index','view'),
			// 	'users'=>array('*'),
			// ),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(
					'index',  // elementi in carico al volontario e in fase di consegna
					'view',		// elemento da visualizzare
					'create', // elemento in fase di 1° inserimento
					'update', // elemento in fase di modifica
					'select', // elemento da selezionare per la consegna
					'delivery' // elemento consegnato
					//'delete'
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
		$model=new Consegne;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Consegne']))
		{
			$model->attributes=$_POST['Consegne'];
			//echo "<pre>".print_r($_POST,true)."</pre>";
				$tmp = explode("/",$model->data);
				$model->data = strtotime($tmp[2].'-'.$tmp[1].'-'.$tmp[0]);
				$model->trigger_alert = 0;
				$model->id_user = Yii::app()->user->objUser['id_user'];
				$model->codfisc = strtoupper($model->codfisc);
				$model->nome = strtoupper($model->nome);
				$model->cognome = strtoupper($model->cognome);
				$model->indirizzo = strtoupper($model->indirizzo);
				$model->note = strtoupper($model->note);

				// PRIMO INSERIMENTO
				$model->id_volontario = 0;
				$model->in_consegna = 0;
				$model->consegnato = 0;
				$model->time_inconsegna = 0;
				$model->time_consegnato = 0;


			 // echo "<pre>".print_r($model->attributes,true)."</pre>";
			 // exit;
			if($model->save())
					$this->redirect(array('view','id'=>crypt::Encrypt($model->id_archive)));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionSelect()
	{
		// echo "<pre>".print_r($_POST,true)."</pre>";
		// exit;
		if(isset($_POST['consegneSelezionate'])){
			foreach ($_POST['consegneSelezionate'] as $x => $id_consegna){
				// echo "<br>".$id_consegna;
				$consegna = Consegne::model()->findByPk($id_consegna);
				$consegna->id_volontario = Yii::app()->user->objUser['id_user'];
				$consegna->in_consegna = 1;
				$consegna->time_inconsegna = time();

				$consegna->update();

				// echo "<pre>".print_r($consegna->attributes,true)."</pre>";
			}
			// exit;
			$this->redirect(array('index'));

		}

		$criteria = new CDbCriteria();
		$criteria->compare('id_volontario',0,false);

		$dataProvider=new CActiveDataProvider('Consegne', array(
			'sort'=>array(
	    		'defaultOrder'=>array(
	      			'data'=>false // viene prima la più recente
	    		)
	  		),
		    'criteria'=>$criteria,
				'pagination' => array(
					'pageSize' => 20,
					),
		));
		$this->render('select',array(
			'dataProvider'=>$dataProvider,
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Consegne']))
		{
			$model->attributes=$_POST['Consegne'];
			$tmp = explode("/",$model->data);
			$model->data = strtotime($tmp[2].'-'.$tmp[1].'-'.$tmp[0]);
			$model->id_user = Yii::app()->user->objUser['id_user'];
			$model->codfisc = strtoupper($model->codfisc);
			$model->nome = strtoupper($model->nome);
			$model->cognome = strtoupper($model->cognome);
			$model->indirizzo = strtoupper($model->indirizzo);
			$model->note = strtoupper($model->note);

			if($model->save())
				$this->redirect(array('view','id'=>crypt::Encrypt($model->id_archive)));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelivery($id)
	{
		$consegna = $this->loadModel(crypt::Decrypt($id));

		$consegna->consegnato = 1;
		$consegna->time_consegnato = time();
		$consegna->update();

		$this->redirect(array('index'));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel(crypt::Decrypt($id))->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		// inizializzo i criteri di ricerca
		$criteria=new CDbCriteria();
		$criteria->compare('id_volontario',Yii::app()->user->objUser['id_user'],false);
		$criteria->compare('consegnato',0,false);

		// carico la lista delle transazioni bitcoin
		$dataProvider=new CActiveDataProvider('Consegne', array(
				'criteria'=>$criteria,
		));


		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Exchanges the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Consegne::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Consegne $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='consegne-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
