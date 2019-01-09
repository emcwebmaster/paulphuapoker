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
 * Template Name: About
 */

get_header();
?>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main">

			<section id="about">
				<h1><?php the_field( 'about_header' ); ?></h1>
			<?php if ( get_field( 'about_image' ) ) { ?>
				<img src="<?php the_field( 'about_image' ); ?>" alt="Paul Phua About" id="about-image"/>
			<?php } ?>
			<p id="about1"><?php the_field( 'about_text_1' ); ?></p>
			<p id="about2"><?php the_field( 'about_text_2' ); ?></p>
			</section>

			<section id="founder-note hidden">
				<h2><?php the_field( 'founder_note_header' ); ?></h2>
				<div id="note">
					<p><?php the_field( 'founder_note' ); ?></p>
					<?php if ( get_field( 'founder_signature' ) ) { ?>
						<img src="<?php the_field( 'founder_signature' ); ?>" alt="Paul Phua Signature" id="signature"/>
					<?php } ?>
				</div>
				<?php if ( get_field( 'founder_image' ) ) { ?>
					<img src="<?php the_field( 'founder_image' ); ?>" alt="Paul Phua"/>
				<?php } ?>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
