<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package paulphuapoker
 * 
 * Template Name: Tournaments
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section id="tournaments" class="container">
				<div id="header-container">
					<h1>High Stakes Tournaments</h1>
				</div>	
				<?php echo do_shortcode('[ajax_posts]'); ?>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
