import re
import sys

def remove_section(filename):
    with open(filename, 'r', encoding='utf-8') as f:
        content = f.read()

    # We want to remove the section with data-id="425efdc"
    # Find the start of this section
    match = re.search(r'<section[^>]*data-id="425efdc"[^>]*>', content)
    if not match:
        print(f"Section not found in {filename}")
        return

    start_idx = match.start()
    
    # Find the matching </section>
    end_idx = -1
    open_tags = 0
    
    # We will search for <section and </section> tags after start_idx
    tag_pattern = re.compile(r'</?section[^>]*>')
    for m in tag_pattern.finditer(content, start_idx):
        tag = m.group(0)
        if tag.startswith('<section'):
            open_tags += 1
        elif tag.startswith('</section'):
            open_tags -= 1
            if open_tags == 0:
                end_idx = m.end()
                break
                
    if end_idx != -1:
        new_content = content[:start_idx] + content[end_idx:]
        with open(filename, 'w', encoding='utf-8') as f:
            f.write(new_content)
        print(f"Successfully removed section from {filename}")
    else:
        print(f"Could not find matching end tag in {filename}")

remove_section('index.php')
remove_section('index_1.html')
