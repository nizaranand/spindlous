<div id="profile_container">


	<div class="outer-post-container">
		<div class="picture">
			<img src="<?php echo base_url() . $post['profile_pic']; ?>" height="35" width="35"/>
			<p class="author"><a href="<?php echo base_url() . $post['author'];?>" ><?php echo $post['author']; ?></a></p>
		</div> 				
		
		<div id="<?php echo $post['sid']; ?>"class="post-container">
		
			<?php if ($post['title'] != '') { ?>
				<h2><a href="<?php echo $post['url']; ?>" class="post-title"><?php echo $post['title']; ?></a></h2>
				<div class="post-body-container">
					<p class="body"><?php echo $post['body']; ?></p>
					<p class="comments"><a href="<?php echo $post['url']; ?>" >Comments[<?php echo $post['ncomments'];?>] Shares[<?php echo $post['nshares'];?>]</a></p>
				</div>
			<?php } else { ?>
				<div class="post-body-container">
					<p class="little-body"><?php echo $post['body']; ?></p>
					<p class="comments"><a href="<?php echo $post['url']; ?>" >Comments[<?php echo $post['ncomments'];?>] Shares[<?php echo $post['nshares'];?>]</a></p>
				</div>
			<?php } ?>
			
			
			
		</div>
	</div>
	
	
</div>