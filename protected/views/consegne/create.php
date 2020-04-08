<?php
/* @var $this StoresController */
/* @var $model Stores */

?>
<div class='section__content section__content--p30'>
	<div class='container-fluid'>
		<div class="row">
			<div class="col-lg-7">
				<div class="card">
					<div class="card-header">
						<h2 class='title-1 m-b-25'><small>Nuova</small> <strong>Consegna</strong></h2>
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

<!-- Seleziona indirizzi -->
<div class="modal fade" id="listaIndirizzi" tabindex="-1" role="dialog" aria-labelledby="AddressModalLabel" aria-hidden="true" style="displ ay: none;" >
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content text-dark">
			<div class="modal-body">
				<div class="table-responsive table--no-card">
					<div class="table table-borderless table-data4 table-wallet text-dark" id="address-grid"></div>
				</div>
			</div>
		</div>
	</div>
</div>
