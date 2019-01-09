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
 * Template Name: Articles
 */

get_header();
?>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main">

			<section id="featured">
				<h1><?php the_field( 'page_header' ); ?></h1>
				<?php $news_listings = get_field( 'news_listings' ); ?>
				<?php if ( $news_listings ): ?>
					<div id="featured-items-wrapper">
						<?php foreach ( $news_listings as $post ):  
							$thumb_url = get_the_post_thumbnail_url($post->ID); ?>
							<?php setup_postdata ( $post ); ?>
							<div id="featured-item" class="hvr-bubble-float-bottom">
								<a href="<?php the_permalink(); ?>"><img src="<?= $thumb_url ?>" alt="<?php the_title(); ?>"/></a>
								<a href="<?php the_permalink(); ?>">
									<p>
										<?php
										$thetitle = $post->post_title; /* or you can use get_the_title() */
										$getlength = strlen($thetitle);
										$thelength = 75;
										echo substr($thetitle, 0, $thelength);
										if ($getlength > $thelength) echo "...";
										?>
									</p>
								</a>
							</div>
						<?php endforeach; ?>
					</div>
				<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</section>	

			<section id="search-posts">
				<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
					<?php
						$exclude_ids   = array();
						$exclude_names = array("Uncategorized"); // Term NAMES to exclude
						
						foreach( $exclude_names as $name ){
							$excluded_term = get_term_by( 'name', $name, 'category' );
							$exclude_ids[] = (int) $excluded_term->term_id; // Get term_id (as a string), typcast to an INT
						} 
						
						$term_args = array(
							'taxonomy' => 'category',
							'orderby' => 'name',
							'order'   => 'ASC',
							'exclude' => $exclude_ids
						);
						if( $terms = get_terms( $term_args ) ) :
							echo '<select name="categoryfilter"><option>Select category...</option>';
							foreach ( $terms as $term ) :
								echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';
							endforeach;
							echo '</select>';
						endif;
					?>
					<label>
						<input type="radio" name="date" value="ASC" /> Date: Ascending
					</label>
					<label>
						<input type="radio" name="date" value="DESC" selected="selected" /> Date: Descending
					</label>
					<button id="apply-filter">Apply filters</button>
					<input type="hidden" name="action" value="customfilter">
				</form>

				<div id="response">
					<?php 
						// the query
						$wpb_all_query = new WP_Query(array(
							'post_type'=>'post', 
							'post_status'=>'publish',
							'category__not_in' => 1,
							'posts_per_page'=>10,
							'order' => 'DESC',
							'orderby' => 'date'
						)); 
					?>
					
					<?php if ( $wpb_all_query->have_posts() ) : ?>
					
						<div id="news-archive">
							<!-- the loop -->
							<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
								<div id="news-archive-item" class="hvr-bubble-float-bottom">
								<?php $thumb_url = get_the_post_thumbnail_url($post->ID); ?>
									<a href="<?php the_permalink(); ?>"><img src="<?= $thumb_url ?>" alt="<?php the_title(); ?>"/></a>
									<a href="<?php the_permalink(); ?>">
										<p>
											<?php
											$thetitle = $post->post_title; /* or you can use get_the_title() */
											$getlength = strlen($thetitle);
											$thelength = 60;
											echo substr($thetitle, 0, $thelength);
											if ($getlength > $thelength) echo "...";
											?>
										</p>
									</a>
								</div>
							<?php endwhile; ?>
							<!-- end of the loop -->
							
						</div>
					
						<?php wp_reset_postdata(); ?>
					
					<?php else : ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					<?php endif; ?>
				</div>
				
				<script async>
					jQuery(function($){
						$('#filter').submit(function(){
							var filter = $('#filter');
							$.ajax({
								url:filter.attr('action'),
								data:filter.serialize(), // form data
								type:filter.attr('method'), // POST
								beforeSend:function(xhr){
									filter.find('button').text('Applying Filters...');          
								},
								success:function(data){
									filter.find('button').text('Apply filters');                
									$('#response').html(data);
								}
							});
							return false;
						});
					});
					
				</script>
				<a href="#search-posts" id="cta-to-filter" class="hvr-float-shadow"><i class="fas fa-chevron-circle-up text-center"></i><p>Use Filter to load more</p></a>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
