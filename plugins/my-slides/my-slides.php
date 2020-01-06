<?php

/**
 * Plugin Name: Images Slider 
 * Description: here is slider for images.
 * Version: 0.1
 * Author: Yousef
 */

add_action('init', 'mySlider_init');
add_action('wp_enqueue_scripts', 'my_css_slider');
add_action('add_meta_boxes', 'my_slider_create_metabox');
add_action('save_post', 'my_slider_save_metabox_value', 10, 2);
add_action('manage_edit-slide_columns', 'my_slider_show_image_in_admin');
add_action('manage_posts_custom_column', 'my_slider_fill_image_in_admin');

function mySlider_init()
{
    $labels = array(
        'name' => 'slides',
        'singular_name' => 'slide',
        'menue_name' => 'slides',
        'all_items' => 'all',
        'view_items' => 'see slide',
        'add_new' => 'add',
    );

    $args = array(
        'label' => 'slides',
        'labels' => $labels,
        'supports' => array('title', 'thumbnail'),
        'show_ui' => true,
        'public' => true

    );

    register_post_type('slide', $args);
    add_image_size('slider', 1920, 480, true);
}


function show_my_slider($limit = 6)
{
    wp_enqueue_script('mySlider_simpleSlider', plugins_url() . '/my-slides/js/simpleSlider.min.js', null, '1.9.0', true);
    add_action('wp_footer', 'my_js_slider', 30);
    $request = array(
        'post_type' => 'slide',
        'orderby' => 'title',
        'order' => 'ASC',
        'posts_per_page' => intval($limit),
    );
    $slides = new WP_Query($request);
    if ($slides->have_posts()) {
        echo '<div class="simple-slider simple-slider-first">';
        echo '<div class="slider-wrapper">';
        while ($slides->have_posts()) {
            global $post;
            $slides->the_post();
            echo '<div class="slider-slide">';
            echo '<a href="' . esc_attr(get_post_meta($post->ID, 'my_slider_link', true)) . '">';
            the_post_thumbnail('slide');
            echo '</div>';
            echo '</a>';
        }
        echo '</div>';
        echo '<div class="slider-btn slider-btn-prev"><</div>';
        echo '<div class="slider-btn slider-btn-next">></div>';
        echo '</div>';
    }
}

function my_js_slider()
{
?>

    <script type="text/javascript">
        let slider = new SimpleSlider('.simple-slider-first', {
            autoplay: true,
            speed: 600,
            delay: 2000,
            loop: true,
        });
    </script>

<?php
}

function my_css_slider()
{
    wp_register_style('my_css_slider_simpleSlider', plugins_url() . '/my-slides/css/simpleSlider.min.css', '', false, 'screen');
    wp_enqueue_style('my_css_slider_simpleSlider');

    wp_register_style('my_css_slider_perso', plugins_url() . '/my-slides/css/perso.css', '', false, 'screen');
    wp_enqueue_style('my_css_slider_perso');
}

function my_slider_create_metabox()
{
    add_meta_box('my_slider_metabox', 'link to slider', 'my_slider_fill_metabox', 'slide', 'normal', 'high');
}

function my_slider_fill_metabox($object_post)
{
    echo '<div class="meta-box-item-title"><h4>URL LINK :</h4></div>
          <div class="meta-box-item-content"><input type="text" name="my_slider_link" value="' . esc_attr(get_post_meta($object_post->ID, 'my_slider_link', true)) . '"/></div>';
    wp_nonce_field('my_slider_key', 'my_slider_token');
}

function my_slider_save_metabox_value($post_id, $post)
{
    if (!isset($_POST['my_slider_link']) || !wp_verify_nonce($_POST['my_slider_token'], 'my_slider_key')) {
        return $post_id;
    }

    update_post_meta($post_id, 'my_slider_link', $_POST['my_slider_link']);
}

function my_slider_show_image_in_admin($columns)
{
    $mini = array('thumbnail' => 'Image');
    $columns = array_slice($columns, 0, 2) + $mini + array_slice($columns, 2, null);

    return $columns;
}

function my_slider_fill_image_in_admin($column)
{
    global $post;

    if ('thumbnail' == $column) {
        echo edit_post_link(get_the_post_thumbnail($post->ID, array(150, 150)), null, null, $post->ID);
    }
}
