<?php
class CrewsController extends CController
{
    public $page;
    
    public function filters()
    {
            return array(
                    'accessControl', // perform access control for CRUD operations
            );
    }
    
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated users to access all actions
                    'users'=>array('@'),
            ),
            array('deny',  // allow all users to access 'index' and 'view' actions.
                    'actions'=>array('create', 'edit'),
                    'users'=>array('*'),
            ),
        );
    }
    
    public function actionIndex()
    {
        
    }
    
    public function actionEdit()
    {
        $model = Crews::model()->findByPK($_GET['id']);
	
	if(empty($model))
	    throw new CHttpException(404, 'The requested crew was not found');
	
	if(!$model->isOwner() && !Yii::app()->user->isAdmin())
	    throw new CHttpException(403, 'You do not have permission to edit this crew!');
	
        if(isset($_POST['Crews']))
        {
                $model->attributes=$_POST['Crews'];
                // validate user input and redirect to the previous page if valid
                if($model->validate())
		{
                    $model->save();
		}
        }
        
        
        $this->render('edit', array('model' => $model));
    }
    
    public function actionCreate()
    {
        $model = new Crews;
        
        if(isset($_POST['Crews']))
        {
                $model->attributes=$_POST['Crews'];
                // validate user input and redirect to the previous page if valid
                if($model->validate())
		{
		    $model->save();
                    //$this->redirect('index');
		}
        }
        
        
        $this->render('create', array('model' => $model));
    }
}