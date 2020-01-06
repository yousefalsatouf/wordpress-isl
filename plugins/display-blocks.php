<?php

/**
 * Plugin Name: Display Blocks
 * Description: add an adminstration menu .
 * Version: 0.1
 * Author: Yousef
 */


add_action('admin_menu', 'displayBlocks');

function displayBlocks()
{
    add_menu_page('used block', 'Blocks', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 15);
}
