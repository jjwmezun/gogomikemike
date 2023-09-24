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
            <?php include( get_template_directory() . '/assets/dist/search.svg' ); ?>
        </div>
    </form>
</div>