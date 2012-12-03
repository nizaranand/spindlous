<div class="profile-container">
	<div class="profile-header">
		<h3><?php echo $user_info['username']; ?></h3>
	</div>
	<div class="bio-container">
		<div class="left-bio">
			<img src="<?php echo base_url(); ?>images/silhoeutte.png" width="150" height="150" />
			<div class="influence-container">
				<span class="influence"><?php echo $user_info['influence']; ?></span><br />
				<span class="influence-label">Influence</span>
			</div>
		</div>
		<div class="right-bio">
			<p>Name: <?php echo $user_info['full_name']; ?></p>
			<p>Website: <a href="<?php echo $user_info['website']; ?>"><?php echo $user_info['website']; ?></a></p>
			<p>Location: <?php echo $user_info['website']; ?></p>
			<p><?php echo $user_info['member_for_string']; ?></p>
			<p>Last seen <?php echo $user_info['last_seen_string']; ?></p>
			<p>Profile views: <?php echo $user_info['profile_views']; ?></p>
			<p><a href="<?php echo base_url() . $this->uri->uri_string . '?tab=following';?>">Following: <?php echo $user_info['following']; ?></a></p>
			<p><a href="<?php echo base_url() . $this->uri->uri_string . '?tab=followers';?>">Followers: <?php echo $user_info['followers']; ?></a></p>
		</div>
		<div class="about">
			<p><?php echo $user_info['blurb']; ?></p>
		</div>
		<div style="clear:both"></div>
	</div>
	<div class="summary-container">
		<div class="summary-row">
			<div class="left">
				<h3><a href="<?php echo base_url() . $this->uri->uri_string . '?tab=posts';?>"><?php echo $post_count; ?> Posts</a></h3>
				<?php foreach ($post_history as $post): ?>
					<p><?php echo $post['vote_diff']; ?> <a href="<?php echo $post['url']; ?>"><?php echo $post['title']; ?></a></p>
				<?php endforeach; ?>
			</div>
			<div class="right">
				<h3><a href="<?php echo base_url() . $this->uri->uri_string . '?tab=influence';?>"><?php echo $user_info['influence']; ?> Influence</a></h3>
				<?php foreach ($influence_history as $post): ?>
					<p><?php echo $post['influence_gain']; ?> <a href="<?php echo $post['url']; ?>"><?php echo $post['title']; ?></a></p>
				<?php endforeach; ?>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="summary-row">
			<div class="left">
				<h3><a href="<?php echo base_url() . $this->uri->uri_string . '?tab=comments';?>"><?php echo $comment_count; ?> Comments</a></h3>
				<?php foreach ($comment_history as $post): ?>
					<p><?php echo $post['vote_diff']; ?> <a href="<?php echo $post['url']; ?>"><?php echo $post['title']; ?></a></p>
				<?php endforeach; ?>
			</div>
			<div class="right">
				<h3><a href="<?php echo base_url() . $this->uri->uri_string . '?tab=shares';?>"><?php echo $share_count; ?> Shares</a></h3>
				<?php foreach ($share_history as $post): ?>
					<p><?php echo $post['vote_diff']; ?> <a href="<?php echo $post['url']; ?>"><?php echo $post['title']; ?></a></p>
				<?php endforeach; ?>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="summary-row">
			<div class="left">
				<h3><a href="<?php echo base_url() . $this->uri->uri_string . '?tab=pictures';?>"><?php echo $picture_count; ?> Pictures</a></h3>
				<?php foreach ($picture_history as $post): ?>
					<p><?php echo $post['vote_diff']; ?> <a href="<?php echo $post['url']; ?>"><?php echo $post['title']; ?></a></p>
				<?php endforeach; ?>
			</div>
			<div class="right">
				<h3><a href="<?php echo base_url() . $this->uri->uri_string . '?tab=votes';?>"><?php echo $vote_count; ?> Votes</a></h3>
				<?php foreach ($vote_history as $post): ?>
					<p></p>
				<?php endforeach; ?>
			</div>
			<div style="clear:both"></div>
		</div>
	</div>
</div>