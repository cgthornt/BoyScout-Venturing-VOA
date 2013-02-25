
<div class="form">
<?php echo CHtml::beginForm(); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'crew'); ?>
		<?php echo CHtml::activeTextField($model,'crew', array('maxlength'=>4)); ?>
	</div>
    
        
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'city'); ?>
		<?php echo CHtml::activeTextField($model,'city', array('maxlength'=>128)); ?>
	</div>
        
        
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'desc'); ?>
		<?php echo CHtml::activeTextArea($model,'desc', array('rows' => 5, 'cols'=>50)); ?>
	</div>
        
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'specialties'); ?>
		<?php echo CHtml::activeTextArea($model,'specialties', array('rows' => 5, 'cols'=>50)); ?>
	</div>
        
        <strong>Optional Items</strong>
        
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'address'); ?>
		<?php echo CHtml::activeTextField($model,'address', array('size' => 40)); ?>
	</div>
        
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'zip'); ?>
		<?php echo CHtml::activeTextField($model,'zip'); ?>
	</div>
        
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'Web site'); ?>
		<?php echo CHtml::activeTextField($model,'url'); ?>
	</div>

    




	<div class="row submit">
            <div class="nolabel">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create Crew' : 'Edit Crew'); ?>
            
            </div>
        </div>
</div>
<?php echo CHtml::endForm(); ?>