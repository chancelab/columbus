<?php echo $this->Html->css('star');?>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo Router::url('/', true) ?>js/jquery.eComboBox.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo Router::url('/', true) ?>js/jquery.jStageAligner.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo Router::url('/', true) ?>js/star.js" charset="utf-8"></script>
<div class="modal fade" id="commentModal"></div>
<div class="ideas view">
<h2><?php  echo __('Idea'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Tag');?></dt>
		<dd>
			<?php
				if ($this->Session->check('Auth.User.id')) {
					echo $this->Form->create('IdeaTag', array('action' => 'addTag', 'name' => 'IdeaTagAddTagForm', 'class' => 'form-inline'));
					echo $this->Form->input('idea_id', array('type' => 'hidden', 'value' => $idea['Idea']['id']));
					echo $this->Form->input('tag_id', array('label' => false, 'class' => 'edit input-select'));
					echo $this->Form->button(__('AddTag'), array('type' => 'button', 'class' => 'btn btn-success', 'onClick' => 'sendAddTag();'));
					echo $this->Form->end();
				}
			?>
			<div id='tag-list'>
			<?php
				foreach ($idea['IdeaTag'] as $ideaTag) {
					foreach (array_keys($tags) as $tagId) {
						if ($tagId == $ideaTag['tag_id']) {
							echo "<span class='tag' id='tag_$tagId'><i class='icon-tag'></i> $tags[$tagId] ";
							if ($this->Session->check('Auth.User.id')) {
								echo "<i class='icon-remove' onclick='removeTag($tagId);'></i>";
							}
							echo "</span>";
						}
					}
				}
			?>
			</div>
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php #echo $this->Html->link($idea['User']['username'], array('controller' => 'users', 'action' => 'view', $idea['User']['id'])); ?>
			<?php echo $users[$idea['User']['id']]; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($idea['Status']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<div class="well">
				<?php echo h($idea['Idea']['title']); ?>
			</div>
		</dd>
		<dt><?php echo __('Body'); ?></dt>
		<dd>
			<div class="well">
				<?php echo nl2br($idea['Idea']['body']); ?>
			</div>
		</dd>

<?php
	if (!empty($idea['IdeaAddInput'])) {
		$i = 0;
		foreach ($idea['IdeaAddInput'] as $ideaAddInput):
			if (!isset($addInputs[$ideaAddInput['input_item_id']])) continue;
			if (strlen($ideaAddInput['body']) == 0 ) continue;
?>
		<dt><?php echo $addInputs[$ideaAddInput['input_item_id']]; ?></dt>
		<dd>
			<div class="well">
				<?php echo $ideaAddInput['body']; ?>
			</div>
		</dd>
	<?php $i++; endforeach; ?>
	<?php if (!empty($attachments)) { ?>
	<dt><?php echo __('Attachment Files'); ?></dt>
	<dd>
		<div class="row">
		<?php foreach ($attachments as $file) : ?>
			<?php
				echo '<div class="span2 attachfile-box">';
				echo $this->Attachment->renderFileTag($file);
				echo '</div>';
			?>
		<?php endforeach; ?>
		</div>
	</dd>
<?php
		}
	}
?>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($idea['Idea']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($idea['Idea']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div id="comment"></div>
<div class="related">
	<dl class="dl-horizontal">
		<dt><?php echo __('Related Idea Ratings'); ?></dt>
		<dd>
			<?php
			$total = 0;
			$rating = 0;
			if (!empty($idea['IdeaRating'])) {
				foreach ($idea['IdeaRating'] as $ideaRating) {
					if ($ideaRating['user_id'] == $this->Session->read('Auth.User.id')) {
						$rating = $ideaRating['rating'];
					}
					$total += $ideaRating['rating'];
				}
			}
		?>
		<div class="star-rect" onmousemove="star.start(event, this, <?php echo h($idea['Idea']['id']);?>, {<?php if ($this->Session->check('Auth.User.id') == false || $idea['Idea']['user_id'] == $this->Session->read('Auth.User.id')) echo "disabled: true,";?>length:3, step:1, sendto: '<?php echo $this->Html->url(array('controller' => 'IdeaRatings', 'action' => 'vote', $idea['Idea']['id']), true); ?>'});"><ul><li>&nbsp;</li><li style="width: <?php echo $rating * 33; ?>%;">&nbsp;</li></ul></div>
		<div class="star-text">
			<span><i class="icon-star"></i><span id="starTotalRating<?php echo h($idea['Idea']['id']);?>"><?php echo $total; ?></span></span>
			<span class="star-text-users">(<span id="starUsers<?php echo h($idea['Idea']['id']);?>"><?php echo count($idea['IdeaRating']); ?></span>users)</span>
			<span class="star-text-alert"><span id="starAlert<?php echo h($idea['Idea']['id']);?>"></span></span>
		</div>
		</dd>
	</dl>
</div>

<div id="content"><dl class="dl-horizontal">
<dt><?php echo __('Related Idea Responses'); ?></dt>
<dd>
	<div id="commentList">
	<?php if (!empty($comments)): ?>
	<?php
		$i = 0;
		foreach ($comments as $comment): $ideaResponse = $comment['IdeaResponse']; ?>
			<?php if ($ideaResponse['user_id'] === $idea['User']['id']): ?>
			<div class="comment">
					<div class="comment_icon"><?php echo $this->Html->image('svg/user-2.svg', array('alt' => 'icon', 'width' => 50 )); ?></div>
					<div class="comment_inner">
					<div class="arrow_box">
				<?php elseif ($ideaResponse['user_id'] === $auth['id']): ?>
				<div class="comment_my">
					<div class="comment_icon"><?php echo $this->Html->image('svg/user-4.svg', array('alt' => 'icon', 'width' => 50 )); ?></div>
					<div class="comment_inner">
					<div class="arrow_box_my">
				<?php else: ?>
				<div class="comment_other">
					<div class="comment_icon"><?php echo $this->Html->image('svg/user-4.svg', array('alt' => 'icon', 'width' => 50 )); ?></div>
					<div class="comment_inner">
					<div class="arrow_box_other">
				<?php endif; ?>
						<?php echo $ideaResponse['body']; ?>
					</div>
					<p class="coment_post">
					ID：<?php echo $ideaResponse['id']; ?>&nbsp;
					投稿者：<?php echo $users[$ideaResponse['user_id']]; ?>&nbsp;
					投稿日：<?php echo $ideaResponse['modified']; ?>
					</p>
				</div>
			</div>
	<?php endforeach; ?>
<?php endif; ?>
</div>
	<div class="paging">
		<p><?php
		echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		));
		?></p>
		<ul class="pager">
		<?php
			echo $this->Paginator->prev('←' . __('previous'), array(), null, array('class' => 'previous'));
			echo $this->Paginator->numbers(array('separator' => ''));
			echo $this->Paginator->next(__('next') . '→', array(), null, array('class' => 'next'));
		?>
	</ul>
	</div>

	<div id="nav-actions">
		<div class="btn-group <?php if (!$this->SmartPhone->isSmartPhone()) echo "btn-group-vertical";?>">
		<?php
			$linkText = __('Edit Idea');
			if ($this->SmartPhone->isSmartPhone()) $linkText = __('Edit');
			if ($this->Session->read('Auth.User.role_id') == ADMIN_ROLE_INDEX || $this->Session->read('Auth.User.id') == $idea['User']['id']){
				echo $this->Html->link($linkText, array('action' => 'edit', $idea['Idea']['id']), array('class' => 'btn btn-small btn-info'));
			}

			$linkText = __('Delete Idea');
			if ($this->SmartPhone->isSmartPhone()) $linkText = __('Delete');
			if ($this->Session->read('Auth.User.role_id') == ADMIN_ROLE_INDEX ||
				($this->Session->read('Auth.User.id') == $idea['User']['id'] && count($idea['IdeaResponse']) == 0)){
				echo $this->Form->postLink($linkText, array('action' => 'delete', $idea['Idea']['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $idea['Idea']['id']));
			}
		?>
		<?php if ($this->Session->check('Auth.User.id')) : ?>
		<a data-toggle="modal" class="btn btn-small btn-success" href="<?php echo Router::url('/IdeaResponses/add/'.$idea['Idea']['id'], true); ?>" data-target="#commentModal"><?php echo __('Comment Idea');?></a>
		<?php endif; ?>
		</div>
	</div>

</dd>
</dl>
</div>

<script>
	$('select.edit').eComboBox({'newItemText' : '(新規追加)', 'editableElements' : false});

	$('#nav-actions').jStageAligner("RIGHT_BOTTOM", {easing: "swing", marginRight: 25, marginBottom: 25});

	$('#IdeaTagAddTagForm input[type!="submit"][type!="button"]').keypress(function(ev) {
		if ((ev.which && ev.which === 13) || (ev.keyCode && ev.keyCode === 13)) {
			return false;
		} else {
			return true;
		}
	});

	$('a[data-toggle=modal]').each(function(){
		$(this).click(function() {
			var target = $(this).attr('data-target');
			var url = $(this).attr('href');
			$(target).load(url);
		});
	});

	function sendAddTag() {
		var postData = {};
		$('#IdeaTagAddTagForm').find(':input').each(function(){
			if ($(this).attr('name') !== undefined) {
				postData[$(this).attr('name')] = $(this).val();
			}
		});

		$.ajax({
			type: 'POST',
			url : '<?php echo $this->Html->url(array('controller' => 'IdeaTags', 'action' => 'addTag')); ?>',
			data : postData,
			success : function(data, dataType) {
				var json = JSON.parse(data);
				if (json.result == 'success') {
					$('#tag-list').append("<span class='tag' id='tag_" + json.tag_id + "'><i class='icon-tag'></i>" + json.tag_name + "<i class='icon-remove-sign' onclick='removeTag(" + json.tag_id + ");'></i></span>");
				} else {
					var error = '';
					error += (json.idea_id !== undefined) ? json.idea_id : '';
					error += (json.name !== undefined) ? json.name : '';
					alert(error);
				}
			}
		});
		return false;
	}

	function removeTag(tagId) {
		var postData = {};
		postData['data[IdeaTag][idea_id]'] = <?php echo $idea['Idea']['id'];?>;
		postData['data[IdeaTag][tag_id]'] = tagId;

		$.ajax({
			type: 'POST',
			url : '<?php echo $this->Html->url(array('controller' => 'IdeaTags', 'action' => 'removeTag')); ?>',
			data : postData,
			success : function(data, dataType) {
				var json = JSON.parse(data);
				if (json.result == 'success') {
					$('#tag_' + tagId).remove();
				}
			}
		});
		return false;
	}
</script>
