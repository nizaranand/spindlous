<div class="summary-container">
	<div class="summary-row">
		<div class="left">
			<h3>
				<a href="<?php echo base_url() . $this->uri->uri_string . '?tab=posts';?>">
					<?php if ($posts_count == 1) {echo "1 Post";} else { echo $posts_count . " Posts"; } ?>
				</a>
			</h3>
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
			<h3>
				<a href="<?php echo base_url() . $this->uri->uri_string . '?tab=comments';?>">
					<?php if ($comments_count == 1) {echo "1 Comment";} else { echo $comments_count . " Comments"; } ?>
				</a>
			</h3>
			<?php foreach ($comment_history as $post): ?>
				<p><?php echo $post['vote_diff']; ?> <a href="<?php echo $post['url']; ?>"><?php echo $post['title']; ?></a></p>
			<?php endforeach; ?>
		</div>
		<div class="right">
			<h3>
				<a href="<?php echo base_url() . $this->uri->uri_string . '?tab=shares';?>">
					<?php if ($shares_count == 1) {echo "1 Share";} else { echo $shares_count . " Shares"; } ?>
				</a>
			</h3>
			<?php foreach ($share_history as $post): ?>
				<p><?php echo $post['vote_diff']; ?> <a href="<?php echo $post['url']; ?>"><?php echo $post['title']; ?></a></p>
			<?php endforeach; ?>
		</div>
		<div style="clear:both"></div>
	</div>
	<div class="summary-row">
		<div class="left">
			<h3>
				<a href="<?php echo base_url() . $this->uri->uri_string . '?tab=pictures';?>">
					<?php if ($pictures_count == 1) {echo "1 Picture";} else { echo $pictures_count . " Pictures"; } ?>
				</a>
			</h3>
			<?php foreach ($picture_history as $post): ?>
				<p><?php echo $post['vote_diff']; ?> <a href="<?php echo $post['url']; ?>"><?php echo $post['title']; ?></a></p>
			<?php endforeach; ?>
		</div>
		<div class="right">
			<h3>
				<a href="<?php echo base_url() . $this->uri->uri_string . '?tab=votes';?>">
					<?php if ($votes_count == 1) {echo "1 Vote";} else { echo $votes_count . " Votes"; } ?>
				</a>
			</h3>
			<?php foreach ($vote_history as $post): ?>
				<p></p>
			<?php endforeach; ?>
		</div>
		<div style="clear:both"></div>
	</div>
</div>