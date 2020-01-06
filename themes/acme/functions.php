<?php

add_action('wp_enqueue_scripts', 'myTheme');

function myTheme()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
