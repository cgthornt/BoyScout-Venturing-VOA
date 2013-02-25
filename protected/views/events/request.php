<?php
$this->page['title'] = 'Event details for ' . CHtml::encode($model->title);

?>
<p style="margin-left: 0px;padding-left:0px">
    <?php
	echo CHtml::link('&laquo; back', 'events');
	
	// Actions if the user can edit this
	if($model->canEdit() || Yii::app()->user->isAdmin())
	{

	    echo ' -  ', CHtml::link('edit', 'events/edit?id=' . $model->ID), ' - ';
	    
	    echo CHtml::link('delete', '#', array(
	       'onclick'=>'return confirm(\'Are you sure you want to delete this event?\')',
	    ));

	}
    
    ?>
</p>

<div class="post">
    <div class="title"><?php echo $model->title; ?></div>
    <div class="author">hosted by
            <?php echo CHtml::link('Crew ' . $model->crew->crew,
                              'crews/' . $model->crew->ID); ?>
            on <strong><?php echo date("F n @ g:i a",strtotime($model->date)); ?></strong>
    </div>
    
    
    <div class="content">
        <p>
        <?php echo strip_tags($model->desc, '<p><br><br /><b><i><s>'); ?>
        </p>
    </div>

    <div class="nav">
        <b>Additional Information</b><br />
		Slots Available: <?php echo $model->openings; ?> 
                <?php if(!empty($model->zip)) { ?>
		| Meeting Zip: <?php echo $model->zip;  }?><br />
        
    </div>

    <?php if(!Yii::app()->user->isGuest) { ?>
    <h2 style="margin-top:20px">Contact Request</h2>
    <div class="form" style="margin-top:15px">
    Want to learn more about this event or meet up? Fill out the form below!
    <?php $this->renderPartial('_reqForm', array('form' => $form)); ?>
    </div>
    
    <?php } else { ?>
        <div class="msgbox" style="margin-top:15px">
            You must be logged in to submit a contact request.
            <?php echo CHtml::link('Login now', 'site/login'); ?>.
        </div>
    
    <?php
    }
    if(!empty($model->zip))
    {
    
    ?>
    
    <div class="mapcontainer">
        <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?near=<?php echo $model->zip; ?>&amp;output=embed"></iframe>
        <br /><em>Notice: this is only an estimate based off a ZIP code</em>
        <br /><a href="http://maps.google.com/maps?near=<?php echo $model->zip; ?>">View Larger Map</a>
    </div>
    <?php
    }    
    ?>

</div>