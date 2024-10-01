			<footer class="footer footer-transparent d-print-none">
				<div class="container-fluid text-center">
					<?= config('app.copyright'); ?>
				</div>
			</footer>
		</div>
	</div>
	<!-- Page level custom scripts -->
	<script src="<?= js('custom.js'); ?>"></script>
<?php
    if(isset($_SESSION['flash_message'])) {
		$message = getFlashMessage();
?>
		<script>
			$('.preloader').fadeOut().promise().done(function() {
				var Toast = Swal.mixin({ <?= implode(', ', array_map(fn($k, $v) => "$k: $v", array_keys($message['mixin']), $message['mixin'])); ?> });
<?php
                unset($message['mixin']);
?>
                Toast.fire({ <?= implode(', ', array_map(fn($k, $v) => "$k: $v", array_keys($message), $message)); ?> });
			});
		</script>
<?php
    }
	modal('main_logout');
?>
</body>
</html>