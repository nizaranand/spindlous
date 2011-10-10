<?php if (!$u = Current_user::user()) {$this->load->view('welcome_page');} ?>

<div id="settings-container">
	<div id="tab-container">
	
		<span class="settings-menu-item" ><a href="<?php echo base_url();?>settings">Account</a></span> <span class="settings-menu-item" ><a href="<?php echo base_url();?>settings/password">Password</a></span> <span class="settings-active-menu-item" >Profile</span>
	
	</div>
	<div id="settings-inner">
		<?php echo form_open('settings/submit'); ?>
		<div class="fixed">			
			<div class="settings-label">&nbsp;</div>
			<div class="input">
				<h2>Profile</h2>
			</div>
		</div>
		<?php echo validation_errors('<p class="error">','</p>'); ?>
		<div class="fixed">			
			<div class="label" > Picture: </div>
			<div class="input">
				<img src="<?php echo base_url() . $u['profile_pic']; ?>" height="100" width="100" />
				<p><input type="button" id="new_picture" value="Upload Picture" /></p>
			</div>
			
		</div>
		<div class="fixed">			
			<label class="label" for="full_name">Full name: </label>
			<div class="input">
				<input type="text" name="full_name" value="<?php echo $u['full_name'] ?>" />
			</div>
		</div>
		<div class="fixed">	
			<div class="label">
				&nbsp;
			</div>
			<div class="input">
				<input type="hidden" name="hidden" value="profile" />
				<?php echo form_submit('submit','Submit'); ?>
			</div>
		</div>
		
		<?php echo form_close(); ?>
	</div>
	
</div>