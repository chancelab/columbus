<style type="text/css">
.controls input {
	width: 85%;
}
.controls textarea {
	width: 85%;
	height: 60px;
}
</style>
<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('List %s', __('Idea Responses'));?></h2>
		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table" style="word-wrap: break-word; word-break: break-all;">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('idea_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('user_id');?></th>
				<th style='width:50%;'><?php echo $this->BootstrapPaginator->sort('body');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('modified');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($ideaResponses as $ideaResponse): ?>
			<tr>
				<td><?php echo h($ideaResponse['IdeaResponse']['id']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($ideaResponse['Idea']['title'], '/ideas/view/'. $ideaResponse['Idea']['id']); ?>
				</td>
				<td>
					<?php echo $this->Html->link($ideaResponse['User']['last_name'] . " " . $ideaResponse['User']['first_name'], array('controller' => 'users', 'action' => 'view', $ideaResponse['User']['id'])); ?>
				</td>
				<td style='width:50%;'><?php echo h($ideaResponse['IdeaResponse']['body']); ?>&nbsp;</td>
				<td><?php echo h($ideaResponse['IdeaResponse']['modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ideaResponse['IdeaResponse']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $ideaResponse['IdeaResponse']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>

		<?php echo $this->BootstrapPaginator->pagination(); ?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0 8px 10px; margin-top:8px;">
		<?php echo $this->Form->create('IdeaResponse', array('controller' => 'idea_responses', 'action' => 'index')); ?>
		<fieldset>
			<legend style="margin-bottom: 0;"><?php echo __('Search');?></legend>
			<?php echo $this->Form->input('id', array('type' => 'number')); ?>
			<?php echo $this->Form->input('title'); ?>
			<?php echo $this->Form->input('name'); ?>
			<?php echo $this->Form->input('body'); ?>
		</fieldset>
		<?php echo $this->Form->end(__('Search')); ?>
		</div>
	</div>
</div>