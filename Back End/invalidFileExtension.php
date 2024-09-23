<?php  if (count($invalidFileExtension) > 0) : ?>
	<h6 class="fw-light" style="color: red; font-weight: bold; margin-bottom: 0px; padding-left: 10px;">  <!-- background-color: #FF4A4A; -->
		<?php foreach ($invalidFileExtension as $error) : ?>
			<p><?php echo $error ?></p>
		<?php endforeach ?>
	</h6>
<?php  endif ?>
