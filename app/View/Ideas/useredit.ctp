<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('My Profile'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('password',array('required'=>false,'value'=>''));
		echo $this->Form->input('tmp_password',array('type'=>'password','required'=>false));
		echo $this->Form->input('last_name');
		echo $this->Form->input('first_name');
		echo $this->Form->input('email_address',array('type'=>'email'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

