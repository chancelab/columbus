<?php echo $this->Html->css('star');?>
<script type="text/javascript" src="<?php echo Router::url('/', true) ?>js/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo Router::url('/', true) ?>js/jquery.eComboBox.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo Router::url('/', true) ?>js/star.js" charset="utf-8"></script>
<div class="modal fade" id="commentModal"></div>
<div id="searchModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<?php echo $this->BootstrapForm->create('Idea');?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel"><?php echo __('Advanced Search'); ?></h3>
	</div>
	<div class="modal-body">
	<?php
		echo $this->BootstrapForm->input('id', array('type' => 'number'));
		echo $this->BootstrapForm->input('status_id', array('multiple' => 'checkbox', 'div' => 'horizontal-control-group'));
		echo $this->BootstrapForm->input('tag_id', array('multiple' => 'checkbox', 'div' => 'horizontal-control-group'));
		echo $this->BootstrapForm->input('title');
		echo $this->BootstrapForm->input('body', array('type' => 'text'));
		/* TODO: 表示側の実装は完了しているが、Controller側の実装が終わっていないため、いったんコメントアウト
		$counter = 0;
		foreach ($addInputs as $addInput) {
			echo $this->BootstrapForm->input("IdeaAddInput.$counter.input_item_id", array('type' => 'hidden', 'value' => $addInput['InputItem']['id']));
			switch ($addInput['InputItem']['type']) {
				case INPUT_TYPE_STRING:
					echo $this->BootstrapForm->input("IdeaAddInput.$counter.body", array('type' => 'text', 'label' => $addInput['InputItem']['name']));
					break;
				case INPUT_TYPE_TEXT:
					echo $this->BootstrapForm->label($addInput['InputItem']['name']);
					echo $this->BootstrapForm->textarea("IdeaAddInput.$counter.body");
					break;
			}
			$counter++;
		}
		*/
	?>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<?php echo $this->BootstrapForm->button(__('Search'), array('type' => 'submit', 'class' => 'btn btn-success')); ?>
	</div>
	<?php echo $this->BootstrapForm->end(); ?>
</div>
<div class="hide">
	<form id="showboard" name="showboard" method="post" action="<?php echo $this->Html->url(array('controller' => 'ideas', 'action' => 'index', 'board')); ?>">
		<input name="page" type="hidden" value="idea">
		<input name="layout" type="hidden" value="board">
	</form>
