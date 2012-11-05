<div class="content-container">
	<div class="user-header">
		<div class="left-side">
			<h3>Users</h3>
		</div>
		<div class="right-side">
			<?php if($args['tab'] == 'created'):?>
				<p class="right-tab selected">New Users</p>
			<?php else:?>
				<p class="right-tab unselected"><a href="<?php echo base_url() . 'users?tab=created'; ?>">New Users</a></p>
			<?php endif;?>
			<?php if($args['tab'] == 'influence'):?>
				<p class="right-tab selected">Influence</p>
			<?php else:?>
				<p class="right-tab unselected"><a href="<?php echo base_url() . 'users?tab=influence'; ?>">Influence</a></p>
			<?php endif;?>
			<div style="clear:both"></div>
		</div>
		<div style="clear:both"></div>
	</div>
	<div class="users-outer-container">
		<div class="user-filter-container">
			<p class="search-label">Search for a user:</p>
			<input type="text" class="user-search-input" />

			<div style="clear:both"></div>
		</div>
		<div class="users-inner-container">
			<div class="user-column">
			<?php $count = 0; ?>
			<?php foreach ($users as $user): ?>
				<?php if ($count == 8 || $count == 16 || $count == 24 || $count == 32): ?>
					</div>
					<div class="user-column">
				<?php endif; ?>
				<div class="user-container">
					<div class="pic">
						<a href="<?php echo base_url() . 'users/' . $user['username']; ?>">
							<img src="<?php echo $user['profile_pic']; ?>" />
						</a>
					</div>
					<div class="info">
						<p><a href="<?php echo base_url() . 'users/' . $user['username']; ?>"><?php echo $user['username']; ?></a></p>
						<p><?php echo $user['influence']; ?></p>
					</div>
					<div style="clear:both"></div>
				</div>
				<?php $count++; ?>
			<?php endforeach; ?>
			</div>
		</div>
		<div class="user-pages-container">
			<div class="inner-pages-container">
				<?php foreach($pagination_pages as $button) echo $button; ?>
				<div style="clear:both"></div>
			</div>
			<div style="clear:both"></div>
		</div>
	</div>
</div>