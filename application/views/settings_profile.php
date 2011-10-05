<?php if (!$u = Current_user::user()) {$this->load->view('welcome_page');} ?>

<div id="settings-container">
	<div id="tab-container">
	
		<span class="settings-menu-item" ><a href="<?php echo base_url();?>settings">Account</a></span> <span class="settings-menu-item" ><a href="<?php echo base_url();?>settings/password">Password</a></span> <span class="settings-active-menu-item" >Profile</span>
	
	</div>
	<div id="settings-inner">
		<?php echo form_open('settings/submit'); ?>

		<?php echo validation_errors('<p class="error">','</p>'); ?>

		<p>
			<label for="username">Username: </label>
			<?php echo form_input('username',set_value('username')); ?>
		</p>
		<p>
			<label for="email">Email: </label>
			<?php echo form_input('title',set_value('title')); ?>
		</p>
		<p>
			<?php echo form_submit('submit','Submit'); ?>
		</p>
		<?php echo form_close(); ?>
	</div>
	
</div>