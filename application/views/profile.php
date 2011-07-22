<div id="spool">

	<div id = "link-input">
		<?php echo form_open('home/add_spindlet'); ?>	
	
			<p>
				<label form="spindlet:">URL: </label>
			</p>
			<p>
				<?php $data = array(
								'name' => 'url',
								'id' => 'url',
								'value' => '',
								'cols'=> '50'); ?>
								
				<?php echo form_input($data); ?>
				
				<?php echo form_submit('submit', 'Submit', 'id="submit"'); ?>
			</p>
			
		
		<?php echo form_close(); ?>
	</div>
	<div id = "link-container">
		<?php if (sizeof($spool) > 0) { ?>
			<?php foreach ($spool as $row) { ?>
			<p><?php echo $row['url']; ?>
			<?php echo $row['title']; ?>
			<?php echo $row['body']; ?></p>
		<?php } } ?>
		
		
	</div>
</div>