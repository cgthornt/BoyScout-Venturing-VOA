<?php
        $this->page['title'] = 'Administration';
        $this->page['meta_desc'] = 'Site Administration';
?><h1>Admin Central</h1>

<p>
    Select an action from below:
</p>

<ul>
    <li><?php echo CHtml::link('Manage Pages', 'admin/pages'); ?></li>
    <li><?php echo CHtml::link('User management', 'admin/users'); ?></li>