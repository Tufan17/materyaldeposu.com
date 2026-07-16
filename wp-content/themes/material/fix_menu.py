import re
import os

# 1. Add register_nav_menus to functions.php
functions_path = 'functions.php'
with open(functions_path, 'r', encoding='utf-8') as f:
    functions_content = f.read()

menu_registration = """
// Menüleri kaydet
function material_register_menus() {
    register_nav_menus(
        array(
            'primary-menu' => __( 'Ana Menü (Header)', 'material' )
        )
    );
}
add_action( 'init', 'material_register_menus' );

// Menü linklerine span eklemek için walker veya filtre
function material_nav_menu_link_attributes($atts, $item, $args) {
    if($args->theme_location == 'primary-menu') {
        // We will add the span inside the title instead
    }
    return $atts;
}

function material_nav_menu_title($title, $item, $args, $depth) {
    if($args->theme_location == 'primary-menu') {
        return '<span data-text="' . esc_attr($title) . '">' . $title . '</span>';
    }
    return $title;
}
add_filter('nav_menu_item_title', 'material_nav_menu_title', 10, 4);
"""

if 'material_register_menus' not in functions_content:
    with open(functions_path, 'a', encoding='utf-8') as f:
        f.write("\n" + menu_registration)
        print("Menu registration added to functions.php")

# 2. Replace the hardcoded menu in header.php
header_path = 'header.php'
with open(header_path, 'r', encoding='utf-8') as f:
    header_content = f.read()

# The hardcoded menu starts at <ul class="wdt-primary-nav" data-menu="16" id="menu-menu-2">
# and ends right before </div> </div> </div> </div>
# We need to find the ul and its closing tag.
# Using regex to find the menu block.
start_str = '<div class="wdt-header-menu"'
start_idx = header_content.find(start_str)

if start_idx != -1:
    # Find the closing </div> for wdt-header-menu
    # It contains <div class="menu-container"><ul ...> ... </ul></div>
    end_str = '</div>\n</div>\n</div>\n</div>\n</section>'
    # We will search for '</div>\n</div>\n</div>\n</div>\n</section>'
    # Let's do this dynamically by parsing or just finding the <ul ...> ... </ul>
    
    ul_start_idx = header_content.find('<ul class="wdt-primary-nav"', start_idx)
    if ul_start_idx != -1:
        # Let's count open and close ul tags
        open_uls = 0
        ul_end_idx = -1
        # Search tag by tag
        tag_pattern = re.compile(r'</?ul[^>]*>')
        for m in tag_pattern.finditer(header_content, ul_start_idx):
            tag = m.group(0)
            if tag.startswith('<ul'):
                open_uls += 1
            elif tag.startswith('</ul'):
                open_uls -= 1
                if open_uls == 0:
                    ul_end_idx = m.end()
                    break
        
        if ul_end_idx != -1:
            php_code = """
<?php
wp_nav_menu( array(
    'theme_location' => 'primary-menu',
    'menu_class'     => 'wdt-primary-nav',
    'container'      => '',
    'menu_id'        => 'menu-menu-2',
    'fallback_cb'    => false,
) );
?>"""
            new_header = header_content[:ul_start_idx] + php_code + header_content[ul_end_idx:]
            with open(header_path, 'w', encoding='utf-8') as f:
                f.write(new_header)
            print("Menu replaced in header.php")
        else:
            print("Could not find end of ul")
else:
    print("Could not find wdt-header-menu")

