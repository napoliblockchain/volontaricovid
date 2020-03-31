<?php
$nomeApplicazione = 'Distribuzione Aiuti Alimentari';
$shortName = 'DALI';

//Associazione
$nomeAssociazione = 'Napoli Blockchain ETS';
$logoAssociazione = '/css/images/logonapay.png';
$logoAssociazionePrint = '/css/images/anb-trasparente-single2.png';
$ibanAssociazione = 'xx xx x xxxxx xxxxx xxxxxxxxxxxxxxxxx';

$logoApplicazione = '/css/images/napay-yellow.png';

$timeOutSeconds = 3600*24*30; // 1 mese

//configurazione email
$adminSiteweb = 'napoliblockchain.it';
$adminEmail = 'info@napoliblockchain.it';
$pwdEmail = 'naCPSTT18';
$dominioEmail = 'https://webmail.register.it';
$adminName = 'Napoli Blockchain ';
$adminIndirizzo = "Piazza Municipio, 1\n80100 - Napoli\nP.Iva: 011233455667";

///
//IVA AL 22%
$vat = '22';

//explorer btc ed eth
$blockchainCheck = 'https://blockchair.com/search?q=';


// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

$libsPath = dirname(__FILE__).DIRECTORY_SEPARATOR.'../../../libs/';

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>$nomeApplicazione,
	'language' => 'it', // Specifies which language the application is targeted to
    'sourceLanguage' => 'it_IT', //Specifies which language that the application is written in

	//IMPOSTA IL TEMA
	//'theme'=>'mobile',

	// preloading 'log' component
		'preload'=>array('log','bootstrap','jsTrans'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.yii-mail.YiiMailMessage',
	),


	'modules'=>array(
		// uncomment the following to enable the Gii tool

		// 'gii'=>array(
		//
		// 	'generatorPaths'=>array(
		// 		'bootstrap.gii',
		// 	),
		// 	'class'=>'system.gii.GiiModule',
		// 	'password'=>'pippo',
		// 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
		// 	 'ipFilters'=>array('127.0.0.1','::1'),
		// 	'ipFilters' => array($_SERVER['REMOTE_ADDR'],'::1'),
		// 	//'ipFilters'=>false,
		//
		// ),

	),


	// application components
	'components'=>array(
		'session' => array(
			 'autoStart'=>true,
		),
		'jsTrans'=>array(  // abilita la traduzione per javascript
			'class'=>'ext.JsTrans.JsTrans',
			'categories'=>array('js'), // the categories to be made available
			'languages'=>array('it'), // the languages to be made available
			//'onMissingTranslation'=>array('site/missingTranslation'), // optional route to handle untranslated messages
		),
		'bootstrap'=>array(
				'class'=>'bootstrap.components.Bootstrap',
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// SEND EMAIL EXTENSION
		'mail' => array(
					'class' => 'ext.yii-mail.YiiMail',
					'transportType'=>'smtp',
					'transportOptions'=>array(

							'host'=>'authsmtp.securemail.pro',
							'username'=>'info@napoliblockchain.it',
							'password'=>'',
							'port'=>'465',
							'encryption'=>'ssl',

					),
					'viewPath' => 'application.views.mail',
					'logging' => true,
        			'dryRun' => false,
		),
		//SSH LIBRARY
		'phpseclib' => array(
      		'class' => 'ext.phpseclib.PhpSecLib'
    	),


		// MIE CLASSI
		'webRequest'=>require($libsPath.'/webRequest/webRequest.php'),
		'BTCPay'=>require($libsPath.'/BTCPay/BTCPayWebRequest.php'),
		'crypt'=>require($libsPath.'/crypt/crypt.php'),
		'Utils'=>require($libsPath.'/Utils/Utils.php'),
		'NAPay'=>require($libsPath.'/NAPay/Autoloader.php'),
		// funzioni di napay
		// 'WebApp'=>require(dirname(__FILE__).'../../extensions/WebApp.php'),
		'NMail'=>require(dirname(__FILE__).'../../extensions/NMail.php'),

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>YII_DEBUG ? null : 'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		'libsPath'=>$libsPath,
		// this is used in contact page
		'adminSiteweb'=>$adminSiteweb,
		'adminEmail'=>$adminEmail,
		'adminName'=>$adminName,
		'indirizzo'=>$adminIndirizzo,
		'website'=>'https://napoliblockchain.it', // per il link sul logo

		'ibanAssociazione'=>$ibanAssociazione,
		'nomeAssociazione'=>$nomeAssociazione,
		'logoAssociazione'=>$logoAssociazione,
		'logoAssociazionePrint'=>$logoAssociazionePrint,
		'logoApplicazione'=>$logoApplicazione,

		'timeOutSeconds'=>$timeOutSeconds,
		'shortName'=>$shortName,
		'blockchainCheck'=>$blockchainCheck,
		//
		'vat'=>$vat,
	),

);
