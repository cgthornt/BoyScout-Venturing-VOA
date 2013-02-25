<?php
        $this->page['title'] = 'Create Event';
        $this->page['meta_desc'] = 'Promote an event';
?>

<h1>Create an Event</h1>


<p>Fill out the details below to create a new event.</p>

<?php
if(!$model->hasErrors() && !$model->isNewRecord)
{
    echo '<div class="successbox">
            You have successfully created a new event. You may create another
            one below. ', CHtml::link('View event', 'events/' . $model->ID), '
          </div>';
    
    $model2 = new Events();
    $model2->sponsor = $model->sponsor;
    $model2->contact_email = $model->contact_email;
    $model2->url = $model->url;
    $model2->address = $model->address;
    $model2->zip = $model->zip;
    $model = $model2;
    unset($model2);
    
}
?>

<fieldset>
    <legend>Create New Event</legend>

    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</fieldset>



</div><!-- form -->

