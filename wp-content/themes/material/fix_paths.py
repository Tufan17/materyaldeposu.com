import re
import os

files = ['header.php', 'index.php', 'footer.php']

for file in files:
    if not os.path.exists(file): continue
    with open(file, 'r', encoding='utf-8') as f:
        content = f.read()
        
    # Fix previously modified strings if any
    content = content.replace('<?php echo get_theme_root_uri(); ?>/dtlms_theme/', '<?php echo get_template_directory_uri(); ?>/')
    
    # Fix any remaining bare wp-content and wp-includes strings
    content = re.sub(r'(href|src)=[\'"]wp-content/', r'\1="<?php echo get_template_directory_uri(); ?>/wp-content/', content)
    content = re.sub(r'(href|src)=[\'"]wp-includes/', r'\1="<?php echo get_template_directory_uri(); ?>/wp-includes/', content)
    
    with open(file, 'w', encoding='utf-8') as f:
        f.write(content)

print("Paths updated successfully.")
