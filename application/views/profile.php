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
		<?php if ($spool->num_rows > 0) { ?>
			<?php foreach ($spool->result() as $row ) { ?>
			<p><?php echo $row->url; ?>
			<?php echo $row->title; ?>
			<?php echo $row->description; ?></p>
		<?php } } ?>
		
		
	</div>
</div>
<script type="text/javascript">
$('#submit').click(function() {

	var form_data = {
		url: $('#url').val()
	};
	
	$.ajax({
		url: "<?php echo site_url('home/add_link'); ?>,
		type: 'POST',
		data: form_data,
		success: function(msg) {
			alert(msg);
		}
	});
	
	return false;
});
</script>