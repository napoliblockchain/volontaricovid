<?php

/**
 * This is the model class for table "dali_stradario".
 *
 * The followings are the available columns in table 'dali_stradario':
 * @property integer $id_stradario
 * @property string $quartiere
 * @property string $municipalita
 */
class Stradario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dali_stradario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_stradario, via, quartiere, municipalita', 'required'),
			array('id_stradario', 'numerical', 'integerOnly'=>true),
			array('via', 'length', 'max'=>1500),
			array('quartiere', 'length', 'max'=>100),
			array('municipalita', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_stradario, via, quartiere, municipalita', 'safe', 'on'=>'search'),
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
			'id_stradario' => 'Id Stradario',
			'via' => 'Indirizzo',
			'quartiere' => 'Quart.',
			'municipalita' => 'Mun.',
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

		$criteria->compare('id_stradario',$this->id_stradario);
		$criteria->compare('via',$this->via,true);
		$criteria->compare('quartiere',$this->quartiere,true);
		$criteria->compare('municipalita',$this->municipalita,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Stradario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
