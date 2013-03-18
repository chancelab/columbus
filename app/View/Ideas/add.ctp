<?php echo $this->Html->script('jquery.min.js'); ?>
<?php echo $this->Html->script('jquery.smartupdater.js'); ?>
<div class="ideas form" style="margin-top: 50px;">
<?php
	echo $this->Form->create('Idea', array('type' => 'file'));
?>
	<fieldset>
		<legend><?php echo __('Add Idea'); ?></legend>
		<?php
			echo $this->Form->input('status_id', array('default' => $defaultStatus));
			echo $this->Form->input('title');
			echo $this->Form->input('body');
			$counter = 0;
			foreach ($addInputs as $addInput) {
				echo $this->Form->input("IdeaAddInput.$counter.input_item_id", array('type' => 'hidden', 'value' => $addInput['InputItem']['id']));
				switch ($addInput['InputItem']['type']) {
					case INPUT_TYPE_STRING:
						echo $this->Form->input("IdeaAddInput.$counter.body", array('type' => 'string', 'label' => $addInput['InputItem']['name']));
						break;
					case INPUT_TYPE_TEXT:
						echo $this->Form->label($addInput['InputItem']['name']);
						echo $this->Form->textarea("IdeaAddInput.$counter.body");
						break;
					case INPUT_TYPE_FILES:
						echo $this->Form->hidden("Attachment.$counter.model", array('value'=>'Idea'));
						echo $this->Form->input("Attachment.$counter.files", array('type' => 'file', 'label' => $addInput['InputItem']['name']));
						break;
				}
				$counter++;
			}
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div id="heartBeat"></div>
<?php if(!$this->SmartPhone->isSmartPhone()): ?>
<script type="text/javascript" src="<?php echo Router::url('/', true) ?>js/jquery-te-1.2.min.js" charset="utf-8"></script>
<?php echo $this->Html->css('jquery-te-1.2'); ?>
<script>
	$('textarea').jqte();
	$('#heartBeat').smartupdater({
			url : "<?php echo Router::url('/ajax/heartBeat', true); ?>",
		}, function (data) {
			var json = JSON.parse(data);
			if (json.result !== 'success') {
				$('#heartBeat').smartupdater("stop");
				alert('<?php echo __('Session Timeout'); ?>');
			}
		}
	);
</script>
<?php endif; ?>
