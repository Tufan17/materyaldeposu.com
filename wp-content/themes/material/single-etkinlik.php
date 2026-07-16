<?php
/**
 * Template Name: Etkinlik Detay Sayfası
 * Description: Etkinlik (Custom Post Type) için detay şablonu.
 */
get_header(); 
?>

<div class="wdt-main-content-wrapper" style="padding: 150px 20px 80px; background: #fdf6ea;">
    <div class="container" style="max-width: 900px; margin: 0 auto; background: #fff; border-radius: 24px; padding: 50px; box-shadow: 0 15px 40px rgba(0,0,0,0.06);">
        
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
            <header class="post-header" style="text-align: center; margin-bottom: 40px;">
                <div style="display: inline-block; font-size: 13px; font-weight: 700; color: #DA853D; background: rgba(218, 133, 61, 0.1); padding: 5px 15px; border-radius: 50px; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 1px;">
                    <i class="fa fa-calendar-check"></i> ETKİNLİK DETAYI
                </div>
                
                <h1 class="post-title" style="font-family: 'Playfair Display', serif; font-size: 42px; font-weight: 800; color: #303030; line-height: 1.2; margin-bottom: 20px;">
                    <?php the_title(); ?>
                </h1>
                
                <div class="post-meta" style="font-family: 'Inter', sans-serif; font-size: 14px; color: #888; border-top: 1px solid #eee; border-bottom: 1px solid #eee; padding: 15px 0; display: flex; justify-content: center; gap: 20px;">
                    <span><i class="fa fa-calendar" style="color: #838C48;"></i> <?php echo get_the_date('d F Y'); ?></span>
                    <span><i class="fa fa-user" style="color: #838C48;"></i> <?php the_author(); ?></span>
                </div>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-thumbnail" style="margin-bottom: 40px; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                    <?php the_post_thumbnail('full', array('style' => 'width: 100%; height: auto; display: block;')); ?>
                </div>
            <?php endif; ?>

            <div class="post-content" style="font-family: 'Inter', sans-serif; font-size: 17px; color: #555; line-height: 1.8;">
                <?php the_content(); ?>
            </div>
            
            <div style="margin-top: 50px; padding-top: 30px; border-top: 1px solid #eee; text-align: center;">
                <a href="<?php echo esc_url(home_url('/')); ?>" style="display: inline-block; background: #838C48; color: #fff; padding: 12px 30px; border-radius: 50px; font-weight: 600; text-decoration: none; transition: background 0.3s ease;">
                    &larr; Ana Sayfaya Dön
                </a>
            </div>

        <?php endwhile; endif; ?>

    </div>
</div>

<?php get_footer(); ?>
