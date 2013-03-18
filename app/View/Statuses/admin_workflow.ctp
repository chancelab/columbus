<?php echo $this->Html->script('jquery.min.js'); ?>
<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('Status Workflow');?></h2>

		<?php echo $this->BootstrapForm->input('role_id'); ?>
		<table class="table">
			<tr>
				<th><?php echo __('Now %s', __('Statuses'));?></th>
				<th colspan="<?php echo count($statuses);?>"><?php echo __('Allow Shift Status');;?></th>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<?php foreach ($statuses as $status): ?>
				<td><?php echo h($status['Status']['name']); ?>&nbsp;</td>
				<?php endforeach; ?>
			</tr>
			<tbody>
				<?php for ($i = 0; $i < count($statuses); $i++) : ?>
				<tr>
					<td><?php echo h($statuses[$i]['Status']['name']); ?>&nbsp;</td>
					<?php for ($j = 0; $j < count($statuses); $j++) : ?>
					<td><input id="chk_status_id_<?php echo $statuses[$i]['Status']['id']."_".$statuses[$j]['Status']['id'];?>" class="chk_status" type="checkbox" value="<?php echo $statuses[$i]['Status']['id']."/".$statuses[$j]['Status']['id'];?>">&nbsp;</td>
					<?php endfor; ?>
				</tr>
				<?php endfor; ?>
			</tbody>
		</table>

	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Statuses')), array('action' => 'index'));?></li>
		</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
	function saveStatusWorkflow(role_id, status_id, allow_shift_status_id, checked) {
		var postData = {};
		postData['data[StatusWorkflow][role_id]'] = role_id;
		postData['data[StatusWorkflow][status_id]'] = status_id;
		postData['data[StatusWorkflow][allow_shift_status_id]'] = allow_shift_status_id;
		postData['data[StatusWorkflow][is_add]'] = checked;

		$.ajax({
			type: 'POST',
			url : '<?php echo $this->Html->url(array('action' => 'admin_ajax_workflow_save')); ?>',
			data : postData,
			success : function(data, dataType) {
				var json = JSON.parse(data);
				if (json.result == 'success') {
				} else {
					alert('Internal Error');
				}
			},
		});
	}

	function getStatusWorkflow(role_id) {
		var postData = {};
		postData['data[StatusWorkflow][role_id]'] = role_id;

		$('.chk_status').unbind("change");
		// clear now status
		$('.chk_status').each(function() {
			$(this).attr("checked", false);
		});

		$.ajax({
			type: 'POST',
			url : '<?php echo $this->Html->url(array('action' => 'ajax_workflow')); ?>',
			data : postData,
			success : function(data, dataType) {
				var json = JSON.parse(data);
				if (json.result == 'success') {
					for (var row in json.data) {
						var workflow = json.data[row].StatusWorkflow;
						$('#chk_status_id_' + workflow.status_id + '_' + workflow.allow_shift_status_id).attr("checked", true);
					}
					$('.chk_status').bind("change", function(event) {
						var iddata = $(this).val().split('/');
						saveStatusWorkflow(role_id, iddata[0], iddata[1], $(this).is(':checked'));
					});
				} else {
					alert('Internal Error');
				}
			},
		});
	}

	$(document).ready(function(){
		$("#role_id").bind("change", function(event) {
			getStatusWorkflow($("#role_id").val());
		});
		getStatusWorkflow($("#role_id").val());
	});
</script>