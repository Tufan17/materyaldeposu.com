<?php
require_once('../../../wp-load.php');

$pages_to_create = [
    'Hakkımızda' => <<<HTML
        <div style="display: flex; flex-wrap: wrap; gap: 30px; align-items: center;">
            <div style="flex: 1; min-width: 300px;">
                <h3 style="color: #333; margin-bottom: 20px;">Biz Kimiz?</h3>
                <p>Eğitimde dijitalleşmeyi ve pratik yöntemleri benimseyerek, geleceğin teknolojilerini sınıflara taşıyoruz. Amacımız, öğretmenlerin ve öğrencilerin daha verimli bir şekilde etkileşim kurabilmesini sağlamaktır.</p>
                <p>Müfredat analizinden başlayarak, her seviyedeki eğitim içeriklerini interaktif simülasyonlar ve materyaller ile destekliyoruz. Eğitimde yenilikçi yaklaşımların öncüsü olmaktan gurur duyuyoruz.</p>
            </div>
            <div style="flex: 1; min-width: 300px;">
                <img src="/material/wp-content/uploads/2023/11/lms-banner1.jpg" style="width: 100%; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);" alt="Hakkımızda">
            </div>
        </div>
        <div style="margin-top: 50px; text-align: center;">
            <h3 style="color: #333;">Vizyonumuz</h3>
            <p style="max-width: 800px; margin: 0 auto;">Öğrenme süreçlerini sadece kitaplardan çıkarıp, teknoloji ve insan etkileşiminin merkezine koyarak eğitimde global bir standart belirlemek.</p>
        </div>
HTML,
    'İletişim' => <<<HTML
        <div style="display: flex; flex-wrap: wrap; gap: 40px;">
            <div style="flex: 1; min-width: 300px; background: #f9f9f9; padding: 40px; border-radius: 8px;">
                <h3 style="margin-bottom: 20px;">İletişim Bilgilerimiz</h3>
                <p><strong>Adres:</strong><br>Eğitim Vadisi, Teknoloji Cad. No: 42<br>İstanbul, Türkiye</p>
                <p><strong>Telefon:</strong><br><a href="tel:+905551234567">+90 555 123 45 67</a></p>
                <p><strong>E-posta:</strong><br><a href="mailto:info@materyalhavuzu.com">info@materyalhavuzu.com</a></p>
                <div style="margin-top: 30px;">
                    <h4 style="margin-bottom: 15px;">Çalışma Saatlerimiz</h4>
                    <p>Pazartesi - Cuma: 09:00 - 18:00<br>Hafta sonu: Kapalı</p>
                </div>
            </div>
            <div style="flex: 1; min-width: 300px;">
                <h3 style="margin-bottom: 20px;">Bize Ulaşın</h3>
                <form action="#" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
                    <input type="text" placeholder="Adınız Soyadınız" required style="padding: 15px; border: 1px solid #ddd; border-radius: 4px; width: 100%;">
                    <input type="email" placeholder="E-posta Adresiniz" required style="padding: 15px; border: 1px solid #ddd; border-radius: 4px; width: 100%;">
                    <input type="text" placeholder="Konu" style="padding: 15px; border: 1px solid #ddd; border-radius: 4px; width: 100%;">
                    <textarea placeholder="Mesajınız..." rows="5" required style="padding: 15px; border: 1px solid #ddd; border-radius: 4px; width: 100%;"></textarea>
                    <button type="button" class="wdt-button wdt-button-style-default" style="padding: 15px 30px; border: none; cursor: pointer; align-self: flex-start;">Gönder</button>
                </form>
            </div>
        </div>
HTML
];

foreach ($pages_to_create as $title => $content) {
    $existing = get_page_by_title($title);
    if (!$existing) {
        wp_insert_post([
            'post_title'   => $title,
            'post_content' => $content,
            'post_status'  => 'publish',
            'post_type'    => 'page'
        ]);
        echo "Created: $title\n";
    } else {
        wp_update_post([
            'ID'           => $existing->ID,
            'post_content' => $content
        ]);
        echo "Updated: $title\n";
    }
}
?>
