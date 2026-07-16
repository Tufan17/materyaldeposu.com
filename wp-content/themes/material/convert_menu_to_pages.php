<?php
require_once('../../../wp-load.php');

$menu_name = 'Header Menu';
$menu_obj = wp_get_nav_menu_object( $menu_name );

if( $menu_obj ) {
    $menu_items = wp_get_nav_menu_items( $menu_obj->term_id );
    
    foreach( $menu_items as $item ) {
        if( $item->type == 'custom' ) {
            // Don't change if it's the home URL
            if( trim($item->url, '/') == trim(home_url(), '/') ) {
                continue;
            }
            
            $title = $item->title;
            
            // Check if page exists
            $page = get_page_by_title( $title );
            
            if( ! $page ) {
                // Create page
                $page_id = wp_insert_post( array(
                    'post_title'   => $title,
                    'post_status'  => 'publish',
                    'post_type'    => 'page',
                    'post_content' => 'Bu sayfa yapım aşamasındadır.'
                ) );
                echo "Created page: $title\n";
            } else {
                $page_id = $page->ID;
                echo "Found existing page: $title\n";
            }
            
            // Update menu item
            update_post_meta( $item->ID, '_menu_item_type', 'post_type' );
            update_post_meta( $item->ID, '_menu_item_object', 'page' );
            update_post_meta( $item->ID, '_menu_item_object_id', $page_id );
            update_post_meta( $item->ID, '_menu_item_url', '' ); // clear custom URL
            
            echo "Converted menu item $title to page link.\n";
        }
    }
    echo "Done.";
} else {
    echo "Menu not found.";
}
?>
