<?php
// Place all your custom functions below this line.

function Systems() {
    $labels = array(
        'name'               => 'Systems',
        'singular_name'      => 'System',
        'menu_name'          => 'Systems',
        'name_admin_bar'     => 'Systems',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Systems',
        'new_item'           => 'New Systems',
        'edit_item'          => 'Edit Systems',
        'view_item'          => 'View Systems',
        'all_items'          => 'All Systems',
        'search_items'       => 'Search Systems',
        'parent_item_colon'  => 'Parent Systems:',
        'not_found'          => 'No recipes found.',
        'not_found_in_trash' => 'No recipes found in Trash.'
    );

    $args = array( 
        'public'      => true, 
        'labels'      => $labels,
        'description' => 'FASSB SystemS',
        'supports'    => array('title', 'editor', 'thumbnail')
    );
        register_post_type( 'systems', $args );//watch out lowercase
}
add_action( 'init', 'Systems' );
wp_enqueue_script( 'script', get_template_directory_uri() . '/functionality/our_systems/scroll.js', array ( 'jquery' ), 1.1, true);
//category taxonomy funtion is in units folder