<?php if (!$u = Current_user::user()) {$this->load->view('welcome_page');} ?>

<div id="settings-container">
	<div id="tab-container">
	
		<span class="settings-menu-item" ><a href="<?php echo base_url();?>settings">Account</a></span> <span class="settings-active-menu-item" >Password</span> <span class="settings-menu-item" ><a href="<?php echo base_url();?>settings/profile">Profile</a></span> 
	
	</div>
	<div id="settings-inner">
		<?php echo form_open('settings/submit'); ?>
		<div class="fixed">			
			<div class="settings-label">&nbsp;</div>
			<div class="input">
				<h2>Change your password</h2>
			</div>
		</div>

		<?php echo validation_errors('<p class="error">','</p>'); ?>
		<div class="fixed">			
			<label class="label" for="current_password">Current password: </label>
			<div class="input">
				<input type="password" name="current_password" value="">
			</div>
		</div>
		<div class="fixed">		
			<label class="label" for="new_password">New password: </label>
			<div class="input">
				<input type="password" name="new_password" value="">
			</div>
		</div>
		<div class="fixed">			
			<label class="label" for="conf_password">Confirm: </label>
			<div class="input">
				<input type="password" name="conf_password" value="">
			</div>
		</div>
		<div class="fixed">	
			<div class="label">
				&nbsp;
			</div>
			<div class="input">
				<input type="hidden" name="hidden" value="password" />
				<?php echo form_submit('submit','Submit'); ?>
			</div>
		</div>
		
		<?php echo form_close(); ?>
	</div>
	
</div>