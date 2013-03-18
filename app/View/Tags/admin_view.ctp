<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Tag');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($tag['Tag']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Name'); ?></dt>
			<dd>
				<?php echo h($tag['Tag']['name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($tag['Tag']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($tag['Tag']['modified']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Tag')), array('action' => 'edit', $tag['Tag']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Tag')), array('action' => 'delete', $tag['Tag']['id']), null, __('Are you sure you want to delete # %s?', $tag['Tag']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Tags')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Tag')), array('action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Idea Tags')); ?></h3>
	<?php if (!empty($tag['IdeaTag'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Idea Id'); ?></th>
				<th><?php echo __('Tag Id'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Modified'); ?></th>
			</tr>
		<?php foreach ($tag['IdeaTag'] as $ideaTag): ?>
			<tr>
				<td><?php echo $ideaTag['id'];?></td>
				<td><?php echo $ideaTag['idea_id'];?></td>
				<td><?php echo $ideaTag['tag_id'];?></td>
				<td><?php echo $ideaTag['user_id'];?></td>
				<td><?php echo $ideaTag['created'];?></td>
				<td><?php echo $ideaTag['modified'];?></td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
</div>
