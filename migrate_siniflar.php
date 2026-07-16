<?php
// WordPress core dosyasını dahil et
require_once( dirname( __FILE__ ) . '/wp-load.php' );

echo "<pre>";
echo "Sınıf Grupları ve Kademeleri Birleştirme (Migration) Başlıyor...\n\n";

$taxonomy = 'sinif_grubu';

// 1. Ana Kademeleri Oluştur
$kademeler = [
    'İlkokul' => ['1. Sınıf', '2. Sınıf', '3. Sınıf', '4. Sınıf'],
    'Ortaokul' => ['5. Sınıf', '6. Sınıf', '7. Sınıf', '8. Sınıf'],
    'Lise' => ['9. Sınıf', '10. Sınıf', '11. Sınıf', '12. Sınıf']
];

$kademe_ids = [];

foreach ($kademeler as $kademe_adi => $siniflar) {
    // Kademeyi bul veya oluştur
    $term = term_exists($kademe_adi, $taxonomy);
    
    if (!$term) {
        $term = wp_insert_term($kademe_adi, $taxonomy, array(
            'description' => $kademe_adi . ' kademesindeki tüm sınıflar',
            'slug' => sanitize_title($kademe_adi)
        ));
        
        if (is_wp_error($term)) {
            echo "HATA: $kademe_adi oluşturulamadı. (" . $term->get_error_message() . ")\n";
            continue;
        } else {
            echo "BAŞARILI: $kademe_adi ana kategorisi oluşturuldu.\n";
        }
    } else {
        echo "BİLGİ: $kademe_adi ana kategorisi zaten var.\n";
    }
    
    $kademe_ids[$kademe_adi] = $term['term_id'];
    
    // 2. Alt Sınıfları İlgili Kademeye Bağla
    foreach ($siniflar as $sinif_adi) {
        $sinif_term = term_exists($sinif_adi, $taxonomy);
        
        if (!$sinif_term) {
            // Sınıf yoksa oluştur ve parent ata
            $inserted = wp_insert_term($sinif_adi, $taxonomy, array(
                'parent' => $kademe_ids[$kademe_adi],
                'slug' => sanitize_title($sinif_adi)
            ));
            if (!is_wp_error($inserted)) {
                echo "  + EKLENDİ ve BAĞLANDI: $sinif_adi -> $kademe_adi altında.\n";
            }
        } else {
            // Sınıf varsa parent ID'sini güncelle
            wp_update_term($sinif_term['term_id'], $taxonomy, array(
                'parent' => $kademe_ids[$kademe_adi]
            ));
            echo "  ~ GÜNCELLENDİ (Birleştirildi): $sinif_adi artık $kademe_adi altında.\n";
        }
    }
}

echo "\nMigration (Birleştirme) işlemi tamamlandı! Artık admin panelindeki Sınıf Grupları menüsünde İlkokul > 1. Sınıf şeklinde düzenli göreceksiniz.\n";
echo "</pre>";
