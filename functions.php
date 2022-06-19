<?php
require_once get_theme_file_path( '/inc/tgm.php' );
if(site_url() == "http://organi.local.com/"){
    define("VERSION", time());
}else{
    define("VERSION", wp_get_theme() -> get("Version"));
}
function organi_theme_setup(){
    load_theme_textdomain( "organi", get_theme_file_path( "/languages" ));
    add_theme_support( "title-tag" );
    add_theme_support( "post-thumbnails",array('post') );
    add_theme_support( "custom-logo" );
    add_theme_support( 'html5', array( 'comment-list', 'search-form') );
    add_editor_style( "/assets/css/editor-style.css" );
    add_image_size( "organi-blog-image", 1200, 740, true );
    register_nav_menu( "topmenu", __("Top Menu", "organi") );
}
add_action( "after_setup_theme", "organi_theme_setup" );

function organi_assets() {
    wp_enqueue_style( "fonts.googleapis", "//fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap");
    wp_enqueue_style( "bootstrap", get_theme_file_uri( "css/bootstrap.min.css" ), null, VERSION);
    wp_enqueue_style( "font-awesome", get_theme_file_uri( "css/font-awesome.min.css" ), null, VERSION);
    wp_enqueue_style( "elegant-icons", get_theme_file_uri( "css/elegant-icons.css" ), null, VERSION);
    wp_enqueue_style( "nice-select", get_theme_file_uri( "css/nice-select.css" ), null, VERSION);
    wp_enqueue_style( "jquery-ui", get_theme_file_uri( "css/jquery-ui.min.css" ), null, VERSION);
    wp_enqueue_style( "owl-carousel", get_theme_file_uri( "css/owl.carousel.min.css" ), null, VERSION);
    wp_enqueue_style( "slicknav", get_theme_file_uri( "css/slicknav.min.css" ), null, VERSION);
    wp_enqueue_style( "style", get_theme_file_uri( "css/style.css" ), null, VERSION);
    wp_enqueue_style( 'organi-css', get_stylesheet_uri(),null, VERSION );

    wp_enqueue_script( 'bootstrap-js', get_theme_file_uri("js/bootstrap.min.js"), array("jquery"), VERSION, true);
    wp_enqueue_script( 'nice-select-js', get_theme_file_uri("js/jquery.nice-select.min.js"), array("jquery"), VERSION, true);
    wp_enqueue_script( 'jquery-ui-js', get_theme_file_uri("js/jquery-ui.min.js"), array("jquery"), VERSION, true);
    wp_enqueue_script( 'slicknav-js', get_theme_file_uri("js/jquery.slicknav.js"), array("jquery"), VERSION, true);
    wp_enqueue_script( 'mixitup-js', get_theme_file_uri("js/mixitup.min.js"), array("jquery"), VERSION, true);
    wp_enqueue_script( 'owl-carousel-js', get_theme_file_uri("js/owl.carousel.min.js"), array("jquery"), VERSION, true);
    wp_enqueue_script( 'main-js', get_theme_file_uri("js/main.js"), array("jquery"), VERSION, true);
    wp_enqueue_script( 'custom-js', get_theme_file_uri("js/custom.js"), array("jquery"), VERSION, true);
    }
add_action( 'wp_enqueue_scripts', 'organi_assets' );

/**
 * Menu navigations
 */

function organi_menu_item_class($links) {
    $links = str_replace("sub-menu", "sub-menu header__menu__dropdown", $links);
    $links = str_replace("current_page_item", "current_page_item active", $links);
    return $links;
 }
 add_filter('wp_nav_menu','organi_menu_item_class');


/**
 * ACF Json Save
 */

function organi_acf_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}
add_filter('acf/settings/save_json', 'organi_acf_json_save_point');

/**
 * ACF Json Load Locally
 */

function organi_acf_json_load_point( $paths ) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}
add_filter('acf/settings/load_json', 'organi_acf_json_load_point');
