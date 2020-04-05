<header class="header-desktop">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="header-wrap">
         <?php if (!Yii::app()->user->isGuest) { ?>
          <form class="form-header" action="" method="POST">
            <?php //include ('consegne.php'); ?>
          </form>
          <div class="header-button">
            <div class="noti-wrap">
              <?php  include ('header_notify.php'); ?>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</header>
