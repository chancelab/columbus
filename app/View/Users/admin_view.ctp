<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('User');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($user['User']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Username'); ?></dt>
			<dd>
				<?php echo h($user['User']['username']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Role'); ?></dt>
			<dd>
				<?php echo h($user['Role']['name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Last Name'); ?></dt>
			<dd>
				<?php echo h($user['User']['last_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('First Name'); ?></dt>
			<dd>
				<?php echo h($user['User']['first_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Email Address'); ?></dt>
			<dd>
				<?php echo h($user['User']['email_address']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Comment'); ?></dt>
			<dd>
				<?php echo h($user['User']['comment']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($user['User']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($user['User']['modified']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('User')), array('action' => 'edit', $user['User']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('User')), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Ideas')); ?></h3>
	<?php if (!empty($user['Idea'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Status Id'); ?></th>
				<th><?php echo __('Title'); ?></th>
				<th><?php echo __('Body'); ?></th>
				<th><?php echo __('Delete Flg'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($user['Idea'] as $idea): ?>
			<tr>
				<td><?php echo $idea['id'];?></td>
				<td><?php echo $idea['user_id'];?></td>
				<td><?php echo $idea['status_id'];?></td>
				<td><?php echo $idea['title'];?></td>
				<td><?php echo $idea['body'];?></td>
				<td><?php echo $idea['delete_flg'];?></td>
				<td><?php echo $idea['created'];?></td>
				<td><?php echo $idea['modified'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'ideas', 'action' => 'view', $idea['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'ideas', 'action' => 'edit', $idea['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'ideas', 'action' => 'delete', $idea['id']), null, __('Are you sure you want to delete # %s?', $idea['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('Idea')), array('controller' => 'ideas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Idea Ratings')); ?></h3>
	<?php if (!empty($user['IdeaRating'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Idea Id'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Rating'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($user['IdeaRating'] as $ideaRating): ?>
			<tr>
				<td><?php echo $ideaRating['id'];?></td>
				<td><?php echo $ideaRating['idea_id'];?></td>
				<td><?php echo $ideaRating['user_id'];?></td>
				<td><?php echo $ideaRating['rating'];?></td>
				<td><?php echo $ideaRating['created'];?></td>
				<td><?php echo $ideaRating['modified'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'idea_ratings', 'action' => 'view', $ideaRating['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'idea_ratings', 'action' => 'edit', $ideaRating['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'idea_ratings', 'action' => 'delete', $ideaRating['id']), null, __('Are you sure you want to delete # %s?', $ideaRating['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('Idea Rating')), array('controller' => 'idea_ratings', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Idea Responses')); ?></h3>
	<?php if (!empty($user['IdeaResponse'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Idea Id'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Body'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($user['IdeaResponse'] as $ideaResponse): ?>
			<tr>
				<td><?php echo $ideaResponse['id'];?></td>
				<td><?php echo $ideaResponse['idea_id'];?></td>
				<td><?php echo $ideaResponse['user_id'];?></td>
				<td><?php echo $ideaResponse['body'];?></td>
				<td><?php echo $ideaResponse['created'];?></td>
				<td><?php echo $ideaResponse['modified'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'idea_responses', 'action' => 'view', $ideaResponse['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'idea_responses', 'action' => 'edit', $ideaResponse['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'idea_responses', 'action' => 'delete', $ideaResponse['id']), null, __('Are you sure you want to delete # %s?', $ideaResponse['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('Idea Response')), array('controller' => 'idea_responses', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Idea Response Ratings')); ?></h3>
	<?php if (!empty($user['IdeaResponseRating'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Idea Response Id'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Rating'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($user['IdeaResponseRating'] as $ideaResponseRating): ?>
			<tr>
				<td><?php echo $ideaResponseRating['id'];?></td>
				<td><?php echo $ideaResponseRating['idea_response_id'];?></td>
				<td><?php echo $ideaResponseRating['user_id'];?></td>
				<td><?php echo $ideaResponseRating['rating'];?></td>
				<td><?php echo $ideaResponseRating['created'];?></td>
				<td><?php echo $ideaResponseRating['modified'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'idea_response_ratings', 'action' => 'view', $ideaResponseRating['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'idea_response_ratings', 'action' => 'edit', $ideaResponseRating['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'idea_response_ratings', 'action' => 'delete', $ideaResponseRating['id']), null, __('Are you sure you want to delete # %s?', $ideaResponseRating['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('Idea Response Rating')), array('controller' => 'idea_response_ratings', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
