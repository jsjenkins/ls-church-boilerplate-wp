				<!-- footer -->
				<footer class="footer" role="contentinfo">
					<div class="grid-container footer-content">
						<div class="grid-x grid-padding-x">
							<div class="cell">
								Footer stuff
								<nav class="footer-nav">
									<?php display_navigation('footer-nav'); ?>
								</nav>
							</div>
						</div>
					</div>

					<!-- copyright -->
					<section class="copyright">
						<div class="grid-container">
							<div class="grid-x grid-padding-x">
								<div class="cell medium-auto">
									<p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
									<?php display_navigation('policy-nav'); ?>
								</div>
								<div class="cell medium-shrink">
									<p><a href="http://landslidecreative.com">Website Design</a> by Landslide Creative</a>
								</div>
							</div>
						</div>
					</section>

				</footer>
			</div> <!-- /off-canvas-content -->
		<?php wp_footer(); ?>
	</body>
</html>
