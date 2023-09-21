<?php get_header(); ?>
	
	<h1>Search for “<?= esc_html( get_search_query( true ) ); ?>”</h1>

	<?php if ( have_posts() ) : ?>
		<?php include( get_template_directory() . '/inc/post.php' ); ?>
	<?php else : ?>
		<p>No results.</p>
	<?php endif; ?>

<?php get_footer(); ?>
