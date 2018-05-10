				<!-- footer -->
				<footer class="footer" role="contentinfo">
					<div class="grid-container">
						<div class="grid-x grid-padding-x">
							<div class="cell">
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
								<div class="cell">
									<p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?><br />
									Site by <a href="http://landslidecreative.com">Landslide Creative</a></p>
								</div>
							</div>
						</div>
					</section>

				</footer>
			</div> <!-- /off-canvas-content -->
		<?php wp_footer(); ?>
	</body>
</html>
