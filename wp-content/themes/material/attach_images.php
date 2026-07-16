<?php
require_once('../../../wp-load.php');
require_once('../../../wp-admin/includes/image.php');
require_once('../../../wp-admin/includes/file.php');
require_once('../../../wp-admin/includes/media.php');

$images = [
    '/Users/memisalitufan/.gemini/antigravity-ide/brain/125b8713-3df9-4903-a945-ceb2470a9ab3/edu_digital_classroom_1784149467339.png',
    '/Users/memisalitufan/.gemini/antigravity-ide/brain/125b8713-3df9-4903-a945-ceb2470a9ab3/edu_gamification_1784149475196.png',
    '/Users/memisalitufan/.gemini/antigravity-ide/brain/125b8713-3df9-4903-a945-ceb2470a9ab3/edu_stem_1784149482975.png',
    '/Users/memisalitufan/.gemini/antigravity-ide/brain/125b8713-3df9-4903-a945-ceb2470a9ab3/edu_vr_ar_1784149491650.png',
    '/Users/memisalitufan/.gemini/antigravity-ide/brain/125b8713-3df9-4903-a945-ceb2470a9ab3/edu_group_study_1784149499731.png'
];

$attachment_ids = [];

// Copy images to a temporary location inside wp-content to bypass security restrictions of sideloading from outside
$upload_dir = wp_upload_dir();
foreach ($images as $img_path) {
    $filename = basename($img_path);
    $tmp_path = $upload_dir['path'] . '/' . $filename;
    copy($img_path, $tmp_path);
    
    $file_array = [
        'name' => $filename,
        'tmp_name' => $tmp_path
    ];
    
    // Check if attachment already exists
    global $wpdb;
    $attachment_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'attachment'", pathinfo($filename, PATHINFO_FILENAME)));
    
    if (!$attachment_id) {
        $attachment_id = media_handle_sideload($file_array, 0);
        if (is_wp_error($attachment_id)) {
            echo "Error uploading $filename: " . $attachment_id->get_error_message() . "\n";
            continue;
        }
    }
    $attachment_ids[] = $attachment_id;
}

if (empty($attachment_ids)) {
    die("No images loaded.\n");
}

// Get the 15 newest posts
$recent_posts = get_posts([
    'numberposts' => 15,
    'post_type' => 'post',
    'post_status' => 'publish'
]);

$count = 0;
foreach ($recent_posts as $post) {
    // Cycle through the images
    $attach_id = $attachment_ids[$count % count($attachment_ids)];
    set_post_thumbnail($post->ID, $attach_id);
    $count++;
}

echo "Successfully attached images to $count blog posts.\n";
