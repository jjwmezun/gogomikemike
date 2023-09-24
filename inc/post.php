<?php
	global $wp_query;
    $titleTag = is_single() ? 'h1' : 'h2';
    $subheaderTag = is_single() ? 'h2' : 'h3';
?>

<?php gomike_group_posts_sequence_top(); ?>

<?php if ( have_posts() ) : ?>

    <?php $images = gomike_get_rand_images( intval( $wp_query->found_posts ) ); ?>

    <?php while ( have_posts() ) : ?>
        <?php the_post(); ?>

        <article class="gomike-post">

            <?php gomike_single_post_sequence_top(); ?>

            <<?= $titleTag; ?> class="gomike-piece-title gomike-post-title<?php if ( is_single() ) { ?> gomike-post-title-single<?php } ?>">
                <?php if ( !is_single() ) { ?><a href="<?php the_permalink(); ?>"><?php } ?>
                    <?php the_title(); ?>
                <?php if ( !is_single() ) { ?></a><?php } ?>
            </<?= $titleTag; ?>>
            <div class="gomike-post-date"><?php the_time( get_option( 'date_format' ) ); ?></div>

            <?= gomike_render_image( array_pop( $images ) ); ?>

            <div class="gomike-piece-content gomike-post-content">
                <?php the_content(); ?>
            </div> <!-- POST_CONTENT -->

            <?php if ( gomike_get_meta( 'prompt' ) ) { ?>
                <div class="gomike-post-prompt">
                    <<?= $subheaderTag; ?> class="gomike-post-subheader gomike-post-subheader-prompt">
                        <?= __( 'Prompt:', 'gogomikemike' ); ?>
                    </<?= $subheaderTag; ?>>
                        <p><?php gomike_print_meta( 'prompt' ); ?></p>
                </div> <!-- PROMPT -->
            <?php } ?>

            <?php gomike_single_post_sequence_bottom(); ?>

        </article>

    <?php endwhile; ?>
<?php endif; ?>

<?php gomike_group_posts_sequence_bottom(); ?>