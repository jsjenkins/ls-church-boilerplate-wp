<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?></title>

		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div class="off-canvas position-right" id="offCanvas" data-off-canvas data-auto-focus="false">
			<ul class="off-canvas-navigation">
	        	<?php display_simple_navigation('mobile-nav'); ?>
	        </ul>
		</div>
		<div class="off-canvas-content" data-off-canvas-content>
			<header class="header" role="banner">
				<div class="grid-container">
					<div class="grid-x">
						<div class="cell">
							<div class="logo">
								<a href="<?php echo home_url(); ?>">
									<img src="<?php echo get_image_directory(); ?>/logo.png" alt="" class="logo-img">
								</a>
							</div>
							<nav class="main-nav">
								<?php display_navigation('main-nav'); ?>
							</nav>
						</div>
					</div>
				</div>
			</header>
