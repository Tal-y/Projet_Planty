<?php

function oceanwp_child_enqueue_parent_style() {

	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update the theme).
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );

	// Load the stylesheet.
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
	
}

add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style',);

function mon_theme_support() {

	add_theme_support('menu');
	register_nav_menu( 'header', 'menu_header' );
}

function ajouter_lien_utilisateur_connecte( $items, $args) {
    if ( is_user_logged_in() && $args->theme_location == 'header' ) {
        $items .= '<li class="nav_item lien_admin"><a href="http://planty.local/wp-admin/index.php">Admin</a></li>';
    }
    return $items;
 }
 add_filter( 'wp_nav_menu_items', 'ajouter_lien_utilisateur_connecte', 1, 2 );
function planty_menu_class( $classes ) {
	$classes[] = 'nav_item';
	return $classes;
}


add_filter('nav_menu_css_class','planty_menu_class',10,1);
add_filter( 'wpcf7_load_js', '__return_false' );