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
 * Template Name: Contact Us
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<section id="contact-header" class="container-fluid" 
				<?php if ( get_field( 'contact_info_banner' ) ) { ?>
					style="background: url('<?php the_field( 'contact_info_banner' ); ?>') center center;
				<?php } ?> background-size: cover;">
				<div id="contact-info" class="container-fluid">
					<h1><?php the_field( 'contact_header' ); ?></h1>
					<?php if ( have_rows( 'contact_info_section' ) ) : ?>
						<ul>
							<?php while ( have_rows( 'contact_info_section' ) ) : the_row(); ?>
								<?php $contact_link = get_sub_field( 'contact_link' ); ?>
								<?php if ( $contact_link ) { ?>
									<li><?php the_sub_field( 'contact_icon' ); ?>&nbsp;<a href="<?php echo $contact_link['url']; ?>" target="<?php echo $contact_link['target']; ?>"><p><?php echo $contact_link['title']; ?></p></a></li>
								<?php } ?>
							<?php endwhile; ?>
						</ul>
					<?php else : ?>
						<?php // no rows found ?>
					<?php endif; ?>
				</div>
			</section>
			<section id="contact-page" class="container">
				<p><?php the_field( 'contact_form_details' ); ?></p>
				<div id="contact-form">
					<?php the_field( 'contact_form_shortcode' ); ?>
				</div>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
