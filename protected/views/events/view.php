<?php
        $this->page['title'] = 'View Events';
        $this->page['meta_desc'] = 'View upcoming events';
?>
<h1>Events</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_eventDetail',
        'ajaxVar' => false,
)); ?>
