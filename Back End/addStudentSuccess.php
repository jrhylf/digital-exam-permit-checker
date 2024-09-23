<?php  if (count($studentSuccess) > 0) : ?>
	<h6 class="fw-light" style="color: green; font-weight: bold; margin-bottom: 0px; padding-left: 10px;"> <!-- background-color: #22D300; -->
		<?php foreach ($studentSuccess as $error) : ?>
			<p><?php echo $error ?></p>
		<?php endforeach ?>
	</h6>
<?php  endif ?>
