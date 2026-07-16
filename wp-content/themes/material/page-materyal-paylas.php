<?php
/**
 * Template Name: Materyal Paylaş
 */

// Form gönderildi mi kontrol et
$form_mesaji = '';
$form_durumu = '';

if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_materyal']) ) {
    // Güvenlik kontrolü
    if ( ! isset( $_POST['materyal_nonce'] ) || ! wp_verify_nonce( $_POST['materyal_nonce'], 'materyal_paylas_action' ) ) {
        $form_mesaji = 'Güvenlik doğrulaması başarısız oldu.';
        $form_durumu = 'error';
    } else {
        $baslik   = sanitize_text_field( $_POST['materyal_baslik'] );
        $sinif    = intval( $_POST['sinif_grubu'] );
        $ders     = intval( $_POST['dersler'] );
        $konu     = intval( $_POST['konular'] );
        $diger    = sanitize_text_field( $_POST['diger_konu'] );
        $icerik   = wp_kses_post( $_POST['materyal_icerik'] );

        if ( empty($baslik) ) {
            $form_mesaji = 'Lütfen bir başlık giriniz.';
            $form_durumu = 'error';
        } else {
            // "Diğer" seçildiyse yeni konu ekle
            if ( $konu === -1 && !empty($diger) ) {
                $yeni_konu = wp_insert_term( $diger, 'konular' );
                if ( ! is_wp_error( $yeni_konu ) ) {
                    $konu = $yeni_konu['term_id'];
                }
            }

            // Yeni materyali taslak (pending) olarak ekle
            $yeni_post = array(
                'post_title'   => $baslik,
                'post_content' => $icerik,
                'post_status'  => 'pending',
                'post_type'    => 'materyaller'
            );

            $post_id = wp_insert_post( $yeni_post );

            if ( $post_id ) {
                // Sınıflandırmaları ata
                if ( $sinif ) wp_set_object_terms( $post_id, intval($sinif), 'sinif_grubu' );
                if ( $ders )  wp_set_object_terms( $post_id, intval($ders), 'dersler' );
                if ( $konu && $konu !== -1 )  wp_set_object_terms( $post_id, intval($konu), 'konular' );

                // Dosya yüklendiyse işle
                if ( ! empty( $_FILES['materyal_dosya']['name'] ) ) {
                    require_once( ABSPATH . 'wp-admin/includes/image.php' );
                    require_once( ABSPATH . 'wp-admin/includes/file.php' );
                    require_once( ABSPATH . 'wp-admin/includes/media.php' );
                    
                    $attachment_id = media_handle_upload( 'materyal_dosya', $post_id );
                    
                    if ( ! is_wp_error( $attachment_id ) ) {
                        // Dosyayı materyale özel alan olarak kaydet
                        update_post_meta( $post_id, 'yuklenen_dosya_id', $attachment_id );
                    }
                }

                $form_mesaji = 'Teşekkürler! Materyaliniz başarıyla gönderildi ve onay için sıraya alındı.';
                $form_durumu = 'success';
            } else {
                $form_mesaji = 'Sistemsel bir hata oluştu, lütfen tekrar deneyin.';
                $form_durumu = 'error';
            }
        }
    }
}

get_header(); 
?>

