<?php

use Mezun\GoGoMikeMike\WPMetaBox;
use WaughJ\WPAdminMenuManager\WPAdminMenuManager;
use Mezun\GoGoMikeMike\WPUploadImage;

require_once( 'vendor/autoload.php' );

function gomike_current_year() : string
{
	date_default_timezone_set( 'UTC' );
	return strval( date( 'Y' ) );
};

function gomike_register_main_style() : void
{
	wp_register_style( 'main_css', get_template_directory_uri() . '/assets/dist/index.css' );
	wp_enqueue_style( 'main_css' );
};

function gomike_register_admin_style() : void
{
	wp_register_style( 'admin_css', get_template_directory_uri() . '/assets/dist/admin.css' );
	wp_enqueue_style( 'admin_css' );
}

function gomike_register_main_css() : void
{
	add_action( 'wp_enqueue_scripts', 'gomike_register_main_style' );
	add_action( 'admin_enqueue_scripts', 'gomike_register_admin_style' );
};

function gomike_register_main_script() : void
{
	wp_register_script( 'main', get_template_directory_uri() . '/assets/dist/index.js', [], '0.1.2', [ 'strategy' => 'defer' ] );
	wp_enqueue_script( 'main' );
};

function gomike_register_archives_script() : void
{
	wp_register_script( 'archives', get_template_directory_uri() . '/assets/dist/archives.js', [], '0.1.2', [ 'strategy' => 'defer' ] );
	wp_enqueue_script( 'archives' );
};

function gomike_register_main_js() : void
{
	add_action( 'wp_enqueue_scripts', 'gomike_register_main_script' );
};

function gomike_register_archives_js() : void
{
	add_action( 'wp_enqueue_scripts', 'gomike_register_archives_script' );
};

function gomike_print_meta( string $key, ?int $post_id = null, bool $single = true ) : void
{
	echo gomike_get_meta( $key, $post_id, $single );
}

function gomike_get_meta( string $key, ?int $post_id = null, bool $single = true ) : string
{
	if ( !$post_id )
	{
		$post_id = get_the_ID();
	}

	return get_post_meta( $post_id, $key, $single );
};

function gomike_older_post_link() : void
{
	previous_post_link( gomike_make_class( 'gomike-single-post-sequence-list-item', 'older', 'li' ) . '%link</li>', '&lsaquo; %title' );
};

function gomike_newer_post_link() : void
{
	next_post_link( gomike_make_class( 'gomike-single-post-sequence-list-item', 'newer', 'li' ) . '%link</li>', '%title &rsaquo;' );
};

function gomike_single_post_sequence( string $type = 'top' ) : void
{
	if ( is_single() )
	{
		gomike_print_class( 'gomike-single-post-sequence-nav', $type, 'nav' );
			gomike_print_class( 'gomike-single-post-sequence-list', $type, 'ul' );
				gomike_older_post_link();
				gomike_newer_post_link();
			echo '</ul>';
		echo '</nav> <!-- POST_SEQUENCE_NAV -->';
	}
};

function gomike_single_post_sequence_top() : void
{
	gomike_single_post_sequence( 'top' );
};

function gomike_single_post_sequence_bottom() : void
{
	gomike_single_post_sequence( 'bottom' );
};

function gomike_older_posts_link() : void
{
	if ( get_next_posts_link() )
	{
		gomike_print_class( 'gomike-group-posts-sequence-list-item', 'older', 'li' );
			next_posts_link( '&laquo; Older Stories' );
		echo '</li>';
	}
};

function gomike_newer_posts_link() : void
{
	if ( get_previous_posts_link() )
	{
		gomike_print_class( 'gomike-group-posts-sequence-list-item', 'newer', 'li' );
			previous_posts_link( 'Newer Stories &raquo;' );
		echo '</li>';
	}
};

function gomike_group_posts_sequence( $type = 'top' ) : void
{
	?>
		<nav class="gomike-group-posts-sequence-nav gomike-group-posts-sequence-nav<?= $type; ?>">
			<ul class="gomike-group-posts-sequence-list">
				<?php gomike_older_posts_link(); ?>
				<?php gomike_newer_posts_link(); ?>
			</ul>
		</nav>
	<?php
}

function gomike_group_posts_sequence_top() : void
{
	gomike_group_posts_sequence( 'top' );
};

function gomike_group_posts_sequence_bottom() : void
{
	gomike_group_posts_sequence( 'bottom' );
};

