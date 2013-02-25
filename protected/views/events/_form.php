
<div class="form">
<?php echo CHtml::beginForm(); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'sponsor'); ?>
		<?php echo CHtml::activeTextField($model,'sponsor', array('maxlength'=>124)); ?>
		<div class="nolabel">
			<p class="hint">
				The sponsor of this event (For example, <em>Crew 2040</em>)
			</p>
		</div>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'title'); ?>
		<?php echo CHtml::activeTextField($model,'title', array('maxlength'=>128)); ?>
	</div>

        <div class="row">
            <?php echo CHtml::activeLabelEx($model,'date');
            
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute'=>'date',            
            ));

        ?>
        </div>
    
        
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'contact_email'); ?>
		<?php echo CHtml::activeTextField($model,'contact_email', array('maxlength'=>128)); ?>
		<p class="hint">
			All contact requests will be sent to this email address. Your email will not
			be publically visible.
		</p>
	</div>
        
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'openings'); ?>
		<?php echo CHtml::activeTextField($model,'openings', array('maxlength'=>5)); ?>
		
		<p class="hint">
			The number of people you're looking for. Enter 0 if you don't have a specific
			amount of openings.
		</p>
	
	</div>
        
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'desc'); ?>
		<?php
		  $this->widget('application.extensions.tinymce.ETinyMce',
			array('name'=>'Events[desc]', 'value'=>$model->desc,
			      'options' => array('width' => 500, 'height' => 250)));
		  
		  ?>
		
		<p class="hint">
			The full description of the event. This should contain all of the details
			for the event.
		</p>
	</div>
	
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'brief_desc'); ?>
		<?php echo CHtml::activeTextArea($model,'brief_desc', array('rows' => 3, 'cols'=>50)); ?>
		<p class="hint">
			This is the description that will show up in search results.
			The brief description should catch the person's attention and
			get them to click on the full description. This is limited
			to 500 characters.
		</p>
	</div>
        
        <strong>Optional Items</strong>
        
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'url'); ?>
		<?php echo CHtml::activeTextField($model,'url', array('size' => 40)); ?>
		<p class="hint">
			The URL of the sponsor (i.e. http://www.crew2040.com).
			Must begin with an <strong>http://</strong>
		</p>
	</div>
	
	
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'address'); ?>
		<?php echo CHtml::activeTextField($model,'address', array('size' => 40)); ?>
	</div>
        
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'zip'); ?>
		<?php echo CHtml::activeTextField($model,'zip'); ?>
	</div>

    




	<div class="row submit">
            <div class="nolabel">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create Event' : 'Edit Event'); ?>
            
            </div>
        </div>
	<?php echo CHtml::endForm(); ?>
</div>
