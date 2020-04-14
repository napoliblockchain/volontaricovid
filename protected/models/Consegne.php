<?php

/**
 * This is the model class for table "dali_archive".
 *
 * The followings are the available columns in table 'dali_archive':
 * @property integer $id_archive
 * @property integer $id_user
 * @property string $codfisc
 * @property string $nome
 * @property string $cognome
 * @property string $telefono
 * @property integer $data
 * @property integer $adulti
 * @property integer $bambini
 * @property string $indirizzo
 * @property string $quartiere
 * @property string $municipalita
 * @property integer $trigger_alert
 * @property integer $id_volontario
 * @property integer $in_consegna
 * @property integer $consegnato
 * @property integer $time_inconsegna
 * @property integer $time_consegnato
 * @property string $note
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
            array('id_user, codfisc, nome, cognome, data, adulti, bambini, indirizzo, telefono, quartiere, municipalita', 'required'),
            array('id_user, data, adulti, bambini, trigger_alert, id_volontario, in_consegna, consegnato, time_inconsegna, time_consegnato', 'numerical', 'integerOnly'=>true),
            array('codfisc', 'length', 'max'=>16),
            array('telefono', 'length', 'max'=>50),
            array('nome, cognome', 'length', 'max'=>100),
            array('indirizzo', 'length', 'max'=>500),
            array('note', 'length', 'max'=>250),
            array('quartiere', 'length', 'max'=>100),
            array('municipalita', 'length', 'max'=>10),

            array('trigger_alert', 'checkTrigger'),

            array('codfisc', 'validateCF'),

            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_archive, id_user, codfisc, nome, cognome, telefono, data, adulti, bambini, indirizzo, trigger_alert, id_volontario, in_consegna, consegnato, time_inconsegna, time_consegnato, quartiere, municipalita', 'safe', 'on'=>'search'),
        );
    }

    /**
	 * check if CF is duplicate
	 */
	public function checkTrigger($attribute,$params)
	{
	    if ($this->trigger_alert == 1)
	    	$this->addError('codfisc', 'Questo codice fiscale è già presente nelle consegne dell\'ultima settimana.');
	}

    /**
	 * check if CF is valid
	 */
	public function validateCF($attribute,$params)
	{
        $cf = new CodiceFiscale();

		if( !$cf->ValidaCodiceFiscale($this->codfisc) ){
            $this->addError('codfisc', 'Codice fiscale non conforme.');
        }


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
            'id_archive' => 'ID Ord.',
            'id_user' => 'Id User',
            'codfisc' => 'Codice Fiscale del capo-famiglia',
            'data' => 'Data ordine',
            'adulti' => 'Adulti',
            'bambini' => 'Neonati (0/12 mesi)',
            'indirizzo' => 'Indirizzo',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'telefono' => 'Telefono',
            'trigger_alert' => 'Trigger Alert',
            'id_volontario' => 'Id Volontario',
            'in_consegna' => 'In Consegna',
            'consegnato' => 'Consegnato',
            'time_inconsegna' => 'Data di presa in carico',
            'time_consegnato' => 'Data di Consegna',
            'note' => 'Note',
            'quartiere' => 'Quartiere',
            'municipalita' => 'Municipalità',
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

       //  echo "<pre>".print_r($_POST,true)."</pre>";
       // echo "<pre>".print_r($_GET,true)."</pre>";
       // echo "<pre>".print_r($this->attributes,true)."</pre>";
       // exit;



        $criteria=new CDbCriteria;

        $criteria->compare('id_archive',$this->id_archive);
        $criteria->compare('id_user',$this->id_user);
        $criteria->compare('codfisc',$this->codfisc,true);
        $criteria->compare('nome',$this->nome,true);
        $criteria->compare('cognome',$this->cognome,true);
        $criteria->compare('telefono',$this->telefono,true);
        $criteria->compare('data',$this->data);
        $criteria->compare('adulti',$this->adulti);
        $criteria->compare('bambini',$this->bambini);
        $criteria->compare('indirizzo',$this->indirizzo,true);
        $criteria->compare('trigger_alert',$this->trigger_alert);
        $criteria->compare('id_volontario',$this->id_volontario);
        //$criteria->compare('in_consegna',$this->in_consegna);
        //$criteria->compare('consegnato',$this->consegnato);
        $criteria->compare('time_inconsegna',$this->time_inconsegna);
        $criteria->compare('time_consegnato',$this->time_consegnato);
        $criteria->compare('note',$this->note);

        $criteria->compare('quartiere',$this->quartiere,true);
        $criteria->compare('municipalita',$this->municipalita);

        $criteria->compare('in_consegna',0,false);
        $criteria->compare('consegnato',0,false);

        return new CActiveDataProvider($this, array(
          'criteria'=>$criteria,
          'sort'=>array(
            'defaultOrder'=>array(
              'id_archive'=>false,
            )
          ),
          'pagination' => array(
            'pageSize' => 20,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DaliArchive the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
