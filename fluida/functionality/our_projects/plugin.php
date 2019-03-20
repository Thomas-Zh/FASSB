<?php

function Projects() {
    $labels = array(
        'name'               => 'Projects',
        'singular_name'      => 'Project',
        'menu_name'          => 'Projects',
        'name_admin_bar'     => 'Projects',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Projects',
        'new_item'           => 'New Projects',
        'edit_item'          => 'Edit Projects',
        'view_item'          => 'View Projects',
        'all_items'          => 'All Projects',
        'search_items'       => 'Search Projects',
        'parent_item_colon'  => 'Parent Projects:',
        'not_found'          => 'No recipes found.',
        'not_found_in_trash' => 'No recipes found in Trash.'
    );

    $args = array( 
        'public'      => true, 
        'labels'      => $labels,
        'description' => 'FASSB PROJECTS'
    );
        register_post_type( 'projects', $args );//watch out lowercase
}
add_action( 'init', 'Projects' );
//category taxonomy funtion is in units folder