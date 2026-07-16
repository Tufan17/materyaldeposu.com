import re
import sys

def modify_icons(filename):
    try:
        with open(filename, 'r', encoding='utf-8') as f:
            lines = f.readlines()
    except FileNotFoundError:
        return
        
    # We will iterate through lines and make replacements
    new_lines = []
    skip = False
    for i, line in enumerate(lines):
        # Change column width from 16 to 25
        line = line.replace('elementor-col-16', 'elementor-col-25')
        
        # Change texts
        line = line.replace('<h5>HTML</h5>', '<h5>Anasınıfı</h5>')
        line = line.replace('<h5>CSS</h5>', '<h5>İlkokul</h5>')
        line = line.replace('<h5>Android</h5>', '<h5>Ortaokul</h5>')
        line = line.replace('<h5>Photoshop</h5>', '<h5>Lise</h5>')
        
        # If we reach the 5th column (jQuery), we start skipping
        if '<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-6a0e000"' in line or \
           '<div class="elementor-column elementor-col-16 elementor-inner-column elementor-element elementor-element-6a0e000"' in line:
            skip = True
            
        # If we are at the end of the section (line 250 or so), stop skipping
        # The section containing these columns ends with </section>
        # We need to preserve the closing tags for the container
        if skip and '</div>' in line and lines[i+1].strip() == '</section>':
            # Wait, let's just use string replacement on the whole content for the last two columns
            pass

    # Actually, a better way is to read the whole file, find the 5th and 6th columns, and remove them.
    with open(filename, 'r', encoding='utf-8') as f:
        content = f.read()
        
    content = content.replace('elementor-col-16', 'elementor-col-25')
    content = content.replace('<h5>HTML</h5>', '<h5>Anasınıfı</h5>')
    content = content.replace('<h5>CSS</h5>', '<h5>İlkokul</h5>')
    content = content.replace('<h5>Android</h5>', '<h5>Ortaokul</h5>')
    content = content.replace('<h5>Photoshop</h5>', '<h5>Lise</h5>')
    
    # Remove 5th column (jQuery)
    col5_start = content.find('<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-6a0e000"')
    if col5_start != -1:
        col5_end = content.find('<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-214095e"', col5_start)
        if col5_end != -1:
            content = content[:col5_start] + content[col5_end:]
            
    # Remove 6th column (Ruby)
    col6_start = content.find('<div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-214095e"')
    if col6_start != -1:
        # It ends right before </div>\n</section> for the inner section
        col6_end = content.find('</div>\n</section>', col6_start)
        if col6_end != -1:
            content = content[:col6_start] + content[col6_end:]

    with open(filename, 'w', encoding='utf-8') as f:
        f.write(content)

modify_icons('index.php')
modify_icons('index_1.html')
print("Icons modified successfully.")
