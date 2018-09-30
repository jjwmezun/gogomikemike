<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<?php gomike_html_title(); ?>
		<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700' rel='stylesheet' type='text/css'>
		<?php wp_head(); ?>
	</head>
	<body <?php gomike_body_class(); ?>>

		<header class="gomike-main-header">
			<h1 class="gomike-main-header-title"><?php bloginfo( 'name' ); ?></h1>
			<?php include( 'assets/img/microstories-logo.svg' ); ?>
			<?php gomike_main_nav(); ?>
		</header> <!-- MAIN_HEADER -->
		<?php gomike_search(); ?>

		<section <?php gomike_main_content_class(); ?>>
