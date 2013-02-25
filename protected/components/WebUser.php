<?php
 
// this file must be stored in:
// protected/components/WebUser.php
 
class WebUser extends CWebUser { 
 
  // Store model to not repeat query.
  public $model;
  private $_admin = false;
  
  public $username, $email, $date_created, $crew, $hasCrew, $id;
  
  public function init()
  {
    parent::init();

        if(!$this->getIsGuest())
        {
            $this->id = $this->getId();
            $this->model = User::model()->with('crew')->findByPk($this->getId());
            $this->username = $this->model->username;
            $this->email = $this->model->email;
            $this->_admin = ($this->model->admin == 1);
            $this->date_created = $this->model->date_created;
            $this->crew = $this->model->crew;
            $this->hasCrew = !empty($this->crew);
        }
    
  }
 
 
  // This is a function that checks the field 'role'
  // in the User model to be equal to 1, that means it's admin
  // access it by Yii::app()->user->isAdmin()
  function isAdmin(){
    return $this->_admin;
  }
}
?>