<?php
$page->title = 'Create a Crew';
?>
<h1>Create a Crew</h1>
<p>
    You must create a crew before you can create events.
</p>

<fieldset>
    <legend>Create Crew</legend>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>

</fieldset>