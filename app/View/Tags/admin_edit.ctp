<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('Tag', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Admin Edit %s', __('Tag')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('name');
				echo $this->BootstrapForm->hidden('id');
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Tag.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Tag.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Tags')), array('action' => 'index'));?></li>
		</ul>
		</div>
	</div>
</div>