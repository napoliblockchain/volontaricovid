<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	const ERROR_USERNAME_NOT_ACTIVE = 3;
	const ERROR_USERNAME_NOT_MEMBER = 4;

	private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		// CREO IL PRIMO HASH DI UNA PASSWORD
		// $hash = CPasswordHelper::hashPassword($this->password);
		// echo $hash;
		// exit;

		$save = new Save;

		//Creo la query
		$record=Users::model()->findByAttributes(array('email'=>$this->username));
		if($record===null){
			$this->errorCode=self::ERROR_USERNAME_INVALID;
			$save->WriteLog('dali','useridentity','authenticate','Incorrect username: '.$this->username);
		}
		else if(!CPasswordHelper::verifyPassword($this->password,$record->password)){
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
			$save->WriteLog('dali','useridentity','authenticate','Incorrect password.');
		}
		else if($record->status_activation_code == 0){
			$this->errorCode=self::ERROR_USERNAME_NOT_ACTIVE;
			$save->WriteLog('dali','useridentity','authenticate','User not active: '.$this->username);
		}
		else
		{
			//altrimenti, prosegue...
			$this->_id=$record->id_user;
			$this->errorCode=self::ERROR_NONE;

			$save->WriteLog('dali','useridentity','authenticate','User '.$this->username. ' logged in.');

			$this->setState('objUser', array(
				'id_user' => $record->id_user,
				'name' => $record->name,
				'surname' => $record->surname,
				'email' => $record->email,
				'privilegi' => $record->type,
				'facade' => 'dashboard',
			));
		}
		return !$this->errorCode;
	}
}
