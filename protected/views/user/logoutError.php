<?php
        $this->page['title'] = 'Logout Error';
        $this->page['meta_desc'] = 'There was an error logging you out';
?>
<h1>Logout Error</h1>
<p>
    There was an error verifying your session ID. You may try logging out again
    by clicking
    <?php echo CHtml::link('this link', 'user/logout/?key=' . Yii::app()->user->getStateKeyPrefix()); ?>.
</p>