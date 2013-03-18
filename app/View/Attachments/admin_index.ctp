<div class="row-fluid">
		<h2><?php echo __('List %s', __('Attachments'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('model');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('foreign_key');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('dir');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('name');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('thumbnail');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($attachments as $attachment): ?>
			<tr>
				<td><?php echo h($attachment['Attachment']['id']); ?>&nbsp;</td>
				<td><?php echo h($attachment['Attachment']['model']); ?>&nbsp;</td>
				<td><?php echo h($attachment['Attachment']['foreign_key']); ?>&nbsp;</td>
				<td><?php echo h($attachment['Attachment']['dir']); ?>&nbsp;</td>
				<td><?php echo h($attachment['Attachment']['name']); ?>&nbsp;</td>
				<td width="150"><?php echo $this->Attachment->renderFileTag($attachment); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $attachment['Attachment']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $attachment['Attachment']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>

		<?php echo $this->BootstrapPaginator->pagination(); ?>
</div>
