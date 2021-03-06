<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $reCaptcha;

	private $_identity;

	public $informativa_trigger;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		if (gethostname()=='CGF6135T'){
			return array(
				// username and password are required
				array('username, password', 'required'),

				array('informativa_trigger', 'checkInformativa'),

				// password needs to be authenticated
				array('password', 'authenticate'),

				// username has to be a valid email address
				// array('username', 'email'),

				// secret is required
				array('reCaptcha ', 'required'),
			);
		}else{
			return array(
				// username and password are required
				array('username, password', 'required'),

				array('informativa_trigger', 'checkInformativa'),

				// password needs to be authenticated
				array('password', 'authenticate'),

				// username has to be a valid email address
				//array('username', 'email'),

				// secret is required
				array('reCaptcha ', 'required'),
				// Se il sito non lavora su https, il validatore restituirà errore di connessione !!!!
				array('reCaptcha', 'application.extensions.reCaptcha2.SReCaptchaValidator', 'secret' => Settings::load()->reCaptcha2PrivateKey,'message' => 'The verification code is incorrect.'),
			);

		}
	}

	/**
	 * check if the user checked Informativa
	 */
	public function checkInformativa($attribute,$params)
	{
	    if ($this->informativa_trigger == 0)
	    	$this->addError('informativa_trigger', 'Devi confermare di aver letto l\'informativa.');
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'Username',
			'password'=>'Password',
			'informativa_trigger' => 'Informativa',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 * @param string $attribute the name of the attribute to be validated.
	 * @param array $params additional parameters passed with rule when being executed.
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
			$errorCode = $this->_identity->errorCode;

			switch ($errorCode){
				case UserIdentity::ERROR_PASSWORD_INVALID:
					$this->addError('password','La password non è corretta.');
					break;

				case UserIdentity::ERROR_USERNAME_INVALID:
					$this->addError('username','L\'username non è corretto.');
					break;

				case UserIdentity::ERROR_USERNAME_NOT_ACTIVE:
					$this->addError('password','L\'utente non è abilitato.');
					break;

				// case UserIdentity::ERROR_TERMS_NOT_CHECKED:
				// 	$this->addError('username','Devi confermare di aver letto l\'informativa.');
				// 	break;

			}
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=3600*24*90; // 90 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
