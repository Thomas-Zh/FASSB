<?php

function Newfassbs() {
    $labels = array(
        'name'               => 'Newfassbs',
        'singular_name'      => 'Newfassb',
        'menu_name'          => 'Newfassbs',
        'name_admin_bar'     => 'Newfassbs',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Newfassbs',
        'new_item'           => 'New Newfassbs',
        'edit_item'          => 'Edit Newfassbs',
        'view_item'          => 'View Newfassbs',
        'all_items'          => 'All Newfassbs',
        'search_items'       => 'Search Newfassbs',
        'parent_item_colon'  => 'Parent Newfassbs:',
        'not_found'          => 'No recipes found.',
        'not_found_in_trash' => 'No recipes found in Trash.'
    );

    $args = array( 
        'public'      => true, 
        'labels'      => $labels,
        'description' => 'FASSB Newfassb',
        'show_in_rest' => true,
        'rest_base'             => 'Newfassbs',
        'rest_controller_class' => 'WP_REST_Posts_Controller'
    );
        register_post_type( 'newfassb', $args );//watch out lowercase
}
add_action( 'init', 'Newfassbs' );

//category taxonomy funtion is in units folder