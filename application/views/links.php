<?php if (!$u = Current_User::user()) {$this->load->view('welcome_page');} ?>



<div id="new-link-button" class="new"><a href="/">Add a new link</a></div>

<div id="spool">
	
	<?php if (sizeof($spool) > 0):?>
	<ul>
		<?php foreach ($spool as $row): ?>
		<li>
		<?php if ($row->title != ''):?><a href="<?php echo $row->url;?>"><?php echo $row->title;?></a>
		<?php else:?><a href="<?php echo $row->url;?>"><?php echo $row->url;?></a><?php endif;?><span class = "time"> added <?php echo $row->created;?></span>
		<?php if ($row->body != ''):?><p><?php echo $row->body;?></p><?php endif;?>
		</li>
		<?php endforeach;?>
	</ul>
	<?php endif;?>
	
</div>

<div id="post-form-container">
	
	<?php echo form_open('ajax/add_post'); ?>
	<p>
		<label for="title">URL: </label>
		<input id="url" class="url" type="text" size="20" />
	<p>
	<p class="image-preview">
		<img id="link-image" src="images/placeholder.jpg" />
		<br />
		<a href="/" id="prev-image">Prev</a> - <a href="/" id="next-image">Next</a>
	</p>
		<label for="title">Title: </label>
		<input id="title" class="title" type="text" size="20" />
	</p>
	<p>
		<label for="body">Description: </label>
		<textarea id="body" class="body" rows="3" cols="20"></textarea>
	</p>	
	<p>
		<label for="tags">Tags: </label>
		<textarea id="tags" class="tags" rows="3" cols="20"></textarea>
	</p>
	<p>
		<label for="publish">Publish</label>
		<input type="checkbox" id="publish" />
		<input type="hidden" id="type" name="type" value="link" />
	</p>
		
	<p>
		<input type="button" id="post-submit" value="Add" />
	</p>
	<?php echo form_close(); ?>
	
	<a href='/' id='close'>Close</a>
	
</div>


