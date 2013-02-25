<?php
        $this->page['title'] = 'Login';
        $this->page['meta_desc'] = 'Login to the Web site';
?>

<h1>Login</h1>


<p>You need to login to access all features of this Website</p>

<fieldset>
    <legend>Login</legend>
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
                <p class="hint">
                    <div class="nolabel">
			Don't have an account? <?php echo CHtml::link('Create an Account', 'user/create'); ?>.
                    </div>
                </p>
	</div>

	<div class="row rememberMe">
		<?php echo CHtml::activeLabel($model,''); ?>
                <?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
                <strong>Remember Me</strong>
		
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->
</fieldset>

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