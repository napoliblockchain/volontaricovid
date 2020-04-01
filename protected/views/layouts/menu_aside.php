<aside class="menu-sidebar d-none d-lg-block">
	<div  class="logo">
		<a href="<?php echo Yii::app()->createUrl('site/index'); ?>">
			<?php Logo::header(); ?>
		</a>
	</div>
	<div id="page-vesuvio"></div>
	<div class="menu-sidebar__content js-scrollbar1">
		<nav class="navbar-sidebar">
			<?php
			if (Yii::app()->user->isGuest)
			{
			?>
				<ul class="list-unstyled navbar__list">
					<li class="active">
						<a class="js-arrow" href="<?php echo Yii::app()->createUrl('site/login'); ?>">
							<i class="fas fa-sign-in-alt"></i>Login</a>
					</li>
				</ul>
			<?php
			}else{
				?>
				<ul class="list-unstyled navbar__list">
					<li class="active">
						<a class="js-arrow" href="<?php echo Yii::app()->createUrl('site/index');?>"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
					</li>
					<li>
						<a class="js-arrow" href="<?php echo Yii::app()->createUrl('consegne/create');?>">
							<i class="fas fa-tasks"></i>Inserisci</a>
					</li>
					<li>
						<a class="js-arrow" href="<?php echo Yii::app()->createUrl('site/logout');?>">
							<i class="fa fa-power-off"></i>Uscita</a>
					</li>


				</ul>
			<?php } ?>
		</nav>
	</div>
</aside>
