<ul>
<?php foreach(Pages::model()->links()->findAll() as $link)
{
    $class = $link['title_url'] == $this->page['title_url'] ? 'current' : 'link';
    echo '<li>', CHtml::link($link['title'], 'home/' . $link['title_url'], array('class' => $class)),  '</li>';
}

    echo '</ul><ul style="margin-top:15px;padding-top:8px;border-top: 1px dashed #666666">';

    echo '<li>', CHtml::link('Venturing Connect', 'events', array('class' => 'link')), '</li>';

// User Management
if(Yii::app()->user->isGuest)
{
    echo '<li>', CHtml::link('Login', Yii::app()->user->loginUrl, array('class' => 'link')), '</li>';
    echo '<li>', CHtml::link('Register', 'user/create', array('class' => 'sublink')), '</li>';
}
else
{

    echo '<li>', CHtml::link('Promote Event', 'events/create', array('class' => 'sublink')), '</li>';
}

if(Yii::app()->user->isAdmin())
{
    echo '</ul><ul style="margin-top:15px;padding-top:8px;">';
    
    echo '<li>', CHtml::link('Administration', 'admin/index', array('class' => 'link')), '</li>';
    echo '<li>', CHtml::link('Edit Pages', 'admin/pages', array('class' => 'sublink')), '</li>';
    echo '<li>', CHtml::link('Users', 'admin/users', array('class' => 'sublink')), '</li>';
}

if(!Yii::app()->user->isGuest)
{
    echo '</ul><ul style="margin-top:15px;padding-top:8px;">';
    echo '<li>', CHtml::link('My Account', 'user/controlPanel', array('class' => 'link')), '</li>';
    echo '<li>', CHtml::link('Logout', 'user/logout/?key=' . Yii::app()->user->getStateKeyPrefix() , array('class' => 'sublink')), '</li>';
}

?>
</ul>