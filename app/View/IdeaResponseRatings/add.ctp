<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('IdeaResponseRating', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Add %s', __('Idea Response Rating')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('idea_response_id', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('user_id');
				echo $this->BootstrapForm->input('rating', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Idea Response Ratings')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Idea Responses')), array('controller' => 'idea_responses', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Idea Response')), array('controller' => 'idea_responses', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>