<?php if (!$u = Current_user::user()) {$this->load->view('welcome_page');} ?>

<div id="settings-container">
	<div id="tab-container">
	
		<span class="settings-active-menu-item" >Account</span> <span class="settings-menu-item" ><a href="<?php echo base_url();?>settings/password">Password</a></span> <span class="settings-menu-item" ><a href="<?php echo base_url();?>settings/profile">Profile</a></span>
	
	</div>
	<div id="settings-inner">
		<?php echo form_open('settings/submit'); ?>

		<?php echo validation_errors('<p class="error">','</p>'); ?>
		<div class="fixed">			
			<label class="settings-label" for="username">Username: </label>
			<div class="input">
				<input type="text" name="username" value="<?php echo $u['username'] ?>">
			</div>
		</div>
		<div class="fixed">		
			<label class="settings-label" for="email">Email: </label>
			<div class="input">
				<input type="text" name="email" value="<?php echo $u['email'] ?>">
			</div>
		</div>
		<div class="fixed">	
		
				<?php echo form_submit('submit','Submit'); ?>

		</div>
		
		<?php echo form_close(); ?>
	</div>
	
</div>