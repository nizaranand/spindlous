<?php if (!$u = Current_User::user()) {$this->load->view('welcome_page');} ?>



<div id="new-link-button" class="new"><a href="/">Add a new link</a></div>

<div id="spool">
	
	<?php if (sizeof($spool) > 0):?>
	<ul>
		<?php foreach ($spool as $row): ?>
		<li>
		<?php if ($row['title'] != ''):?><a href="<?php echo $row['url'];?>"><?php echo $row['title'];?></a>
		<?php else:?><a href="<?php echo $row['url'];?>"><?php echo $row['url'];?></a><?php endif;?><span class = "time"> added <?php echo $row['created'];?></span>
		<?php if ($row['body'] != ''):?><p><?php echo $row['body'];?></p><?php endif;?>
		</li>
		<?php endforeach;?>
	</ul>
	<?php endif;?>
	
</div>

<div id="post-form-container">
	
	<?php echo form_open('ajax/add_post'); ?>
	
	<div class="fixed">	
		<label class="label" for="title">URL: </label>
		<div class="input">
			<input id="url" class="url" type="text" size="20" />
		</div>
	</div>
	<div class="fixed">
		<div class="input">	
			<p class="image-preview">
				<img id="link-image" src="images/placeholder.jpg" />
				<br />
				<a href="/" id="prev-image">Prev</a> - <a href="/" id="next-image">Next</a>
			</p>
		</div>
	</div>
	<div class="fixed">
		<label class="label" for="title">Title: </label>
		<div class="input">
			<input id="title" class="title" type="text" size="20" />
		</div>	
	</div>
	<div class="fixed">
		<label class="label" for="body">Description: </label>
		<div class="input">
			<textarea id="body" rows="3" cols="40"></textarea>
		</div>
	</div>	
	<div class="fixed">
		<label class="label" for="tags">Tags: </label>
		<div class="input">
			<textarea id="tags" class="tags" rows="3" cols="20"></textarea>
		</div>
	</div>
	<div class="fixed">
		<label class="label" for="publish">Publish</label>
		<div class="input-checkbox">
			<input type="checkbox" id="publish" />
		</div>
		<input type="hidden" id="type" name="type" value="link" />
	</div>
		
	<div class="fixed">
		<div class="label">
		</div>
		<div class="input">
			<input type="button" id="post-submit" value="Add" />
		</div>
	</div
	<?php echo form_close(); ?>
	
	<span class="close">
		<a href='/' id='close'>Close</a>
	</span>
	
</div>


