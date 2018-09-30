<?php get_header(); ?>
	
	<?php gomike_group_posts_sequence_top(); ?>
	
	<?php while ( have_posts() ) : the_post(); ?>
	
		<article <?php gomike_post_class(); ?>>
		
			<?php gomike_single_post_sequence_top(); ?>
		
			<h1 class="gomike-piece-title gomike-post-title<?php if ( is_single() ) { ?> gomike-post-title-single<?php } ?>">
				<?php if ( !is_single() ) { ?><a href="<?php the_permalink(); ?>"><?php } ?>
					<?php the_title(); ?>
				<?php if ( !is_single() ) { ?></a><?php } ?>
			</h1>
			
			<?php gomike_random_img(); ?>
			
			<div class="gomike-piece-content gomike-post-content">
				<?php the_content(); ?>
			</div> <!-- POST_CONTENT -->
			
			<div class="gomike-post-created">
				<h2 class="gomike-post-subheader gomike-post-subheader-created">Originally Created:</h2>
					<p><?php the_time( get_option( 'date_format' ) ); ?></p>
			</div> <!-- CREATED -->
			
			<?php if ( gomike_get_meta( 'prompt' ) ) { ?>
				<div class="gomike-post-prompt">
					<h2 class="gomike-post-subheader gomike-post-subheader-prompt">Prompt:</h2>
						<p><?php gomike_print_meta( 'prompt' ); ?></p>
				</div> <!-- PROMPT -->
			<?php } ?>

			<div class="gomike-post-ratings">
				<h2 class="gomike-post-subheader gomike-post-subheader-ratings">Rating:</h2>
				<p><?php if(function_exists('the_ratings')) { the_ratings(); } ?></p>
			</div> <!-- POST_RATINGS -->
			
			<?php gomike_single_post_sequence_bottom(); ?>
			
		</article>

	<?php endwhile; ?>
	
	<?php gomike_group_posts_sequence_bottom(); ?>
	
<?php get_footer(); ?>