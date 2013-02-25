<?php
class UserController extends CController
{
    public $page = array();
    
    public function filters()
    {
            return array(
                    'accessControl', // perform access control for CRUD operations
            );
    }

    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                    'class'=>'CCaptchaAction',
                    'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                    'class'=>'CViewAction',
            ),
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',  
                    'actions'=>array('index','login', 'create', 'captcha'),
                    'users'=>array('*'),
            ),
            array('allow', // allow authenticated users to access all actions
                    'users'=>array('@'),
            ),
            array('deny',  // deny all users
                    'users'=>array('*'),
            ),
        );
    }
    
    /**
     * Logs the user out. Requires a key to log the user out
     */
    public function actionLogout()
    {
        // Make sure we have a logout ke so that a random person
        // can't post a link and log someone out.
        if($_GET['key'] == Yii::app()->user->getStateKeyPrefix())
        {
            Yii::app()->user->logout();
            $this->redirect(Yii::app()->homeUrl);
        }
        else
        {
            $this->render('logoutError');
        }
    }
    
    /**
     * View the user control panel
     */
    public function actionControlPanel()
    {
        $this->render('controlPanel');
    }
    
    
    /**
     * Display the login form
     */
    public function actionLogin()
    {
        $model=new LoginForm;
        // collect user input data
        if(isset($_POST['LoginForm']))
        {
                $model->attributes=$_POST['LoginForm'];
                // validate user input and redirect to the previous page if valid
                if($model->validate())
                {
                    Logs::create(Logs::T_NOTICE, 'Login successfull', Logs::E_LOGIN);
                    $this->redirect(Yii::app()->user->returnUrl);
                }
                else
                {
                    Logs::create(Logs::T_ALERT,
                                 'Login attempt failed with username \'' . $model->username . '\'',
                                 Logs::E_LOGIN);
                }
        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }
    
    
    /**
     * Show the registration form
     */
    public function actionCreate()
    {
        $model = new UserRegisterForm;
        
        //var_dump(Yii::app()->user);
        
       if(isset($_POST['UserRegisterForm']))
        {
                $model->attributes=$_POST['UserRegisterForm'];
                // validate user input and redirect to the previous page if valid
                if($model->validate())
                {
                    $model->createUser();
                    $this->redirect(Yii::app()->user->returnUrl);
                }
        }
        
        $this->render('create', array('model'=>$model));

    }


    public function actionEdit()
    {
        $model = User::model()->findByPK($_GET['id']);
        
        if(empty($model))
            throw new CHttpException(404, 'The requested user was not found');
        
        if($model->ID != Yii::app()->user->id && !Yii::app()->user->isAdmin())
            throw new CHttpException(403, 'You are not allowed to modify this user');
     
     
        
       if(isset($_POST['UserRegisterForm']))
        {
                $model->attributes=$_POST['UserRegisterForm'];
                // validate user input and redirect to the previous page if valid
                if($model->validate())
                {
                    $model->createUser();
                    $this->redirect(Yii::app()->user->returnUrl);
                }
        }
        
        $this->render('edit', array('model'=>$model));  
    }

}
?>