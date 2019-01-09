<?php
/**
 * paulphuapoker functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package paulphuapoker
 */

if ( ! function_exists( 'paul_phua_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function paul_phua_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on paulphuapoker, use a find and replace
		 * to change 'paul-phua' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'paul-phua', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'paul-phua' ),
			'footer' => __( 'footer-menu', 'paul-phua' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'paul_phua_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'paul_phua_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function paul_phua_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'paul_phua_content_width', 640 );
}
add_action( 'after_setup_theme', 'paul_phua_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function paul_phua_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'paul-phua' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'paul-phua' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'paul_phua_widgets_init' );

/**
 * 
 * Register sidebar for single-tournament.php
 *
 */

function child_register_sidebar(){
    register_sidebar(array(
        'name' => 'Tournaments Sidebar',
        'id' => 'sidebar-tournament',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
}

add_action( 'widgets_init', 'child_register_sidebar' );

/**
 * Enqueue scripts and styles.
 */
function paul_phua_scripts() {
	wp_enqueue_style( 'paul-phua-style', get_stylesheet_uri() );

	wp_enqueue_script( 'paul-phua-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'paul-phua-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'paul_phua_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 ***************************** CUSTOM CODE ********************************
 */

/*
* Add ACF Options Page
*/
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

/*
 * Order ACF relationship items by date descending
 */
function my_relationship_query( $args, $field, $post_id ) {
	
	$args['order'] = 'DESC';
	$args['orderby'] = 'post_date';
	
	// return
    return $args;
    
}
// filter for every field
add_filter('acf/fields/relationship/query', 'my_relationship_query', 10, 3);

/*
* Register Custom Post Type
*/
function custom_post_type_tournament() {

	$labels = array(
		'name'                  => _x( 'Tournaments', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Tournament', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Tournaments', 'text_domain' ),
		'name_admin_bar'        => __( 'Tournaments', 'text_domain' ),
		'archives'              => __( 'Tournament Archives', 'text_domain' ),
		'attributes'            => __( 'Tournament Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Tournament:', 'text_domain' ),
		'all_items'             => __( 'All Tournaments', 'text_domain' ),
		'add_new_item'          => __( 'Add New Tournaments', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Tournaments', 'text_domain' ),
		'edit_item'             => __( 'Edit Tournaments', 'text_domain' ),
		'update_item'           => __( 'Update Tournaments', 'text_domain' ),
		'view_item'             => __( 'View Tournaments', 'text_domain' ),
		'view_items'            => __( 'View Tournaments', 'text_domain' ),
		'search_items'          => __( 'Search Tournaments', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Tournament', 'text_domain' ),
		'description'           => __( 'Major High Stakes Tournaments', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'revisions', 'page-attributes' ),
		'taxonomies'            => array( 'tournament_category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-tickets-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'Tournament', $args );

}
add_action( 'init', 'custom_post_type_tournament', 0 );


/*
 * initial posts display
 */
function script_load_more($args = array()) {
    //initial posts load
    echo '<div id="ajax-primary" class="content-area">';
        echo '<div id="ajax-content" class="content-area">';
            ajax_script_load_more($args);
		echo '<a href="javascript:;" id="loadMore"  data-page="1" data-url="'.admin_url("admin-ajax.php").'" >Scroll down for more</a>';
		echo '</div>';
    echo '</div>';
}

/*
 * create short code.
 */
add_shortcode('ajax_posts', 'script_load_more');

/*
 * load more script call back
 */
function ajax_script_load_more($args) {
    //init ajax
    $ajax = false;
    //check ajax call or not
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $ajax = true;
    }
    //number of posts per page default
    $num =5;
    //page number
    $paged = $_POST['page'] + 1;
    //args
    $args = array(
        'post_type' => 'tournament',
        'post_status' => 'publish',
        'posts_per_page' =>$num,
        'paged'=>$paged
    );
    //query
    $query = new WP_Query($args);
    //check
    if ($query->have_posts()):
        //loop articales
        while ($query->have_posts()): $query->the_post();
            //include articles template
            include 'template-parts/content-tournament.php';
        endwhile;
    else:
        echo 0;
    endif;
    //reset post data
    wp_reset_postdata();
    //check ajax call
    if($ajax) die();
}

/*
 * load more script ajax hooks
 */
add_action('wp_ajax_nopriv_ajax_script_load_more', 'ajax_script_load_more');
add_action('wp_ajax_ajax_script_load_more', 'ajax_script_load_more');

/*
 * enqueue js script
 */
add_action( 'wp_enqueue_scripts', 'ajax_enqueue_script' );
/*
 * enqueue js script call back
 */
function ajax_enqueue_script() {
    wp_enqueue_script( 'script_ajax', get_theme_file_uri( '/js/script_ajax.js' ), array( 'jquery' ), '1.0', true );
}

/*
 * Exclude current post from recent posts
 */
function be_exclude_current_post( $args ) {
	if( is_singular() && !isset( $args['post__in'] ) )
		$args['post__not_in'] = array( get_the_ID() );
	return $args;
}
add_filter( 'widget_posts_args', 'be_exclude_current_post' );

/*
 * Add search and filter on Opinions page
 */
function my_filters(){
    $args = array(
        'orderby' => 'date',
		'order' => $_POST['date'],
		'paged' => $paged,
		'category__not_in' => array(1),
		'posts_per_page' => 100,
		'post_status' =>'publish'
    );
  
        if( isset( $_POST['categoryfilter'] ) )
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'id',
				'terms' => $_POST['categoryfilter'],
            )
        );
   
    $query = new WP_Query( $args );
  
    if( $query->have_posts() ) : ?>
		<div id="news-archive">
		<?php while( $query->have_posts() ): $query->the_post();?>
			<div id="news-archive-item" class="hvr-bubble-float-bottom">
				<?php $thumb_url = srcset_post_thumbnail($medium) ?>
				<a href="<?php the_permalink(); ?>"><img src="<?= $thumb_url ?>" alt="<?= $query->post->post_title ?>"></a>
				<a href="<?php the_permalink(); ?>">
					<p>
						<?php
						$thetitle = $query->post->post_title; /* or you can use get_the_title() */
						$getlength = strlen($thetitle);
						$thelength = 75;
						echo substr($thetitle, 0, $thelength);
						if ($getlength > $thelength) echo "...";
						?>
					</p>
				</a>
			</div>
		<?php endwhile;
		wp_reset_postdata();?>
		</div>
	<?php
	else :
        echo 'No posts found';
	endif;
	
    die();
}
add_action('wp_ajax_customfilter', 'my_filters');
add_action('wp_ajax_nopriv_customfilter', 'my_filters');

function srcset_post_thumbnail($defaultSize = 'medium')
{  
    // those are the default thumbnail sizes for wordpress.
    // we can -and should- define our own sizes according to our breakpoints

    $thumbnailSizes = [
        'thumbnail',
        'medium',
        'large',
        'full'
    ];
    
    // here, we add our breakpoints as detailed in https://css-tricks.com/video-screencasts/133-figuring-responsive-images/
    // thanks @chriscoyier

    $html = '<img sizes="';
    $html .= '(max-width: 30em) 100vw, ';
    $html .= '(max-width: 50em) 50vw, ';
    $html .= 'calc(33vw - 100px)" ';
    $html .= 'srcset="';

    $thumb_id = get_post_thumbnail_id();

    for ($i = 0; $i < count($thumbnailSizes); $i++) {
        $thumb = wp_get_attachment_image_src($thumb_id, $thumbnailSizes[$i], true);

        $url = $thumb[0];
        $width = $thumb[1];

        $html .= $url . ' ' . $width . 'w';

        if ($i < count($thumbnailSizes) - 1) {
            $html .= ', ';
        }
    }

    $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);

    $thumbMedium = wp_get_attachment_image_src($thumb_id, $defaultSize, true);

    $html .= '" ';
    $html .= 'src="' . $thumbMedium[0];

    return $html;
}

// we can output our srcset post-thumbnail via the function srcset_post_thumbnail($size);

/*
 * add shortcode filter to text fields
 */
add_filter('acf/format_value/type=text', 'do_shortcode');










