<?php
/*
Template Name: Story List
*/

get_header(); ?>
	
	<h1 class="gomike-piece-title gomike-page-title"><?php the_title(); ?></h1>
	
	<div class="gomike-piece-content gomike-page-content">
		<?php the_content(); ?>
		
		<?php gomike_story_list(); ?>
		
	</div> <!-- POST_CONTENT -->
	
<?php get_footer(); ?>