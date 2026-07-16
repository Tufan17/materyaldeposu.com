<?php
/**
 * Template Name: Gelişmiş Materyal Arama
 */
get_header();

// Arama ve Filtre Parametrelerini Al
$search_query = isset($_GET['q']) ? sanitize_text_field($_GET['q']) : '';
$sinif_slug = isset($_GET['sinif']) ? sanitize_text_field($_GET['sinif']) : '';
$ders_slug = isset($_GET['ders']) ? sanitize_text_field($_GET['ders']) : '';

// Taxonomy'leri çek
$siniflar = get_terms(array('taxonomy' => 'sinif_grubu', 'hide_empty' => false));
$dersler = get_terms(array('taxonomy' => 'dersler', 'hide_empty' => false));

// WP Query Argümanlarını Hazırla
$args = array(
    'post_type'      => 'materyaller',
    'post_status'    => 'publish',
    'posts_per_page' => 24,
    'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
    's'              => $search_query
);

$tax_query = array('relation' => 'AND');

if (!empty($sinif_slug)) {
    $tax_query[] = array(
        'taxonomy' => 'sinif_grubu',
        'field'    => 'slug',
        'terms'    => $sinif_slug
    );
}

if (!empty($ders_slug)) {
    $tax_query[] = array(
        'taxonomy' => 'dersler',
        'field'    => 'slug',
        'terms'    => $ders_slug
    );
}

if (count($tax_query) > 1) {
    $args['tax_query'] = $tax_query;
}

$arama_sonuclari = new WP_Query($args);
?>

