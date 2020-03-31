<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Napoli Blockchain">
    <meta name="author" content="Napoli Blockchain">
    <meta name="keywords" content="Napoli Blockchain">

    <!-- Progressive Web App -->
    <link rel="manifest" href="<?php echo Yii::app()->request->baseUrl; ?>/manifest.json">

        <!-- iOS -->
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="<?php echo CHtml::encode($this->pageTitle); ?>">
        <link rel="apple-touch-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/src/images/icons/apple-icon-76x76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/src/images/icons/apple-icon-144x144.png" sizes="144x144">

        <!-- iExplorer -->
        <meta name="msapplication-TileImage" content="<?php echo Yii::app()->request->baseUrl; ?>/src/images/icons/apple-icon-144x144.png" sizes="144x144">
        <meta name="msapplication-TileColor" content="#fff">
        <meta name="theme-color" content="#3f51b5">

    <!-- Title Page-->
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/css/favicon.ico" type="image/x-icon" />

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

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" rel="stylesheet" media="all" >

    <!-- NEW CSS-->
    <!-- NEW CSS-->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/wallet.css" rel="stylesheet" media="all" >
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/css/sandstone.css" rel="stylesheet" media="all">
    <!-- <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/css/lumen.css" rel="stylesheet" media="all"> -->

    <!-- Jquery JS-->
    <!-- <script src="<?php //echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/jquery-3.2.1.min.js"></script> -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/chartjs/Chart.bundle.min.js"></script>

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/orologio.css" rel="stylesheet" media="all" >

</head>

<body class="animsition">
    <div class="page-wrapper">
        <?php
            // PREPARAZIONE LINK MENU
            //Stabilisco in base ai privilegi se visualizzare o meno un menù
            $pos = 'none';
            $socio = 'none';
            $commerciante = 'none';
            //$associazione = 'none';
            $amministratore = 'none';

            //$privilegesName = [0=>'pos',10=>'merch',15=>'assoc',20=>'admin'];
            //$privilegesName = [0=>'pos',10=>'merch',15=>'assoc',20=>'admin'];

			$visible[20] = 'none';
			//$visible[15] = 'none';
			$visible[10] = 'none';
            $visible[5] = 'none';
			$visible[0] = 'none';

            if (!Yii::app()->user->isGuest){
				switch (Yii::app()->user->objUser['privilegi']){
					case 0:
						$visible[0] = 'ihnerit';
						break;

                    case 5:
                        $visible[5] = 'ihnerit';
                        break;

					case 10:
						$visible[10] = 'ihnerit';
                        //$visible[5] = 'ihnerit';
						break;

					// case 15:
					// 	$visible[15] = 'ihnerit';
					// 	$visible[10] = 'ihnerit';
                    //     //$visible[5] = 'ihnerit';
					// 	break;

					case 20:
						$visible[20] = 'ihnerit';
						//$visible[15] = 'ihnerit';
						$visible[10] = 'ihnerit';
                        //$visible[5] = 'ihnerit';
						break;
				}

                //(Yii::app()->user->objUser['privilegi'] >= 20) ? $amministratore = 'ihnerit' : $amministratore = 'none';


               /* (Yii::app()->user->objUser['privilegi'] == 0) ? $pos = 'ihnerit' : $pos = 'none';
                (Yii::app()->user->objUser['privilegi'] >= 10 && Yii::app()->user->objUser['privilegi'] <15) ? $commerciante = 'ihnerit' : $commerciante = 'none';
                (Yii::app()->user->objUser['privilegi'] >= 15) ? $associazione = 'ihnerit' : $associazione = 'none';
                (Yii::app()->user->objUser['privilegi'] >= 20) ? $amministratore = 'ihnerit' : $amministratore = 'none';*/
            }

            // echo Yii::app()->user->objUser['privilegi'];
            // echo $commerciante;

        ?>
        <!-- HEADER MOBILE-->
            <?php include ('header_mobile.php'); ?>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
            <?php
			include ('menu_aside.php');
			?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <?php
            if (!Yii::app()->user->isGuest)
                include ('header_desktop.php');
            ?>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <?php echo $content; ?>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

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

    <!-- Call Service Worker-->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/src/js/promise.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/src/js/fetch.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/src/js/idb.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/src/js/utility.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/src/js/service.js"></script>

    <!-- Main JS-->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/js/main.js"></script>


<?php

include ('js_backend.php'); // backend notify
include ('js_sw.php');  // service worker
include ('js_validatepassword.php'); // validate password


?>
<!-- <input type='hidden' id='countedNews' value='<?php //echo (isset($countedNews)) ? $countedNews : 0; ?>'> -->
</body>
</html>
<!-- end document-->
