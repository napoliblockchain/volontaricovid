<?php

/**
 * This is the model class for table "dali_users".
 *
 * The followings are the available columns in table 'np_users':
 * @property integer $id_user
 * @property integer $id_users_type
 * @property string $status
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $surname
 * @property string $activation_code
 * @property integer $status_activation_code
 */
class Users extends CActiveRecord
{
	public $ga_cod;


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dali_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, password', 'required'),
			array('email', 'unique',  'message'=>'La mail inserita è già presente in archivio.'),
			array('email, password, name, surname', 'length', 'max'=>255),
			array('ga_secret_key', 'length', 'max'=>16),
			//array('password', 'allowEmpty'=>false, 'on' => 'update'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_user, email, name, surname', 'safe', 'on'=>'search'),
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
			'id_user' => 'Id User',
			'email' => 'Email',
			'password' => 'Password',
			'ga_secret_key' => 'Google Authentication Code',
			'name' => 'Nome',
			'surname' => 'Cognome',
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

		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('surname',$this->surname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));

	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
