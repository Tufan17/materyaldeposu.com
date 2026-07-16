<?php
/**
 * Sınıf Grupları Taxonomy Şablonu
 * (Sınıf -> Ders -> Konu -> Materyal Hiyerarşisi)
 */
get_header(); 

$current_term = get_queried_object();
$secili_ders = isset($_GET['ders']) ? sanitize_text_field($_GET['ders']) : '';
$secili_konu = isset($_GET['konu']) ? sanitize_text_field($_GET['konu']) : '';

// 1. Durum: Alt sınıfları kontrol et (Örn: Lise -> 9, 10, 11)
$children = get_terms( array(
    'taxonomy'   => 'sinif_grubu',
    'parent'     => $current_term->term_id,
    'hide_empty' => false,
) );

if ( ! is_wp_error( $children ) && ! empty( $children ) ) {
    usort( $children, function( $a, $b ) {
        $order_a = (int) get_term_meta( $a->term_id, 'sinif_grubu_order', true );
        $order_b = (int) get_term_meta( $b->term_id, 'sinif_grubu_order', true );
        if ( $order_a == $order_b ) {
            return strnatcmp( $a->name, $b->name );
        }
        return $order_a - $order_b;
    });
}
?>

<div class="wdt-main-content-wrapper" style="padding: 150px 20px 60px; background: #fdf6ea; min-height: 80vh;">
    <div class="container" style="max-width: 1200px; margin: 0 auto;">
        
        <header class="page-header" style="text-align: center; margin-bottom: 50px;">
            <?php 
            // Breadcrumbs (Ekmek Kırıntıları) oluştur
            $breadcrumbs = array();
            $breadcrumbs[] = '<a href="'.esc_url(get_term_link($current_term)).'" style="color:#838C48; text-decoration:none;">'.esc_html($current_term->name).'</a>';
            
            if ( $secili_ders ) {
                $ders_term = get_term_by('slug', $secili_ders, 'dersler');
                if ( $ders_term ) {
                    $breadcrumbs[] = '<a href="'.esc_url(add_query_arg('ders', $secili_ders, get_term_link($current_term))).'" style="color:#838C48; text-decoration:none;">'.esc_html($ders_term->name).'</a>';
                }
            }
            if ( $secili_konu ) {
                $konu_term = get_term_by('slug', $secili_konu, 'konular');
                if ( $konu_term ) {
                    $breadcrumbs[] = '<span style="color:#666;">'.esc_html($konu_term->name).'</span>';
                }
            }
            ?>
            <div style="display: inline-block; font-size: 14px; font-weight: 700; color: #838C48; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 15px; background: rgba(131,140,72,0.1); padding: 5px 15px; border-radius: 20px;">
                <i class="fa fa-folder-open" style="margin-right:5px;"></i> <?php echo implode(' <span style="color:#ccc; margin:0 5px;">/</span> ', $breadcrumbs); ?>
            </div>

            <h1 class="page-title" style="font-family: 'Playfair Display', serif; font-size: 42px; font-weight: 800; color: #303030; margin-bottom: 20px;">
                <?php 
                if ( $secili_konu && isset($konu_term) ) {
                    echo esc_html($konu_term->name) . ' Materyalleri';
                } elseif ( $secili_ders && isset($ders_term) ) {
                    echo esc_html($ders_term->name) . ' Konuları';
                } else {
                    echo esc_html($current_term->name);
                }
                ?>
            </h1>
        </header>

        <?php 
        // AŞAMA 1: EĞER ALT SINIFLAR VARSA (Örn: Lise -> 9. Sınıf)
        if ( !empty($children) && !is_wp_error($children) ) : 
        ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 30px; margin-bottom: 60px;">
                <?php foreach ( $children as $child ) : ?>
                    <a href="<?php echo esc_url(get_term_link($child)); ?>" style="display: block; text-decoration: none;">
                        <div style="background: #fff; padding: 40px 30px; border-radius: 20px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid rgba(131,140,72,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 35px rgba(0,0,0,0.1)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.05)';">
                            <div style="width: 70px; height: 70px; margin: 0 auto 20px; background: linear-gradient(135deg, rgba(131,140,72,0.1), rgba(218,133,61,0.1)); border-radius: 18px; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="#838C48"><path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/></svg>
                            </div>
                            <h3 style="font-family: 'Raleway', sans-serif; font-size: 22px; font-weight: 700; color: #303030; margin-bottom: 10px;">
                                <?php echo esc_html($child->name); ?>
                            </h3>
                            <span style="display: inline-block; font-size: 14px; font-weight: 600; color: #DA853D;">
                                Kategoriyi İncele &rarr;
                            </span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

        <?php 
        // AŞAMA 2, 3, 4: ALT SINIF YOKSA (Örn: 9. Sınıf'tayız) -> DERS > KONU > MATERYAL
        else: 
            
            // Mevcut filtrelerle postları çek
            $tax_query = array('relation' => 'AND');
            $tax_query[] = array('taxonomy' => 'sinif_grubu', 'field' => 'term_id', 'terms' => $current_term->term_id);
            if ( $secili_ders ) { $tax_query[] = array('taxonomy' => 'dersler', 'field' => 'slug', 'terms' => $secili_ders); }
            if ( $secili_konu ) { $tax_query[] = array('taxonomy' => 'konular', 'field' => 'slug', 'terms' => $secili_konu); }

            $args = array(
                'post_type' => 'materyaller',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'tax_query' => $tax_query
            );
            $posts = get_posts($args);

            // AŞAMA 2: DERSLER LİSTESİ (Ders seçilmediyse)
            if ( empty($secili_ders) ) {
                $ders_ids = array();
                foreach ($posts as $p) {
                    $terms = wp_get_post_terms($p->ID, 'dersler', array('fields' => 'ids'));
                    if (!is_wp_error($terms)) { foreach($terms as $id) { $ders_ids[$id] = true; } }
                }

                if ( !empty($ders_ids) ) {
                    $dersler = get_terms(array('taxonomy' => 'dersler', 'include' => array_keys($ders_ids), 'hide_empty' => false));
                    echo '<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">';
                    foreach ($dersler as $ders) {
                        $url = add_query_arg('ders', $ders->slug, get_term_link($current_term));
                        echo '<a href="'.esc_url($url).'" style="display: block; text-decoration: none;">';
                        echo '<div style="background: #fff; padding: 25px 20px; border-radius: 16px; text-align: center; border-left: 4px solid #F2672E; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: all 0.3s ease;" onmouseover="this.style.transform=\'translateY(-3px)\'; this.style.boxShadow=\'0 10px 20px rgba(0,0,0,0.1)\';" onmouseout="this.style.transform=\'translateY(0)\'; this.style.boxShadow=\'0 5px 15px rgba(0,0,0,0.05)\';">';
                        echo '<h3 style="font-family: \'Inter\', sans-serif; font-size: 18px; font-weight: 700; color: #333; margin: 0;">'.esc_html($ders->name).'</h3>';
                        echo '<div style="margin-top: 10px; font-size: 13px; color: #888;">Konuları Gör &rarr;</div>';
                        echo '</div></a>';
                    }
                    echo '</div>';
                } else {
                    echo '<div style="text-align:center; padding:50px; background:#fff; border-radius:15px; color:#666;">Bu sınıfa ait henüz ders veya materyal eklenmemiş.</div>';
                }
            }
            
            // AŞAMA 3: KONULAR LİSTESİ (Ders seçilmiş, Konu seçilmemişse)
            elseif ( !empty($secili_ders) && empty($secili_konu) ) {
                $konu_ids = array();
                foreach ($posts as $p) {
                    $terms = wp_get_post_terms($p->ID, 'konular', array('fields' => 'ids'));
                    if (!is_wp_error($terms)) { foreach($terms as $id) { $konu_ids[$id] = true; } }
                }

                if ( !empty($konu_ids) ) {
                    $konular = get_terms(array('taxonomy' => 'konular', 'include' => array_keys($konu_ids), 'hide_empty' => false));
                    echo '<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">';
                    foreach ($konular as $konu) {
                        $url = add_query_arg(array('ders' => $secili_ders, 'konu' => $konu->slug), get_term_link($current_term));
                        echo '<a href="'.esc_url($url).'" style="display: flex; align-items: center; justify-content: space-between; text-decoration: none; background: #fff; padding: 20px 25px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.03); transition: all 0.2s ease;" onmouseover="this.style.boxShadow=\'0 8px 20px rgba(0,0,0,0.08)\'; this.style.background=\'#fdfdfd\';" onmouseout="this.style.boxShadow=\'0 4px 10px rgba(0,0,0,0.03)\'; this.style.background=\'#fff\';">';
                        echo '<span style="font-family: \'Inter\', sans-serif; font-size: 16px; font-weight: 600; color: #303030;">'.esc_html($konu->name).'</span>';
                        echo '<span style="background: rgba(131,140,72,0.1); color: #838C48; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">Materyaller <i class="fa fa-angle-right"></i></span>';
                        echo '</a>';
                    }
                    echo '</div>';
                } else {
                    echo '<div style="text-align:center; padding:50px; background:#fff; border-radius:15px; color:#666;">Bu derse ait konu bulunamadı.</div>';
                }
            }

            // AŞAMA 4: MATERYALLER LİSTESİ (Ders ve Konu seçilmişse)
            elseif ( !empty($secili_ders) && !empty($secili_konu) ) {
                if ( count($posts) > 0 ) {
                    echo '<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 30px;">';
                    foreach ( $posts as $post ) {
                        setup_postdata($post);
                        $tur_terms = get_the_terms($post->ID, 'materyal_turu');
                        $tur_isim = ($tur_terms && !is_wp_error($tur_terms)) ? $tur_terms[0]->name : 'Döküman';
                        $icon = ($tur_isim == 'Video') ? 'fa-play-circle' : (($tur_isim == 'Slayt') ? 'fa-tv' : 'fa-file-pdf');
                        ?>
                        <article class="materyal-card" style="background: #fff; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: all 0.3s ease; position: relative; display: flex; flex-direction: column; height: 100%;">
                            <div style="position: absolute; top: 20px; right: 20px; font-size: 24px; color: rgba(131,140,72,0.2);">
                                <i class="fa <?php echo esc_attr($icon); ?>"></i>
                            </div>
                            <div style="display: inline-block; font-size: 12px; font-weight: 700; color: #fff; background: #838C48; padding: 4px 12px; border-radius: 20px; margin-bottom: 15px; align-self: flex-start;">
                                <?php echo esc_html($tur_isim); ?>
                            </div>
                            <h3 style="font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: #303030; margin-bottom: 15px; line-height: 1.3;">
                                <?php the_title(); ?>
                            </h3>
                            <p style="font-family: 'Inter', sans-serif; font-size: 15px; color: #666; line-height: 1.6; margin-bottom: 25px; flex-grow: 1;">
                                <?php echo wp_trim_words(get_the_content(), 15, '...'); ?>
                            </p>
                            <a href="<?php the_permalink(); ?>" style="display: block; text-align: center; width: 100%; background: rgba(218,133,61,0.1); color: #DA853D; font-weight: 700; padding: 12px 0; border-radius: 12px; text-decoration: none; transition: background 0.3s ease;" onmouseover="this.style.background='#DA853D'; this.style.color='#fff';" onmouseout="this.style.background='rgba(218,133,61,0.1)'; this.style.color='#DA853D';">
                                İncele & İndir
                            </a>
                        </article>
                        <?php
                    }
                    wp_reset_postdata();
                    echo '</div>';
                } else {
                    echo '<div style="text-align:center; padding:50px; background:#fff; border-radius:15px; color:#666;">Bu konuya ait henüz materyal yüklenmemiş.</div>';
                }
            }

        endif; 
        ?>

    </div>
</div>

<?php get_footer(); ?>
