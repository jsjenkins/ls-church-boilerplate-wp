<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?></title>

		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<?php wp_head(); ?>

		<?php the_field('gtm_head', 'options'); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php the_field('gtm_body', 'options'); ?>

		<div class="off-canvas position-right" id="offCanvas" data-off-canvas data-trap-focus="true">
			<ul class="off-canvas-navigation">
	        	<?php display_simple_navigation('mobile-nav'); ?>
	        	<button class="close-off-canvas" aria-label="Close menu" type="button" data-close>
			      Close Menu
			    </button>
	        </ul>
		</div>
		<div class="off-canvas-content" data-off-canvas-content>
			<header class="header" role="banner">
				<div class="accessibility-nav">
					<a href="#main-content" class="skip-link">Skip to Main Content</a>
				</div>
				<?php if( get_field('alert_toggle', 'options') ) { ?>
					<div class="alert-bar">
						<button class="close-button" data-close>&times;</button>
						<?php the_field('alert_copy', 'options'); ?>
					</div>
				<?php } ?>
				<div class="grid-container" id="main-navigation">
					<div class="grid-x vertical-center">
						<div class="cell auto">
							<div class="logo">
								<a href="<?php echo home_url(); ?>">
									<?php $site_logo = get_field( 'site_logo', 'options');
									if( $site_logo ) { ?>
										<img src="<?php echo acf_image_single( 'site_logo', 'small', FALSE, 'options' ); ?>" alt="" class="logo-img" />
									<?php } else { ?>
										<img src="<?php echo get_image_directory(); ?>/logo.png" alt="" class="logo-img" />
									<?php } ?>
								</a>
							</div>
						</div>
						<div class="cell shrink">
							<nav class="main-nav">
								<?php display_navigation('main-nav'); ?>
							</nav>
							<div class="mobile-nav-toggle">
								<a href="#" class="off-canvas-toggle" data-toggle="offCanvas" aria-label="Mobile Navigation">
									<div></div>
									<div></div>
									<div></div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</header>
