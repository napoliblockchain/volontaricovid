<style>
.noti_box {
  width: 100px;
  height: 60px;
  background-c olor: red;
}
.font_big{
  font-size: 1em;
}
@media (max-width: 991px) {
    .noti-wrap {
        position: relative;
        top: 50px;
    }
}
</style>
<div class="noti-wrap">
  <div class="noti__item js-item-menu noti_box">
    <i class="fa fa-home"></i>
    <span class="badge badge-success font_big" id="noti-consegnati">0</span>
    <span class="text-light">Consegnati</span>
  </div>
  <div class="noti__item js-item-menu noti_box">
    <i class="fa fa-truck"></i>
    <span class="badge badge-warning font_big" id="noti-inconsegna">0</span>
    <span class="text-light">In&nbsp;consegna</span>
  </div>
  <div class="noti__item js-item-menu noti_box">
    <i class="fa fa-inbox"></i>
    <span class="badge badge-primary font_big" id="noti-incarico">0</span>
    <span class="text-light">In&nbsp;carico</span>
  </div>

</div>
