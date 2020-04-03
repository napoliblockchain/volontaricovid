<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Napoli Blockchain">
    <meta name="author" content="Napoli Blockchain">
    <meta name="keywords" content="Napoli Blockchain">

    <!-- Title Page-->
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Fontfaces CSS-->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/css/font-face.css" rel="stylesheet" media="all">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/css/theme.css" rel="stylesheet" media="all">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/glyphicon.css" rel="stylesheet" media="all" >
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/orologio.css" rel="stylesheet" media="all" >


    <!-- Bitcoin Real Time price CSS-->
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/BRTP.css'); ?>
    <!-- Keypad CSS-->
    <?php //Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/keypad.css'); ?>
    <!-- Numpad CSS-->
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/numpad/easy-numpad.css'); ?>

    <!-- Jquery JS-->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/jquery-3.2.1.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/chartjs/Chart.bundle.min.js"></script>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <center>
        <div class="log in-header">
            <div class="login-logo">
    			<?php Logo::header(); ?>
    		</div>
		</div>

        <!-- non includo il menù per permettere il logout -->
		<!-- <div style="float:left; left:5%;">
			<?php //include("menu_pos.php"); ?>
		</div> -->

        <center>


            <!-- MAIN CONTENT-->
            <div>
                <?php echo $content; ?>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->


    </div>



    <!-- Bootstrap JS-->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/bootstrap-4.1/bootstrap.min.js"></script>

    <!-- Vendor JS       -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/slick/slick.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/wow/wow.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/animsition/animsition.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/select2/select2.min.js"></script>

    <!-- Main JS-->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/js/main.js"></script>




<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/jquery/numpad/easy-numpad.js', CClientScript::POS_END);

//$BtcPayServerAddress = Yii::app()->params['BTCPayServerAddress'];
//indirizzo del serve btcpay server
//cerco indirizzo server BTCPAYSERVER
$settingsNapos=Settings::load();  //$settingsNapos = SettingsNapos::model()->findByPk(1);
$BtcPayServerAddress = $settingsNapos->BTCPayServerAddress;

//assegno valori del POS per l'invoice creation
$BtcPayServerNamePOS = Yii::app()->user->name;
$BtcPayServerIDPOS = Yii::app()->user->objUser['id_user'];
$pos=Pos::model()->findByPk($BtcPayServerIDPOS);
$idMerchant = $pos->id_merchant;

//$urlController = Yii::app()->createUrl('webpos/transaction');
$customer = Yii::app()->user->objUser['email'];


//RICERCA GATEWAY PER INVIARE COMANDI PERSONALIZZATI
$merchants=Merchants::model()->findByAttributes(array('id_merchant'=>$idMerchant));
//$settings=Settings::model()->findByAttributes(array('id_user'=>$merchants->id_user));
$settings=Settings::loadUser($merchants->id_user);
$gateways=Gateways::model()->findByPk($settings->id_gateway);
#exit;

//Adesso che ho caricato i gateways creo gli url redirect e ipnlogger su https. inutile http che nn funziona
$URLIpn = 'https://'.$_SERVER['HTTP_HOST'].Yii::app()->createUrl('ipn/'.$gateways->action_controller);

//nel redirect mi serve l'id invoice che dovrò poi verificare se il pagamento è stato effettuato ed
//inviare quindi la stampa. ma al momento posso solo creare il richiamo al controller...
//pertanto non lo invierò più da qui ma lo creo direttamente dencto il controller
//$URLRedirect = 'https://'.$_SERVER['HTTP_HOST'].Yii::app()->createUrl('webpos/keypad'); //TORNA ALLA PAGINA KEYPAD tramite il tasto di BtcPay Server


$urlController = Yii::app()->createUrl('webpos/'.$gateways->action_controller.'Invoice'); // controller che crea la transazione
$urlTokenController = Yii::app()->createUrl('webtoken/invoice'); // controller che crea la transazione per il token

//url per la stampa ricevuta
// $urlPrintPdf = Yii::app()->createUrl('webpos/printInvoice',array('id'=>$invoiceId,'action'=>$invoiceAction)); //


// CERCO L'INDIRIZZO DEL TOKEN. SE PRESENTE AUTORIZZO LA CREAZIONE DELL'INVOICE, ALTRIMENTI NISBA...
$tokenAuth = false;
$wallet_address = '';
$wallets=Wallets::model()->findByPk($settings->id_wallet);
if (null !== $wallets){
    $wallet_address = $wallets->wallet_address;
    $tokenAuth = true;
}

$myConfirmscript = <<<JS
    var ajax_loader_url = 'css/images/loading.gif';
    var tokenAuth = '{$tokenAuth}';

    $("button[id='token']").click(function(){
        event.preventDefault();
        if (tokenAuth == false){
            $('#bitpay-pairing__message').text('Non è possibile ricevere Token!');
            return false;
        }

		var amount_val = $('#easy-numpad-output').text();
		if (amount_val == 0 || amount_val == '')
			return false;

            $.ajax({
    			url:'{$urlTokenController}',
    			type: "POST",
    			beforeSend: function() {
    				$('#waiting_span-token').hide();
    				$('#waiting_span-token').after('<div class="waiting_span"><center><img width=25 src="'+ajax_loader_url+'"></center></div>');
       			},
    			data:{
                    'wallet_address': '{$wallet_address}',
    				'id_pos'		: '{$BtcPayServerIDPOS}',
    				'id_merchant'	: '{$idMerchant}',
    				'amount'		: amount_val,
    			    'email'			: '{$customer}',
    			},
    			dataType: "json",
    			success:function(data){
    				$('.waiting_span').remove();
    				$('#waiting_span-token').show();

    				if (data.error){
    					$('#bitpay-pairing__message').text(data.error);
    					return false;
    				}else{
                        window.location.href = data.url;
    				}
    			},
    			error: function(j){
            var json = jQuery.parseJSON(j.responseText);
    				$('#waiting_span-token').show();
    				$('.waiting_span').remove();
    				$('#bitpay-pairing__message').text(json.error);
    			}
    		});
    });


	$("button[id='done']").click(function(){
		event.preventDefault();
		var amount_val = $('#easy-numpad-output').text();
		if (amount_val == 0 || amount_val == '')
			return false;

		var rate = $('#ebc_price').html();
		$.ajax({
			url:'{$urlController}',
			type: "POST",
			beforeSend: function() {
				$('#waiting_span-btc').hide();
				$('#waiting_span-btc').after('<div class="waiting_span"><center><img width=25 src="'+ajax_loader_url+'"></center></div>');
   			},
			data:{
				'id_pos'		: '{$BtcPayServerIDPOS}',
				'id_merchant'	: '{$idMerchant}',
				'url'			: '{$BtcPayServerAddress}',
				'amount'		: amount_val,
			    'email'			: '{$customer}',
				'ipnUrl'		: '{$URLIpn}',
				'rate'			: rate,
			},
			dataType: "json",
			success:function(data){
				$('.waiting_span').remove();
				$('#waiting_span-btc').show();

				if (data.error){
					$('#bitpay-pairing__message').text(data.error);
					return false;
				}else{
					if ('{$gateways->action_controller}' != 'Bitpay')
						window.location.href = data.url;
					else
						top.location = data.url;
				}
			},
			error: function(j){
                var json = jQuery.parseJSON(j.responseText);
				$('#waiting_span-btc').show();
				$('.waiting_span').remove();
				$('#bitpay-pairing__message').text(json.error);
                //console.log(json.message);
			}
		});
	});

JS;

Yii::app()->clientScript->registerScript('myConfirmscript', $myConfirmscript);

?>

</body>
</html>
<!-- end document-->
