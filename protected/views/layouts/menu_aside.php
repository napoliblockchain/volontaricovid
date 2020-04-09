<aside class="menu-sidebar d-none d-lg-block">
	<div  class="logo">
		<a href="<?php echo Yii::app()->createUrl('site/index'); ?>">
			<?php Logo::header(100,40); ?>
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
					<?php
						$visible = isset (Yii::app()->user->objUser["privilegi"]) ? (Yii::app()->user->objUser["privilegi"] == 20) ? "" : "none" : "none";
					?>
					<li class="has-sub" style='display: <?php echo $visible; ?>;'>
						<a class="js-arrow" href="#">
							<i class="fa fa-archive"></i>Amministrazione</a>
						<ul class="list-unstyled navbar__sub-list js-sub-list">
							<li>
								<a href="<?php echo Yii::app()->createUrl('users/index');?>"><i class="fas fa-users"></i>Operatori</a>
							</li>
							<li>
								<a target="_blank" href="<?php echo Yii::app()->createUrl('consegne/export');?>"><i class="fa fa-download"></i>Esporta</a>
							</li>
							<li>
								<a href="<?php echo Yii::app()->createUrl('consegne/manage');?>"><i class="fa fa-truck"></i>Consegne</a>
							</li>
						</ul>
					</li>

					<li>
						<a class="js-arrow" href="<?php echo Yii::app()->createUrl('consegne/create');?>">
							<i class="fa fa-list-ol"></i>Inserisci</a>
					</li>
					<li>
						<div class="delete-serviceWorker">
								<a href="<?php echo Yii::app()->createUrl('site/logout');?>" >
								<i class="fa fa-power-off"></i>Uscita</a>
						</div>
					</li>


				</ul>
			<?php } ?>
		</nav>
	</div>
</aside>
