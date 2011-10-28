<?php $u = Current_User::user(); ?>

<div id="post_container">
	<div class="outer-post-container">
		<div class="picture">
			<img src="<?php echo base_url() . $post['profile_pic']; ?>" height="35" width="35"/>
			<p class="author"><a href="<?php echo base_url() . $post['author'];?>" ><?php echo $post['author']; ?></a></p>
		</div> 				
		

		<div id="<?php echo $post['sid']; ?>"class="post-container-1">
		<?php if ($post['title'] != '') { ?>
			<h2><a href="<?php echo $post['url']; ?>" class="post-title"><?php echo $post['title']; ?></a></h2>
		<?php } ?>
			<div class="post-body-container">
				<p class="body"><?php echo $post['body']; ?></p>
			</div>
		</div>
		
	</div>
	
	<?php $type = $this->input->get("route"); ?>
	
	<div id="tab-container">
	
		<?php if ($type == "comments" || $type == "") { ?>
			<ul id="tabs">
				<li id="comments-tab" class="active-menu-item" >Comments</li>
				<li id="shares-tab" class="menu-item" ><a href="/">Shares</a></li>
				<li id="tags-tab" class="menu-item" ><a href="/">Tags</a></li>
			</ul>
		<?php } else if ($type == "shares") { ?>
			<ul id="tabs">
				<li id="comments-tab" class="menu-item" ><a href="/" >Comments</a></li>
				<li id="shares-tab" class="active-menu-item" >Shares</li>
				<li id="tags-tab" class="menu-item" ><a href="/">Tags</a></li>
			</ul>
		<?php } else if ($type == "tags") { ?>
			<ul id="tabs">
				<li id="comments-tab" class="menu-item" ><a href="/">Comments</a></li>
				<li id="shares-tab" class="menu-item" ><a href="/">Shares</a></li>
				<li id="tags-tab" class="active-menu-item" >Tags</li>
			</ul>
		<?php } ?>
	
	
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
				</div>
			</div>
		</div>
		
		<?php if ($comments) { ?>
			<?php $this->load->view("comment", array("node" => $comments));  ?>
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

