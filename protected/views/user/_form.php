

<fieldset>
    <legend>Edit User</legend>
<div class="form">
<?php echo CHtml::beginForm(); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'username'); ?>
		<?php echo CHtml::activeTextField($model,'username'); ?>
	</div>

        
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'email'); ?>
		<?php echo CHtml::activeTextField($model,'email'); ?>
	</div>



	<div class="row submit">
            <div class="nolabel">
		<?php echo CHtml::submitButton('Modify Account'); ?>
            
            </div>
        </div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->
</fieldset>