<h1>User Management</h1>
<p>
    Below is the information for your account
</p>
<?php
        $this->page['title'] = 'User Control Panel';
        $this->page['meta_desc'] = 'View and edit your profile';

        $crew = Yii::app()->user->crew;
        
        $Tabs = array
               (
                  'profile'=>array('title'=>'Profile','view'=>'_profile'),
                  'crew'=>array('title'=>'My Crew', 'view'=>'_crew'),
                  'events'=>array('title'=>'Events', 'view'=>'_events'),
               );

    $this->widget('CTabView', array('tabs'=>$Tabs));
?>