<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Input Item');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($inputItem['InputItem']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Name'); ?></dt>
			<dd>
				<?php echo h($inputItem['InputItem']['name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Type'); ?></dt>
			<dd>
				<?php echo h($inputItem['InputItem']['type']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Comment'); ?></dt>
			<dd>
				<?php echo h($inputItem['InputItem']['comment']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($inputItem['InputItem']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($inputItem['InputItem']['modified']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Input Item')), array('action' => 'edit', $inputItem['InputItem']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Input Item')), array('action' => 'delete', $inputItem['InputItem']['id']), null, __('Are you sure you want to delete # %s?', $inputItem['InputItem']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Input Items')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Input Item')), array('action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Idea Add Inputs')); ?></h3>
	<?php if (!empty($inputItem['IdeaAddInput'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Idea Id'); ?></th>
				<th><?php echo __('Input Item Id'); ?></th>
				<th><?php echo __('Body'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($inputItem['IdeaAddInput'] as $ideaAddInput): ?>
			<tr>
				<td><?php echo $ideaAddInput['id'];?></td>
				<td><?php echo $ideaAddInput['idea_id'];?></td>
				<td><?php echo $ideaAddInput['input_item_id'];?></td>
				<td><?php echo $ideaAddInput['body'];?></td>
				<td><?php echo $ideaAddInput['created'];?></td>
				<td><?php echo $ideaAddInput['modified'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'idea_add_inputs', 'action' => 'view', $ideaAddInput['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'idea_add_inputs', 'action' => 'edit', $ideaAddInput['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'idea_add_inputs', 'action' => 'delete', $ideaAddInput['id']), null, __('Are you sure you want to delete # %s?', $ideaAddInput['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('Idea Add Input')), array('controller' => 'idea_add_inputs', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
