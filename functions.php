<?php

use Mezun\GoGoMikeMike\WPMetaBox;
use WaughJ\WPAdminMenuManager\WPAdminMenuManager;
use Mezun\GoGoMikeMike\WPUploadImage;

require_once( 'vendor/autoload.php' );

$random_img_list = null;

function gomike_current_year() : string
{
	date_default_timezone_set( 'UTC' );
	return strval( date( 'Y' ) );
};

function gomike_list_rand_index( $list, $start_limit = 0, $end_limit = 0 )
{
	return rand( 0 + $start_limit, sizeof( $list ) - ( 1 + $end_limit ) );
}

function gomike_list_rand( $list, $start_limit = 0, $end_limit = 0 )
{
	return $list[ gomike_list_rand_index( $list, $start_limit, $end_limit ) ];
};

function gomike_get_upload( $filename )
{
	return wp_upload_dir( '' )[ 'baseurl' ] . '/' . $filename;
};

function gomike_date_format()
{
	return 'Y M j';
};

function gomike_register_main_style()
{
	wp_register_style( 'main_css', get_template_directory_uri() . '/assets/dist/index.css' );
	wp_enqueue_style( 'main_css' );
};

function gomike_register_admin_style()
{
	wp_register_style( 'admin_css', get_template_directory_uri() . '/assets/dist/admin.css' );
	wp_enqueue_style( 'admin_css' );
}

function register_main_css()
{
	add_action( 'wp_enqueue_scripts', 'gomike_register_main_style' );
	add_action( 'admin_enqueue_scripts', 'gomike_register_admin_style' );
};

function gomike_register_main_script()
{
	wp_register_script( 'main', get_template_directory_uri() . '/assets/dist/index.js' );
	wp_enqueue_script( 'main' );
};

function register_main_js()
{
	add_action( 'wp_footer', 'gomike_register_main_script' );
};

function gomike_body_class()
{
	global $post;
	$class_template = 'gomike-body';
	$class = $class_template;

	if ( !empty( $post ) )
	{
		$class .= ' ' . $class_template . '-' . $post->post_name;
	}

	if ( is_home() )
		$class .= ' ' . $class_template . '-home';

	echo 'class="' . $class . '"';
};

function gomike_post_class()
{
	echo 'class="gomike-post"';
};

function gomike_print_meta( $key, $post_id = null, $single = true )
{
	echo gomike_get_meta( $key, $post_id, $single );
}

function gomike_get_meta( $key, $post_id = null, $single = true )
{

	if ( !$post_id )
	{
		$post_id = get_the_ID();
	}

	return get_post_meta( $post_id, $key, $single );
};

function gomike_oldest_post_link()
{
	$posts = get_posts( array( 'posts_per_page' => 1, 'order' => 'ASC' ) );

	foreach( $posts as $p )
	{
		if ( $p->ID != get_the_ID() )
		{
			echo  gomike_make_class( 'gomike-single-post-sequence-list-item', 'oldest', 'li' ) . '<a href="' . get_permalink( $p ) . '">&laquo; ' . $p->post_title . '</a></li>';
		}
	}
};

function gomike_older_post_link()
{
	previous_post_link( gomike_make_class( 'gomike-single-post-sequence-list-item', 'older', 'li' ) . '%link</li>', '&lsaquo; %title' );
};

function gomike_newer_post_link()
{
	next_post_link( gomike_make_class( 'gomike-single-post-sequence-list-item', 'newer', 'li' ) . '%link</li>', '%title &rsaquo;' );
};

function gomike_newest_post_link()
{
	$posts = get_posts( array( 'posts_per_page' => 1, 'order' => 'DESC' ) );

	foreach( $posts as $p )
	{
		if ( $p->ID != get_the_ID() )
		{
			echo  gomike_make_class( 'gomike-single-post-sequence-list-item', 'newest', 'li' ) . '<a href="' . get_permalink( $p ) . '">' . $p->post_title . ' &raquo;</a></li>';
		}
	}
};

function gomike_single_post_sequence( $type = 'top' )
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

function gomike_single_post_sequence_top()
{
	gomike_single_post_sequence( 'top' );
};

function gomike_single_post_sequence_bottom()
{
	gomike_single_post_sequence( 'bottom' );
};

function gomike_older_posts_link()
{
	if ( get_next_posts_link() )
	{
		gomike_print_class( 'gomike-group-posts-sequence-list-item', 'older', 'li' );
			next_posts_link( '&laquo; Older Stories' );
		echo '</li>';
	}
};

function gomike_newer_posts_link()
{
	if ( get_previous_posts_link() )
	{
		gomike_print_class( 'gomike-group-posts-sequence-list-item', 'newer', 'li' );
			previous_posts_link( 'Newer Stories &raquo;' );
		echo '</li>';
	}
};

function gomike_group_posts_sequence( $type = 'top' )
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

function gomike_group_posts_sequence_top()
{
	gomike_group_posts_sequence( 'top' );
};

