<?php
        $this->page['title'] = 'Edit Event';
        $this->page['meta_desc'] = 'Edit an existing event';
?>

<h1>Edit an Event</h1>


<p>
    You can make changes to your event here.
</p>

<?php
if(isset($_POST['Events']))
{
    echo '<div class="successbox">Event successfully updated!</div>';
}

?>

<fieldset>
    <legend>Edit an Event</legend>

    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</fieldset>

<?php echo CHtml::link('Back', 'events'); ?>
</div><!-- form -->

