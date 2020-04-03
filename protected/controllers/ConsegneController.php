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
					'delivery', // elemento consegnato
					'checkCF',	// verifica presenza del CODICE FISCALE entro i 7 giorni
					'assign',	// assegna a se stessi la chiamata
					'restituisci', // restituisci la consegna nel calderone
					'export', 	// esporta la lista delle consegne in formato xls
					'print', 	// stampa la lista di consegna dei pacchi
					'tutti', 	// considera consegnati tutti i pacchi nello stato 2 (in consegna)
					//'delete'
				),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionPrint()
	{
		//carico i SETTINGS della WebApp
		$settingsWebApp = Settings::load();

		//carico l'estensione pdf
		Yii::import('application.extensions.MYPDF.*');

		// create new PDF document
		$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(Yii::app()->params['adminName']);
		$pdf->SetAuthor(Yii::app()->params['shortName']);
		$pdf->SetTitle("Lista di consegna");
		$pdf->SetSubject('Lista di consegna');

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

		$pdf->SetHeaderData(
			Yii::app()->basePath.'../../'.Yii::app()->params['logoAssociazionePrint'],
			21,
			date('d M Y - H:i',time()),
			"\r\nID Volontario: ".Yii::app()->user->objUser['id_user']
		);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(10, PDF_MARGIN_TOP, 10);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}
		// ---------------------------------------------------------

		// inizializzo i criteri di ricerca
		$criteria=new CDbCriteria();
		$criteria->compare('id_volontario',Yii::app()->user->objUser['id_user'],false);
		$criteria->compare('consegnato',0,false);

		// carico la lista delle transazioni bitcoin
		$dataProvider=new CActiveDataProvider('Consegne', array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>array(
					'id_archive'=>false,
				)
			),
		));

		$iterator = new CDataProviderIterator($dataProvider);
		$x = 0;
		foreach($iterator as $data) {
			$loadData[$x][] = $data->id_archive;
			$loadData[$x][] = $data->cognome . " " . $data->nome;
			$loadData[$x][] = $data->telefono;
			$loadData[$x][] = $data->indirizzo;
			$loadData[$x][] = $data->note;

			// mentre preparo il pdf aggiorno lo stato della consegna a 2
			$consegna = $this->loadModel($data->id_archive);
			$consegna->in_consegna = 2;
			$consegna->update();

			$x++;
		}

		if (!isset($loadData)){
			echo "No data found!";
			die();
		}

		$header['head'] = array('Codice', 'Nome', 'Tel.', 'Indirizzo');
		$header['title'] = 'CONSEGNE PRONTE';

		// print colored table
		$pdf->ColoredTable($header, $loadData);
		// reset pointer to the last page
		$pdf->lastPage();

		//Close and output PDF document
		ob_end_clean();

		//Close and output PDF document
		$pdf->Output('listadiconsegna.pdf', 'I');
	}

	public function actionAssign($id){
		$consegna = $this->loadModel(crypt::Decrypt($id));
		$consegna->id_volontario = Yii::app()->user->objUser['id_user'];
		$consegna->in_consegna = 1;
		$consegna->time_inconsegna = time();
		$consegna->update();
		$this->redirect(array('index'));
	}

	public function actionRestituisci($id){
		$consegna = $this->loadModel(crypt::Decrypt($id));
		$consegna->id_volontario = 0;
		$consegna->in_consegna = 0;
		$consegna->time_inconsegna = 0;
		$consegna->update();
		$this->redirect(array('index'));
	}

	public function actionCheckCF(){
		$criteria = new CDbCriteria();
		$criteria->compare('codfisc',strtoupper($_POST['codfisc']),false);

		$tmp = explode("/",$_POST['data']);
		$time = strtotime($tmp[2].'-'.$tmp[1].'-'.$tmp[0]);
		$settimana = 60 * 60 * 24 * 7;
		$limite = $time - $settimana;

		$criteria->addCondition('data > '.$limite);
		$dataProvider=new CActiveDataProvider('Consegne', array(
				'criteria'=>$criteria,
		));

		$totaleCodici = $dataProvider->totalItemCount;
		if ($totaleCodici >0 ){
			$result = true;
		}else{
			$result = false;
		}
		echo CJSON::encode(['success'=>$result],true);
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

			$tmp = explode("/",$model->data);
			$model->data = strtotime($tmp[2].'-'.$tmp[1].'-'.$tmp[0]);
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
			}
			$this->redirect(array('index'));
		}

		$model=new Consegne('search');
		$model->unsetAttributes();

		if(isset($_GET['Consegne']))
			$model->attributes=$_GET['Consegne'];

		$this->render('select',array(
			'model'=>$model,
		));

		// $criteria = new CDbCriteria();
		// $criteria->compare('id_volontario',0,false);
		//
		// $dataProvider=new CActiveDataProvider('Consegne', array(
		// 	'sort'=>array(
	  //   		'defaultOrder'=>array(
	  //     			'data'=>false // viene prima la più recente
	  //   		)
	  // 		),
		//     'criteria'=>$criteria,
		// 		'pagination' => array(
		// 			'pageSize' => 20,
		// 			),
		// ));
		// $this->render('select',array(
		// 	'dataProvider'=>$dataProvider,
		// ));
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
		$consegna->in_consegna = 3;
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
	 * esporta in un foglio excel l'archivio consegne
 	 */
 	public function actionExport()
	{

		$dataProvider=new CActiveDataProvider('Consegne', array(
			'sort'=>array(
	    		'defaultOrder'=>array(
	      			'id_archive'=>false
	    		)
	  		),
		));

		$Creator = Yii::app()->params['nomeAssociazione'];
		$LastModifiedBy = "Sergio Casizzone";
		$Title = "Office 2007 XLSX Test Document";
		$Subject = "Office 2007 XLSX Test Document";
		$Description = "Estrazione dati per Office 2007 XLSX, generated using PHP classes.";
		$Keywords = "office 2007 openxml php";
		$Category = "export";

		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		// Set document properties
		$objPHPExcel->getProperties()->setCreator($Creator)
									 ->setLastModifiedBy($LastModifiedBy)
									 ->setTitle($Title)
									 ->setSubject($Subject)
									 ->setDescription($Description)
									 ->setKeywords($Keywords)
									 ->setCategory($Category);

		// Add header
		$colonne = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q');
		$intestazione = array(
			"ID",
			"Data Inserimento",
			"ID User che inserisce",
			"Codice Fiscale",
			"Nome",
			"Cognome",
			"Telefono",
			"Adulti",
			"Neonati",
			"Indirizzo",
			"Alert se < 7gg",
			"ID Volontario in consegna",
			"Pacco in consegna",
			"Data presa in carico",
			"Consegnato",
			"Data consegna",
			"Note"
		);

		foreach ($colonne as $n => $l){
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue($l.'1', $intestazione[$n]);
		}
		$transactions = new CDataProviderIterator($dataProvider);
		$riga = 2;
		$Rows = 1; //$transactions->totalItemCount;

		foreach($transactions as $item) {
			// Miscellaneous glyphs, UTF-8
			$objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A'.$riga, $item->id_archive)
			            ->setCellValue('B'.$riga, date("d/m/Y",$item->data))
						->setCellValue('C'.$riga, $item->id_user)
						->setCellValue('D'.$riga, $item->codfisc)
						->setCellValue('E'.$riga, $item->nome)
						->setCellValue('F'.$riga, $item->cognome)
						->setCellValue('G'.$riga, $item->telefono)
						->setCellValue('H'.$riga, $item->adulti)
						->setCellValue('I'.$riga, $item->bambini)
						->setCellValue('J'.$riga, $item->indirizzo)
						->setCellValue('K'.$riga, $item->trigger_alert)
						->setCellValue('L'.$riga, $item->id_volontario)
						->setCellValue('M'.$riga, $item->in_consegna)
						->setCellValue('N'.$riga, ($item->time_inconsegna == 0) ? '' : date("d/m/Y H:i:s",$item->time_inconsegna))
						->setCellValue('O'.$riga, $item->consegnato)
						->setCellValue('P'.$riga, ($item->time_consegnato == 0) ? '' : date("d/m/Y H:i:s",$item->time_consegnato))
						->setCellValue('Q'.$riga, $item->note);

			$riga++;
			$Rows++;
		}

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('export');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		// Redirect output to a client’s web browser (Excel5)
		$time = time();
		$date = date('Y/m/d H:i:s', $time);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$date.'-export.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		// inizializzo i criteri di ricerca
		$criteria=new CDbCriteria();
		// se è loggato il Volontario, questo filtro viene utilizzato
		//if (Yii::app()->user->objUser['privilegi'] == 0)
		$criteria->compare('id_volontario',Yii::app()->user->objUser['id_user'],false);
		$criteria->compare('in_consegna',1,false);

		// carico la lista delle consegne
		$dataProvider=new CActiveDataProvider('Consegne', array(
			'criteria'=>$criteria,
		));

		$criteria2=new CDbCriteria();
		// se è loggato il Volontario, questo filtro viene utilizzato
		//if (Yii::app()->user->objUser['privilegi'] == 0)
		$criteria2->compare('id_volontario',Yii::app()->user->objUser['id_user'],false);
		$criteria2->compare('in_consegna',2,false);
		// carico la lista delle consegne
		$dataSpedite=new CActiveDataProvider('Consegne', array(
			'criteria'=>$criteria2,
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'dataSpedite'=>$dataSpedite,
		));
	}

	public function actionTutti(){
		$criteria2=new CDbCriteria();
		$criteria2->compare('id_volontario',Yii::app()->user->objUser['id_user'],false);
		$criteria2->compare('in_consegna',2,false);
		// carico la lista delle consegne
		$dataProvider=new CActiveDataProvider('Consegne', array(
			'criteria'=>$criteria2,
		));

		$iterator = new CDataProviderIterator($dataProvider);

		foreach($iterator as $item) {
			$consegna = $this->loadModel($item->id_archive);
			$consegna->consegnato = 1;
			$consegna->time_consegnato = time();
			$consegna->in_consegna = 3;
			$consegna->update();
		}
		$this->redirect(array('index'));
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
