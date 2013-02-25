<?php
        $this->page['title'] = 'Registration';
        $this->page['meta_desc'] = 'Register to the Web site';
?>

<h1>Registration</h1>

<p>You need to create an account to access all features of this Web site</p>

<fieldset>
    <legend>Registration</legend>
<div class="form">
<?php echo CHtml::beginForm(); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'username'); ?>
		<?php echo CHtml::activeTextField($model,'username'); ?>
	</div>
        
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'password'); ?>
		<?php echo CHtml::activePasswordField($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'confirm password'); ?>
		<?php echo CHtml::activePasswordField($model,'password2'); ?>
	</div>
        
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'email'); ?>
		<?php echo CHtml::activeTextField($model,'email'); ?>
	</div>
        
	<?php if(extension_loaded('gd')): ?>
	<div class="row">
		<div class="nolabel">
		<?php $this->widget('CCaptcha'); ?>
                </div>
        </div>
        
        <div class="row">
                <?php echo CHtml::activeLabelEx($model,'verifyCode'); ?>
		<?php echo CHtml::activeTextField($model,'verifyCode'); ?>
		<div class="hint">
                    <div class="nolabel">
                    Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div></div>
	</div>
	<?php endif; ?>
        
        <p class="hint">
            <div class="nolabel">
                Already have an account? <?php echo CHtml::link('Login now', 'user/login'); ?>.
            </div>
        </p>



	<div class="row submit">
            <div class="nolabel">
		<?php echo CHtml::submitButton('Create Account'); ?>
            
            </div>
        </div>
</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->

<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>