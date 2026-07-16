<?php
require_once( dirname( __FILE__ ) . '/wp-load.php' );

echo "<pre>";
echo "İletişim sayfası kontrol ediliyor...\n";

// "İletişim" adında sayfa var mı kontrol et
$page = get_page_by_title('İletişim');
$page_id = 0;

if (!$page) {
    // Sayfa yoksa oluştur
    $page_id = wp_insert_post(array(
        'post_title'     => 'İletişim',
        'post_name'      => 'iletisim', // slug
        'post_status'    => 'publish',
        'post_type'      => 'page',
    ));
    if (!is_wp_error($page_id)) {
        echo "BAŞARILI: 'İletişim' sayfası oluşturuldu (ID: $page_id).\n";
    } else {
        echo "HATA: Sayfa oluşturulamadı.\n";
    }
} else {
    $page_id = $page->ID;
    echo "BİLGİ: 'İletişim' sayfası zaten mevcut (ID: $page_id).\n";
}

// Şablonu ata
if ($page_id) {
    update_post_meta($page_id, '_wp_page_template', 'page-iletisim.php');
    echo "BAŞARILI: 'page-iletisim.php' şablonu sayfaya atandı.\n";
}

echo "\nİşlem tamam! Artık wp-admin > Sayfalar bölümünde 'İletişim' sayfasını görebilir ve Menülere ekleyebilirsiniz.\n";
echo "</pre>";
