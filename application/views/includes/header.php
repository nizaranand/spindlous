<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Spindlous</title>
	<script src="<?=base_url()?>scripts/jquery.js" ></script>
	<link href='http://fonts.googleapis.com/css?family=Lato:300italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen" charset="utf-8">
</head>

<body>
<?php if ($u = Current_User::user()):?>

<div id="top-bar">
	<div id = "container1">
		<div id = "spindlous"><p><a href = "<?php echo base_url();?>">Spindlous</a></p></div>
		<div id = "container3">
			<p>
				<a href = "<?php echo base_url();?>feed">FEED</a> | 							   
				<a href = "<?php echo base_url();?>profile">PROFILE</a> | 
				<a href = "<?php echo base_url();?>tags">TAGS</a> |
				<a href = "<?php echo base_url();?>users">USERS</a> |
				<a href = "<?php echo base_url();?>saved">SAVED</a> |
				<a href = "<?php echo base_url();?>settings">SETTINGS</a> |
				<a href = "<?php echo base_url();?>about">ABOUT</a>
			</p>
		</div>
	</div>
	<div id = "container2">
		<div id = "user_control_box"><p>Hello <em><?php echo $u['username']; ?></em></p></div>
		<div id = "logout"><p><?php echo anchor('logout','Logout'); ?></p></div>
	</div>
</div>


<?php else: ?>

<div id="top-bar">
	<div id = "container1">
		<div id = "spindlous"><p><a href = "<?php echo base_url();?>">Spindlous</a></p></div>
		<div id = "container3">
			<p>
				<a href = "<?php echo base_url();?>tags">TAGS</a> |
				<a href = "<?php echo base_url();?>users">USERS</a> |
				<a href = "<?php echo base_url();?>about">ABOUT</a>
			</p>
		</div>
	</div>
</div>

<?php endif; ?>