<div class="entry-grid-layout wdt-overlap-style wdt-scalein-hover wdt-bt-gradient-overlay alignnone column wdt-one-third wdt-post-entry swiper-slide">
    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-entry has-post-format'); ?>>
        <div class="entry-thumb">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php if (has_post_thumbnail()) { 
                    the_post_thumbnail('large', ['class' => 'attachment-wdt-blog-iii-column size-wdt-blog-iii-column wp-post-image']); 
                } else { 
                    $fallbacks = ['blog12.jpg', 'blog11.jpg', 'blog7.jpg', 'lms-banner1.jpg', 'lms-banner2.jpg', 'lms-banner3.jpg'];
                    $img = $fallbacks[get_the_ID() % count($fallbacks)];
                ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/wp-content/uploads/2023/11/<?php echo $img; ?>" alt="<?php the_title_attribute(); ?>" class="attachment-wdt-blog-iii-column size-wdt-blog-iii-column wp-post-image">
                <?php } ?>
            </a>
        </div>
        <div class="entry-body">
            <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
        </div>
        <div class="entry-date">
            <?php echo get_the_date('d M'); ?>
            <div class="entry-format"><a class="ico-format" href="<?php the_permalink(); ?>"></a></div>
        </div>
        <div class="entry-title">
            <h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
        </div>
        <div class="entry-meta-group">
            <div class="entry-author">
                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php echo esc_attr(get_the_author()); ?>">
                    <?php echo get_the_author(); ?>
                </a>
            </div>
            <div class="entry-tags">
                <i class="wdticon-bookmark"> </i> 
                <?php the_category(', '); ?>
            </div>
        </div>
    </article>
</div>