function gomike_group_posts_sequence_bottom()
{
	gomike_group_posts_sequence( 'bottom' );
};

function gomike_make_class( $base_class, $specific_class = null, $element = null )
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


function gomike_print_class( $base_class, $specific_class = null, $element = null )
{
	echo gomike_make_class( $base_class, $specific_class, $element );
}

function gomike_main_nav()
{
	/*
	$page_list = get_pages();
	$link_class = 'gomike-main-nav-list-item';

	echo '<nav class="gomike-main-nav">';
		echo '<ul class="gomike-main-nav-list">';

			foreach ( $page_list as $page )
			{
				gomike_print_class( $link_class, $page->post_name, 'li' );
					echo '<a ' . gomike_make_class( 'gomike-main-nav-list-link', $page->post_name ) . ' href="' . get_permalink( $page->ID ) . '">' . $page->post_title . '</a>';
				echo '</li>';
			}

			$rand_post = get_posts( 'orderby=rand&posts_per_page=1' );

			foreach ( $rand_post as $r )
			{
				gomike_print_class( $link_class, 'random-story', 'li' );
					echo '<a ' . gomike_make_class( 'gomike-main-nav-list-link', 'random-story' ) . ' href="' . get_permalink( $r->ID ) . '">Random Story</a>';
				echo '</li>';
			}

		echo '</ul>';
	echo '</nav> <!-- MAIN_NAV -->';*/
	$menu = WPAdminMenuManager::getHeaderMenu();

	if ( empty( $menu ) ) return;

	?>
		<nav class="gomike-main-nav">
			<ul class="gomike-main-nav-list">
			<?php
				$list = $menu->getMenu();
				foreach ( $list as $item )
				{
					?>
						<li class="gomike-main-nav-list-item">
							<a class="gomike-main-nav-list-link" href="<?= $item->getUrl(); ?>">
								<?= $item->getTitle(); ?>
							</a>
						</li>
					<?php
				}
			?>
			</ul>
		</nav>
	<?php
};

function gomike_search()
{
	?>
	<!-- SEARCH -->
		<div class="gomike-search">
			<form method="get" id="searchform" action="/">
				<div id="gomike-search-input" class="gomike-search-input">
					<textarea
						name="s"
						class="gomike-search-bar"
						id="gomike-search-bar"
						placeholder="<?= __( 'Search', 'gogomikemike' ); ?>"
					></textarea>
				</div>
				<div class="gomike-search-submit">
					<input
						type="submit"
						value="<?= __( 'Search', 'gogomikemike' ); ?>"
						class="gomike-search-submit-input"
					/>
					<?php include( 'assets/dist/search.svg' ); ?>
				</div>
			</form>
		</div>
	<!-- SEARCH -->
	<?php
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

function gomike_story_list()
{
	$post_list = get_posts
	(
		array(
			'posts_per_page' => 9999,
			'order' => 'ASC'
		)
	);

	gomike_print_class( 'gomike-story-list', null, 'ul' );
	foreach( $post_list as $p )
	{
		gomike_print_class( 'gomike-story-list-item', null, 'li' );
		echo '<a ' . gomike_make_class( 'gomike-story-list-link' ) . ' href="' . get_permalink( $p->ID ) . '">';
			echo gomike_make_class( 'gomike-story-list-title', null, 'h2' ) . $p->post_title . '</h2>';
			echo gomike_make_class( 'gomike-story-list-date', null, 'p' ) . mysql2date( gomike_date_format(), $p->post_date ) . '</p>';
		echo '</a> <!-- STORY_LIST_LINK -->';
		echo '</li> <!-- STORY_LIST_ITEM -->';
	}
	echo '</ul> <!-- STORY_LIST -->';
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

function gomike_favicons() : void
{
	?>
		<link rel="apple-touch-icon" sizes="180x180" href="/wp-content/themes/gogomikemike/assets/dist/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/wp-content/themes/gogomikemike/assets/dist/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/wp-content/themes/gogomikemike/assets/dist/favicon-16x16.png">
		<link rel="manifest" href="/wp-content/themes/gogomikemike/assets/dist/site.webmanifest">
		<link rel="mask-icon" href="/wp-content/themes/gogomikemike/assets/dist/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="shortcut icon" href="/wp-content/themes/gogomikemike/assets/dist/favicon.ico">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-config" content="/wp-content/themes/gogomikemike/assets/dist/browserconfig.xml">
		<meta name="theme-color" content="#ffffff">
	<?php
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

add_action( 'wp_enqueue_scripts', 'gomike_remove_block_library' );
add_action( 'wp_enqueue_scripts', 'gomike_remove_jquery' );

// Turn on thumbnails.
add_theme_support( 'post-thumbnails' );

// Turn on title tag.
add_theme_support( 'title-tag' );

add_filter( 'big_image_size_threshold', '__return_false' );

register_main_css();
register_main_js();

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

WPAdminMenuManager::createHeaderMenu();

add_filter( 'pre_get_posts', 'gomike_exclude_pages_from_search' );