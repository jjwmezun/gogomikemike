<?php get_header(); ?>
	
	<?php gomike_group_posts_sequence_top(); ?>
	
	<?php while ( have_posts() ) : the_post(); ?>
		
			<h1 class="gomike-piece-title gomike-page-title"><?php the_title(); ?></h1>
			
			<div class="gomike-piece-content gomike-page-content">
				<?php the_content(); ?>
			</div> <!-- POST_CONTENT -->

	<?php endwhile; ?>
	
<?php get_footer(); ?>