<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();


	/**
	* Questa funzione ha lo scopo di mascherare l'indirizzo, ma di mostrarlo su
	* richiesta (click)
	* @var string $address è la stringa indirizzo da celare
	* @var number $id è l'id della row da richiamare in caso di click
	* @var number $tag è l'operazione richiesta
	*/
	public function maskAddress($address,$id,$tag=0)
	{
		$link = Yii::app()->createUrl(
			"consegne/view",
			["id"=>crypt::Encrypt($id),"tag"=>$tag]
		);

		$return = CHtml::link('******<span>'.$address.'</span>',$link,[
			'class'=>'tipaddress'
		]);
		return $return;
	}

	public function setDateArray($time){
		$oggi = date("Y-m-d",$time);
		$start = date('Y-m-d', mktime(0,0,0,'03','25','2020'));

		$array[] = $oggi;

		$explode = explode ("-",$oggi);
		while (true)
		{
			$date = date('Y-m-d', mktime(0,0,0,$explode[1],$explode[2]-1,$explode[0]));
			$array[] = $date;
			$explode = explode ("-",$date);

			if ($date == $start)
				break;

		}
		// creo l'array con le date
		$t['']='';
		foreach ($array as $a){
			$tmp = explode("-",$a);
			$t[strtotime($tmp[0].'-'.$tmp[1].'-'.$tmp[2])] = date('d M Y', mktime(0,0,0,$tmp[1],$tmp[2],$tmp[0]));
		}

		return $t;
	}

}
