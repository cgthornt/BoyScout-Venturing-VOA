<?php
class HomeController extends CController
{
    public $page;
    
    public function actionIndex()
    {
        $this->findPage('Home');
        $this->render('page', array('page' => $this->page));
    
    }
    
    public function actionView()
    {
        
    
        if($this->findPage($_GET['page']))
           $this->render('page', array('page' => $this->page));
        else
            throw new CHttpException(404, 'The server could not find the requested page');
        
        
        
    }
    
    public function actionTest()
    {


    }
    
    private function findPage($pageTitle)
    {
        $this->page = Pages::model()->find('title_url=:title_url', array(':title_url' => $pageTitle))->attributes;
        return ($this->page != null);
    }
}

?>