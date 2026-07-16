<?php
/**
 * Template Name: Materyaller Sayfası
 * Description: Materyaller Arşiv Şablonu (Ana Materyal Sayfası)
 */
get_header(); 

// En üst seviye (parent = 0) kademeleri al (İlkokul, Ortaokul, Lise)
$main_kademeler = get_terms( array(
    'taxonomy'   => 'sinif_grubu',
    'parent'     => 0,
    'hide_empty' => false,
) );
if (!is_wp_error($main_kademeler)) {
    usort($main_kademeler, function($a, $b) {
        $order_a = (int) get_term_meta($a->term_id, 'sinif_grubu_order', true);
        $order_b = (int) get_term_meta($b->term_id, 'sinif_grubu_order', true);
        return $order_a - $order_b;
    });
}
?>

<div class="wdt-main-content-wrapper" style="padding: 150px 20px 60px; background: #fdf6ea;">
    <div class="container" style="max-width: 1200px; margin: 0 auto;">
        
        <header class="page-header" style="text-align: center; margin-bottom: 60px;">
            <div style="display: inline-block; font-size: 14px; font-weight: 700; color: #838C48; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 15px;">
                Eğitim Materyalleri
            </div>
            <h1 class="page-title" style="font-family: 'Playfair Display', serif; font-size: 42px; font-weight: 800; color: #303030; margin-bottom: 20px;">
                Tüm Materyaller
            </h1>
            <p style="font-family: 'Inter', sans-serif; font-size: 18px; color: #666; max-width: 600px; margin: 0 auto;">
                İhtiyacınız olan eğitim kademesini seçerek ilgili sınıf seviyelerine ve materyallere ulaşabilirsiniz.
            </p>
        </header>

        <?php 
        // 1. ANA KADEMELERİ (İlkokul, Ortaokul, Lise) GÖSTER
        if ( !empty($main_kademeler) && !is_wp_error($main_kademeler) ) : 
        ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 40px; margin-bottom: 80px;">
                <?php foreach ( $main_kademeler as $kademe ) : ?>
                    <a href="<?php echo esc_url(get_term_link($kademe)); ?>" style="display: block; text-decoration: none;">
                        <div style="background: #fff; padding: 50px 30px; border-radius: 24px; text-align: center; box-shadow: 0 15px 40px rgba(0,0,0,0.06); border: 1px solid rgba(131,140,72,0.1); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden;">
                            <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, #838C48, #DA853D);"></div>
                            
                            <div class="kademe-icon-container" style="width: 90px; height: 90px; margin: 0 auto 25px; background: linear-gradient(135deg, rgba(131,140,72,0.1), rgba(218,133,61,0.1)); border-radius: 24px; display: flex; align-items: center; justify-content: center; transition: transform 0.4s ease;">
                                <?php 
                                $icon_url = get_term_meta($kademe->term_id, 'sinif_grubu_icon_url', true);
                                if ($icon_url): 
                                ?>
                                    <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($kademe->name); ?>" style="width: 100%; height: 100%; object-fit: cover; border-radius: 24px;">
                                <?php else: ?>
                                    <?php if($kademe->name == 'İlkokul'): ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" fill="#838C48"><path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3z"/></svg>
                                    <?php elseif($kademe->name == 'Ortaokul'): ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" fill="#838C48"><path d="M21 5c-1.11-.35-2.33-.5-3.5-.5-1.95 0-4.05.4-5.5 1.5-1.45-1.1-3.55-1.5-5.5-1.5S2.45 4.9 1 6v14.65c0 .25.25.5.5.5.1 0 .15-.05.25-.05C3.1 20.45 5.05 20 6.5 20c1.95 0 4.05.4 5.5 1.5 1.35-.85 3.8-1.5 5.5-1.5 1.65 0 3.35.3 4.75 1.05.1.05.15.05.25.05.25 0 .5-.25.5-.5V6c-.6-.45-1.25-.75-2-1z"/></svg>
                                    <?php else: ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" fill="#838C48"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <h3 style="font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: #303030; margin-bottom: 15px;">
                                <?php echo esc_html($kademe->name); ?>
                            </h3>
                            <span style="display: inline-block; padding: 10px 24px; background: #f5f7f2; color: #838C48; font-family: 'Inter', sans-serif; font-size: 15px; font-weight: 600; border-radius: 50px;">
                                Sınıfları Gör &rarr;
                            </span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php 
        // 2. SON EKLENEN MATERYALLER
        if ( have_posts() ) : 
        ?>
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px; border-bottom: 2px solid rgba(131,140,72,0.2); padding-bottom: 15px;">
                <h2 style="font-family: 'Raleway', sans-serif; font-size: 28px; font-weight: 700; color: #303030; margin: 0;">
                    Son Eklenen Materyaller
                </h2>
            </div>
            
            <div class="materyal-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px;">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.05); transition: transform 0.3s; border: 1px solid rgba(0,0,0,0.04);">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>" style="display: block;">
                                <?php the_post_thumbnail('medium_large', ['style' => 'width: 100%; height: 220px; object-fit: cover; transition: transform 0.3s;']); ?>
                            </a>
                        <?php else: ?>
                            <div style="width: 100%; height: 220px; background: linear-gradient(135deg, #f5f5f5, #e0e0e0); display: flex; align-items: center; justify-content: center; color: #999;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="#ccc"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                            </div>
                        <?php endif; ?>
                        
                        <div style="padding: 25px;">
                            <?php 
                            $turler = get_the_terms(get_the_ID(), 'materyal_turu');
                            if($turler) {
                                echo '<span style="display: inline-block; background: rgba(131,140,72,0.1); color: #838C48; padding: 4px 12px; border-radius: 50px; font-size: 12px; font-weight: 700; margin-bottom: 15px; letter-spacing: 1px;">' . esc_html($turler[0]->name) . '</span>';
                            }
                            ?>
                            <h2 style="font-family: 'Raleway', sans-serif; font-size: 20px; font-weight: 700; margin-top: 0; margin-bottom: 15px; line-height: 1.4;">
                                <a href="<?php the_permalink(); ?>" style="color: #303030; text-decoration: none;"><?php the_title(); ?></a>
                            </h2>
                            <p style="font-family: 'Inter', sans-serif; font-size: 14px; color: #666; margin-bottom: 25px; line-height: 1.6;">
                                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                            </p>
                            <a href="<?php the_permalink(); ?>" style="display: block; text-align: center; background: linear-gradient(135deg, #838C48, #DA853D); color: #fff; padding: 12px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: opacity 0.3s;">
                                Materyali İncele
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="pagination" style="margin-top: 50px; text-align: center;">
                <?php 
                echo paginate_links(array(
                    'prev_text' => '&laquo; Önceki',
                    'next_text' => 'Sonraki &raquo;',
                    'type'      => 'list'
                )); 
                ?>
                <style>
                    .pagination ul { list-style: none; padding: 0; display: inline-flex; gap: 10px; }
                    .pagination li a, .pagination li span { display: block; padding: 10px 18px; background: #fff; border-radius: 8px; color: #303030; text-decoration: none; font-weight: 600; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
                    .pagination li span.current { background: #838C48; color: #fff; }
                </style>
            </div>

        <?php else : ?>
            <div style="text-align: center; padding: 80px 20px; background: #fff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                <div style="margin-bottom: 20px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="#ddd"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                </div>
                <h3 style="font-family: 'Raleway', sans-serif; font-size: 22px; color: #303030; margin-bottom: 10px;">Henüz Materyal Yok</h3>
                <p style="color: #666;">Sisteme henüz materyal eklenmemiş.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<style>
    /* Hover Effects for Cards */
    .wdt-main-content-wrapper a > div:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(131,140,72,0.15) !important;
        border-color: rgba(131,140,72,0.3) !important;
    }
    .wdt-main-content-wrapper a > div:hover div[style*="border-radius: 24px"] {
        transform: scale(1.1) rotate(5deg);
        background: linear-gradient(135deg, rgba(131,140,72,0.2), rgba(218,133,61,0.2)) !important;
    }
    .wdt-main-content-wrapper a > div:hover span {
        background: linear-gradient(135deg, #838C48, #DA853D) !important;
        color: #fff !important;
    }
    .materyal-grid article:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(131,140,72,0.1) !important;
    }
    .materyal-grid article:hover img {
        transform: scale(1.05);
    }
    .materyal-grid article a:hover {
        opacity: 0.9;
    }
</style>

<?php get_footer(); ?>
