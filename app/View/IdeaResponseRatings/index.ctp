<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('List %s', __('Idea Response Ratings'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('idea_response_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('user_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('rating');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('modified');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($ideaResponseRatings as $ideaResponseRating): ?>
			<tr>
				<td><?php echo h($ideaResponseRating['IdeaResponseRating']['id']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($ideaResponseRating['IdeaResponse']['id'], array('controller' => 'idea_responses', 'action' => 'view', $ideaResponseRating['IdeaResponse']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($ideaResponseRating['User']['username'], array('controller' => 'users', 'action' => 'view', $ideaResponseRating['User']['id'])); ?>
				</td>
				<td><?php echo h($ideaResponseRating['IdeaResponseRating']['rating']); ?>&nbsp;</td>
				<td><?php echo h($ideaResponseRating['IdeaResponseRating']['created']); ?>&nbsp;</td>
				<td><?php echo h($ideaResponseRating['IdeaResponseRating']['modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $ideaResponseRating['IdeaResponseRating']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $ideaResponseRating['IdeaResponseRating']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ideaResponseRating['IdeaResponseRating']['id']), null, __('Are you sure you want to delete # %s?', $ideaResponseRating['IdeaResponseRating']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>

		<?php echo $this->BootstrapPaginator->pagination(); ?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Idea Response Rating')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Idea Responses')), array('controller' => 'idea_responses', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Idea Response')), array('controller' => 'idea_responses', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>