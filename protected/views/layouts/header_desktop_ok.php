<header class="header-desktop">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="header-wrap">
				<!-- <form class="form-header" action="" method="POST">-->
					<!-- <img src="<?php //echo Yii::app()->request->baseUrl; ?>/css/images/panorama.jpg" > -->
				<!-- </form>-->
				<!-- <form class="form-header" action="" method="POST">
					<input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
					<button class="au-btn--submit" type="submit">
						<i class="zmdi zmdi-search"></i>
					</button>
				</form> -->
				<?php if (!Yii::app()->user->isGuest) { ?>
				<div class="header-button">
					<div class="account-wrap">
						<div class="noti-wrap " style='display:none;'>
                                                         </div>
						<div class="account-wrap">
                                    													 
						<div class="account-item clearfix js-item-menu">
							<!-- <div class="image">
								<i class="fas fa-user"></i>
							</div>-->
							<div class="content">
								<a class="js-acc-btn" href="#"><?php echo Yii::app()->user->objUser['name']; ?></a>                            </div>
							<div class="account-dropdown js-dropdown">
								<div class="info clearfix">
									<div class="image">
										<a href="#">
											<i class="fas fa-user"></i>
										</a>
									</div>
									<div class="content">
										<h5 class="name">
											<a href="#"><?php echo Yii::app()->user->objUser['name']; ?></a>
										</h5>
										<span class="email"><?php echo Yii::app()->user->name; ?></span>
									</div>
								</div>
								<div class="account-dropdown__body">
									<div class="account-dropdown__item">
										<a href="<?php echo Yii::app()->createUrl('users/view').'&id='.crypt::Encrypt(Yii::app()->user->objUser['id_user']);?>">
											<i class="zmdi zmdi-account"></i>Account</a>
									</div>
									<div class="account-dropdown__item" style='display: <?php echo $commerciante; ?>;'>
										<a href="<?php echo Yii::app()->createUrl('settings/index');?>">
											<i class="zmdi zmdi-settings"></i>Impostazioni</a>
									</div>
								</div>
								<div class="account-dropdown__footer">
									<a href="<?php echo Yii::app()->createUrl('site/logout');?>">
										<i class="zmdi zmdi-power"></i>Logout</a>
								</div>
							</div>
						</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</header>
