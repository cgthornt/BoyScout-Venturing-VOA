<div class="post" id="c<?php echo $data->ID; ?>">
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id'=>'event_' . $data->ID,
        // additional javascript options for the dialog plugin
        'options'=>array(
            'title'=> 'Details for ' . CHtml::encode($data->title),
            'autoOpen'=>false,
            'modal' => true,
            'width' => 600,
            'height' => 400,
        ),
    ));
    
    echo strip_tags($data->desc, '<p><br><br /><b><i><s>');
    
    $this->endWidget('zii.widgets.jui.CJuiDialog');

    ?>



	<div class="title"><?php echo CHtml::link($data->title, 'events/' .$data->ID); ?></div>
        <div class="author">hosted by
		<?php
                if(empty($data->url))
                    echo CHtml::encode($data->sponsor);
                else
                {
                    echo '<a href="', CHtml::encode($data->url), '" target="_blank">',
                          CHtml::encode($data->sponsor), '</a>';
                }
                ?>
		on <strong><?php echo date("F j",strtotime($data->date)); ?></strong>
	</div>
        <div class="content">
            <p>
            <?php echo CHtml::encode($data->brief_desc); ?>
            </p>
        </div>
	
	<div class="nav">
		Slots Available: <?php echo $data->openings == 0 ? '<em>None specified</em>' : $data->openings; ?> |
		<?php
		if(!empty($data->address))
			echo 'Address: ', CHtml::encode($data->address);
		
		if(!empty($data->zip))
			echo 'Meeting Zip: ', $data->zip, '<br />';
		
                
                echo CHtml::link('More details', '#', array(
                   'onclick'=>'$("#event_' . $data->ID . '").dialog("open"); return false;',
                ));
                
                echo ' &bull; ';

                
		echo CHtml::link('Request more information', 'events/' .$data->ID);
                
                if(Yii::app()->user->isAdmin() || Yii::app()->user->id == $data->ID_USER)
                {
                    echo ' | ' . CHtml::link('Edit Event', 'events/edit/id/' . $data->ID) .
                         ' &bull; ' . 
                         CHtml::link('Delete Event', 'events/delete/id/' . $data->ID,  array(
                            'onClick' => 'return confirm(\'Are you sure you want to delete this event? This cannot be undone!\')',
                         ));
                }
                
                ?>
	</div>


</div>