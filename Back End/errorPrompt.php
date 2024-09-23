<?php  if (count($error) > 0) : ?>
	<h6 class="fw-light" style="color: red; font-weight: bold; margin-bottom: 0px;">
		<?php foreach ($error as $prompt) : ?>
			<p><?php echo $prompt ?></p>
		<?php endforeach ?>
	</h6>
<?php  endif ?>
