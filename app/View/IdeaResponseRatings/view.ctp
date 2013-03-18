<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Idea Response Rating');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($ideaResponseRating['IdeaResponseRating']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Idea Response'); ?></dt>
			<dd>
				<?php echo $this->Html->link($ideaResponseRating['IdeaResponse']['id'], array('controller' => 'idea_responses', 'action' => 'view', $ideaResponseRating['IdeaResponse']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('User'); ?></dt>
			<dd>
				<?php echo $this->Html->link($ideaResponseRating['User']['username'], array('controller' => 'users', 'action' => 'view', $ideaResponseRating['User']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Rating'); ?></dt>
			<dd>
				<?php echo h($ideaResponseRating['IdeaResponseRating']['rating']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($ideaResponseRating['IdeaResponseRating']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($ideaResponseRating['IdeaResponseRating']['modified']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Idea Response Rating')), array('action' => 'edit', $ideaResponseRating['IdeaResponseRating']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Idea Response Rating')), array('action' => 'delete', $ideaResponseRating['IdeaResponseRating']['id']), null, __('Are you sure you want to delete # %s?', $ideaResponseRating['IdeaResponseRating']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Idea Response Ratings')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Idea Response Rating')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Idea Responses')), array('controller' => 'idea_responses', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Idea Response')), array('controller' => 'idea_responses', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