</div>
<div class="ideas index">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#home" data-toggle="tab">Home</a></li>
		<li><?php echo $this->Html->link(__('Board'), array('controller' => 'ideas', 'action' => 'index', 'board'), array('onclick' => "document.showboard.submit(); return false;")); ?></li>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Actions <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<?php if ($this->Session->check('Auth.User.id')) : ?>
				<li><?php echo $this->Html->link(__('New Idea'), array('action' => 'add')); ?></li>
				<?php endif; ?>
				<li><a href="#searchModal" data-toggle="modal"><?php echo __('Advanced Search'); ?></a></li>
			</ul>
		</li>
	</ul>
	<?php
		echo $this->BootstrapForm->create('IdeaTag', array('class' => 'tag-search-form form-inline', 'url' => array('controller' => 'ideas', 'action' => 'index')));
		echo $this->BootstrapForm->input('tag_id', array('label' => __('idea tag'), 'class' => 'edit'));
		echo $this->BootstrapForm->button(__('Search'), array('type' => 'submit', 'class' => 'btn btn-success'));
		echo $this->BootstrapForm->end();
	?>
	<table class="table table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->BootstrapPaginator->sort('id', __('ID').'<i class="icon-sort"></i>', array('escape' => false)); ?></th>
			<th><?php echo $this->BootstrapPaginator->sort('User.first_name', __('Name').'<i class="icon-sort"></i>', array('escape' => false)); ?></th>
			<th><?php echo $this->BootstrapPaginator->sort('status_id', __('Status').'<i class="icon-sort"></i>', array('escape' => false)); ?></th>
			<th><?php echo $this->BootstrapPaginator->sort('title', __('Title').'<i class="icon-sort"></i>', array('escape' => false)); ?></th>
			<?php if(!$this->SmartPhone->isSmartPhone()): ?>
				<th><?php echo $this->BootstrapPaginator->sort('body', __('Body').'<i class="icon-sort"></i>', array('escape' => false)); ?></th>
			<?php endif; ?>
			<th><?php echo $this->BootstrapPaginator->sort('modified', __('Modified').'<i class="icon-sort"></i>', array('escape' => false, "direction" => "desc")); ?></th>
			<?php if(!$this->SmartPhone->isSmartPhone()): ?>
				<th><?php echo $this->BootstrapPaginator->sort('total_ratings', __('Votes').'<i class="icon-sort"></i>', array('escape' => false, "direction" => "desc"));?></th>
				<th><?php echo $this->BootstrapPaginator->sort('idea_responses_count', __('CommentCount').'<i class="icon-sort"></i>', array('escape' => false, "direction" => "desc"));?></th>
			<?php endif; ?>
			<th><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($ideas as $idea): ?>
	<tr>
		<td class="td-id"><?php echo h($idea['Idea']['id']); ?>&nbsp;</td>
		<td class="td-user"><?php echo h($idea['User']['last_name']) . "&nbsp;" . h($idea['User']['first_name']); ?>&nbsp;</td>
		<td class="td-status-<?php echo h($idea['Status']['id']); ?>"><?php echo h($idea['Status']['name']); ?>&nbsp;</td>
		<td class="td-title"><?php echo $this->Html->link($this->MbText->truncate(h($idea['Idea']['title']),15), array('action' => 'view', $idea['Idea']['id'])); ?></td>
		<?php if(!$this->SmartPhone->isSmartPhone()): ?>
			<td class="td-body"><?php echo $this->MbText->truncate(strip_tags($idea['Idea']['body']),20); ?>&nbsp;</td>
		<?php endif; ?>
		<td class="td-modified"><?php echo h($idea['Idea']['modified']); ?>&nbsp;</td>
		<?php if(!$this->SmartPhone->isSmartPhone()): ?>
			<td	class="td-total_ratings">
				<div class="star-rect" onmousemove="star.start(event, this, <?php echo h($idea['Idea']['id']);?>, {<?php if ($this->Session->check('Auth.User.id') == false || $this->Session->read('Auth.User.id') == $idea['Idea']['user_id']) echo "disabled: true,";?>length:3, step:1, sendto: '<?php echo $this->Html->url(array('controller' => 'IdeaRatings', 'action' => 'vote', $idea['Idea']['id']), true); ?>'});"><ul><li>&nbsp;</li><li style="width: <?php echo $idea['Idea']['ratings'] * 33; ?>%;">&nbsp;</li></ul></div>
				<div class="star-text">
					<span><i class="icon-star"></i><span id="starTotalRating<?php echo h($idea['Idea']['id']);?>"><?php echo $idea['Idea']['total_ratings']; ?></span></span>
					<span class="star-text-users">(<span id="starUsers<?php echo h($idea['Idea']['id']);?>"><?php echo $idea['Idea']['ratings_count']; ?></span>users)</span>
					<span class="star-text-alert"><span id="starAlert<?php echo h($idea['Idea']['id']);?>"></span></span>
				</div>
			</td>
			<td class="td-idea_responses_count<?php if ($idea['Idea']['new_comment']) echo " new"; ?>">
			<?php
				if ($idea['Idea']['idea_responses_count'] == 0){
					echo "<span class='push-num'>" . h($idea['Idea']['idea_responses_count']) . "</span>";
				} else {
			?>
					<a href='#' rel="tooltip"  data-original-title="<?php
						echo __('latest comment') .
						__('Created') . '：' . $idea['Idea']['new_comment_body']['IdeaResponse']['created'] . ' ' .
						__('Modified') . '：' . $idea['Idea']['new_comment_body']['User']['last_name'] . ' ' . $idea['Idea']['new_comment_body']['User']['first_name'] . ' ' .
						__('Comment') . '：「' . $idea['Idea']['new_comment_body']['IdeaResponse']['body'].'」';
						?>" comment_id='<?php echo $idea['Idea']['id']; ?>' >
						<?php echo h($idea['Idea']['idea_responses_count']); ?>
					</a>
			<?php
				}
			?>
			<?php if ($idea['Idea']['new_comment']) { ?>
				<span>New!!</span>
			<?php } ?>
			</td>
		<?php endif; ?>
		<td class="actions">
			<?php if(!$this->SmartPhone->isSmartPhone()): ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $idea['Idea']['id']), array('class' => 'btn btn-small btn-primary')); ?>
			<?php endif; ?>
			<?php
				if($this->Session->read('Auth.User.role_id') == ADMIN_ROLE_INDEX || $this->Session->read('Auth.User.id') == $idea['User']['id']){
					echo $this->Html->link(__('Edit'), array('action' => 'edit', $idea['Idea']['id']), array('class' => 'btn btn-small btn-info'));
				}
			?>
			<?php if ($this->Session->check('Auth.User.id')) : ?>
			<a data-toggle="modal" class="btn btn-small" href="<?php echo Router::url('/IdeaResponses/add/'.$idea['Idea']['id'], true); ?>" data-target="#commentModal"><?php echo __('Comment');?></a>
			<?php endif; ?>
			<?php
				if($this->Session->read('Auth.User.role_id') == ADMIN_ROLE_INDEX ||
					($this->Session->read('Auth.User.id') == $idea['User']['id'] && $idea['Idea']['idea_responses_count'] == 0)){
					echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $idea['Idea']['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $idea['Idea']['id']));
				}
			?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<?php echo $this->BootstrapPaginator->pagination(); ?>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('a[rel=tooltip]').tooltip();
		$('a[data-toggle=modal]').each(function(){
			$(this).click(function() {
				var target = $(this).attr('data-target');
				var url = $(this).attr('href');
				$(target).load(url);
			});
		});
	});

	$('select.edit').eComboBox({'newItemText' : '(自由入力)', 'editableElements' : false});
	$('#IdeaIndexForm input[type!="submit"][type!="button"]').keypress(function(ev) {
		if ((ev.which && ev.which === 13) || (ev.keyCode && ev.keyCode === 13)) {
			$('#IdeaIndexForm').submit();
		} else {
			return true;
		}
	});
</script>