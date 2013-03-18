<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('AppSetting', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('App Setting'); ?></legend>
				<?php
				echo $this->BootstrapForm->input('title', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				/* TODO: 将来的に実装予定の項目
				echo $this->BootstrapForm->input('enable_smtp');
				echo $this->BootstrapForm->input('smtp_from', array('type' => 'text'));
				echo $this->BootstrapForm->input('smtp_host');
				echo $this->BootstrapForm->input('smtp_port');
				echo $this->BootstrapForm->input('smtp_username');
				echo $this->BootstrapForm->input('smtp_password', array('type' => 'password'));
				*/
				echo $this->BootstrapForm->input('allow_anonymous');
				echo $this->BootstrapForm->input('any_useradd', array('options' => $any_useradds));
				echo $this->BootstrapForm->hidden('id');
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
</div>