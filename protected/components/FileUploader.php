<?php
Yii::import('zii.widgets.CPortlet');
 
class FileUploader extends CPortlet
{
    public function init()
    {
        parent::init();
    }
 
    protected function renderContent()
    {
        $this->render('fileUploader');
    }
}
?>