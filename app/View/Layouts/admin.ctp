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
	<?php echo $this->Html->css('columbus.generic'); ?>

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Le fav and touch icons -->
	<!--
	<link rel="shortcut icon" href="/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">
	-->
	<?php
	echo $this->fetch('meta');
	echo $this->fetch('css');
	?>
</head>

<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<?php
					if ($this->Session->check('Auth.User.id')) {
				?>
					<a class="brand" href="<?php echo $this->webroot.'admin';?>">
						<?php echo $title_for_layout; ?>
					</a>
				<?php
					} else {
				?>
					<a class="brand" href="<?php echo $this->webroot;?>">
						<?php echo $title_for_layout; ?>
					</a>
				<?php
					}
				?>
				<div class="nav-collapse">
					<ul class="nav">
					<?php if ($this->Session->check('Auth.User.id')) { ?>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo __('App Setting'); ?><b class="caret"></b></a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
								<li role="presentation"><?php echo $this->Html->link(__('App Setting'), '/admin/AppSettings/edit'); ?></li>
								<li role="presentation"><?php echo $this->Html->link(__('Manage Status'), '/admin/statuses'); ?></li>
								<li role="presentation"><?php echo $this->Html->link(__('ACL'), '/admin/acl'); ?></li>
							</ul>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo __('Manage Data'); ?><b class="caret"></b></a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
								<li role="presentation"><?php echo $this->Html->link(__('Manage User'), '/admin/users'); ?></li>
								<li role="presentation"><?php echo $this->Html->link(__('Manage Input Item'), '/admin/InputItems'); ?></li>
								<li role="presentation"><?php echo $this->Html->link(__('Manage Tag'), '/admin/tags'); ?></li>
								<li role="presentation"><?php echo $this->Html->link(__('Manage File'), '/admin/attachments'); ?></li>
								<li role="presentation"><?php echo $this->Html->link(__('List %s', __('Idea Responses')), '/admin/idea_responses'); ?></li>
							</ul>
						</li>
					<?php } ?>
					</ul>
					<ul class="nav" style="float:right;">
					<?php if ($this->Session->check('Auth.User.id')) { ?>
						<li><?php echo $this->Html->link('<i class="icon-lightbulb"></i>'.__('Ideas'), '/', array('escape' => false)); ?></li>
						<li><?php echo $this->Html->link('<i class="icon-signout"></i>'.__('logout'), '/admin/users/logout', array('escape' => false)); ?></li>
					<?php } ?>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>

	<div id="container" class="container">

		<?php echo $this->Session->flash(); ?>

		<?php echo $this->fetch('content'); ?>

	</div> <!-- /container -->

	<!-- Le javascript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
	<?php echo $this->Html->script('bootstrap.min'); ?>
	<?php echo $this->fetch('script'); ?>
	<?php echo $this->Html->script('columbus.common.js'); ?>
</body>
</html>
