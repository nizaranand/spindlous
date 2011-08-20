<div id="new-post-button"><a href="/" id="new-post" class="new">New Post</a></div>

<div id="profile_container">
	Followers | User Info | Settings
	
			<?php if (sizeof($spool) > 0) { ?>
				<?php foreach ($spool as $row) { ?>
					<div id = "<?php echo $row->shortid; ?>"class="post-container">
						<p><a href="<?php echo $row->url; ?>" class="post-title"><?php echo $row->title; ?></a></p>
						<p><?php echo $row->body; ?></p>
						
					</div>
				<?php } } ?>
			
	
</div>

<div id="post-form-container">
	
	<?php echo form_open('ajax/add_post'); ?>

	<p>
		<label for="title">Title: </label>
		<input id="title" class="title" type="text" size="20" />
	</p>
	<p>
		<label for="body">Body: </label>
		<textarea id="body" class="body" rows="3" cols="20"></textarea>
	</p>	
	<p>
		<label for="tags">Tags: </label>
		<textarea id="tags" class="tags" rows="3" cols="20"></textarea>
	</p>
	<p>
		<label for="publish">Publish</label>
		<input type="checkbox" id="publish" />
	</p>
		
	<p>
		<input type="button" id="post-submit" value="Post" />
		<input type="hidden" id="type" value="post" />
		<input type="hidden" id="parent" value="" />
		<input type="hidden" id="root" value="" />
	</p>
	<?php echo form_close(); ?>
	
	<a href='/' id='close'>Close</a>
	
</div>