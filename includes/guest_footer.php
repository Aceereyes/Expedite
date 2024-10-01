			<footer class="footer border-top bg-dark">
				<div class="container pb-5">
					<div class="row">
						<div class="col">
							<div class="row">
								<div class="col-lg-4 mt-4 p-3">
									<h2 class="mb-4 mb-4 mt-3">About Us</h2>
									<h4>Expedite is a job portal, online job management system developed by Aaron Christian Delos Reyes, John Kevin Golveo, Jan Michael Nicerio, and Niel Adiran Lopez for his project in April 2023.</h4>
								</div>
								<div class="col-lg-4 mt-3 p-3">
									<h2 class="mb-4 mt-4">Quick Links</h2>
									<div class="row">
										<div class="col-lg-6">
											<a href="index.php" class="link-muted"><p>Home</p></a>
											<!-- <a href="job_list.php" class="link-muted"><p>Job List</p></a> -->
											<a href="partners.php" class="link-muted"><p>Partners</p></a>
											<!-- <a href="freelancers.php" class="link-muted"><p>Freelancers</p></a> -->
										</div>
										<div class="col-lg-6">
											<a href="about_us.php" class="link-muted"><p>About Us</p></a>
											<a href="contact_us.php" class="link-muted"><p>Contact Us</p></a>
											<a href="login_admin.php" class="link-muted"><p>Admin Login</p></a>
										</div>
									</div>
								</div>
								<div class="col-lg-4 mt-3 p-3">
									<h2 class= "mb-4 mt-4">Contact Details</h2>
									<p style="text-align: justify;">Address: Amafel Building, Aguinaldo Highway, Dasmarinas, Cavite</p>
									<p style="text-align: justify;">Email: <a href="mailto:expeditephilippines@gmail.com " class="link-muted">expeditephilippines@gmail.com</a></p>
									<p style="text-align: justify;">Phone: <a href="tel:+639762728869" class="link-muted">+63 976 272 8869</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="lg:col-auto lg:order-last">
							<div class="col-12">
								<div class="list-inline-dots" style="display: flex; justify-content: space-between; align-items: flex-end;">
									<div>
										<a class="link-muted" href="terms.php">Terms of service</a>
										<span class="link-muted">/</span>
										<a class="link-muted" href="privacy_policy.php">Privacy Policy</a>
									</div>
									<a href="https://expediteph.com/" class="link-muted" target="_blank" rel="noopener noreferrer" style="float: left;">© Expedite PH</a>
								</div>
							</div>
						</div>
					</div>
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
?>
</body>
</html>