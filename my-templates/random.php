<?php /* Template Name: Random */ ?>

<?php
    global $post;
    $posts = [];
    while ( empty( $posts ) )
    {
        $posts = get_posts
        ([
            'post_type' => 'post',
            'orderby' => 'rand',
            'numberposts' => 1
        ]);
    }
    $post = $posts[ 0 ];
?>

<?php get_header(); ?>

    <?php $images = gomike_get_rand_images( 1 ); ?>

    <article class="gomike-post">

        <h1 class="gomike-piece-title gomike-post-title">
            <?php the_title(); ?>
        </h1>
        <div class="gomike-post-date"><?php the_time( get_option( 'date_format' ) ); ?></div>

        <?= gomike_render_image( array_pop( $images ) ); ?>

        <div class="gomike-piece-content gomike-post-content">
            <?php the_content(); ?>
        </div> <!-- POST_CONTENT -->

        <?php if ( gomike_get_meta( 'prompt' ) ) : ?>
            <div class="gomike-post-prompt">
                <h2 class="gomike-post-subheader gomike-post-subheader-prompt">
                    <?= __( 'Prompt:', 'gogomikemike' ); ?>
                </h2>
                    <p><?php gomike_print_meta( 'prompt' ); ?></p>
            </div> <!-- PROMPT -->
        <?php endif; ?>

    </article>

    <div>
        <p>
            <a href="/random-story/"><?= __( 'Read ’nother random story', 'gogomikemike' ); ?> ⇒</a>
        </p>
    </div>

<?php get_footer(); ?>