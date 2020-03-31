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
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/btcpayserver.css"  >


    <!-- Bitcoin Real Time price CSS-->
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/BRTP.css'); ?>
    <!-- Numpad CSS-->
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/numpad/easy-numpad.css'); ?>

    <!-- Jquery JS-->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/jquery-3.2.1.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/cool/vendor/chartjs/Chart.bundle.min.js"></script>


</head>

<body class="animsition">
    <div class="page-wrapper">
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
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/jquery/countdown/jquery.countdown.js', CClientScript::POS_END);
?>

</body>
</html>
<!-- end document-->
