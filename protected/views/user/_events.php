<p>
    Below is a list of events created by this user
</p>
<?php

$dataProvider=new CActiveDataProvider('Events', array(
    'criteria' => array(
        'select' => 'ID, title, sponsor',
        'condition' => 'ID_USER=:idu',
        'params' => array(':idu' => Yii::app()->user->id),
    ),
    
    'pagination'=>array(
        'pageSize'=>20,
    ),

                                                      
                                                      ));

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns' => array(
        array(
            'htmlOptions' => array('style' => 'width:30px;text-align:center'),
            'name' => 'ID',
            'value' => '$data->ID',
        ),
        array(
            'htmlOptions' => array('style' => 'width:200px;'),
            'name' => 'title',
            'value' => '$data->title',
        ),
        
        'sponsor',
    ),
    
));

?>