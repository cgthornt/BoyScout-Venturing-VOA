<?php

Yii::import('zii.widgets.CPortlet');

class Links extends CPortlet
{
    public function getLinks()
    {
        return Pages::model()->links()->findAll();
    }
    protected function renderContent()
    {
        $this->render('links');
    }
}
?>