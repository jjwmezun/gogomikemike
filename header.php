<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<link rel="canonical" href="<?= gomike_get_canonical_url(); ?>">
		<meta charset="utf-8">
		<link rel="apple-touch-icon" sizes="180x180" href="/wp-content/themes/gogomikemike/assets/dist/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/wp-content/themes/gogomikemike/assets/dist/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/wp-content/themes/gogomikemike/assets/dist/favicon-16x16.png">
		<link rel="manifest" href="/wp-content/themes/gogomikemike/assets/dist/site.webmanifest">
		<link rel="mask-icon" href="/wp-content/themes/gogomikemike/assets/dist/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="shortcut icon" href="/wp-content/themes/gogomikemike/assets/dist/favicon.ico">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-config" content="/wp-content/themes/gogomikemike/assets/dist/browserconfig.xml">
		<meta name="theme-color" content="#ffffff">
		<?php wp_head(); ?>
	</head>
	<body id="gomike-body">
		<div>
			<div class="skip-to-content-link">
				<a href="#content"><?= __( 'Skip to Content', 'gogomikemike' ); ?></a>
			</div>
			<header id="gomike-main-header" class="gomike-main-header">
				<div class="gomike-header-logo">
					<a aria-label="<?= __( 'Home', 'gogomikemike' ); ?>" class="gomike-header-logo-link" href="/">
						<?php include( get_template_directory() . '/assets/dist/microstories-logo.svg' ); ?>
					</a>
				</div>
				<?php include( get_template_directory() . '/inc/nav.php' ); ?>
				<?php include( get_template_directory() . '/inc/search.php' ); ?>
			</header> <!-- MAIN_HEADER -->

			<main id="content" <?php gomike_main_content_class(); ?>>
