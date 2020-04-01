<header class="header-mobile d-block d-lg-none">
	<div class="header-mobile__bar">
		<div class="container-fluid">
			<div class="header-mobile-inner">
				<a class='logo' href="<?php echo Yii::app()->createUrl('site/index'); ?>">
					<?php Logo::header(); ?>
				</a>
				<button class="hamburger hamburger--slider" type="button">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
			</div>
		</div>
	</div>
	<nav class="navbar-mobile">
		<div class="container-fluid">
			<ul class="navbar-mobile__list list-unstyled">
			 <?php
			if (Yii::app()->user->isGuest)
			{
			?>
						<li>
							<a class="js-arrow" href="<?php echo Yii::app()->createUrl('site/login'); ?>">
							<i class="fas fa-sign-in-alt"></i>Login</a>
						</li>
			<?php
			}else{
			?>

				<li class="active">
					<a class="js-arrow" href="<?php echo Yii::app()->createUrl('site/index');?>">Dashboard <i class="fas fa-tachometer-alt"></i></a>
				</li>

				<li>
					<a class="js-arrow" href="<?php echo Yii::app()->createUrl('consegne/create');?>">
						Inserisci&nbsp;<i class="fas fa-tasks"></i></a>
				</li>
				<li>
					<div class="delete-serviceWorker">
						<a class="js-arrow" href="<?php echo Yii::app()->createUrl('site/logout');?>">
							Uscita&nbsp;<i class="fa fa-power-off"></i></a>
					</div>

				</li>



				<?php } ?>
			</ul>
		</div>
	</nav>
</header>
