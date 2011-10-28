<?php if ($type == 'self') { ?>
	<div id="new-post-button"><a href="/" id="new-post" class="new">New Post</a></div>
<?php } ?>

<div id="profile_container">

	<?php if (sizeof($spool) > 0) { ?>
	
		<div class="profile-top">
		</div>
		
		<?php foreach ($spool as $row) { ?>
			
			<?php if ($row['type'] != 'comment') { ?>
				<div class="outer-post-container">
					<div class="picture">
						<img src="<?php echo base_url() . $row['profile_pic']; ?>" height="35" width="35"/>
						<p class="author"><a href="<?php echo base_url() . $row['author'];?>" ><?php echo $row['author']; ?></a></p>
					</div> 				
					
					
					
						<?php if ($row['title'] != '') { ?>
							<div id="<?php echo $row['sid']; ?>"class="post-container">
								<h2><a href="<?php echo $row['url']; ?>" class="post-title"><?php echo $row['title']; ?></a></h2>
								<div class="post-body-container">
									<p class="body"><?php echo $row['body']; ?></p>
									<p class="comments"><a href="<?php echo $row['url']; ?>" >Comments[<?php echo $row['ncomments'];?>] Shares[<?php echo $row['nshares'];?>]</a></p>
								</div>
							</div>
						<?php } else { ?>
							<div id="<?php echo $row['sid']; ?>"class="little-post-container">
								<div class="post-body-container">
									<p class="little-body"><?php echo $row['body']; ?></p>
									<p class="little-comments"><a href="<?php echo $row['url']; ?>" >Comments[<?php echo $row['ncomments'];?>] Shares[<?php echo $row['nshares'];?>]</a></p>
								</div>
							</div>
						<?php } ?>
						
						
						
				</div>
			<?php } ?>
			
			
		<?php } ?>
		
		<div class="profile-bottom">
		</div>
			
	<?php } ?>

</div>

<div id="post-form-container">
	
	<?php echo form_open('ajax/add_post'); ?>

	<div class="fixed">	
		<label class="label" for="title">Title: </label>
		<div class="input">
			<input id="title" type="text" size="20" />
		</div>
	</div>
	<div class="fixed">	
		<label class="label" for="body">Body: </label>
		<div class="input">
			<textarea id="body" rows="3" cols="40"></textarea>
		</div>
	</div>
	<div class="fixed">	
		<label class="label" for="tags">Tags: </label>
		<div class="input">
			<textarea id="tags" rows="3" cols="20"></textarea>
		</div>
	</div>
	<div class="fixed">	
		<label class="label" for="publish">Publish:</label>
		<div class="input-checkbox">
			<input type="checkbox" id="publish" />
		</div>
	</div>
		
	<div class="fixed">	
		<div class="label"></div>
		<div class="input">
			<input type="button" id="post-submit" value="Post" />
		</div>
		<input type="hidden" id="type" value="post" />
		<input type="hidden" id="parent" value="" />
		<input type="hidden" id="root" value="" />
		
	</div>
	
	<?php echo form_close(); ?>
			
	<span class="close">
		<a href='/' id='close'>Close</a>
	</span>
	
</div>