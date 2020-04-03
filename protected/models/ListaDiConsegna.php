<?php

/**
 * This is the model class for table "dali_lista_di_consegna".
 *
 * The followings are the available columns in table 'dali_lista_di_consegna':
 * @property integer $id_ldc
 * @property integer $id_volontario
 * @property integer $timestamp
 * @property string $id_archive
 */
class ListaDiConsegna extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dali_lista_di_consegna';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_volontario, timestamp, id_archive', 'required'),
			array('id_volontario, timestamp', 'numerical', 'integerOnly'=>true),
			array('id_archive', 'length', 'max'=>2000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_ldc, id_volontario, timestamp, id_archive', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_ldc' => 'Id Ldc',
			'id_volontario' => 'Id Volontario',
			'timestamp' => 'Timestamp',
			'id_archive' => 'Id Archive',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_ldc',$this->id_ldc);
		$criteria->compare('id_volontario',$this->id_volontario);
		$criteria->compare('timestamp',$this->timestamp);
		$criteria->compare('id_archive',$this->id_archive,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ListaDiConsegna the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
