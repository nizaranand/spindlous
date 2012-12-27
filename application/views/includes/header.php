<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>mashtagg</title>
	<link href='http://fonts.googleapis.com/css?family=Anaheim' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato:300italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen" charset="utf-8">
</head>

<body>
<?php if ($u = Current_User::user()):?>
<div id="top-bar">
	<div id = "container1">
		<div id = "mashtagg"><p><a href = "<?php echo base_url();?>">mashtagg</a></p></div>
		<div id = "container3">
			<div id="container4">
				<div class="link-box feed-link">
					<p><a href = "<?php echo base_url();?>feed">FEED</a></p>
				</div>
				<div class="link-box blog-link">
					<p><a href = "<?php echo base_url();?>blog">BLOG</a></p>
				</div>
				<div class="link-box profile-link">
					<p><a href = "<?php echo base_url() . 'profile'; ?>">PROFILE</a></p>
				</div>
				<div class="link-box tags-link">
					<p><a href = "<?php echo base_url();?>tags">TAGS</a></p>
				</div>
				<div class="link-box users-link">
					<p><a href = "<?php echo base_url();?>users">USERS</a></p>
				</div>
				<div class="link-box saved-link">
					<p><a href = "<?php echo base_url();?>saved">SAVED</a></p>
				</div>
				<div class="link-box settings-link">
					<p><a href = "<?php echo base_url();?>settings">SETTINGS</a></p>
				</div>
				<div class="link-box about-link">
					<p><a href = "<?php echo base_url();?>about">ABOUT</a></p>
				</div>
				<div style="clear:both"></div>
			</div>

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
		<div id = "slasht"><p><a href = "<?php echo base_url();?>">Slasht</a></p></div>
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