<div class="content">
    <?php if(!empty($users[$id])) {
		$text = $users[$id];
    }
	else {
		$text = 'no user'; 
	} ?>

	<p>Bonjours <?php echo $text ?></p>
</div>