
<?php foreach($pagination_pages as $button): ?>
	<div class="pagination-button <?php echo $button['type'] . ' ' .$button['active']; ?>">
		<?php echo $button['value']; ?>
	</div>
<?php endforeach; ?>