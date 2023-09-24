<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<link rel="canonical" href="<?= gomike_get_canonical_url(); ?>">
		<meta charset="utf-8">
		<?php gomike_favicons(); ?>
		<?php wp_head(); ?>
	</head>
	<body id="gomike-body" <?php gomike_body_class(); ?>>
		<div>
			<div class="skip-to-content-link">
				<a href="#content"><?= __( 'Skip to Content', 'gogomikemike' ); ?></a>
			</div>
			<header id="gomike-main-header" class="gomike-main-header">
				<div class="gomike-header-logo">
					<a aria-label="<?= __( 'Home', 'gogomikemike' ); ?>" class="gomike-header-logo-link" href="/">
						<?php include( 'assets/dist/microstories-logo.svg' ); ?>
					</a>
				</div>
				<?php gomike_main_nav(); ?>
				<?php gomike_search(); ?>
			</header> <!-- MAIN_HEADER -->

			<main id="content" <?php gomike_main_content_class(); ?>>
