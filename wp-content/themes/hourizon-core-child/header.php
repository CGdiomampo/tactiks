<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Hourizon Core
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
		<div class="container" >
			<div class="header-main">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"  rel="home"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" /></a>
			</div>
			<div id="search-container" >

				<form role="search" method="get" id="searchform" class="search-form" action="#">
					<div><label class="screen-reader-text" for="s">Search for:</label>
						<input class="search-field" placeholder="Search" type="text" value="" name="s" id="s">
						<input type="hidden" name="post_type" value="product">
						<input class="search-submit" type="submit" id="searchsubmit" value="Go">
					</div>
				</form>

				<div class="header_cart"><!-- Start header cart -->
					<div class="togg">
						<a id="shopping_cart" class="shopping_cart tog cart-contents" href="http://localhost/clients/shoemura/cart/" title="View your shopping cart"> Cart <span class="item-total">1</span></a>
					</div>
				</div>

				<ul class="accessAccount" >
					<?php if ( !is_user_logged_in() ) : ?>
					<li><a href="<?php echo site_url('my-account'); ?>">Login</a></li>
					<li>|</li>
					<li><a href="<?php echo site_url('my-account'); ?>">Register</a></li>
					<?php else: ?>
					<li><a href="<?php echo site_url('my-account'); ?>">My Account</a></li>
					<?php endif; ?>
				</ul>

				<div class="clearfix"></div>
			</div>
		</div>
	</header>

	<nav role="navigation" class="navigation site-navigation">
		<?php wp_nav_menu(
			array(
				'theme_location' => 'primary' ,
				'container'       => 'ul',
				'menu_class'      => 'navbar container nav-menu',
			)
		); ?>
	</nav>

	<div id="content" class="site-content">
