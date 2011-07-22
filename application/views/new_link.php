<?php if (!$u = Current_user::user()) {$this->load->view('welcome_page');} ?>

<div id="new_link_form">

	

	<?php echo form_open('saved_links/add'); ?>
	
	<p class="heading">New Link</p>

	<?php echo validation_errors('<p class="error">','</p>'); ?>

	<p>
		<label for="url">URL: </label>
		<?php echo form_input('url',set_value('url')); ?>
	</p>
	<p>
		<label for="title">Title: </label>
		<?php echo form_input('title',set_value('title')); ?>
	</p>
	<p>
	
		
		<label for="description">Description:</label>
		<?php echo form_textarea('body',set_value('body')); ?>
	</p>
	<p>
		<?php echo form_submit('submit','Submit'); ?>
	</p>
	<?php echo form_close(); ?>

</div>