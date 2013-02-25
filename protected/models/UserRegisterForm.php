<?php

/**
 * .
 */
class UserRegisterForm extends CFormModel
{
	public $username;
	public $password;
	public $password2;
        public $email;
        public $verifyCode;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password, password2, email', 'required'),
			// rememberMe needs to be a boolean
			array('email', 'email'),
			// password needs to be authenticated
			array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
                        array('password', 'compare', 'compareAttribute'=>'password2'),
                        array('username', 'doesNotExist'),
                        array('username', 'length', 'min'=>3, 'max'=>12),

		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'verifyCode'=>'Verification Code',
		);
	}
        
        public function createUser()
        {
            User::model()->create($this->username, $this->password, $this->email, true);
        }

	/**
	 * Makes sure the username does not exist!
	 */
	public function doesNotExist($attribute,$params)
	{

            if(User::userExists($this->username))
                $this->addError('username', 'This username already exists');
	}
}
