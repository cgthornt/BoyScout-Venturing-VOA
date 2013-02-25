<?php
$model = Yii::app()->user->model;
?><h2 class="tabs-text-header">Account Details</h2>


    <p>
        Below is all of the information we have for your account.
    </p>
    
    <table class="nicetable">
        <tr class="nicetable-entry">
            <td class="nicetable-head" style="width:125px">Username</td>
            <td style="width:250px"><?php echo $model->username; ?></td>
        </tr>
        
        <tr class="nicetable-entry">
            <td class="nicetable-head">Email</td>
            <td><?php echo $model->email; ?></td>
        </tr>
        
        <tr class="nicetable-entry">
            <td class="nicetable-head">Member since</td>
            <td><?php echo date("F j, Y",strtotime($model->date_created)); ?></td>
        </tr>
        
        <tr class="nicetable-entry">
            <td class="nicetable-head">Account ID</td>
            <td><?php echo $model->ID; ?></td>
        </tr>
    </table>
    
    <p>
        <?php echo CHtml::link('Edit my account', 'user/edit/?id=' . $model->ID); ?>  
    </p>
