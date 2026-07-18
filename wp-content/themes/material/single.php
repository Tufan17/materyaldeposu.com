<?php
/**
 * Tekil Blog Yazısı (Post) Şablonu - Premium Tasarım ve Yan Menü
 */
get_header(); ?>

<div class="wdt-main-content-wrapper" style="padding: 150px 20px 80px; background: #fdf6ea; position: relative;">
    
    <!-- Arka plan süslemeleri için ayrı kapsayıcı (Taşmaları önlemek ve sticky'yi bozmamak için) -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; pointer-events: none; z-index: 0;">
        <div style="position: absolute; top: -100px; left: -100px; width: 500px; height: 500px; background: rgba(131,140,72,0.06); border-radius: 50%; filter: blur(60px);"></div>
        <div style="position: absolute; bottom: 5%; right: -150px; width: 400px; height: 400px; background: rgba(218,133,61,0.06); border-radius: 50%; filter: blur(50px);"></div>
    </div>

    <div class="container" style="max-width: 1200px; margin: 0 auto; position: relative; z-index: 1;">
        
        <?php while ( have_posts() ) : the_post(); ?>
            <div style="display: flex; flex-wrap: wrap; gap: 40px; align-items: flex-start;">
                
                <!-- SOL TARAF: ANA İÇERİK -->
                <div class="main-article-content" style="flex: 1 1 700px; background: #fff; border-radius: 24px; box-shadow: 0 15px 40px rgba(0,0,0,0.04); overflow: hidden; border: 1px solid rgba(131,140,72,0.08);">
                    
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="entry-thumb" style="width: 100%; height: 450px; overflow: hidden; position: relative;">
                            <?php the_post_thumbnail('full', ['style' => 'width: 100%; height: 100%; display: block; object-fit: cover; transition: transform 0.5s ease;']); ?>
                            <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 50%; background: linear-gradient(to top, rgba(0,0,0,0.4), transparent); pointer-events: none;"></div>
                        </div>
                    <?php endif; ?>

                    <header class="entry-header" style="background: #fff; padding: 50px 50px 30px; position: relative;">
                        <!-- Kategoriler -->
                        <div style="position: absolute; top: -20px; left: 50px; display: flex; gap: 10px;">
                            <?php
                            $categories = get_the_category();
                            if ( ! empty( $categories ) ) {
                                foreach( $categories as $category ) {
                                    echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" style="background: #838c48; color: #fff; padding: 8px 16px; border-radius: 30px; font-size: 13px; font-weight: 700; text-decoration: none; box-shadow: 0 4px 10px rgba(131,140,72,0.3); transition: transform 0.3s ease;" onmouseover="this.style.transform=\'translateY(-2px)\'" onmouseout="this.style.transform=\'translateY(0)\'">' . esc_html( $category->name ) . '</a>';
                                }
                            }
                            ?>
                        </div>

                        <?php the_title( '<h1 class="entry-title" style="font-family: \'Playfair Display\', serif; font-size: 40px; font-weight: 800; color: #222; margin-top: 15px; margin-bottom: 20px; line-height: 1.25;">', '</h1>' ); ?>
                        
                        <div class="entry-meta" style="display: flex; align-items: center; gap: 20px; font-family: 'Inter', sans-serif; font-size: 14px; color: #777; border-top: 1px solid #eee; padding-top: 20px;">
                            <span class="meta-author" style="display: flex; align-items: center; gap: 8px;">
                                <?php echo get_avatar( get_the_author_meta( 'ID' ), 32, '', '', array('style' => 'border-radius:50%;') ); ?>
                                <strong style="color: #444;"><?php the_author(); ?></strong>
                            </span>
                            <span class="meta-date" style="display: flex; align-items: center; gap: 6px;">
                                <i class="fa fa-calendar-alt" style="color: #ccc;"></i> <?php echo get_the_date(); ?>
                            </span>
                        </div>
                    </header>

                    <div class="entry-content-wrap" style="padding: 0 50px 50px;">
                        <div class="entry-content blog-post-body" style="font-family: 'Inter', sans-serif; font-size: 17px; line-height: 1.85; color: #4a4a4a;">
                            <?php 
                            the_content(); 
                            wp_link_pages( array(
                                'before' => '<div class="page-links" style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee; font-weight: bold;">' . esc_html__( 'Sayfalar:', 'material' ),
                                'after'  => '</div>',
                            ) );
                            ?>
                        </div>
                    </div>

                    <div class="entry-footer" style="padding: 30px 50px; background: #fafafa; border-top: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
                        <div class="post-tags" style="flex: 1;">
                            <?php 
                            $tags = get_the_tags();
                            if ( $tags ) {
                                echo '<i class="fa fa-tags" style="color: #838c48; margin-right: 10px;"></i>';
                                foreach ( $tags as $tag ) {
                                    echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" style="display: inline-block; background: #fff; padding: 5px 14px; border-radius: 8px; font-size: 13px; color: #555; text-decoration: none; border: 1px solid #e0e0e0; margin-right: 8px; margin-bottom: 8px; transition: all 0.3s ease;" onmouseover="this.style.borderColor=\'#838c48\'; this.style.color=\'#838c48\';" onmouseout="this.style.borderColor=\'#e0e0e0\'; this.style.color=\'#555\';">' . esc_html( $tag->name ) . '</a>';
                                }
                            }
                            ?>
                        </div>
                        
                        <div class="post-share" style="display: flex; gap: 12px;">
                            <span style="font-family: 'Inter', sans-serif; font-size: 14px; font-weight: 700; color: #222; display: flex; align-items: center; margin-right: 5px;">Paylaş:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" style="width: 40px; height: 40px; border-radius: 12px; background: #eff3fa; color: #3b5998; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 16px; transition: all 0.3s ease;" onmouseover="this.style.background='#3b5998'; this.style.color='#fff';" onmouseout="this.style.background='#eff3fa'; this.style.color='#3b5998';"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" style="width: 40px; height: 40px; border-radius: 12px; background: #e8f5fd; color: #1da1f2; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 16px; transition: all 0.3s ease;" onmouseover="this.style.background='#1da1f2'; this.style.color='#fff';" onmouseout="this.style.background='#e8f5fd'; this.style.color='#1da1f2';"><i class="fab fa-twitter"></i></a>
                            <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>" target="_blank" style="width: 40px; height: 40px; border-radius: 12px; background: #e9fbf0; color: #25d366; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 16px; transition: all 0.3s ease;" onmouseover="this.style.background='#25d366'; this.style.color='#fff';" onmouseout="this.style.background='#e9fbf0'; this.style.color='#25d366';"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                    
                    <?php
                    if ( comments_open() || get_comments_number() ) :
                        echo '<div style="padding: 0 50px; background: #fff;">';
                        comments_template();
                        echo '</div>';
                    endif;
                    ?>
                </div>

                <!-- SAĞ TARAF: YAN MENÜ (ÖNERİLENLER) -->
                <aside class="sidebar-recent-posts" style="flex: 0 0 350px; position: sticky; top: 120px;">
                    <div style="background: #fff; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(131,140,72,0.1);">
                        <h3 style="font-family: 'Playfair Display', serif; font-size: 24px; font-weight: 800; color: #222; margin-bottom: 25px; border-bottom: 2px solid #838c48; padding-bottom: 15px; display: inline-block;">
                            Son Yazılar
                        </h3>
                        
                        <div style="display: flex; flex-direction: column; gap: 20px;">
                            <?php
                            $recent_args = array(
                                'post_type'      => 'post',
                                'posts_per_page' => 4,
                                'post_status'    => 'publish',
                                'post__not_in'   => array( get_the_ID() ) // Mevcut yazıyı hariç tut
                            );
                            $recent_posts = new WP_Query( $recent_args );

                            if ( $recent_posts->have_posts() ) :
                                while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
                                ?>
                                    <a href="<?php the_permalink(); ?>" class="suggested-post-card" style="display: flex; gap: 15px; align-items: center; text-decoration: none; group; transition: transform 0.2s ease;" onmouseover="this.style.transform='translateX(5px)';" onmouseout="this.style.transform='translateX(0)';">
                                        <div style="flex: 0 0 90px; height: 90px; border-radius: 12px; overflow: hidden; background: #eee;">
                                            <?php if ( has_post_thumbnail() ) {
                                                the_post_thumbnail('thumbnail', ['style' => 'width: 100%; height: 100%; object-fit: cover;']);
                                            } else {
                                                echo '<div style="width:100%; height:100%; background:#838c48; opacity:0.2;"></div>';
                                            } ?>
                                        </div>
                                        <div style="flex: 1;">
                                            <h4 style="font-family: 'Inter', sans-serif; font-size: 15px; font-weight: 700; color: #333; margin: 0 0 5px 0; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                <?php the_title(); ?>
                                            </h4>
                                            <span style="font-family: 'Inter', sans-serif; font-size: 12px; color: #888; display: flex; align-items: center; gap: 4px;">
                                                <i class="fa fa-clock" style="font-size: 10px;"></i> <?php echo get_the_date('d M Y'); ?>
                                            </span>
                                        </div>
                                    </a>
                                <?php
                                endwhile;
                                wp_reset_postdata();
                            else:
                                echo '<p style="color:#777; font-size:14px;">Farklı bir yazı bulunamadı.</p>';
                            endif;
                            ?>
                        </div>
                    </div>
                </aside>

            </div>
        <?php endwhile; ?>

    </div>
</div>

<style>
/* CSS Reset ve Ekstra Stiller */
.blog-post-body p { margin-bottom: 20px; }
.blog-post-body h1, .blog-post-body h2, .blog-post-body h3, .blog-post-body h4 {
    margin-top: 40px; margin-bottom: 20px; font-family: 'Playfair Display', serif; color: #222; font-weight: 700;
}
.blog-post-body h2 { font-size: 28px; }
.blog-post-body h3 { font-size: 24px; }
.blog-post-body img { max-width: 100%; height: auto; border-radius: 12px; margin: 20px 0; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
.blog-post-body a { color: #838c48; text-decoration: underline; text-decoration-color: rgba(131,140,72,0.3); }
.blog-post-body a:hover { text-decoration-color: #838c48; }

/* Responsive Düzenleme */
@media (max-width: 992px) {
    .main-article-content { flex: 1 1 100% !important; }
    .sidebar-recent-posts { flex: 1 1 100% !important; position: static !important; }
}
@media (max-width: 768px) {
    .wdt-main-content-wrapper { padding: 120px 15px 50px !important; }
    .entry-header, .entry-content-wrap, .entry-footer { padding: 30px !important; }
    .entry-title { font-size: 32px !important; }
}
</style>

<?php get_footer(); ?>
