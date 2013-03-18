<?php echo $this->BootstrapForm->create('IdeaResponse', array('class' => 'form-horizontal', 'style' => 'margin:0;'));?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h3><?php echo __('Add %s', __('Comment')); ?></h3>
</div>
<div class="modal-body">
	<fieldset>
		<?php
		echo $this->BootstrapForm->input('idea_id', array(
						"type" => "hidden",
						"value" => $ideaId)
		);
		echo $this->BootstrapForm->input('body', array('label' => false, 'div' => false, 'rows' => 10, 'style' => 'width:98%;'));
		?>
	</fieldset>
</div>
<div class="modal-footer">
	<a href="#" class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Close'); ?></a>
	<?php echo $this->BootstrapForm->submit(__('Submit'), array('div' => false, 'class' => 'btn btn-primary'));?>
</div>
<?php echo $this->BootstrapForm->end();?>
