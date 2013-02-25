<?php
$page->title = 'Edit a Crew';
?>
<h1>Edit a Crew</h1>
<p>
    Fill out the following fields to edit the crew
</p>

<fieldset>
    <legend>Edit Crew</legend>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>

</fieldset>
