<div class="content-container">
	<div class="user-header">
		<div class="left-side">
			<h3>Users</h3>
		</div>
		<div class="right-side">
			<?php if($tab == 'new_users'):?>
				<p class="right-tab selected">New Users</p>
			<?php else:?>
				<p class="right-tab unselected">New Users</p>
			<?php endif;?>
			<?php if($tab == 'influence'):?>
				<p class="right-tab selected">Influence</p>
			<?php else:?>
				<p class="right-tab unselected">Influence</p>
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
						<img src="<?php echo $user['profile_pic']; ?>" />
					</div>
					<div class="info">
						<p><?php echo $user['username']; ?></p>
					</div>
					<div style="clear:both"></div>
				</div>
				<?php $count++; ?>
			<?php endforeach; ?>
			</div>
		</div>
		<div class="user-pages-container">
			<div class="inner-pages-container">
				<?php foreach($pagination_pages as $button): ?>
					<div class="pagination-button <?php echo $button['type'] . ' ' .$button['active']; ?>">
						<?php if($button['type'] == "previous_button"): ?>
							<a href = "<?php echo base_url();?>users?page=<?php echo ($page - 1);?>&filter=<?php echo $filter;?>&tab=<?php echo $tab; ?>"><?php echo $button['value']; ?></a>
						<?php elseif ($button['type'] == "active_number"): ?>
							<?php echo $button['value']; ?>
						<?php elseif ($button['type'] == "page_number"): ?>
							<a href = "<?php echo base_url();?>users?page=<?php echo $button['value'];?>&filter=<?php echo $filter;?>&tab=<?php echo $tab; ?>"><?php echo $button['value']; ?></a>
						<?php elseif ($button['type'] == "ellipses"): ?>
							<?php echo $button['value']; ?>
						<?php elseif ($button['type'] == "next_button"): ?>
							<a href = "<?php echo base_url();?>users?page=<?php echo ($page + 1);?>&filter=<?php echo $filter;?>&tab=<?php echo $tab; ?>"><?php echo $button['value']; ?></a>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
				<div style="clear:both"></div>
			</div>
			<div style="clear:both"></div>
		</div>
	</div>
</div>