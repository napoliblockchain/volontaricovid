<?php
$http_host = $_SERVER['HTTP_HOST'];

$walletUrl = 'https://wallet.' . Utils::get_domain($http_host) . '/index.php?r=wallet/index';
$posUrl = 'https://pos.' . Utils::get_domain($http_host) . '/index.php?r=site/index';
?>

<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
			<?php if (!Yii::app()->user->isGuest) { ?>
                <form class="form-header" action="" method="POST">
                    <div id="orologio"></div>
                </form>
                <div class="header-button">
                    <div class="noti-wrap">
                        <?php  include ('header_notify.php'); ?>
                    </div>
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="content">
                                <a class="js-acc-btn" href="#"><i class="zmdi zmdi-hc-2x zmdi-widgets text-success"></i></a>
                            </div>
                            <div class="account-dropdown js-dropdown" id='apps-dropdown'>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item" >
                                        <a href='<?php echo $walletUrl?>' target="_blank">
                                            <img style="max-width: 40px;" src='src/images/icons/apple-icon-76x76.png'><span style="margin-left:30px;">Wallet TTS</span>
                                        </a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href='<?php echo $posUrl?>' target="_blank">
                                            <img style="max-width: 40px;" src='css/images/pos-76x76.png'><span style="margin-left:30px;">POS (Point of Sale)</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="content">
                                <a class="js-acc-btn" href="#"><?php echo Yii::app()->user->objUser['name']; ?></a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#"><i class="fa fa-user" style="font-size: 4em;"></i></a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="#"><?php echo Yii::app()->user->objUser['name'].chr(32).Yii::app()->user->objUser['surname']; ?></a>
                                        </h5>
                                        <span class="email"><?php echo Yii::app()->user->name; ?></span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <?php if (Yii::app()->user->objUser['facade'] != 'pos'){ ?>
                                        <div class="account-dropdown__item">
                                            <a href="<?php echo Yii::app()->createUrl('users/view').'&id='.crypt::Encrypt(Yii::app()->user->objUser['id_user']);?>">
                                                <i class="fa fa-user"></i>Account utente</a>
                                        </div>
                                    <?php } ?>

                                    <!-- <?php //if (Yii::app()->user->objUser['privilegi'] != 20 && Yii::app()->user->objUser['facade'] != 'pos'){ ?>
                                        <div class="account-dropdown__item">
                                            <?php //if (Yii::app()->user->objUser['facade'] == 'pos'){ ?>
                                                <a href="<?php //echo Yii::app()->createUrl('merchants/view').'&id='.crypt::Encrypt(Pos::model()->findByPk(Yii::app()->user->objUser['id_user'])->id_merchant);?>">
                                                    <i class="fas fa-shopping-cart"></i>Account commerciante</a>
                                            <?php //}else if (Yii::app()->user->objUser['privilegi'] != 5){ ?>
                                                <a href="<?php //echo Yii::app()->createUrl('merchants/view').'&id='.crypt::Encrypt(Merchants::model()->findByAttributes(array('id_user'=>Yii::app()->user->objUser['id_user']))->id_merchant);?>">
                                                    <i class="fas fa-shopping-cart"></i>Account commerciante</a>
                                            <?php //} ?>

                                        </div>
                                    <?php //} ?> -->

                                    <div class="account-dropdown__item" style='display: <?php echo $visible[10]; ?>;'>
                                        <a href="<?php echo Yii::app()->createUrl('settings/index');?>">
                                            <i class="fa fa-gear"></i>Impostazioni <?php if (Yii::app()->user->objUser['privilegi'] == 20) echo "Associazione"; ?></a>
                                    </div>

                                </div>
                                <div class="account-dropdown__footer delete-serviceWorker">
                                    <a href="<?php echo Yii::app()->createUrl('site/logout');?>" >
                           <i class="fa fa-power-off"></i><?php echo Yii::t('lang','Logout');?></a>
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
