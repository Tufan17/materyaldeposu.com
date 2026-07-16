<?php
/**
 * Template Name: İletişim Sayfası
 * Description: İletişim sayfası için özel şablon — Premium Tasarım
 */
get_header();

// İletişim bilgileri (Customizer'dan çekilir)
$phone = get_theme_mod('iletisim_phone', '+90 (555) 123 45 67');
$email = get_theme_mod('iletisim_email', 'iletisim@siteadresi.com');
$address = get_theme_mod('iletisim_address', 'Eğitim Vadisi, Teknoloji Cad. No:1, İstanbul');
$map_iframe = get_theme_mod('iletisim_map_iframe', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d192697.79327595676!2d28.871754050228723!3d41.00549580879685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caa7040068086b%3A0xe1ccfe98bc01b0d0!2zxLBzdGFuYnVs!5e0!3m2!1str!2str!4v1689252390000!5m2!1str!2str');
?>

<div class="wdt-main-content-wrapper contact-page-wrapper">
    
    <!-- Hero Alanı -->
    <section class="contact-hero" style="position: relative; padding: 140px 20px 100px; background: linear-gradient(135deg, #0a110c 0%, #17421a 100%); color: #ffffff; text-align: center; overflow: hidden;">
        <!-- Dekoratif Arka Plan Elemanları -->
        <div style="position: absolute; top: -50%; left: -10%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(230,81,0,0.2) 0%, transparent 70%); border-radius: 50%;"></div>
        <div style="position: absolute; bottom: -30%; right: -5%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(201,169,78,0.2) 0%, transparent 70%); border-radius: 50%;"></div>
        
        <div class="container" style="max-width: 800px; margin: 0 auto; position: relative; z-index: 1;">
            <div style="display: inline-block; font-size: 15px; font-weight: 800; color: #ff9d2e; letter-spacing: 3px; text-transform: uppercase; margin-bottom: 25px; background: rgba(255,157,46,0.1); padding: 8px 20px; border-radius: 50px;">
                Bize Ulaşın
            </div>
            <h1 style="font-family: 'Playfair Display', serif; font-size: 56px; font-weight: 800; color: #ffffff; margin-bottom: 25px; line-height: 1.2; text-shadow: 0 4px 10px rgba(0,0,0,0.3);">
                İletişimde Kalalım
            </h1>
            <p style="font-family: 'Inter', sans-serif; font-size: 19px; color: rgba(255,255,255,0.9); line-height: 1.7; max-width: 650px; margin: 0 auto;">
                Sorularınız, önerileriniz veya iş birlikleri için bizimle iletişime geçmekten çekinmeyin. Size yardımcı olmaktan memnuniyet duyarız.
            </p>
        </div>
    </section>

    <div class="container" style="max-width: 1200px; margin: -50px auto 100px; position: relative; z-index: 10; padding: 0 20px;">
        
        <!-- İletişim Kartları -->
        <div class="contact-cards" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-bottom: 80px;">
            
            <!-- Kart 1: Adres -->
            <div class="contact-card" style="background: rgba(255,255,255,1); padding: 50px 30px; border-radius: 24px; text-align: center; box-shadow: 0 15px 35px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.04); transition: transform 0.3s ease;">
                <div style="width: 80px; height: 80px; margin: 0 auto 25px; background: linear-gradient(135deg, rgba(27,94,32,0.1), rgba(230,81,0,0.1)); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" fill="#1B5E20"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                </div>
                <h3 style="font-family: 'Raleway', sans-serif; font-size: 24px; font-weight: 700; color: #0F1A12; margin-bottom: 15px;">Adresimiz</h3>
                <p style="font-family: 'Inter', sans-serif; font-size: 16px; color: #555; line-height: 1.6;">
                    <?php echo esc_html($address); ?>
                </p>
            </div>

            <!-- Kart 2: Telefon -->
            <div class="contact-card" style="background: rgba(255,255,255,1); padding: 50px 30px; border-radius: 24px; text-align: center; box-shadow: 0 15px 35px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.04); transition: transform 0.3s ease; transform: translateY(-20px);">
                <div style="width: 80px; height: 80px; margin: 0 auto 25px; background: linear-gradient(135deg, rgba(230,81,0,0.1), rgba(201,169,78,0.1)); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" fill="#E65100"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                </div>
                <h3 style="font-family: 'Raleway', sans-serif; font-size: 24px; font-weight: 700; color: #0F1A12; margin-bottom: 15px;">Telefon</h3>
                <p style="font-family: 'Inter', sans-serif; font-size: 16px; color: #555; line-height: 1.6;">
                    <a href="tel:<?php echo esc_attr(str_replace([' ', '(', ')'], '', $phone)); ?>" style="color: #555; text-decoration: none; transition: color 0.3s;"><?php echo esc_html($phone); ?></a><br>
                    Pzt - Cum, 09:00 - 18:00
                </p>
            </div>

            <!-- Kart 3: Email -->
            <div class="contact-card" style="background: rgba(255,255,255,1); padding: 50px 30px; border-radius: 24px; text-align: center; box-shadow: 0 15px 35px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.04); transition: transform 0.3s ease;">
                <div style="width: 80px; height: 80px; margin: 0 auto 25px; background: linear-gradient(135deg, rgba(201,169,78,0.1), rgba(27,94,32,0.1)); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" fill="#C9A94E"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                </div>
                <h3 style="font-family: 'Raleway', sans-serif; font-size: 24px; font-weight: 700; color: #0F1A12; margin-bottom: 15px;">E-Posta</h3>
                <p style="font-family: 'Inter', sans-serif; font-size: 16px; color: #555; line-height: 1.6;">
                    <a href="mailto:<?php echo esc_attr($email); ?>" style="color: #555; text-decoration: none; transition: color 0.3s;"><?php echo esc_html($email); ?></a><br>
                    7/24 Bize yazabilirsiniz
                </p>
            </div>
        </div>

        <!-- İletişim Formu ve Harita Bölümü -->
        <div class="contact-content" style="display: flex; flex-wrap: wrap; gap: 40px; background: #fff; border-radius: 30px; overflow: hidden; box-shadow: 0 30px 60px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.03);">
            
            <!-- Sol: İletişim Formu -->
            <div class="contact-form-section" style="flex: 1 1 500px; padding: 60px 50px;">
                <h2 style="font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 800; color: #0F1A12; margin-bottom: 15px;">Bize Mesaj Gönderin</h2>
                <p style="font-family: 'Inter', sans-serif; font-size: 16px; color: #666; margin-bottom: 40px;">Formu doldurun, size en kısa sürede geri dönüş yapalım.</p>
                
                <form class="custom-contact-form" action="#" method="post">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div class="form-group">
                            <label style="display: block; font-size: 14px; font-weight: 600; color: #333; margin-bottom: 8px;">Adınız Soyadınız</label>
                            <input type="text" placeholder="Örn: Ahmet Yılmaz" style="width: 100%; padding: 15px 20px; border: 1px solid #e0e0e0; border-radius: 12px; font-family: 'Inter', sans-serif; font-size: 15px; background: #f9f9f9; transition: all 0.3s;">
                        </div>
                        <div class="form-group">
                            <label style="display: block; font-size: 14px; font-weight: 600; color: #333; margin-bottom: 8px;">E-Posta Adresiniz</label>
                            <input type="email" placeholder="ornek@email.com" style="width: 100%; padding: 15px 20px; border: 1px solid #e0e0e0; border-radius: 12px; font-family: 'Inter', sans-serif; font-size: 15px; background: #f9f9f9; transition: all 0.3s;">
                        </div>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #333; margin-bottom: 8px;">Konu</label>
                        <input type="text" placeholder="Mesajınızın konusu nedir?" style="width: 100%; padding: 15px 20px; border: 1px solid #e0e0e0; border-radius: 12px; font-family: 'Inter', sans-serif; font-size: 15px; background: #f9f9f9; transition: all 0.3s;">
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 30px;">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #333; margin-bottom: 8px;">Mesajınız</label>
                        <textarea rows="5" placeholder="Size nasıl yardımcı olabiliriz?" style="width: 100%; padding: 15px 20px; border: 1px solid #e0e0e0; border-radius: 12px; font-family: 'Inter', sans-serif; font-size: 15px; background: #f9f9f9; transition: all 0.3s; resize: vertical;"></textarea>
                    </div>
                    
                    <button type="submit" style="display: inline-block; width: 100%; padding: 18px 30px; background: linear-gradient(135deg, #1B5E20, #2E7D32); color: #fff; font-family: 'Inter', sans-serif; font-size: 16px; font-weight: 700; border: none; border-radius: 12px; cursor: pointer; transition: transform 0.3s, box-shadow 0.3s; box-shadow: 0 10px 20px rgba(27,94,32,0.2);">
                        Mesajı Gönder
                    </button>
                </form>
            </div>

            <!-- Sağ: Harita (Google Maps Iframe) -->
            <div class="contact-map-section" style="flex: 1 1 400px; min-height: 400px; background: #f0f0f0; position: relative;">
                <iframe src="<?php echo esc_url($map_iframe); ?>" 
                    width="100%" height="100%" style="border:0; position: absolute; top:0; left:0; width:100%; height:100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

    </div>
</div>

<style>
    /* Hover Effects for Contact Page */
    .contact-card:hover {
        transform: translateY(-10px) !important;
        box-shadow: 0 30px 60px rgba(0,0,0,0.1) !important;
        border-color: rgba(230,81,0,0.2) !important;
    }
    .contact-card a:hover {
        color: #E65100 !important;
    }
    .custom-contact-form input:focus, .custom-contact-form textarea:focus {
        outline: none;
        border-color: #1B5E20 !important;
        background: #fff !important;
        box-shadow: 0 0 0 4px rgba(27,94,32,0.1);
    }
    .custom-contact-form button:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(27,94,32,0.3) !important;
    }
    
    @media (max-width: 991px) {
        .contact-card { transform: translateY(0) !important; }
        .contact-content { flex-direction: column; }
        .contact-map-section { min-height: 350px; }
        .contact-form-section { padding: 40px 30px; }
    }
</style>

<?php get_footer(); ?>
