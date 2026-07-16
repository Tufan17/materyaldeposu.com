<?php
/**
 * Tekil Materyal Detay Şablonu
 */
get_header(); ?>

<div class="wdt-main-content-wrapper" style="padding: 150px 20px 80px; background: #fdf6ea; position: relative; overflow: hidden;">
    
    <!-- Arka plan süslemeleri -->
    <div style="position: absolute; top: -50px; left: -100px; width: 400px; height: 400px; background: rgba(131,140,72,0.05); border-radius: 50%; filter: blur(50px);"></div>
    <div style="position: absolute; bottom: 10%; right: -100px; width: 300px; height: 300px; background: rgba(218,133,61,0.05); border-radius: 50%; filter: blur(40px);"></div>

    <div class="container" style="max-width: 950px; margin: 0 auto; position: relative; z-index: 1;">
        
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="background: #fff; border-radius: 24px; box-shadow: 0 20px 50px rgba(0,0,0,0.06); overflow: hidden; border: 1px solid rgba(131,140,72,0.1);">
                
                <!-- Üst Kısım (Header Alanı) -->
                <header class="entry-header" style="background: linear-gradient(135deg, rgba(131,140,72,0.05) 0%, rgba(218,133,61,0.05) 100%); padding: 50px 40px; text-align: center; border-bottom: 1px solid rgba(0,0,0,0.05);">
                    <?php 
                    $sinif = get_the_terms(get_the_ID(), 'sinif_grubu');
                    $ders = get_the_terms(get_the_ID(), 'dersler');
                    $konu = get_the_terms(get_the_ID(), 'konular');
                    $tur = get_the_terms(get_the_ID(), 'materyal_turu');
                    
                    echo '<div class="badges" style="margin-bottom: 25px; display: flex; justify-content: center; gap: 10px; flex-wrap: wrap;">';
                    if($sinif && !is_wp_error($sinif)) {
                        echo '<span style="background: #fff; color: #838C48; padding: 6px 16px; border-radius: 50px; font-size: 13px; font-weight: 700; box-shadow: 0 4px 10px rgba(131,140,72,0.1); border: 1px solid rgba(131,140,72,0.1);"><i class="fa fa-graduation-cap"></i> ' . esc_html($sinif[0]->name) . '</span>';
                    }
                    if($ders && !is_wp_error($ders)) {
                        echo '<span style="background: #fff; color: #DA853D; padding: 6px 16px; border-radius: 50px; font-size: 13px; font-weight: 700; box-shadow: 0 4px 10px rgba(218,133,61,0.1); border: 1px solid rgba(218,133,61,0.1);"><i class="fa fa-book"></i> ' . esc_html($ders[0]->name) . '</span>';
                    }
                    if($konu && !is_wp_error($konu)) {
                        echo '<span style="background: #fff; color: #0171BB; padding: 6px 16px; border-radius: 50px; font-size: 13px; font-weight: 700; box-shadow: 0 4px 10px rgba(1,113,187,0.1); border: 1px solid rgba(1,113,187,0.1);"><i class="fa fa-layer-group"></i> ' . esc_html($konu[0]->name) . '</span>';
                    }
                    echo '</div>';
                    
                    the_title( '<h1 class="entry-title" style="font-family: \'Playfair Display\', serif; font-size: 42px; font-weight: 800; color: #303030; margin-bottom: 0; line-height: 1.3;">', '</h1>' ); 
                    ?>
                </header>

                <div class="entry-content-wrap" style="padding: 40px; display: flex; flex-direction: column; align-items: center;">
                    
                    <div class="materyal-icon" style="width: 80px; height: 80px; background: rgba(131,140,72,0.1); color: #838C48; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; margin-bottom: 25px;">
                        <i class="fa fa-file-alt"></i>
                    </div>

                    <div class="entry-content" style="font-family: 'Inter', sans-serif; font-size: 18px; line-height: 1.8; color: #555; text-align: center; max-width: 700px; margin-bottom: 40px;">
                        <?php 
                        $content = apply_filters('the_content', get_the_content());
                        // İçerik içindeki <img ...> etiketlerini temizle
                        $content = preg_replace('/<img[^>]+>/i', '', $content);
                        // Eğer medyaya link verildiyse (<a> etiketi ve wp-content/uploads geçiyorsa) onları da temizle
                        $content = preg_replace('/<a[^>]*href="[^"]*wp-content\/uploads[^"]*"[^>]*>.*?<\/a>/i', '', $content);
                        // İçerik içindeki WP galeri / resim caption kodlarını temizle
                        $content = preg_replace('/\[caption[^\]]*\].*?\[\/caption\]/is', '', $content);
                        // Boş p etiketlerini temizle
                        $content = preg_replace('/<p>\s*(?:<br\s*\/?>)?\s*<\/p>/i', '', $content);
                        
                        echo $content;
                        ?>
                    </div>

                    <?php
                    // Ekli tüm medyaları al (Kullanıcının text editöre sürüklediği her şey buradadır)
                    $attachments = get_attached_media('', get_the_ID());
                    $dosya_id_meta = get_post_meta(get_the_ID(), 'yuklenen_dosya_id', true);

                    $all_files = array();
                    if ($dosya_id_meta) {
                        $meta_post = get_post($dosya_id_meta);
                        if ($meta_post) $all_files[$dosya_id_meta] = $meta_post;
                    }
                    if (!empty($attachments)) {
                        foreach($attachments as $att) {
                            $all_files[$att->ID] = $att;
                        }
                    }

                    if (!empty($all_files)) :
                    ?>
                        <!-- Gelişmiş Dosya Gösterimi -->
                        <div class="attached-files" style="width: 100%; max-width: 800px; text-align: left; background: #fafafa; border-radius: 20px; padding: 30px; margin-bottom: 30px; border: 1px solid #eaeaea;">
                            <h3 style="font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: #303030; margin-bottom: 25px; display: flex; align-items: center;">
                                <i class="fa fa-paperclip" style="color: #838C48; margin-right: 10px;"></i> İndirilebilir Dosyalar
                            </h3>
                            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px;">
                                <?php 
                                foreach ($all_files as $att_id => $att) {
                                    $url = wp_get_attachment_url($att_id);
                                    $title = $att->post_title;
                                    $mime = get_post_mime_type($att_id);
                                    
                                    // Dosya tipine göre ikon belirle
                                    $icon = 'fa-file-alt';
                                    $color = '#666';
                                    if (strpos($mime, 'image') !== false) { $icon = 'fa-file-image'; $color = '#0171BB'; }
                                    elseif (strpos($mime, 'pdf') !== false) { $icon = 'fa-file-pdf'; $color = '#d32f2f'; }
                                    elseif (strpos($mime, 'word') !== false || strpos($mime, 'document') !== false) { $icon = 'fa-file-word'; $color = '#1976d2'; }
                                    elseif (strpos($mime, 'video') !== false) { $icon = 'fa-file-video'; $color = '#F2672E'; }
                                    elseif (strpos($mime, 'zip') !== false || strpos($mime, 'rar') !== false) { $icon = 'fa-file-archive'; $color = '#7b1fa2'; }

                                    echo '<a href="'.esc_url($url).'" target="_blank" download style="display: flex; align-items: center; background: #fff; padding: 15px 20px; border-radius: 12px; text-decoration: none; border: 1px solid #eaeaea; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(0,0,0,0.02);" onmouseover="this.style.borderColor=\''.esc_attr($color).'\'; this.style.transform=\'translateY(-3px)\'; this.style.boxShadow=\'0 8px 20px rgba(0,0,0,0.05)\';" onmouseout="this.style.borderColor=\'#eaeaea\'; this.style.transform=\'translateY(0)\'; this.style.boxShadow=\'0 4px 10px rgba(0,0,0,0.02)\';">';
                                    echo '<i class="fa '.esc_attr($icon).'" style="font-size: 28px; color: '.esc_attr($color).'; margin-right: 15px; min-width: 28px; text-align: center;"></i>';
                                    echo '<span style="font-family: \'Inter\', sans-serif; font-size: 14px; font-weight: 600; color: #444; word-break: break-word; line-height: 1.4;">'.esc_html(wp_trim_words($title, 5, '...')).'</span>';
                                    echo '</a>';
                                }
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Özel İndirme ve Paylaşım Alanı -->
                    <div class="action-buttons" style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; width: 100%; padding-top: 10px;">

                        <!-- WhatsApp Paylaş -->
                        <?php
                        $post_url = urlencode(get_permalink());
                        $post_title = urlencode(get_the_title());
                        $whatsapp_url = "https://api.whatsapp.com/send?text=" . $post_title . " - " . $post_url;
                        ?>
                        <a href="<?php echo $whatsapp_url; ?>" target="_blank" class="whatsapp-btn" style="display: inline-flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #25D366 0%, #1da851 100%); color: #fff; padding: 16px 45px; border-radius: 50px; font-size: 16px; font-weight: 700; text-decoration: none; box-shadow: 0 10px 20px rgba(37,211,102,0.3); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 15px 25px rgba(37,211,102,0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 20px rgba(37,211,102,0.3)';">
                            <i class="fab fa-whatsapp" style="margin-right:10px; font-size:22px;"></i>
                            Sınıfta Paylaş
                        </a>
                    </div>

                </div>
            </article>
        <?php endwhile; ?>

    </div>
</div>

<?php get_footer(); ?>
