<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('List %s', __('Statuses'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('name');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('default');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('close_flg');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($statuses as $status): ?>
			<tr>
				<td><?php echo h($status['Status']['id']); ?>&nbsp;</td>
				<td><?php echo h($status['Status']['name']); ?>&nbsp;</td>
				<td><?php if ($status['Status']['default']) echo '<i class="icon-ok"></i>'; ?>&nbsp;</td>
				<td><?php if ($status['Status']['close_flg']) echo '<i class="icon-ok"></i>'; ?>&nbsp;</td>
				<td class="actions">
					<div class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo __('Menu'); ?><b class="caret"></b></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							<li role="presentation"><?php echo $this->Html->link('<i class="icon-edit"></i> ' . __('Edit'), array('action' => 'edit', $status['Status']['id']), array('escape' => false, 'role' => 'menuitem', 'tabindex' => -1)); ?></li>
							<li role="presentation"><?php echo $this->BootstrapForm->postLink('<i class="icon-remove-sign"></i> ' . __('Delete'), array('action' => 'delete', $status['Status']['id']), array('escape' => false, 'role' => 'menuitem', 'tabindex' => -1), __('Are you sure you want to delete # %s?', $status['Status']['id'])); ?></li>
							<li role="presentation"><?php echo $this->BootstrapForm->postLink('<i class="icon-star"></i> ' . __('Default Status'), array('action' => 'default_status', $status['Status']['id']), array('escape' => false, 'role' => 'menuitem', 'tabindex' => -1)); ?></li>
							<li role="presentation"><?php echo $this->BootstrapForm->postLink('<i class="icon-ok-sign"></i> ' . __('Close Status'), array('action' => 'close_status', $status['Status']['id']), array('escape' => false, 'role' => 'menuitem', 'tabindex' => -1)); ?></li>
							<li role="presentation"><?php echo $this->BootstrapForm->postLink('<i class="icon-arrow-up"></i> ' . __('Up Order'), array('action' => 'up_order', $status['Status']['id']), array('escape' => false, 'role' => 'menuitem', 'tabindex' => -1)); ?></li>
							<li role="presentation"><?php echo $this->BootstrapForm->postLink('<i class="icon-arrow-down"></i> ' . __('Down Order'), array('action' => 'down_order', $status['Status']['id']), array('escape' => false, 'role' => 'menuitem', 'tabindex' => -1)); ?></li>
						</ul>
					</div>
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
			<li><?php echo $this->Html->link(__('New %s', __('Status')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('Status Workflow'), array('action' => 'workflow')); ?></li>
		</ul>
		</div>
	</div>
</div>