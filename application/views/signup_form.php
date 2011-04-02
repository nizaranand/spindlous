<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Signup Form</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css"
		type="text/css" media="all">
</head>
<body>

<div id="signup_form">

	<p class="heading">New User Signup</p>

	<?php echo form_open('saved_links/add'); ?>

	<?php echo validation_errors('<p class="error">','</p>'); ?>

	<p>
		<label for="email">E-mail: </label>
		<?php echo form_input('email',set_value('email')); ?>
	</p>	
	<p>
		<label for="password">Password: </label>
		<?php echo form_password('password'); ?>
	</p>
	<p>
		<label for="passconf">Confirm Password: </label>
		<?php echo form_password('passconf'); ?>
	</p>	
	<p>
		<?php echo form_submit('submit','Create my account'); ?>
	</p>
	<?php echo form_close(); ?>
	<p>
		<?php echo anchor('login','Login Form'); ?>
	</p>

</div>

</body>
</html>
