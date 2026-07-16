import os
import re

html_file = 'index_1.html'
with open(html_file, 'r', encoding='utf-8') as f:
    lines = f.readlines()

header_lines = lines[0:1215]
body_lines = lines[1215:1704]
footer_lines = lines[1704:]

# Add wp_head and wp_footer
for i, line in enumerate(header_lines):
    if '</head>' in line:
        header_lines.insert(i, '<?php wp_head(); ?>\n')
        break

# For footer, find </body>
for i in range(len(footer_lines)-1, -1, -1):
    if '</body>' in footer_lines[i]:
        footer_lines.insert(i, '<?php wp_footer(); ?>\n')
        break

with open('header.php', 'w', encoding='utf-8') as f:
    f.writelines(header_lines)

with open('index.php', 'w', encoding='utf-8') as f:
    f.write('<?php get_header(); ?>\n')
    f.writelines(body_lines)
    f.write('<?php get_footer(); ?>\n')

with open('footer.php', 'w', encoding='utf-8') as f:
    f.writelines(footer_lines)

with open('style.css', 'w', encoding='utf-8') as f:
    f.write("""/*
Theme Name: Material
Theme URI: 
Author: Antigravity
Author URI: 
Description: Custom WordPress theme from index_1.html
Version: 1.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: material
*/
""")

with open('functions.php', 'w', encoding='utf-8') as f:
    f.write("""<?php
function material_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'material_theme_setup');
""")

print("Successfully created theme files.")
