<div class="row login">
	<div class="span4 offset4">
	<?php
		echo $this->BootstrapForm->create('User', array('action' => 'login'));
	?>
		<legend>Please Login</legend>
	<?php
		echo $this->BootstrapForm->input('username', array('placeholder' => ' Username '));
		echo $this->BootstrapForm->input('password', array('placeholder' => ' Password '));
		echo $this->BootstrapForm->button('Login', array('class' => 'btn btn-info btn-block'));
		echo $this->BootstrapForm->end();
	?>
	</div>
</div>