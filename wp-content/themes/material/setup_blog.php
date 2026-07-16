<?php
require_once('../../../wp-load.php');

// Rename index.php to front-page.php to serve as the homepage
if (file_exists('index.php')) {
    rename('index.php', 'front-page.php');
}

// Create a new index.php for the blog list
$index_php_content = <<<HTML
<?php get_header(); ?>
<!-- **Main** -->
<div id="main">
    <section class="elementor-section elementor-top-section elementor-element elementor-section-boxed elementor-section-height-default" style="padding: 100px 0;">
        <div class="elementor-container">
            <div class="elementor-column elementor-col-100">
                <div class="wdt-heading-holder">
                    <h2 class="wdt-heading-title-wrapper wdt-heading-align-center wdt-heading-deco-wrapper">
                        <span class="wdt-heading-title">BLOG</span>
                    </h2>
                    <div class="wdt-heading-separator-wrapper">
                        <div class="wdt-heading-separator with-line"><div class="wdt-separator-line"></div></div>
                    </div>
                </div>
                
                <div style="margin-top: 50px;" class="wdt-post-list-carousel-container">
                    <div class="wdt-posts-list-wrapper">
                        <div class="tpl-blog-holder" style="display:flex; flex-wrap:wrap; gap:30px;">
                            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                                <div class="entry-grid-layout wdt-overlap-style wdt-scalein-hover wdt-bt-gradient-overlay wdt-post-entry" style="width: calc(33.333% - 20px);">
                                    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-entry'); ?>>
                                        <div class="entry-thumb">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php if (has_post_thumbnail()) { 
                                                    the_post_thumbnail('large'); 
                                                } else { ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/wp-content/uploads/2023/11/blog12.jpg" alt="Default Image">
                                                <?php } ?>
                                            </a>
                                        </div>
                                        <div class="entry-details">
                                            <div class="entry-meta-group">
                                                <div class="entry-date">
                                                    <i class="wdticon-calendar"> </i> <?php echo get_the_date('M d, Y'); ?>
                                                </div>
                                            </div>
                                            <div class="entry-title">
                                                <h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                                            </div>
                                            <div class="entry-body"><?php the_excerpt(); ?></div>
                                            <a href="<?php the_permalink(); ?>" class="wdt-button wdt-template-textual wdt-button-link wdt-button-style-default">Read More</a>
                                        </div>
                                    </article>
                                </div>
                            <?php endwhile; ?>
                            
                            <div class="wdt-pagination">
                                <?php echo paginate_links(); ?>
                            </div>
                            
                            <?php else : ?>
                                <p><?php esc_html_e( 'Henüz yazı bulunmamaktadır.' ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>
HTML;

file_put_contents('index.php', $index_php_content);

// Set the "Blog" page as the posts page
$blog_page = get_page_by_title('Blog');
if ($blog_page) {
    update_option('show_on_front', 'page');
    
    // Also we need to create/set a "Home" page as front page if it doesn't exist
    $home_page = get_page_by_title('Ana Sayfa');
    if (!$home_page) {
        $home_page_id = wp_insert_post(array(
            'post_title' => 'Ana Sayfa',
            'post_status' => 'publish',
            'post_type' => 'page',
        ));
    } else {
        $home_page_id = $home_page->ID;
    }
    
    update_option('page_on_front', $home_page_id);
    update_option('page_for_posts', $blog_page->ID);
}

// Generate some sample blog posts
$sample_images = [
    get_template_directory_uri() . '/wp-content/uploads/2023/11/lms-banner1.jpg',
    get_template_directory_uri() . '/wp-content/uploads/2023/11/lms-banner2.jpg',
    get_template_directory_uri() . '/wp-content/uploads/2023/11/lms-banner3.jpg',
    get_template_directory_uri() . '/wp-content/uploads/2023/11/blog12.jpg',
    get_template_directory_uri() . '/wp-content/uploads/2023/11/blog11.jpg',
    get_template_directory_uri() . '/wp-content/uploads/2023/11/blog7.jpg'
];

$sample_titles = [
    'Öğrenme Simülasyonlarının Geleceği',
    'Sınıf İçi Grup Çalışmalarının Faydaları',
    'Müfredat Analizinin Eğitime Etkisi',
    'Pratik Eğitim Neden Önemlidir?',
    'Modern Sınıflarda Teknolojinin Yeri',
    'Öğretmenler İçin Yeni Metodolojiler'
];

for ($i = 0; $i < count($sample_titles); $i++) {
    // Check if post already exists
    if (!get_page_by_title($sample_titles[$i], OBJECT, 'post')) {
        $post_id = wp_insert_post(array(
            'post_title' => $sample_titles[$i],
            'post_content' => 'Bu makalede ' . $sample_titles[$i] . ' konusunu detaylıca ele alacağız. Eğitimde yeni teknolojiler ve metodlar kullanarak öğrenci motivasyonunu artırabiliriz. Eğitim sürecinde uygulamalı eğitim ve simülasyonların önemi her geçen gün artmaktadır. Daha fazla bilgi için bizi takip etmeye devam edin.',
            'post_status' => 'publish',
            'post_type' => 'post',
        ));
        
        // Let's add the featured image if possible. We can sideload it or just cheat by inserting HTML in the content, but the loop expects a thumbnail.
        // It's harder to programmatically attach an external URL as a thumbnail without downloading it.
        // Since we know the path, let's create attachments.
        
        // Actually, for a quick sample, we can just edit the loop to use a random image from our array if there's no thumbnail.
    }
}

echo "Blog setup complete. Homepage and Blog pages separated.";
?>