<div class="wdt-main-content-wrapper" style="padding: 150px 20px 80px; background: #fdf6ea;">
    <div class="container" style="max-width: 1300px; margin: 0 auto;">

        <div style="text-align: center; margin-bottom: 50px;">
            <h1 style="font-family: 'Playfair Display', serif; font-size: 48px; font-weight: 800; color: #303030;">Materyal Kütüphanesi</h1>
            <p style="font-size: 18px; color: #666; max-width: 600px; margin: 0 auto;">Aradığınız dökümanlara, slaytlara ve videolara hızlıca ulaşmak için filtreleri kullanın.</p>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 40px; align-items: flex-start;">
            
            <!-- SOL TARAF: FİLTRELEME PANELİ -->
            <aside style="flex: 0 0 300px; background: #fff; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid rgba(131,140,72,0.1); position: sticky; top: 120px;">
                <h3 style="font-size: 20px; font-weight: 700; color: #303030; margin-bottom: 25px; border-bottom: 2px solid rgba(131,140,72,0.2); padding-bottom: 10px;">
                    <i class="fa fa-filter" style="color: #838C48; margin-right: 5px;"></i> Detaylı Arama
                </h3>
                
                <form method="GET" action="<?php echo esc_url(get_permalink()); ?>">
                    
                    <!-- Kelime Arama -->
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #555; margin-bottom: 8px;">Anahtar Kelime</label>
                        <input type="text" name="q" value="<?php echo esc_attr($search_query); ?>" placeholder="Ne arıyorsunuz?" style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #ddd; font-family: 'Inter', sans-serif;">
                    </div>

                    <!-- Sınıf Seçimi -->
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #555; margin-bottom: 8px;">Sınıf Grubu</label>
                        <select name="sinif" id="filter_sinif" style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #ddd; font-family: 'Inter', sans-serif; background: #fff;">
                            <option value="">Tüm Sınıflar</option>
                            <?php foreach ($siniflar as $sinif) : ?>
                                <option value="<?php echo esc_attr($sinif->slug); ?>" data-id="<?php echo esc_attr($sinif->term_id); ?>" <?php selected($sinif_slug, $sinif->slug); ?>>
                                    <?php echo esc_html($sinif->name); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Ders Seçimi -->
                    <div style="margin-bottom: 30px;">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #555; margin-bottom: 8px;">Ders</label>
                        <select name="ders" id="filter_ders" style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #ddd; font-family: 'Inter', sans-serif; background: #fff;">
                            <option value="">Tüm Dersler</option>
                            <?php foreach ($dersler as $ders) : ?>
                                <option value="<?php echo esc_attr($ders->slug); ?>" data-id="<?php echo esc_attr($ders->term_id); ?>" <?php selected($ders_slug, $ders->slug); ?>>
                                    <?php echo esc_html($ders->name); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" style="width: 100%; background: linear-gradient(135deg, #838C48 0%, #6b7337 100%); color: #fff; padding: 15px; border: none; border-radius: 10px; font-size: 16px; font-weight: 700; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(131,140,72,0.3);" onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';">
                        Sonuçları Getir
                    </button>

                    <?php if(!empty($search_query) || !empty($sinif_slug) || !empty($ders_slug)): ?>
                        <a href="<?php echo esc_url(get_permalink()); ?>" style="display: block; text-align: center; margin-top: 15px; font-size: 14px; color: #DA853D; text-decoration: none; font-weight: 600;">
                            Filtreleri Temizle
                        </a>
                    <?php endif; ?>

                </form>
            </aside>

            <!-- SAĞ TARAF: SONUÇLAR -->
            <main style="flex: 1; min-width: 0;">
                
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                    <h2 style="font-size: 24px; font-weight: 700; color: #303030; margin: 0;">Arama Sonuçları</h2>
                    <span style="background: rgba(218,133,61,0.1); color: #DA853D; padding: 5px 15px; border-radius: 20px; font-size: 14px; font-weight: 700;">
                        <?php echo $arama_sonuclari->found_posts; ?> Materyal Bulundu
                    </span>
                </div>

                <?php if ($arama_sonuclari->have_posts()) : ?>
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px;">
                        <?php while ($arama_sonuclari->have_posts()) : $arama_sonuclari->the_post(); 
                            $tur_terms = get_the_terms(get_the_ID(), 'materyal_turu');
                            $tur_isim = ($tur_terms && !is_wp_error($tur_terms)) ? $tur_terms[0]->name : 'Döküman';
                            $icon = ($tur_isim == 'Video') ? 'fa-play-circle' : (($tur_isim == 'Slayt') ? 'fa-tv' : 'fa-file-pdf');
                        ?>
                            <article style="background: #fff; border-radius: 20px; padding: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.03); transition: all 0.3s ease; position: relative; display: flex; flex-direction: column; height: 100%;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 35px rgba(0,0,0,0.08)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.03)';">
                                <div style="position: absolute; top: 15px; right: 20px; font-size: 20px; color: rgba(131,140,72,0.2);">
                                    <i class="fa <?php echo esc_attr($icon); ?>"></i>
                                </div>
                                <div style="display: inline-block; font-size: 11px; font-weight: 700; color: #838C48; background: rgba(131,140,72,0.1); padding: 4px 10px; border-radius: 20px; margin-bottom: 12px; align-self: flex-start;">
                                    <?php echo esc_html($tur_isim); ?>
                                </div>
                                <h3 style="font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: #303030; margin-bottom: 10px; line-height: 1.3;">
                                    <a href="<?php the_permalink(); ?>" style="color: inherit; text-decoration: none;"><?php the_title(); ?></a>
                                </h3>
                                <div style="font-family: 'Inter', sans-serif; font-size: 14px; color: #777; line-height: 1.5; margin-bottom: 20px; flex-grow: 1;">
                                    <?php echo wp_trim_words(get_the_content(), 12, '...'); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" style="display: block; text-align: center; width: 100%; background: #fdfdfd; border: 1px solid #eaeaea; color: #303030; font-weight: 600; padding: 10px 0; border-radius: 10px; text-decoration: none; font-size: 14px; transition: background 0.2s ease;" onmouseover="this.style.background='rgba(218,133,61,0.1)'; this.style.color='#DA853D'; this.style.borderColor='rgba(218,133,61,0.2)';" onmouseout="this.style.background='#fdfdfd'; this.style.color='#303030'; this.style.borderColor='#eaeaea';">
                                    İncele
                                </a>
                            </article>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>

                    <!-- Sayfalama -->
                    <div style="margin-top: 40px; text-align: center;">
                        <?php
                        echo paginate_links(array(
                            'total' => $arama_sonuclari->max_num_pages,
                            'prev_text' => '&laquo; Önceki',
                            'next_text' => 'Sonraki &raquo;',
                        ));
                        ?>
                    </div>

                <?php else : ?>
                    <div style="background: #fff; padding: 50px; border-radius: 20px; text-align: center; border: 1px dashed #ccc;">
                        <i class="fa fa-search" style="font-size: 40px; color: #ccc; margin-bottom: 15px;"></i>
                        <h3 style="font-size: 20px; color: #555;">Sonuç Bulunamadı</h3>
                        <p style="color: #888;">Seçtiğiniz filtrelere uygun materyal yok. Lütfen filtreleri değiştirerek tekrar deneyin.</p>
                    </div>
                <?php endif; ?>

            </main>

        </div>
    </div>
</div>

<style>
/* Basit sayfalama stili */
.page-numbers {
    display: inline-block;
    padding: 8px 16px;
    margin: 0 5px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    color: #333;
    text-decoration: none;
    font-weight: 600;
}
.page-numbers.current {
    background: #838C48;
    color: #fff;
    border-color: #838C48;
}
.page-numbers:hover:not(.current) {
    background: #f5f5f5;
}
</style>

<script>
jQuery(document).ready(function($){
    $('#filter_sinif').on('change', function(){
        var sinif_id = $(this).find(':selected').data('id');
        var ders_dropdown = $('#filter_ders');
        
        ders_dropdown.html('<option value="">Yükleniyor...</option>');
        
        if(sinif_id) {
            $.post(ajaxurl, {
                action: 'get_bagli_dersler',
                sinif_id: sinif_id,
                is_admin: 0
            }, function(response) {
                // Varsayılan "-- Ders Seç --" metnini "Tüm Dersler" ile değiştir.
                ders_dropdown.html(response.replace('-- Ders Seç --', 'Tüm Dersler'));
            });
        } else {
            ders_dropdown.html('<option value="">Tüm Dersler</option>');
        }
    });
});
</script>

<?php get_footer(); ?>
