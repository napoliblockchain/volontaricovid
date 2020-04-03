<?php
/* @var $this UsersController */
/* @var $dataProvider CActiveDataProvider */
function type($type){
  if ($type == 0){
    return "Volontario";
  }else{
    return "Gestore";
  }
}

?>
<div class='section__content section__content--p30'>
	<div class='container-fluid'>
		<div class="row">
			<div class="col-lg-12">
                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40 bg-overlay--semitransparent">
					<div class="card-header ">
						<i class="fas fa-users"></i>
						<span class="card-title">Lista Volontari</span>
              <div class="float-right">
							<?php $actionURL = Yii::app()->createUrl('users/create'); ?>
							<a href="<?php echo $actionURL;?>">
								<button class="btn alert-primary text-light img-cir" style="padding:2.5px; width:30px; height:30px;">
									<i class="fa fa-plus"></i></button>
							</a>
						</div>

					</div>
					<div class="card-body">
        				<div class="table-responsive table--no-card m-t-40">
        					<?php
        					$this->widget('zii.widgets.grid.CGridView', array(
                          'id'=>'soci-grid',
                          'htmlOptions' => array('class' => 'table table-wallet '),
        					        'dataProvider'=>$dataProvider,
                          'id'=>'users-grid',
                          'enablePagination'  => true,
        						'columns' => array(

        							array(
        								'type'=> 'raw',
        					      'name'=>'name',
                        'header'=>'Nome',
        								'value' => 'CHtml::link(CHtml::encode(strtoupper(Users::model()->findByPk($data->id_user)->surname).chr(32).Users::model()->findByPk($data->id_user)->name), Yii::app()->createUrl("users/view")."&id=".CHtml::encode(crypt::Encrypt($data->id_user)))',
                                        'filter' => CHtml::listData(Users::model()->findAll(array('order'=>'surname ASC, name ASC')), 'surname', function($items) {
                                        	 return $items->surname.' '.$items->name;
                                        })
        					      ),
        							array(
        					      'name'=>'email',
        								'type'=>'raw',
        								'value' => 'CHtml::link(CHtml::encode($data->email), Yii::app()->createUrl("users/view")."&id=".CHtml::encode(crypt::Encrypt($data->id_user)))',
        					        ),


        							array(
        					            'name'=>'type',
                              'header'=>'Tipo',
        								      'value'=>'type($data->type)',
        					        ),

                                    [
                                        'value' =>''
                                        ]


        						)
        					));
        					?>
        				</div>
                    </div>

                </div>
			</div>
		</div>

		<?php echo Logo::footer(); ?>
	</div>
</div>
