<?php $u = Current_User::user(); ?>

<div id="post_container">

	<div class="post-header">
		<div class="left-side">
			<div class="username-holder">
				<h3 class="author"><a href="<?php echo base_url() . $post['author'];?>" ><?php echo $post['author']; ?></a></h3>
			</div>
			<div class="title-holder">
				<?php if ($post['title'] != '') { ?>
					<h3><a href="<?php echo $post['url']; ?>" class="post-title"><?php echo $post['title']; ?></a></h3>
				<?php } ?>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="right-side">
		</div>
		<div style="clear:both"></div>
	</div>
	<div class="outer-post-container">
		<div class="picture">
			<img src="<?php echo base_url() . $post['profile_pic']; ?>"/>
			
		</div> 				
		

		<div id="<?php echo $post['sid']; ?>"class="post-container-1">
			<div class="post-body-container">
				<p class="body"><?php echo $post['body']; ?></p>
			</div>
		</div>
		
	</div>
	
	<?php $type = $this->input->get("route"); ?>
	
	<div id="tab-container">
	
		<?php if ($type == "comments" || $type == "") { ?>
			<div id="tabs">
				<div id="shares-tab" class="menu-item" ><a href="/">Shares</a></div>
				<div id="tags-tab" class="menu-item" ><a href="/">Tags</a></div>
				<div id="comments-tab" class="active-menu-item" >Comments</div>
			</div>
		<?php } else if ($type == "shares") { ?>
			<div id="tabs">
				<div id="shares-tab" class="active-menu-item" >Shares</div>
				<div id="tags-tab" class="menu-item" ><a href="/">Tags</a></div>
				<div id="comments-tab" class="menu-item" ><a href="/" >Comments</a></div>
			</div>
		<?php } else if ($type == "tags") { ?>
			<div id="tabs">
				<div id="shares-tab" class="menu-item" ><a href="/">Shares</a></div>
				<div id="tags-tab" class="active-menu-item" >Tags</div>
				<div id="comments-tab" class="menu-item" ><a href="/">Comments</a></div>
			</div>
		<?php } ?>
	
		<div style="clear:both"></div>
	</div>
	
	<?php if ($type == "comments" || $type == "") { ?>
		<div id="comment-container" class="visible">
	<?php } else { ?>
		<div id="comment-container" class="hidden">
	<?php } ?>
	
		<div class="new-comment-container">
			<div class="add_comment_container">
				<div class="input_container">
					<textarea class="new_comment_input" rows="5" cols="50"></textarea>
				</div>
				<div class="add_comment">
					<input type="button" id="first_new_comment" class="new_comment" value="New Comment"/>
					<input type="hidden" id="root_comment" value="<?php echo $post['sid']; ?>" />
					<input type="hidden" id="parent_comment" value="<?php echo $post['sid']; ?>" />
					<div class="loading-gif hidden"></div>
				</div>
			</div>
		</div>
		<div class="new-comment-holder">
		</div>
		
		<?php if ($comments) { ?>
			<?php $this->load->view("comment", array("node" => $comments, "odd" => TRUE));  ?>
		<?php } else { ?>
				<p>There are no comments yet.</p>
		<?php } ?>
		
	</div>
	
	<?php if ($type == "shares"){ ?>
		<div id="shares-container" class="visible">
	<?php } else { ?>
		<div id="shares-container" class="hidden">
	<?php } ?>
	
		<?php if (sizeof($shares) > 0) { ?>
			<?php foreach ($shares as $share) { ?>
				
				<p class="share">Shared by <?php echo $share['author'] ?> on <?php echo $share['published'] ?></p>
				
			<?php } ?>
		<?php } else { ?>
				<p>No one has shared this post yet.</p>
		<?php } ?>
	
	
	</div>
	
	<?php if ($type == "tags") { ?>
		<div id="tags-container" class="visible">
	<?php } else { ?>
		<div id="tags-container" class="hidden">
	<?php } ?>

	
		<?php if (sizeof($post['tags']) > 0) { ?>
			<?php if ((sizeof($post['tags']) == 1) && ($post['tags'][0] == '')) {?>
				<p>This post doesn't have any tags.</p>
				<?php } else {?>
				<?php foreach ($post['tags'] as $tag) { ?>
					
					<p class="tag"><?php echo $tag ?></p>
					
				<?php } ?>
			<?php } ?>
		<?php } else { ?>
			<p>This post doesn't have any tags.</p>
		<?php } ?>

	</div>
</div>