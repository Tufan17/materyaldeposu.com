<?php
require_once('../../../wp-load.php');

$menu_name   = 'Header Menu';
$menu_exists = wp_get_nav_menu_object( $menu_name );

if( ! $menu_exists ){
    $menu_id = wp_create_nav_menu($menu_name);

    // Get the HTML content
    $html = file_get_contents('index_1.html');
    
    // Find the menu
    $start_pos = strpos($html, '<ul class="wdt-primary-nav"');
    if ($start_pos !== false) {
        $end_pos = strpos($html, '</ul>', $start_pos);
        // We need to match the correct closing ul. 
        // Let's use DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        $xpath = new DOMXPath($dom);
        $primary_ul = $xpath->query('//ul[contains(@class, "wdt-primary-nav")]')->item(0);
        
        if ($primary_ul) {
            function process_ul($ul, $parent_id, $menu_id, $xpath) {
                foreach ($ul->childNodes as $li) {
                    if ($li->nodeName == 'li') {
                        // Skip extra lis injected by theme
                        $class = $li->getAttribute('class');
                        if (strpos($class, 'close-nav') !== false || strpos($class, 'go-back') !== false || strpos($class, 'see-all') !== false) {
                            continue;
                        }
                        
                        $a = $xpath->query('./a', $li)->item(0);
                        if ($a) {
                            $title_span = $xpath->query('./span', $a)->item(0);
                            $title = $title_span ? $title_span->nodeValue : $a->nodeValue;
                            $url = $a->getAttribute('href');
                            if ($url == 'javascript:void(0);') $url = '#';
                            if ($url == 'index_1.html') $url = home_url('/');
                            
                            $item_id = wp_update_nav_menu_item($menu_id, 0, array(
                                'menu-item-title'  => $title,
                                'menu-item-url'    => $url,
                                'menu-item-status' => 'publish',
                                'menu-item-parent-id' => $parent_id
                            ));
                            
                            // Check for sub-menu
                            $sub_ul = $xpath->query('./ul[contains(@class, "sub-menu")]', $li)->item(0);
                            if ($sub_ul) {
                                process_ul($sub_ul, $item_id, $menu_id, $xpath);
                            }
                        }
                    }
                }
            }
            
            process_ul($primary_ul, 0, $menu_id, $xpath);
            
            // Assign menu to location
            $locations = get_theme_mod('nav_menu_locations');
            $locations['primary-menu'] = $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
            
            echo "Menu imported and assigned successfully.";
        } else {
            echo "Primary UL not found.";
        }
    } else {
        echo "Menu string not found.";
    }
} else {
    echo "Menu already exists.";
}
?>
