<?php
/*
Template Name: Archives
*/

gomike_register_archives_js();

$postList = gomike_get_post_list();

get_header(); ?>
	
	<h1 class="gomike-piece-title gomike-page-title"><?php the_title(); ?></h1>
	
	<div class="gomike-piece-content gomike-page-content">
		<?php the_content(); ?>
		
		<div id="gomike-story-archive" class="gomike-story-archive">
			<ul class="gomike-story-list">
				<?php foreach ( $postList as $post ) : ?>
					<li class="gomike-story-list-item">
						<h2 class="gomike-story-list-title">
							<a href="<?= get_permalink( $post->ID ); ?>" class="gomike-story-list-link">
								<?= html_entity_decode( $post->post_title ); ?>
							</a>
						</h2>
						<div class="gomike-story-list-date">
							<time datetime="<?= $post->post_date; ?>">
								<?= mysql2date( get_option( 'date_format' ), $post->post_date ); ?>
							</time>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		
	</div> <!-- POST_CONTENT -->
	
<?php get_footer(); ?>