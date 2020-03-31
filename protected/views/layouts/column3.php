<?php /* @var $this Controller */ ?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="it">
	<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/css/favicon.ico" type="image/x-icon" />

	<script src="jquery/jquery-1.10.2.min.js"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/glyphicon.css">
</head>
<body>
	<div id="mainpage">
		<div class="login-header">
			<div class="login-logo">
				<?php Logo::header(); ?>
			</div>
		</div>
		<div id="links" style="position:absolute; top:135px; left:20px;">
			<?php include("menu_pos.php"); ?>
		</div>
		<div id='brtp'>
			<?php echo BRTP::RealTimeBtc(); ?>
		</div>
		<center>
			<div id="bitpay-pairing__message" class="errorMessage"></div>
		</center>


			<div id="content">
				<?php echo $content; ?>
			</div>
			<!-- content -->


	</div>
</body>
</html>
