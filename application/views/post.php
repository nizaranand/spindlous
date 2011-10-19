<div id="post_container">
	<div class="outer-post-container">
		<div class="picture">
			<img src="<?php echo base_url() . $post['profile_pic']; ?>" height="35" width="35"/>
			<p class="author"><a href="<?php echo base_url() . $post['author'];?>" ><?php echo $post['author']; ?></a></p>
		</div> 				
		

		
		<?php if ($post['title'] != '') { ?>
			<div id="<?php echo $post['sid']; ?>"class="post-container">
				<h2><a href="<?php echo $post['url']; ?>" class="post-title"><?php echo $post['title']; ?></a></h2>
				<div class="post-body-container">
					<p class="body"><?php echo $post['body']; ?></p>
					<p class="comments"><a href="<?php echo $post['url']; ?>" >Comments[<?php echo $post['ncomments'];?>] Shares[<?php echo $post['nshares'];?>]</a></p>
				</div>
			</div>
		<?php } else { ?>
			<div id="<?php echo $post['sid']; ?>"class="little-post-container">
				<div class="-post-body-container">
					<p class="little-body"><?php echo $post['body']; ?></p>
					<p class="little-comments"><a href="<?php echo $post['url']; ?>" >Comments[<?php echo $post['ncomments'];?>] Shares[<?php echo $post['nshares'];?>]</a></p>
				</div>
			</div>
		<?php } ?>
			
			
			
		
	</div>
	
	<div id="tab-container">
	
		<span class="settings-active-menu-item" >Comments</span> <span class="settings-menu-item" ><a href="<?php echo base_url();?>settings/password">Shares</a></span> <span class="settings-menu-item" ><a href="<?php echo base_url();?>settings/profile">Tags</a></span>
	
	</div>
</div>