<div class="wdt-main-content-wrapper" style="padding: 150px 20px 80px; background: #fdf6ea;">
    <div class="container" style="max-width: 800px; margin: 0 auto; background: #fff; border-radius: 24px; padding: 50px; box-shadow: 0 15px 40px rgba(0,0,0,0.06);">
        
        <header class="post-header" style="text-align: center; margin-bottom: 40px;">
            <div style="display: inline-block; font-size: 13px; font-weight: 700; color: #838C48; background: rgba(131, 140, 72, 0.1); padding: 5px 15px; border-radius: 50px; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 1px;">
                <i class="fa fa-share-alt"></i> BİLGİYİ PAYLAŞIN
            </div>
            
            <h1 class="post-title" style="font-family: 'Playfair Display', serif; font-size: 42px; font-weight: 800; color: #303030; line-height: 1.2; margin-bottom: 20px;">
                Materyal Paylaş
            </h1>
            <p style="font-family: 'Inter', sans-serif; font-size: 16px; color: #666; line-height: 1.6;">
                Elinizdeki eğitim dokümanlarını, soruları ve notları buradaki formu kullanarak tüm öğrencilerle ve öğretmenlerle paylaşabilirsiniz. Gönderiniz onaylandıktan sonra sistemde yayınlanacaktır.
            </p>
        </header>

        <?php if ( $form_mesaji ) : ?>
            <div style="padding: 20px; border-radius: 12px; margin-bottom: 30px; text-align: center; font-weight: 600; <?php echo $form_durumu === 'success' ? 'background: #e8f5e9; color: #2e7d32;' : 'background: #ffebee; color: #c62828;'; ?>">
                <?php echo $form_mesaji; ?>
            </div>
        <?php endif; ?>

        <?php if ( $form_durumu !== 'success' ) : ?>
            <form action="" method="post" enctype="multipart/form-data" style="font-family: 'Inter', sans-serif;">
                <?php wp_nonce_field( 'materyal_paylas_action', 'materyal_nonce' ); ?>
                
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #333;">Materyal Başlığı *</label>
                    <input type="text" name="materyal_baslik" required style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 15px;" placeholder="Örn: 9. Sınıf Matematik 1. Dönem 1. Yazılı Soruları">
                </div>

                <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #333;">Sınıf Seçiniz</label>
                        <select name="sinif_grubu" style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 15px; background: #fff;">
                            <option value="">-- Seçiniz --</option>
                            <?php 
                            $siniflar = get_terms( array('taxonomy' => 'sinif_grubu', 'hide_empty' => false) );
                            foreach ( $siniflar as $sinif ) { echo '<option value="' . esc_attr($sinif->term_id) . '">' . esc_html($sinif->name) . '</option>'; }
                            ?>
                        </select>
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #333;">Ders Seçiniz</label>
                        <select name="dersler" style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 15px; background: #fff;">
                            <option value="">-- Seçiniz --</option>
                            <?php 
                            $dersler = get_terms( array('taxonomy' => 'dersler', 'hide_empty' => false) );
                            foreach ( $dersler as $ders ) { echo '<option value="' . esc_attr($ders->term_id) . '">' . esc_html($ders->name) . '</option>'; }
                            ?>
                        </select>
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #333;">Konu Seçiniz</label>
                    <select name="konular" id="konu_secimi" style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 15px; background: #fff;" onchange="toggleDiger(this.value)">
                        <option value="">-- Seçiniz --</option>
                        <?php 
                        $konular = get_terms( array('taxonomy' => 'konular', 'hide_empty' => false) );
                        foreach ( $konular as $k ) { echo '<option value="' . esc_attr($k->term_id) . '">' . esc_html($k->name) . '</option>'; }
                        ?>
                        <option value="-1" style="font-weight: bold;">+ Diğer (Listede Yok)</option>
                    </select>
                </div>

                <div id="diger_konu_alani" style="margin-bottom: 20px; display: none;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #333;">Lütfen Konuyu Yazınız</label>
                    <input type="text" name="diger_konu" style="width: 100%; padding: 12px 15px; border: 1px solid #838C48; border-radius: 8px; font-size: 15px;" placeholder="Yeni konu adını giriniz...">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #333;">Açıklama / İçerik</label>
                    <?php 
                        $settings = array( 'media_buttons' => false, 'textarea_rows' => 6, 'editor_class' => 'materyal-editor' );
                        wp_editor( '', 'materyal_icerik', $settings ); 
                    ?>
                </div>

                <div style="margin-bottom: 30px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #333;">Doküman / Dosya Yükle (Varsa)</label>
                    <input type="file" name="materyal_dosya" style="width: 100%; padding: 10px; border: 1px dashed #ccc; border-radius: 8px; font-size: 15px; background: #fafafa;">
                    <small style="color: #888; display: block; margin-top: 5px;">İzin verilen formatlar: PDF, Word, Excel, ZIP (Max: 10MB)</small>
                </div>

                <div style="text-align: center;">
                    <button type="submit" name="submit_materyal" style="background: #838C48; color: #fff; padding: 15px 40px; border: none; border-radius: 50px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 10px 20px rgba(131,140,72,0.3);">
                        Materyali Gönder
                    </button>
                </div>

            </form>
        <?php endif; ?>

    </div>
</div>

<script>
function toggleDiger(val) {
    var alani = document.getElementById('diger_konu_alani');
    if (val === '-1') {
        alani.style.display = 'block';
        alani.querySelector('input').setAttribute('required', 'required');
    } else {
        alani.style.display = 'none';
        alani.querySelector('input').removeAttribute('required');
    }
}
</script>

<?php get_footer(); ?>
