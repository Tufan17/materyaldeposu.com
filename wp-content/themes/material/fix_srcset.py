import os
import re

files = ['header.php', 'index.php', 'footer.php']

for file in files:
    if not os.path.exists(file): continue
    with open(file, 'r', encoding='utf-8') as f:
        content = f.read()
        
    # Replace bare wp-content/ inside srcset
    # srcset is like: srcset="wp-content/... 1170w, wp-content/... 300w"
    # We can just replace 'wp-content/' if it is preceded by a quote or a space.
    # Actually, we can just replace ' wp-content/' with ' <?php echo get_template_directory_uri(); ?>/wp-content/'
    # and '"wp-content/' with '"<?php echo get_template_directory_uri(); ?>/wp-content/'
    
    # Since we already did src="wp-content/", any remaining bare "wp-content/" inside srcset
    # might be preceded by 'srcset="' or a space after a comma.
    
    content = re.sub(r'srcset=[\'"]wp-content/', r'srcset="<?php echo get_template_directory_uri(); ?>/wp-content/', content)
    content = re.sub(r',\s*wp-content/', r', <?php echo get_template_directory_uri(); ?>/wp-content/', content)
    
    with open(file, 'w', encoding='utf-8') as f:
        f.write(content)

print("Srcset paths fixed.")
