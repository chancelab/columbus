<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('List %s', __('Users'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('username');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('role_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('last_name');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('first_name');?></th>
				<?php
					if ($setting['AppSetting']['any_useradd'] == ANY_USERADD_ADMIN) {
						echo "<th>" . $this->BootstrapPaginator->sort('appd_flg') . "</th>";
					}
				?>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('modified');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($users as $user): ?>
			<tr>
				<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
				<td><?php echo h($user['Role']['name']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['first_name']); ?>&nbsp;</td>
				<?php if ($setting['AppSetting']['any_useradd'] == ANY_USERADD_ADMIN) : ?>
				<td>
					<div class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<?php
						if ($user['User']['appd_flg'] === true) {
							echo __('APPD');
						} else if ($user['User']['appd_flg'] === false) {
							echo __('REJECT');
						} else {
							echo __('WAITING');
						}
				?>
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							<li role="presentation"><?php echo $this->BootstrapForm->postLink(__('Approve This User'), array('action' => 'appd_user', $user['User']['id']), array('role' => 'menuitem', 'tabindex' => -1)); ?></li>
							<li role="presentation"><?php echo $this->BootstrapForm->postLink(__('Reject This User'), array('action' => 'reject_user', $user['User']['id']), array('role' => 'menuitem', 'tabindex' => -1)); ?></li>
						</ul>
					</div>
				</td>
				<?php endif; ?>
				<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->BootstrapHtml->link(__('Edit'), array('action' => 'edit', $user['User']['id']), array('class' => 'btn btn-info')); ?>
					<?php echo $this->BootstrapForm->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
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
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>