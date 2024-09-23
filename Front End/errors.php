<?php  if (count($errors) > 0) : ?>
	<h6 class="fw-light" style="color: red; font-weight: bold; margin-bottom: 0px;">
		<?php foreach ($errors as $error) : ?>
			<p><?php echo $error ?></p>
		<?php endforeach ?>
	</h6>
<?php  endif ?>
