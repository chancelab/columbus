<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>
		<?php echo strip_tags($title_for_layout); ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<?php echo $this->Html->css('bootstrap.min'); ?>
	<!-- common styles add by shirato -->
	<?php echo $this->Html->css('common_style'); ?>
	<style>

	body {
		padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
	}
	</style>
	<?php echo $this->Html->css('bootstrap-responsive.min'); ?>

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Le fav and touch icons -->
	<link rel="shortcut icon" href="/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">
	<?php
	echo $this->fetch('meta');
	echo $this->fetch('css');
	?>
</head>

<body>
	<?php if ($notices != null) : ?>
	<div id="popover-notices" style="display:none;">
		<ul>
			<?php foreach ($notices as $notice) : ?>
			<li>
				<button type="button" class="close" data-dismiss="alert" onclick="ajax_read_message(<?php echo $notice['Notice']['id'];?>);">&times;</button>
				<?php echo $notice['Notice']['message']; ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php endif; ?>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="<?php echo $this->webroot;?>" style="white-space: nowrap;<?php if ($this->SmartPhone->isSmartPhone()) echo 'width:50%; overflow:hidden; ';?>">
					<?php echo $title_for_layout; ?>
				</a>
				<?php if ($this->Session->check('Auth.User.id')) : ?>
				<?php if ($this->SmartPhone->isSmartPhone()) { ?>
				<ul class="nav" style="float:right;">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo __('Menu'); ?><b class="caret"></b></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							<li role="presentation"><?php echo $this->Html->link(__('New Idea'), array('action' => 'add')); ?></li>
							<?php if ($this->Session->read('Auth.User.role_id') == ADMIN_ROLE_INDEX) : ?>
							<li role="presentation"><?php echo $this->Html->link(__('Setting'), '/admin/');?></li>
							<?php endif; ?>
							<li role="presentation"><?php echo $this->Html->link(__('MyProfile'), '/ideas/useredit');?></li>
							<li role="presentation"><?php echo $this->Html->link(__('Logout'), '/users/logout');?></li>
						</ul>
					</li>
				</ul>
				<?php } else { ?>
				<ul class="nav">
					<li class="nav_NewIdea"><?php echo $this->Html->link(__('New Idea'), array('action' => 'add')); ?></li>
				</ul>
				<ul class="nav" style="float:right;">
					<?php if ($this->Session->read('Auth.User.role_id') == ADMIN_ROLE_INDEX) : ?>
					<li class="nav_Setting"><?php echo $this->Html->link(__('Setting'), '/admin/');?></li>
					<?php endif; ?>
					<li class="nav_MyProfile"><?php echo $this->Html->link(__('MyProfile'), '/ideas/useredit');?></li>
					<li class="nav_Logout"><?php echo $this->Html->link(__('Logout'), '/users/logout');?></li>
					<?php if ($notices != null) : ?>
					<li class="popover-notice-area">
						<a href="#" id="popover-notice-link" data-html="true" data-placement="bottom" rel="popover" class="popover-alert" title="<?php echo __('Notice');?>">
						<i class="icon-ok-sign"></i> お知らせ (<span id="notice-message-num"><?php echo count($notices); ?></span>)
						</a>
					</li>
					<?php endif; ?>
				</ul>
				<?php } ?>
				<?php elseif ($app_settings != null && $app_settings['AppSetting']['allow_anonymous']): ?>
				<ul class="nav" style="float:right;">
					<li class="nav_Login"><?php echo $this->Html->link('<i class="icon-signin"></i> '.__('Login'), '/users/login', array('escape' => false));?></li>
				</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="container">

		<?php echo $this->Session->flash(); ?>

		<?php echo $this->fetch('content'); ?>

	</div> <!-- /container -->

	<!-- Le javascript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
	<?php echo $this->Html->script('bootstrap.min'); ?>
	<?php echo $this->fetch('script'); ?>
	<script type="text/javascript">
		function ajax_read_message(id) {
			var postData = {};
			postData['data[Notice][id]'] = id;

			$.ajax({
				type: 'POST',
				url : '<?php echo $this->Html->url(array('controller' => 'ajax', 'action' => 'read_notice_message')); ?>',
				data : postData,
				success : function(data, dataType) {
					var json = JSON.parse(data);
					if (json.result == 'success') {
						var noticeCount = Number($('#notice-message-num').text());
						$('#notice-message-num').text(noticeCount-1);
						if (noticeCount <= 1) {
							$('#popover-notice-link').popover('hide');
							$('.popover-notice-area').hide();
						}
					} else {
						alert('Internal Error');
					}
				},
			});
		}
	</script>
	<?php echo $this->Html->script('columbus.common.js'); ?>

</body>
</html>
