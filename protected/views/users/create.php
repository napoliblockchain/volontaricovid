<?php
/* @var $this UsersController */
/* @var $model Users */

?>
<div class='section__content section__content--p30'>
	<div class='container-fluid'>
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h2 class='title-1 m-b-25'><small>Nuovo</small> <strong>socio</strong></h2>
					</div>
					<div class="card-body card-block">
						<?php $this->renderPartial('_form', array('model'=>$model)); ?>
					</div>
				</div>
			</div>
		</div>
		<?php echo Logo::footer(); ?>
	</div>
</div>
