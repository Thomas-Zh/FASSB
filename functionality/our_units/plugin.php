<?php

function Units() {
    $labels = array(
        'name'               => 'Units',
        'singular_name'      => 'Unit',
        'menu_name'          => 'Units',
        'name_admin_bar'     => 'Units',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Units',
        'new_item'           => 'New Units',
        'edit_item'          => 'Edit Units',
        'view_item'          => 'View Units',
        'all_items'          => 'All Units',
        'search_items'       => 'Search Units',
        'parent_item_colon'  => 'Parent Units:',
        'not_found'          => 'No recipes found.',
        'not_found_in_trash' => 'No recipes found in Trash.'
    );

    $args = array( 
        'public'      => true, 
        'labels'      => $labels,
        'description' => 'FASSB UNITS'
    );
        register_post_type( 'units', $args );//watch out lowercase
}
add_action( 'init', 'Units' );
 
add_action( 'init', 'Applications_taxonomy', 10);
//create a custom taxonomy name it "Applicationes" for Units
function Applications_taxonomy() {
  $labels = array(
    'name' => _x( 'Application', 'taxonomy general name' ),
    'singular_name' => _x( 'Application', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Applications' ),
    'all_items' => __( 'All Applications' ),
    'parent_item' => __( 'Parent Application' ),
    'parent_item_colon' => __( 'Parent Application:' ),
    'edit_item' => __( 'Edit Application' ), 
    'update_item' => __( 'Update Application' ),
    'add_new_item' => __( 'Add New Application' ),
    'new_item_name' => __( 'New Application Name' ),
    'menu_name' => __( 'Application' ),
  );    
 
  register_taxonomy('application',array('page','post','units','projects'), array(//watch out lowercase//btw, watch out that the Applicationes "post" is using is "Application", here pluralized to differentiate them.
    'labels' => $labels,
    'public' => true,
    'hierarchical'=> true,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_nav_menus'=>true,
    'show_tagcloud'=> true,
    'show_in_rest'=>true,
    'query_var' => true,
    'rewrite' => array( 'slug' => '' ),
  ));
}
add_action( 'init', 'category_taxonomy', 9);
//create a custom taxonomy name it "categoryes" for Units
function category_taxonomy() {
  $labels = array(
    'name' => _x( 'category', 'taxonomy general name' ),
    'singular_name' => _x( 'category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search categories' ),
    'all_items' => __( 'All categories' ),
    'parent_item' => __( 'Parent category' ),
    'parent_item_colon' => __( 'Parent category:' ),
    'edit_item' => __( 'Edit category' ), 
    'update_item' => __( 'Update category' ),
    'add_new_item' => __( 'Add New category' ),
    'new_item_name' => __( 'New category Name' ),
    'menu_name' => __( 'Categories' ),
  );    
 
  register_taxonomy('category',array('page','post','units','projects'), array(//watch out lowercase//btw, watch out that the categories "post" is using is "category", here pluralized to differentiate them.
    'labels' => $labels,
    'public' => true,
    'hierarchical'=> true,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_nav_menus'=>true,
    'show_tagcloud'=> true,
    'show_in_rest'=>true,
    'query_var' => true,
    'rewrite' => array( 'slug' => '' ),
  ));
}