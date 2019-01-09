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
 */

get_header();
?>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main">

		<section id="watch">
			<h1><?php the_field( 'video_page_header' ); ?></h1>
			<div id="watch">
				<?php the_field( 'video_gallery' ); ?>
			</div>
		</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
