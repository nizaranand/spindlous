<div id="spool">

	<div id = "spindlet-input">
		<?php echo form_open('home/add_spindlet'); ?>	
	
			<p>
				<label form="spindlet:">URL: </label>
			</p>
			<p>
				<?php $data = array(
								'name' => 'url',
								'id' => 'url',
								'value' => '',
								'cols'=> '50',
								'rows' => '1'); ?>
								
				<?php echo form_textarea($data); ?>
				
				<?php echo form_submit('submit','Submit'); ?>
			</p>
			
		
		<?php echo form_close(); ?>
	</div>
	<div id = "self-spool-container">
		<?php if ($spool->num_rows > 0) { ?>
			<?php foreach ($spool->result() as $row ) { ?>
			<p><?php echo $row->url; ?>
			<?php echo $row->title; ?>
			<?php echo $row->description; ?></p>
		<?php } } ?>
		
		
	</div>
	
	
</div>