<?php echo $this->Html->css('star');?>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js" charset="utf-8"></script>
<script src="http://isotope.metafizzy.co/jquery.isotope.min.js"></script>
<script type="text/javascript" src="<?php echo Router::url('/', true) ?>js/jquery.eComboBox.js"></script>
<script type="text/javascript" src="<?php echo Router::url('/', true) ?>js/star.js"></script>
<div class="modal fade" id="viewModal" style="left:25%; width: 80%; overflow: scroll;"></div>
<div class="hide">
	<form id="showlist" name="showlist" method="post" action="<?php echo $this->Html->url(array('controller' => 'ideas', 'action' => 'index')); ?>">
		<input name="page" type="hidden" value="idea">
		<input name="layout" type="hidden" value="list">
	</form>
</div>
<div class="ideas index">
<div style="">
	<ul class="nav nav-tabs">
		<li><?php echo $this->Html->link(__('Home'), array('controller' => 'ideas', 'action' => 'index'), array('onclick' => "document.showlist.submit(); return false;")); ?></li>
		<li class="active"><?php echo $this->Html->link(__('Board'), array('controller' => 'ideas', 'action' => 'index', 'board')); ?></li>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Actions <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li><?php echo $this->Html->link(__('New Idea'), array('action' => 'add')); ?></li>
			</ul>
		</li>
	</ul>
	<?php
		echo $this->BootstrapForm->create('IdeaTag', array('class' => 'tag-search-form form-inline', 'url' => array('controller' => 'ideas', 'action' => 'index')));
		echo $this->BootstrapForm->input('tag_id', array('label' => __('idea tag'), 'class' => 'edit'));
		echo $this->BootstrapForm->button(__('Search'), array('type' => 'submit', 'class' => 'btn btn-success'));
		echo $this->BootstrapForm->end();
	?>
</div>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<ul class="pager ideasboard_pager">
	<?php
		echo $this->Paginator->prev('←' . __('previous'), array(), null, array('class' => 'previous'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . '→', array(), null, array('class' => 'next'));
	?>
	</ul>
	</div>
<div id="container">
	<?php foreach ($ideas as $idea): ?>
	<?php
		if($idea['Idea']['total_ratings'] > 3 && $idea['Idea']['idea_responses_count'] >= 2) {
			$attr['class'] = 'best ';
			$attr['maxlen_s'] = 60;
			$attr['maxlen_l'] = 150;
		} else if($idea['Idea']['idea_responses_count'] >= 3) {
			$attr['class'] = 'hot ';
			$attr['maxlen_s'] = 40;
			$attr['maxlen_l'] = 80;
		} else if($idea['Idea']['total_ratings'] >= 5) {
			$attr['class'] = 'good ';
			$attr['maxlen_s'] = 40;
			$attr['maxlen_l'] = 80;
		} else {
			$attr['class'] = "";
			$attr['maxlen_s'] = 20;
			$attr['maxlen_l'] = 30;
		}
	?>
<div class="<?php echo $attr['class']; ?>box" id="<?php echo h($idea['Idea']['id']); ?>">
	<div class="drop-shadow rotated lifted">
<!--
<a data-toggle="modal" class="a_block" href="<?php echo Router::url('/ideas/view/'.$idea['Idea']['id'], true); ?>?mode=modal" data-target="#viewModal">
-->
<a class="a_block" href="<?php echo Router::url('/ideas/view/'.$idea['Idea']['id'], true); ?>">
<h2><div><i></i><span></span></div><?php echo h($this->MbText->truncate($idea['Idea']['title'],$attr['maxlen_s'])); ?></h2>
<p class="body">
	<?php echo h($this->MbText->truncate(strip_tags($idea['Idea']['body']),$attr['maxlen_l'])); ?>
</p>
</a>
		<ul class="star-and-comment">
			<li class="star-text">
				<span><i class="icon-star"></i><span id="starTotalRating<?php echo h($idea['Idea']['id']);?>"><?php echo $idea['Idea']['total_ratings']; ?></span></span>
				<span class="star-text-users">(<span id="starUsers<?php echo h($idea['Idea']['id']);?>"><?php echo $idea['Idea']['ratings_count']; ?></span>users)</span>
				<span class="star-text-alert"><span id="starAlert<?php echo h($idea['Idea']['id']);?>"></span></span>
			</li>
			<li class="comment">
			<?php
				if ($idea['Idea']['idea_responses_count'] == 0){
					echo h($idea['Idea']['idea_responses_count']) . " <br><span>comment</span>";
				} else {
					echo "<a comment_id='".$idea['Idea']['id']."' >". h($idea['Idea']['idea_responses_count']) ."<br><span>comment</span></a> ";
					if ($idea['Idea']['new_comment']) {
						echo "<span class='comment-new'>New!!</span>";
					}
				}
			?>
			</li>
		</ul>
</div><!--/.drop-shadow-->
</div>
<?php endforeach; ?>
</div>
</div>
<script type="text/javascript">
/*
    $('#container').masonry({
      itemSelector: '.box',
      columnWidth: 240,
    });
*/
$('#container').isotope({
masonryHorizontal : {
    rowHeight : 100
  }
});

		$('select.edit').eComboBox({'newItemText' : '(自由入力)'});

		$('a[data-toggle=modal]').each(function(){
			$(this).click(function() {
				var target = $(this).attr('data-target');
				var url = $(this).attr('href');
				$(target).load(url);
			});
		});

</script>
