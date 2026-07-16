<?php get_header(); ?>
<!-- **Main** -->
<div id="main">
<div data-elementor-type="wp-page" data-elementor-id="blog" class="elementor elementor-blog">
<section class="elementor-section elementor-top-section elementor-element elementor-section-boxed elementor-section-height-default" data-element_type="section">
<div class="elementor-container elementor-column-gap-no">
<div class="elementor-column elementor-col-100 elementor-top-column elementor-element" data-element_type="column">
<div class="elementor-widget-wrap elementor-element-populated">

<div class="elementor-element elementor-widget elementor-widget-wdt-heading" data-element_type="widget" style="padding-top:80px;">
<div class="elementor-widget-container">
<div class="wdt-heading-holder" id="wdt-heading-blog"><h2 class="wdt-heading-title-wrapper wdt-heading-align-center wdt-heading-deco-wrapper"><span class="wdt-heading-title">BLOG</span></h2><div class="wdt-heading-separator-wrapper"><div class="wdt-heading-separator with-line"><div class="wdt-separator-line"></div></div></div></div> </div>
</div>

<div class="elementor-element elementor-element-7984341 elementor-widget elementor-widget-wdt-blog-posts" data-element_type="widget" data-id="7984341" data-settings='{"carousel_slidesperview":"3","carousel_slidesperview_laptop":4,"carousel_slidesperview_tablet_extra":2,"carousel_slidesperview_tablet":2,"carousel_slidesperview_mobile_extra":1,"carousel_slidesperview_mobile":1,"wdt_animation_effect":"none"}' data-widget_type="wdt-blog-posts.default">
<div class="elementor-widget-container">
<style>
#blog-grid-wrapper .tpl-blog-holder {
    display: grid !important;
    grid-template-columns: repeat(3, 1fr) !important;
    gap: 30px !important;
    transform: none !important;
    transition: none !important;
    flex-wrap: unset !important;
    box-sizing: border-box !important;
}
#blog-grid-wrapper .wdt-posts-list-wrapper {
    overflow: visible !important;
}
#blog-grid-wrapper .entry-grid-layout {
    width: 100% !important;
    max-width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    float: none !important;
    flex: none !important;
    box-sizing: border-box !important;
}
@media (max-width: 1024px) {
    #blog-grid-wrapper .tpl-blog-holder {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}
@media (max-width: 600px) {
    #blog-grid-wrapper .tpl-blog-holder {
        grid-template-columns: 1fr !important;
    }
}
.blog-pagination-wrapper {
    text-align: center;
    padding: 40px 0;
}
.blog-pagination-wrapper .page-numbers {
    display: inline-block;
    padding: 8px 14px;
    margin: 0 3px;
    border: 1px solid #ddd;
    text-decoration: none;
    color: #333;
    border-radius: 4px;
    transition: all 0.3s;
}
.blog-pagination-wrapper .page-numbers.current,
.blog-pagination-wrapper .page-numbers:hover {
    background: #838c48;
    color: #fff;
    border-color: #838c48;
}
.entry-title h4 a {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.4; /* Ensure line height is set for proper clamping */
    max-height: 2.8em; /* Fallback for older browsers: 2 * line-height */
}
</style>
<div class="wdt-post-list-carousel-container" id="blog-grid-wrapper"><div class="wdt-posts-list-wrapper"><div class="tpl-blog-holder"><?php if ( have_posts() ) : while ( have_posts() ) : the_post();
$extra_classes = get_post_class('blog-entry has-post-format');
if (!has_post_thumbnail()) { $extra_classes[] = 'has-post-thumbnail'; }
?><div class="entry-grid-layout wdt-overlap-style wdt-scalein-hover wdt-bt-gradient-overlay alignnone wdt-post-entry"><article class="<?php echo esc_attr(implode(' ', $extra_classes)); ?>" id="post-<?php the_ID(); ?>">
<!-- Featured Image -->
<div class="entry-thumb">
<a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>"><?php if (has_post_thumbnail()) {
    the_post_thumbnail('large', ['class' => 'attachment-wdt-blog-iii-column size-wdt-blog-iii-column wp-post-image', 'decoding' => 'async', 'loading' => 'lazy', 'sizes' => '(max-width: 1170px) 100vw, 1170px']);
} else {
    $fallbacks = ['blog12.jpg', 'blog7.jpg', 'blog11.jpg'];
    $img = $fallbacks[get_the_ID() % count($fallbacks)];
    $base = get_template_directory_uri() . '/wp-content/uploads/2023/11/' . $img;
?><img alt="" class="attachment-wdt-blog-iii-column size-wdt-blog-iii-column wp-post-image" decoding="async" height="822" loading="lazy" sizes="(max-width: 1170px) 100vw, 1170px" src="<?php echo $base; ?>" srcset="<?php echo $base; ?> 1170w" width="1170"/><?php } ?></a>
</div><!-- Featured Image -->
<div class="entry-body"><p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p></div>
<!-- Entry Date -->
<div class="entry-date">
	<?php echo get_the_date('d D'); ?><!-- Post Format --><div class="entry-format"><a class="ico-format" href="<?php the_permalink(); ?>"></a></div><!-- Post Format --></div><!-- Entry Date -->
<!-- Entry Title -->
<div class="entry-title">
<h4> <a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
</h4>
</div><!-- Entry Title --><div class="entry-meta-group">
<!-- Entry Author -->
<div class="entry-author">
<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="View all posts by <?php echo esc_attr(get_the_author()); ?>">
		<?php echo get_the_author(); ?>    </a>
</div><!-- Entry Author -->
<!-- Entry Tags -->
<div class="entry-tags"><i class="wdticon-bookmark"> </i> <?php
$cats = get_the_category();
if ($cats) {
    $cat_links = [];
    foreach ($cats as $cat) {
        $cat_links[] = '<a href="' . get_category_link($cat->term_id) . '" rel="tag">' . $cat->name . '</a>';
    }
    echo implode(' ', $cat_links);
}
?></div><!-- Entry Tags -->
</div></article></div><?php endwhile; ?></div></div></div>

<div class="blog-pagination-wrapper">
    <?php echo paginate_links(); ?>
</div>

<?php else : ?>
<p style="text-align:center; padding: 50px;"><?php esc_html_e( 'Henüz yazı bulunmamaktadır.' ); ?></p>
<?php endif; ?>

</div>
</div>

</div>
</div>
</div>
</section>
</div>
</div>
<?php get_footer(); ?>