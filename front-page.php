<?php get_header(); ?>

<?php $paged = get_query_var('paged') ? get_query_var( 'paged' ) : 1; ?>

<?php if ( $paged === 1 ) : ?>
    <div class="gomike-home-hero">
        <h1 class="screen-reader-text"><?= get_bloginfo( 'name' ); ?></h1>
        <?php include( 'assets/dist/microstories-logo-full.svg' ); ?>
        <div><?= __( 'Updates Tuesdays, Thursdays, & Saturdays', 'gogomikemike' ); ?></div>
    </div>
<?php else : ?>
    <h1 class="gomike-page-title"><?= __( 'Mo’ Stories', 'gogomikemike' ); ?></h1>
<?php endif; ?>

	<?php include( get_template_directory() . '/inc/post.php' ); ?>

<?php get_footer(); ?>