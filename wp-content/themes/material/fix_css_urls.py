import os
import re

base_dir = '/Applications/MAMP/htdocs/material/wp-content/themes/material/wp-content'

files_modified = 0

for root, dirs, files in os.walk(base_dir):
    for file in files:
        if file.endswith('.css'):
            filepath = os.path.join(root, file)
            try:
                with open(filepath, 'r', encoding='utf-8') as f:
                    content = f.read()
            except Exception as e:
                continue
            
            if 'dtlmselementor.wpengine.com' in content:
                rel_dir = os.path.relpath(root, base_dir)
                if rel_dir == '.':
                    depth = 0
                else:
                    depth = len(rel_dir.split(os.sep))
                
                up_path = '../' * depth
                target_prefix = up_path + 'uploads/'
                
                # Replace occurrences in url(...)
                new_content = re.sub(
                    r'url\([\'"]?(?:\.\./)*_external/dtlmselementor\.wpengine\.com/wp-content/uploads/', 
                    f'url({target_prefix}', 
                    content
                )
                
                # There might be inline styles in HTML or other places, but here we only touch CSS files.
                if new_content != content:
                    with open(filepath, 'w', encoding='utf-8') as f:
                        f.write(new_content)
                    files_modified += 1

print(f"Fixed {files_modified} CSS files.")
