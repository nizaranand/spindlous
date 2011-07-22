<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Spindlous</title>
	<script src="<?=base_url()?>scripts/jquery.js" ></script>
	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen" charset="utf-8">
</head>

<body>

<?php if ($u = Current_User::user()):?>

<div id="top-bar">
	<div id = "container1">
		<div id = "spindlous"><p><a href = "<?php echo base_url();?>">Spindlous</a></p></div>
		<div id = "container3"><p><a href = "<?php echo base_url();?>spool">Spool</a> | 							   
							   <a href = "<?php echo base_url();?>saved_links">Saved Links</a> | 
							   <a href = "<?php echo base_url();?>profile">Profile</a></p></div>
	</div>
	<div id = "container2">
		<div id = "user_control_box"><p>Hello <em><?php echo $u->info['username']; ?></em></p></div>
		<div id = "logout"><p><?php echo anchor('logout','Logout'); ?></p></div>
	</div>
</div>


<?php endif; ?>


