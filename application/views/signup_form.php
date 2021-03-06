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

	<?php echo form_open('signup/submit'); ?>

	<?php echo validation_errors('<p class="error">','</p>'); ?>
	
	<p>
		<label for="username">Username: </label>
		<input type="text" id="username" name="username" />
	</p>
	<p>
		<label for="email">E-mail: </label>
		<input type="text" id="email" name="email" />
	</p>	
	<p>
		<label for="password">Password: </label>
		<input type="password" id="password" name="password" />
	</p>
	<p>
		<label for="passconf">Confirm Password: </label>
		<input type="password" id="passconf" name="passconf" />
	</p>	
	<p>
		<?php echo form_submit('submit','Create my account'); ?>
	</p>
	<?php echo form_close(); ?>
	<p class="new_user">
		<?php echo anchor('login','Login Form'); ?>
	</p>

</div>