<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package paulphuapoker
 */

get_header();
?>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : ?>
			<div class="container" id="content-layout">
				<div class="container" id="news-content">
					<h1><?php the_title(); ?></h1>
					<?php 
					the_post();
					
					get_template_part( 'template-parts/content', get_post_type() );
					
					the_post_navigation(); 
					?>
				</div>
				<?php get_sidebar();?>
			</div>
		<?php
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
