<?php

/**
 * This is the model class for table "dali_archive".
 *
 * The followings are the available columns in table 'dali_archive':
 * @property integer $id_archive
 * @property integer $id_user
 * @property string $codfisc
 * @property integer $data
 * @property integer $adulti
 * @property integer $bambini
 * @property string $indirizzo
 * @property integer $trigger_alert
 */
class Consegne extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'dali_archive';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_user, codfisc, data, adulti, bambini, indirizzo ', 'required'),
            array('id_user, adulti, bambini, trigger_alert', 'numerical', 'integerOnly'=>true),
            array('codfisc', 'length', 'max'=>16),
            array('indirizzo', 'length', 'max'=>500),

            // array('data', 'safe'),
            // array('data', 'type', 'type' => 'date', 'message' => '{attribute}: non è nel formato corretto! (gg/mm/aaaa)', 'dateFormat' => 'dd/MM/yyyy'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_archive, id_user, codfisc, data, adulti, bambini, indirizzo, trigger_alert', 'safe', 'on'=>'search'),
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
            'id_archive' => 'Id Archive',
            'id_user' => 'Id User',
            'codfisc' => 'Codice Fiscale del capo-famiglia',
            'data' => 'Data di consegna',
            'adulti' => 'Adulti',
            'bambini' => 'Bambini',
            'indirizzo' => 'Indirizzo',
            'trigger_alert' => 'Trigger Alert',
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

        $criteria->compare('id_archive',$this->id_archive);
        $criteria->compare('id_user',$this->id_user);
        $criteria->compare('codfisc',$this->codfisc,true);
        $criteria->compare('data',$this->data);
        $criteria->compare('adulti',$this->adulti);
        $criteria->compare('bambini',$this->bambini);
        $criteria->compare('indirizzo',$this->indirizzo,true);
        $criteria->compare('trigger_alert',$this->trigger_alert);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Consegne the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
