<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package paulphuapoker
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<!-- <link rel="stylesheet" href="/css/style.css"> -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header">
		<div class="site-branding logo-bar container-fluid text-center">
			<?php if ( get_field( 'header_logo', 'option' ) ) { ?>
				<a href="<?= esc_url(home_url('/')); ?>">
					<?php if ( get_field( 'header_logo', 'option' ) ) { ?>
						<img src="<?php the_field( 'header_logo', 'option' ); ?>" alt="Paul Phua Poker Logo"/>
					<?php } ?>
				</a>
			<?php } ?>
		</div><!-- .site-branding -->
		
		<div class="header-nav container">

			<nav id="site-navigation" class="main-navigation container nav-bar">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
				?>
			</nav><!-- #site-navigation -->
			
			<div id="social-nav">
				<?php if ( have_rows( 'social_nav', 'option' ) ): ?>
					<?php while ( have_rows( 'social_nav', 'option' ) ) : the_row(); ?>
						<?php if ( get_row_layout() == 'social_nav' ) : ?>
							<ul>
								<?php if ( have_rows( 'social_media_outlets' ) ) : ?>
									<?php while ( have_rows( 'social_media_outlets' ) ) : the_row(); ?>
										
										<?php $social_media = get_sub_field( 'social_media' ); ?>
										<?php if ( $social_media ) { ?>
											<li>
												<a href="<?php echo $social_media['url']; ?>" target="<?php echo $social_media['target']; ?>" class="hvr-float">
													<?php if ( get_sub_field( 'social_media_icon' ) ) { ?>
														<img src="<?php the_sub_field( 'social_media_icon' ); ?>" alt="<?php echo $social_media['title']; ?>" />
													<?php } ?>
												</a>
											</li>
										<?php } ?>
										
									<?php endwhile; ?>
								<?php else : ?>
									<?php // no rows found ?>
								<?php endif; ?>
							</ul>
						<?php endif; ?>
					<?php endwhile; ?>
				<?php else: ?>
					<?php // no layouts found ?>
				<?php endif; ?>
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
