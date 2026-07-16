<?php
require_once( dirname( __FILE__ ) . '/wp-load.php' );

echo "<pre>";
echo "Materyaller sayfası kontrol ediliyor...\n";

// "Materyaller" adında sayfa var mı kontrol et
$page = get_page_by_title('Materyaller');
$page_id = 0;

if (!$page) {
    // Sayfa yoksa oluştur
    $page_id = wp_insert_post(array(
        'post_title'     => 'Materyaller',
        'post_name'      => 'materyaller', // slug
        'post_status'    => 'publish',
        'post_type'      => 'page',
    ));
    if (!is_wp_error($page_id)) {
        echo "BAŞARILI: 'Materyaller' sayfası oluşturuldu (ID: $page_id).\n";
    } else {
        echo "HATA: Sayfa oluşturulamadı.\n";
    }
} else {
    $page_id = $page->ID;
    echo "BİLGİ: 'Materyaller' sayfası zaten mevcut (ID: $page_id).\n";
}

// Şablonu ata
if ($page_id) {
    update_post_meta($page_id, '_wp_page_template', 'page-materyaller.php');
    echo "BAŞARILI: 'page-materyaller.php' şablonu sayfaya atandı.\n";
}

// Rewrite kurallarını sıfırla (Flush rewrite rules)
flush_rewrite_rules(true);
echo "BAŞARILI: Kalıcı bağlantılar (Permalinks) güncellendi.\n";

echo "\nİşlem tamam! Artık wp-admin > Sayfalar bölümünde 'Materyaller' sayfasını görebilir ve Menülere ekleyebilirsiniz.\n";
echo "</pre>";
