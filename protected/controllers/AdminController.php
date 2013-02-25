<?php
class AdminController extends CController
{
    public $page;
    
    public function filters()
    {
        if(!Yii::app()->user->isAdmin())
            throw new CHttpException(403, 'Only an administrator may access this page');
    }
    
    
    public function actionIndex()
    {

        $this->render('index');

    }
}

?>