function gomike_make_class( string $base_class, string $specific_class = null, string $element = null ) : string
{
	$string = '';

	if ( $element )
	{
		$string = '<' . $element . ' ';
	}

	$string .= 'class="' . $base_class;

	if ( $specific_class )
	{
		$string .= ' ' . $base_class . '-' . $specific_class;
	}

	$string .= '"';

	if ( $element )
	{
		$string .= '>';
	}

	return $string;
};


function gomike_print_class( string $base_class, string $specific_class = null, string $element = null ) : void
{
	echo gomike_make_class( $base_class, $specific_class, $element );
};

function gomike_main_content_class()
{
	global $post;
	$class_template = 'gomike-main-content';
	$class = $class_template;

	if ( !empty( $post ) )
	{
		$class .= ' ' . $class_template . '-' . $post->post_name;
	}

	echo 'class="' . $class . '"';
};

function gomike_get_post_list() : array
{
	return get_posts
	([
		'posts_per_page' => -1,
		'order' => 'ASC'
	]);
};

function gomike_get_rand_images( int $n ) : array
{
	return get_posts
	([
		'post_type' => 'randimage',
		'orderby' => 'rand',
		'numberposts' => $n,
		'meta_query' => [[ 'key' => '_thumbnail_id' ]] // Only get randimages with thumbnails set.
	]);
};

function gomike_render_image( ?\WP_Post $image ) : void
{
	if ( empty( $image ) ) return;

	$thumbnailId = get_post_thumbnail_id( $image->ID );

	if ( empty( $thumbnailId ) ) return;

	global $gomikeBorderlessOption;
	$isBorderless = $gomikeBorderlessOption->getValue( $image->ID );

	$imageClass = 'gomike-image';
	if ( $isBorderless === 'on' )
	{
		$imageClass .= ' gomike-image-borderless';
	}

	$imageHTML = new WPUploadImage( $thumbnailId, 'responsive', [ 'class' => $imageClass ] );

	?>
		<figure class="gomike-image-frame">
			<?php $imageHTML->print(); ?>
			<?php if ( !empty( $image->post_content ) ) : ?>
				<figcaption class="gomike-image-credit">
					<?= wp_kses_post( $image->post_content ); ?>
				</figcaption>
			<?php endif; ?>
		</figure>
	<?php
}

function gomike_remove_block_library() : void
{
	wp_dequeue_style( 'wp-block-library' );
	wp_deregister_style( 'wp-block-library' );
}

function gomike_remove_jquery() : void
{
	wp_dequeue_script( 'jquery' );
	wp_deregister_script( 'jquery' );
}

function gomike_exclude_pages_from_search( \WP_Query $query ) : void
{
	// Skip if not search or in admin.
	if
	(
		is_admin()
		|| !$query->is_main_query()
		|| !$query->is_search
	)
	{
		return;
	}

	$query->set( 'post_type', 'post' );
}

function gomike_get_canonical_url() : string
{
	global $wp;
	$canonical = home_url( $wp->request );
	if ( !str_ends_with( $canonical, '/' ) )
	{
		$canonical .= '/';
	}
	if ( is_search() )
	{
		$vars = [ 's' => $wp->query_vars[ 's' ] ];
		$canonical = add_query_arg( $vars, $canonical );
	}
	return $canonical;
}

// Remove default JS.
add_action( 'wp_enqueue_scripts', 'gomike_remove_block_library' );
add_action( 'wp_enqueue_scripts', 'gomike_remove_jquery' );

// Turn on thumbnails.
add_theme_support( 'post-thumbnails' );

// Turn on title tag.
add_theme_support( 'title-tag' );

add_filter( 'big_image_size_threshold', '__return_false' );

// Register main CSS & JS.
gomike_register_main_css();
gomike_register_main_js();

// Add prompt post option.
new WPMetaBox
(
	'prompt',
	'Prompt',
	[
		'post-type' => [ 'post' ]
	]
);

// Add randimages post type.
register_post_type
(
    'randimage',
    [
        'labels' =>
        [
            'name' => _x( 'Randimages', 'post-type', 'gogomikemike' ),
            'singular_name' => _x( 'Randimage', 'post-type', 'gogomikemike' )
        ],
        'public' => true,
        'has_archive' => false,
        'show_in_rest' => false,
        'supports' => [ 'editor', 'title', 'thumbnail' ],
		'exclude_from_search' => true
    ]
);

// Add “¿Is borderless?” option to randimages.
$gomikeBorderlessOption = new WPMetaBox
(
	'borderless',
	'¿Is borderless?',
	[
		'post-type' => [ 'randimage' ],
		'input-type' => 'checkbox'
	]
);

// Create header menu.
WPAdminMenuManager::createHeaderMenu();

// Exclude pages from search.
add_filter( 'pre_get_posts', 'gomike_exclude_pages_from_search' );