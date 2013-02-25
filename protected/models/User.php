<?php

class User extends CActiveRecord
{
       // public $ID, $username, $email, $salt, $activation_hash, $activated, $admin;
	/**
	 * The followings are the available columns in table 'tbl_user':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $salt
	 * @var string $email
	 * @var string $profile
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, salt, email', 'required'),
			array('username, password, salt, email', 'length', 'max'=>128),
			array('profile', 'safe'),
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
			'crew' => array(self::HAS_ONE, 'Crews', 'ID_OWNER'),
			'requests' => array(self::HAS_MANY, 'EventRequest', 'ID_USER'),
		);
	} 

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'username' => 'Username',
			'password' => 'Password',
			'salt' => 'Salt',
			'email' => 'Email',
			'profile' => 'Profile',
			'admin' => 'Admin',
		);
	}

	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt)===$this->password;
	}
        
        public static function get($id)
        {
            $val = self::model()->with('crew')->findByPk($id);
            if($val != null)
                return array('is_admin' => ($val->attributes['admin'] == 1),
			     'attrubutes' => $val->attributes,
			     'crew' => $val->crew->attributes);
        }
        
        public static function currentUser()
        {
            return self::get(Yii::app()->user->getId());
        }
        
        
        public function create($username, $password, $email, $activated = false)
        {
            // This variable MUST stay the same!
            $salt = $this->generateSalt();
            
            $user = new User;
            $user->username = $username;
            $user->password = $this->hashPassword($password, $salt);
            $user->email = $email;
            $user->salt = $salt;
            $user->activated = $activated;
            $user->date_created = date ("Y-m-d H:i:s");
            $user->activation_hash = md5($this->generateSalt());
            $user->save();
        }

	/**
	 * Generates the password hash.
	 * @param string password
	 * @param string salt
	 * @return string hash
	 */
	public function hashPassword($password,$salt)
	{
		return sha1($salt.$password);
	}
        
        public static function userExists($username)
        {
            return (self::model()->find('username=:username', array(':username' => $username)) != null);
        }

	/**
	 * Generates a salt that can be used to generate a password hash.
	 * @return string the salt
	 */
	protected function generateSalt()
	{
		return md5(microtime());
	}
}