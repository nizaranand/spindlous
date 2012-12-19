<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Login Form</title>
	<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css"
		type="text/css" media="all">
</head>
<body>

<div id="login-outer-container">

	<div id="logo">
		
	</div>

	<div class="login-boxes">

	</div>

	<div id="signup_form">

		<div class="login-form">

			<?php echo form_open('login/submit', array("autocomplete" => "off")); ?>

			<?php echo validation_errors('<p class="error">','</p>'); ?>

			<p>
				<?php echo form_input(array("name" => "username", "placeholder" => "Username or Email")); ?>
			</p>
			<p>
				<?php echo form_password(array("name" => "password", "placeholder" => "Password")); ?>
			</p>

			<div class="submit-forgot-container">
				<?php echo anchor('forgot_password','Forget your password?'); ?>
				<?php echo form_submit('submit','Login'); ?>
				<div style="clear:both"></div>
			</div>

			<div class="signup-container">
				<p>Mashtagg is currently invite only, but if you have an invite code:</p>
				<span class="signup-button">Signup here</span>
			</div>

			<?php echo form_close(); ?>

		</div>

		<div class="signup-form hidden">
			<?php echo form_open('signup/submit'); ?>

			<?php echo validation_errors('<p class="error">','</p>'); ?>
			
			<p>
				<input type="text" id="username" name="username" placeholder="Username" />
			</p>
			<p>
				<input type="text" id="email" name="email" placeholder="Email address" />
			</p>	
			<p>
				<input type="password" id="password" name="password" placeholder="Password" />
			</p>
			<p>
				<input type="password" id="passconf" name="passconf" placeholder="Confirm password" />
			</p>
			<div class="button-container">
				<?php echo form_submit('submit','Create my account'); ?>
				<div class="cancel-signup">Cancel</div>
				<div style="clear:both"></div>
			</div>
			<?php echo form_close(); ?>
		</div>
		

	</div>

</div>

</body>

<script type="text/javascript" src="<?php echo base_url();?>scripts/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>scripts/slasht.js"></script>

</html>
