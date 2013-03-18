<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Attachment');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($attachment['Attachment']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Name'); ?></dt>
			<dd>
				<?php echo h($attachment['Attachment']['name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($attachment['Attachment']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($attachment['Attachment']['modified']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Attachment')), array('action' => 'edit', $attachment['Attachment']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Attachment')), array('action' => 'delete', $attachment['Attachment']['id']), null, __('Are you sure you want to delete # %s?', $attachment['Attachment']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Attachments')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Attachment')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Idea Attachments')), array('controller' => 'idea_attachments', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Idea Attachment')), array('controller' => 'idea_attachments', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Idea Attachments')); ?></h3>
	<?php if (!empty($attachment['IdeaAttachment'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Idea Id'); ?></th>
				<th><?php echo __('Attachment Id'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($attachment['IdeaAttachment'] as $ideaAttachment): ?>
			<tr>
				<td><?php echo $ideaAttachment['id'];?></td>
				<td><?php echo $ideaAttachment['idea_id'];?></td>
				<td><?php echo $ideaAttachment['attachment_id'];?></td>
				<td><?php echo $ideaAttachment['user_id'];?></td>
				<td><?php echo $ideaAttachment['created'];?></td>
				<td><?php echo $ideaAttachment['modified'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'idea_attachments', 'action' => 'view', $ideaAttachment['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'idea_attachments', 'action' => 'edit', $ideaAttachment['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'idea_attachments', 'action' => 'delete', $ideaAttachment['id']), null, __('Are you sure you want to delete # %s?', $ideaAttachment['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('Idea Attachment')), array('controller' => 'idea_attachments', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
