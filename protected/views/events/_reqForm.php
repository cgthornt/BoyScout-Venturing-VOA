    
    <?php if($form === true) { echo '<div class="successbox">Event request successfully created!</div>'; } else { ?>
    <?php echo CHtml::beginForm(); ?>
    
	<div class="row">
		<?php echo CHtml::activeLabelEx($form,'title'); ?>
		<?php echo CHtml::activeTextField($form,'title'); ?>
		<?php echo CHtml::error($form,'title'); ?>
	</div>
    
	<div class="row">
		<?php echo CHtml::activeLabelEx($form,'body'); ?>
		<?php echo CHtml::activeTextArea($form,'body',array('rows'=>6, 'cols'=>90, 'required' => true)); ?>
		<?php echo CHtml::error($form,'body'); ?>
	</div>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton('Send Request'); ?>
	</div>
    
    <?php echo CHtml::endForm(); } ?>