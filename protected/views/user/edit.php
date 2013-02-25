<?php
        $this->page['title'] = 'Edit User';
        $this->page['meta_desc'] = 'Modify an existing user';
?>

<h1>Modify User</h1>

<p>You can modify a user using the following form fields</p>

<?php $this->renderPartial('_form', array('model' => $model)); ?>

<p>
    <?php echo CHtml::link('Back', 'user/controlPanel'); ?>
</p>