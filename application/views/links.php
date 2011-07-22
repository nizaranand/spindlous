<?php if (!$u = Current_User::user()) {$this->load->view('welcome_page');} ?>



<div id="new-link-button"><a href="<?php echo base_url();?>saved_links/new_link">Add a new link</a></div>

<div id="spool">
	
	<?php if (sizeof($spool) > 0):?>
	<ul>
		<?php foreach ($spool as $row): ?>
		<li>
		<?php if ($row['title'] != ''):?><a href="<?php echo $row['url'];?>"><?php echo $row['title'];?></a>
		<?php else:?><a href="<?php echo $row['url'];?>"><?php echo $row['url'];?></a><?php endif;?><span class = "time"> added <?php echo $row['time_created'];?></span>
		<?php if ($row['body'] != ''):?><p><?php echo $row['body'];?></p><?php endif;?>
		</li>
		<?php endforeach;?>
	</ul>
	<?php endif;?>
	
</div>


