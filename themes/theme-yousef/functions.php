<?php

add_action('wp_enqueue_scripts', 'theme_yousef_load_stylesheet');
add_action('wp_enqueue_scripts', 'theme_yousef_load_js');

function theme_yousef_load_stylesheet()
{
    wp_register_style('theme_yousef_stylesheet', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.4.1');
    wp_enqueue_style('theme_yousef_stylesheet');
}


function theme_yousef_load_js()
{
    wp_register_script('theme_yousef_js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '4.4.1', false);
    wp_enqueue_script('theme_yousef_js');
}

register_nav_menus(
    array('theme_yousef_nav_main' => 'the main navigation of the menu'),
);//display menu into the theme ...
