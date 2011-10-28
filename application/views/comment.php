<?php if ($u = Current_User::user()) { ?>

	<?php foreach ($node->children as $child) { ?>
	
		<div id='<?php echo $child->comment['sid']?>' class='outer-comment-container'>
		<div class='comment-rating'>
		<?php if ($u['username'] == $child->comment['author']) { ?>
			<p class='disabled_upvote'>+</p>
			<p class='disabled_downvote'>-</p>
		<?php } else { ?>
			<?php if ($child->vote) { ?>
			
				<?php if($child->vote['type'] == 'upvote') { ?>
					<p class='clicked_upvote'>+</p>
					<p class='downvote'>-</p>
				<?php } else { ?>
					<p class='upvote'>+</p>
					<p class='clicked_downvote'>-</p>
				<?php } ?>
			
			<?php } else { ?>
				<p class='upvote'>+</p>
				<p class='downvote'>-</p>
			<?php } ?>
		<?php } ?>
		</div>
			<div class='inner-comment-container'>
				<div class='comment-body-container'>
					<p class='comment_author'><a href='<?php echo base_url() . $child->comment['author'] ?>'><?php echo $child->comment['author'] ?></a></p>
					<p class='comment_body'><?php echo $child->comment['body'] ?></p>
						<div class='add_comment_container'>
							<div class='input_container'>
								<textarea class='new_comment_input' rows='5' cols='50'></textarea>
								<div class='add_comment'><input type='button' class='new_comment' value='Save'/></div>
							</div>
							<div class='reply'><a href='/'>reply</a></div>
						</div>
				</div>
				<?php $this->load->view("comment", array("node" => $child)); ?>
			</div>
		</div>
	
	<?php } ?>

<?php } else { ?>

	<?php foreach ($node->children as $child) { ?>
	
		<div id='<?php echo $child->comment['sid'] ?>' class='outer-comment-container'>
			<div class='comment-rating'>
			</div>
			<div class='inner-comment-container'>
				<div class='comment-body-container'>
					<p class='comment_author'><a href='<?php echo base_url() . $child->comment['author'] ?>'><?php echo $child->comment['author'] ?></a></p>
					<p class='comment_body'><?php echo $child->comment['body'] ?></p>
					<div class='add_comment_container'>
						<div class='input_container'>
							<textarea class='new_comment_input' rows='5' cols='50'></textarea>
							<div class='add_comment'><input type='button' class='new_comment' value='Save'/></div>
						</div>
						<div class='reply'><a href='/'>reply</a></div>
					</div>
				</div>
				<?php $this->load->view("comment", array("node" => $child)); ?>
			</div>
		</div>
	
	<?php } ?>

<?php } ?>

