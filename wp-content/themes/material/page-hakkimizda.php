<?php
/**
 * Template Name: Hakkımızda Sayfası
 * Description: Hakkımızda sayfası için özel şablon — Premium Tasarım
 */
get_header();

// Customizer'dan değerleri al
$hero_title = get_theme_mod('hakkimizda_hero_title', 'Hakkımızda');
$hero_subtitle = get_theme_mod('hakkimizda_hero_subtitle', 'Eğitimde kaliteyi ve yenilikçiliği bir araya getiriyoruz.');
$hero_bg_image = get_theme_mod('hakkimizda_hero_bg', get_template_directory_uri() . '/wp-content/uploads/2023/11/lms-banner1.jpg');

$about_title = get_theme_mod('hakkimizda_about_title', 'Biz Kimiz?');
$about_text = get_theme_mod('hakkimizda_about_text', 'Müfredat Materyal Havuzu olarak, eğitimcilere ve öğrencilere en kaliteli kaynakları sunmayı amaçlıyoruz. Deneyimli ekibimiz, modern eğitim anlayışıyla hazırlanmış materyalleri sizlere ulaştırmak için çalışmaktadır. Her geçen gün büyüyen arşivimizle, eğitimin her alanında ihtiyaç duyulan kaynaklara kolayca erişim sağlıyoruz.');
$about_image = get_theme_mod('hakkimizda_about_image', get_template_directory_uri() . '/wp-content/uploads/2023/11/lms-banner2.jpg');

$mission_title = get_theme_mod('hakkimizda_mission_title', 'Misyonumuz');
$mission_text = get_theme_mod('hakkimizda_mission_text', 'Eğitimcilere ve öğrencilere dünya standartlarında, güncel ve erişilebilir materyal kaynakları sunarak eğitim kalitesini artırmak.');

$vision_title = get_theme_mod('hakkimizda_vision_title', 'Vizyonumuz');
$vision_text = get_theme_mod('hakkimizda_vision_text', 'Türkiye\'nin en kapsamlı ve yenilikçi eğitim materyalleri platformu olmak, her öğretmenin ve öğrencinin ilk tercih ettiği kaynak merkezi haline gelmek.');

$values_title = get_theme_mod('hakkimizda_values_title', 'Değerlerimiz');
$values_text = get_theme_mod('hakkimizda_values_text', 'Kalite, yenilikçilik, erişilebilirlik ve sürekli gelişim ilkelerimizle eğitim dünyasına katkıda bulunmak en önemli değerimizdir.');

// İstatistikler
$stat1_number = get_theme_mod('hakkimizda_stat1_number', '500+');
$stat1_label = get_theme_mod('hakkimizda_stat1_label', 'Materyal');
$stat2_number = get_theme_mod('hakkimizda_stat2_number', '1200+');
$stat2_label = get_theme_mod('hakkimizda_stat2_label', 'Kullanıcı');
$stat3_number = get_theme_mod('hakkimizda_stat3_number', '50+');
$stat3_label = get_theme_mod('hakkimizda_stat3_label', 'Eğitimci');
$stat4_number = get_theme_mod('hakkimizda_stat4_number', '30+');
$stat4_label = get_theme_mod('hakkimizda_stat4_label', 'Ders Alanı');

// Ekip üyeleri
$team1_name = get_theme_mod('hakkimizda_team1_name', '');
$team1_title = get_theme_mod('hakkimizda_team1_title', '');
$team1_image = get_theme_mod('hakkimizda_team1_image', '');

$team2_name = get_theme_mod('hakkimizda_team2_name', '');
$team2_title = get_theme_mod('hakkimizda_team2_title', '');
$team2_image = get_theme_mod('hakkimizda_team2_image', '');

$team3_name = get_theme_mod('hakkimizda_team3_name', '');
$team3_title = get_theme_mod('hakkimizda_team3_title', '');
$team3_image = get_theme_mod('hakkimizda_team3_image', '');

// Kilometre taşları
$milestone1_year = get_theme_mod('hakkimizda_milestone1_year', '2020');
$milestone1_text = get_theme_mod('hakkimizda_milestone1_text', 'Projemiz ilk temellerini attı ve eğitim materyalleri dijitalleştirilmeye başlandı.');
$milestone2_year = get_theme_mod('hakkimizda_milestone2_year', '2022');
$milestone2_text = get_theme_mod('hakkimizda_milestone2_text', 'Platform genişleyerek binlerce öğretmen ve öğrenciye ulaştı.');
$milestone3_year = get_theme_mod('hakkimizda_milestone3_year', '2024');
$milestone3_text = get_theme_mod('hakkimizda_milestone3_text', 'Yapay zeka destekli öneri sistemi ve gelişmiş arama altyapısı devreye alındı.');

// CTA (Eylem Çağrısı)
$cta_title = get_theme_mod('hakkimizda_cta_title', 'Hemen Başlayın');
$cta_text = get_theme_mod('hakkimizda_cta_text', 'Binlerce materyale erişim sağlayın ve eğitim deneyiminizi üst seviyeye taşıyın.');
$cta_button_text = get_theme_mod('hakkimizda_cta_button_text', 'Materyalleri Keşfet');
$cta_button_url = get_theme_mod('hakkimizda_cta_button_url', home_url('/materyaller/'));
?>

<style>
/* ===== HAKKIMIZDA — PREMIUM TASARIM ===== */
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap');

:root {
    --hk-primary: #838C48;
    --hk-primary-rgb: 131, 140, 72;
    --hk-secondary: #DA853D;
    --hk-secondary-rgb: 218, 133, 61;
    --hk-dark: #1a1a2e;
    --hk-dark-soft: #303030;
    --hk-cream: #fdf6ea;
    --hk-cream-dark: #F5E9D4;
    --hk-text: #555;
    --hk-text-light: #888;
    --hk-white: #ffffff;
    --hk-glass: rgba(255, 255, 255, 0.08);
    --hk-glass-border: rgba(255, 255, 255, 0.12);
    --hk-radius: 24px;
    --hk-radius-sm: 16px;
    --hk-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
    --hk-shadow-hover: 0 30px 80px rgba(0, 0, 0, 0.12);
}

/* ——— HERO ——— */
.hk-hero {
    position: relative;
    min-height: 520px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    overflow: hidden;
    background: linear-gradient(160deg, rgba(26, 26, 46, 0.92) 0%, rgba(var(--hk-primary-rgb), 0.7) 50%, rgba(var(--hk-secondary-rgb), 0.6) 100%),
                url('<?php echo esc_url($hero_bg_image); ?>') center/cover no-repeat;
    background-attachment: fixed;
}

.hk-hero-particles {
    position: absolute;
    inset: 0;
    pointer-events: none;
    overflow: hidden;
}

.hk-particle {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.06);
    animation: hkFloat linear infinite;
}

@keyframes hkFloat {
    0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 1; }
    100% { transform: translateY(-20vh) rotate(720deg); opacity: 0; }
}

.hk-hero-content {
    position: relative;
    z-index: 3;
    padding: 80px 24px;
    max-width: 860px;
}

.hk-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 20px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 50px;
    font-family: 'Inter', sans-serif;
    font-size: 0.8rem;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.9);
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 30px;
}

.hk-hero-badge-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--hk-secondary);
    animation: hkPulse 2s ease-in-out infinite;
}

@keyframes hkPulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(1.4); }
}

.hk-hero h1 {
    font-family: 'Playfair Display', serif;
    font-size: 4rem;
    font-weight: 800;
    color: var(--hk-white);
    margin-bottom: 24px;
    letter-spacing: -1px;
    line-height: 1.15;
    text-shadow: 0 4px 30px rgba(0,0,0,0.3);
}

.hk-hero h1 span {
    background: linear-gradient(135deg, var(--hk-secondary), #f0c27f);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hk-hero p {
    font-family: 'Inter', sans-serif;
    font-size: 1.15rem;
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.9;
    max-width: 620px;
    margin: 0 auto;
    font-weight: 300;
}

.hk-hero-wave {
    position: absolute;
    bottom: -2px;
    left: 0;
    right: 0;
    z-index: 2;
}

.hk-hero-wave svg {
    display: block;
    width: 100%;
    height: 80px;
}

/* ——— GENEL ——— */
.hk-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 30px;
}

.hk-section-label {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-family: 'Inter', sans-serif;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--hk-primary);
    margin-bottom: 16px;
}

.hk-section-label::before {
    content: '';
    width: 30px;
    height: 2px;
    background: linear-gradient(90deg, var(--hk-primary), var(--hk-secondary));
    border-radius: 1px;
}

.hk-section-title {
    font-family: 'Playfair Display', serif;
    font-size: 2.8rem;
    font-weight: 700;
    color: var(--hk-dark-soft);
    line-height: 1.2;
    margin-bottom: 20px;
    letter-spacing: -0.5px;
}

.hk-section-desc {
    font-family: 'Inter', sans-serif;
    font-size: 1.05rem;
    line-height: 1.85;
    color: var(--hk-text);
    font-weight: 400;
}

/* ——— BİZ KİMİZ ——— */
.hk-about {
    padding: 100px 0 80px;
    background: var(--hk-cream);
    position: relative;
}

.hk-about-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
}

.hk-about-visual {
    position: relative;
}

.hk-about-image-wrap {
    position: relative;
    border-radius: var(--hk-radius);
    overflow: hidden;
    box-shadow: var(--hk-shadow);
}

.hk-about-image-wrap::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 50%, rgba(26, 26, 46, 0.4) 100%);
    z-index: 1;
    pointer-events: none;
}

.hk-about-image-wrap img {
    width: 100%;
    height: 480px;
    object-fit: cover;
    display: block;
    transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

.hk-about-image-wrap:hover img {
    transform: scale(1.06);
}

.hk-about-float-card {
    position: absolute;
    bottom: -30px;
    right: -30px;
    background: var(--hk-white);
    border-radius: var(--hk-radius-sm);
    padding: 24px 30px;
    box-shadow: 0 15px 50px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    gap: 16px;
    z-index: 5;
    border: 1px solid rgba(var(--hk-primary-rgb), 0.1);
}

.hk-about-float-icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    background: linear-gradient(135deg, var(--hk-primary), var(--hk-secondary));
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.hk-about-float-icon svg {
    width: 24px;
    height: 24px;
    fill: var(--hk-white);
}

.hk-about-float-text strong {
    display: block;
    font-family: 'Inter', sans-serif;
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--hk-dark-soft);
    line-height: 1;
}

.hk-about-float-text span {
    font-family: 'Inter', sans-serif;
    font-size: 0.8rem;
    color: var(--hk-text-light);
    font-weight: 500;
}

.hk-about-decor {
    position: absolute;
    top: -20px;
    left: -20px;
    width: 120px;
    height: 120px;
    border: 3px solid rgba(var(--hk-primary-rgb), 0.12);
    border-radius: var(--hk-radius);
    z-index: -1;
}

.hk-about-text-area {
    padding-right: 20px;
}

.hk-about-text-area .hk-section-desc {
    margin-top: 10px;
}

.hk-about-features {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-top: 35px;
}

.hk-about-feature {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 16px;
    background: var(--hk-white);
    border-radius: 14px;
    border: 1px solid rgba(var(--hk-primary-rgb), 0.06);
    transition: all 0.3s ease;
}

.hk-about-feature:hover {
    box-shadow: 0 8px 25px rgba(var(--hk-primary-rgb), 0.08);
    transform: translateY(-2px);
}

.hk-about-feature-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(135deg, rgba(var(--hk-primary-rgb), 0.1), rgba(var(--hk-secondary-rgb), 0.1));
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.hk-about-feature-icon svg {
    width: 20px;
    height: 20px;
    fill: var(--hk-primary);
}

.hk-about-feature span {
    font-family: 'Inter', sans-serif;
    font-size: 0.88rem;
    font-weight: 600;
    color: var(--hk-dark-soft);
    line-height: 1.4;
}

/* ——— MİSYON / VİZYON / DEĞERLER ——— */
.hk-mvv {
    padding: 100px 0;
    background: linear-gradient(180deg, var(--hk-cream) 0%, var(--hk-cream-dark) 100%);
    position: relative;
    overflow: hidden;
}

.hk-mvv::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 800px;
    height: 800px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(var(--hk-primary-rgb), 0.04) 0%, transparent 70%);
    pointer-events: none;
}

.hk-mvv-header {
    text-align: center;
    margin-bottom: 65px;
}

.hk-mvv-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.hk-mvv-card {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(var(--hk-primary-rgb), 0.08);
    border-radius: var(--hk-radius);
    padding: 50px 36px 45px;
    text-align: center;
    position: relative;
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.hk-mvv-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, var(--hk-primary), var(--hk-secondary));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.hk-mvv-card::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    top: 0;
    background: linear-gradient(180deg, transparent 60%, rgba(var(--hk-primary-rgb), 0.02) 100%);
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.5s ease;
}

.hk-mvv-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--hk-shadow-hover);
    background: rgba(255, 255, 255, 0.95);
}

.hk-mvv-card:hover::before {
    transform: scaleX(1);
}

.hk-mvv-card:hover::after {
    opacity: 1;
}

.hk-mvv-icon {
    width: 90px;
    height: 90px;
    margin: 0 auto 28px;
    border-radius: 28px;
    background: linear-gradient(135deg, rgba(var(--hk-primary-rgb), 0.08), rgba(var(--hk-secondary-rgb), 0.08));
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.5s ease;
    position: relative;
}

.hk-mvv-icon::before {
    content: '';
    position: absolute;
    inset: -4px;
    border-radius: 32px;
    border: 2px dashed rgba(var(--hk-primary-rgb), 0.1);
    transition: all 0.5s ease;
}

.hk-mvv-card:hover .hk-mvv-icon {
    background: linear-gradient(135deg, var(--hk-primary), var(--hk-secondary));
    transform: scale(1.08) rotate(5deg);
}

.hk-mvv-card:hover .hk-mvv-icon::before {
    border-color: transparent;
    transform: rotate(-10deg);
}

.hk-mvv-icon svg {
    width: 38px;
    height: 38px;
    fill: var(--hk-primary);
    transition: fill 0.5s ease;
}

.hk-mvv-card:hover .hk-mvv-icon svg {
    fill: var(--hk-white);
}

.hk-mvv-card h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--hk-dark-soft);
    margin-bottom: 14px;
}

.hk-mvv-card p {
    font-family: 'Inter', sans-serif;
    font-size: 0.92rem;
    line-height: 1.85;
    color: var(--hk-text);
    font-weight: 400;
}

/* ——— İSTATİSTİKLER ——— */
.hk-stats {
    padding: 100px 0;
    background: linear-gradient(160deg, var(--hk-dark) 0%, #16213e 50%, #0f3460 100%);
    position: relative;
    overflow: hidden;
}

.hk-stats-mesh {
    position: absolute;
    inset: 0;
    background: 
        radial-gradient(ellipse at 20% 50%, rgba(var(--hk-primary-rgb), 0.08) 0%, transparent 50%),
        radial-gradient(ellipse at 80% 20%, rgba(var(--hk-secondary-rgb), 0.06) 0%, transparent 50%),
        radial-gradient(ellipse at 60% 80%, rgba(100, 150, 255, 0.04) 0%, transparent 50%);
    pointer-events: none;
}

.hk-stats-header {
    text-align: center;
    margin-bottom: 65px;
    position: relative;
    z-index: 2;
}

.hk-stats-header .hk-section-label {
    color: rgba(255, 255, 255, 0.5);
}

.hk-stats-header .hk-section-label::before {
    background: linear-gradient(90deg, rgba(var(--hk-primary-rgb), 0.5), rgba(var(--hk-secondary-rgb), 0.5));
}

.hk-stats-header .hk-section-title {
    color: var(--hk-white);
}

.hk-stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
    position: relative;
    z-index: 2;
}

.hk-stat-card {
    text-align: center;
    padding: 45px 24px;
    border-radius: var(--hk-radius-sm);
    background: var(--hk-glass);
    border: 1px solid var(--hk-glass-border);
    backdrop-filter: blur(20px);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.hk-stat-card::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--hk-primary), var(--hk-secondary));
    opacity: 0;
    transition: opacity 0.4s ease;
}

.hk-stat-card:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(var(--hk-primary-rgb), 0.3);
    transform: translateY(-8px);
}

.hk-stat-card:hover::before {
    opacity: 1;
}

.hk-stat-icon {
    width: 56px;
    height: 56px;
    margin: 0 auto 20px;
    border-radius: 16px;
    background: linear-gradient(135deg, rgba(var(--hk-primary-rgb), 0.15), rgba(var(--hk-secondary-rgb), 0.15));
    display: flex;
    align-items: center;
    justify-content: center;
}

.hk-stat-icon svg {
    width: 26px;
    height: 26px;
    fill: var(--hk-secondary);
}

.hk-stat-number {
    font-family: 'Inter', sans-serif;
    font-size: 3.2rem;
    font-weight: 800;
    background: linear-gradient(135deg, #a0aa5c, var(--hk-secondary), #f0c27f);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 8px;
    line-height: 1.2;
}

.hk-stat-label {
    font-family: 'Inter', sans-serif;
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.55);
    text-transform: uppercase;
    letter-spacing: 2.5px;
    font-weight: 600;
}

/* ——— KİLOMETRE TAŞLARI (TİMELİNE) ——— */
.hk-timeline {
    padding: 100px 0;
    background: var(--hk-cream);
    position: relative;
    overflow: hidden;
}

.hk-timeline-header {
    text-align: center;
    margin-bottom: 70px;
}

.hk-timeline-track {
    position: relative;
    max-width: 800px;
    margin: 0 auto;
}

.hk-timeline-track::before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    width: 3px;
    background: linear-gradient(180deg, var(--hk-primary), var(--hk-secondary));
    transform: translateX(-50%);
    border-radius: 2px;
}

.hk-timeline-item {
    position: relative;
    padding: 0 0 60px;
    display: grid;
    grid-template-columns: 1fr 60px 1fr;
    align-items: start;
}

.hk-timeline-item:last-child {
    padding-bottom: 0;
}

.hk-timeline-content {
    background: var(--hk-white);
    border-radius: var(--hk-radius-sm);
    padding: 30px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.05);
    border: 1px solid rgba(var(--hk-primary-rgb), 0.06);
    transition: all 0.4s ease;
}

.hk-timeline-content:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 50px rgba(var(--hk-primary-rgb), 0.1);
}

.hk-timeline-item:nth-child(odd) .hk-timeline-content {
    grid-column: 1;
    text-align: right;
}

.hk-timeline-item:nth-child(odd) .hk-timeline-dot {
    grid-column: 2;
}

.hk-timeline-item:nth-child(odd) .hk-timeline-spacer {
    grid-column: 3;
}

.hk-timeline-item:nth-child(even) .hk-timeline-spacer {
    grid-column: 1;
}

.hk-timeline-item:nth-child(even) .hk-timeline-dot {
    grid-column: 2;
}

.hk-timeline-item:nth-child(even) .hk-timeline-content {
    grid-column: 3;
    text-align: left;
}

.hk-timeline-dot {
    display: flex;
    justify-content: center;
    padding-top: 25px;
}

.hk-timeline-dot-inner {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--hk-primary), var(--hk-secondary));
    border: 4px solid var(--hk-cream);
    box-shadow: 0 0 0 3px rgba(var(--hk-primary-rgb), 0.2);
    z-index: 2;
}

.hk-timeline-year {
    font-family: 'Playfair Display', serif;
    font-size: 1.6rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--hk-primary), var(--hk-secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 8px;
}

.hk-timeline-text {
    font-family: 'Inter', sans-serif;
    font-size: 0.92rem;
    line-height: 1.75;
    color: var(--hk-text);
    font-weight: 400;
}

/* ——— EKİP ——— */
.hk-team {
    padding: 100px 0;
    background: linear-gradient(180deg, var(--hk-cream) 0%, var(--hk-cream-dark) 100%);
}

.hk-team-header {
    text-align: center;
    margin-bottom: 65px;
}

.hk-team-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 36px;
}

.hk-team-card {
    text-align: center;
    background: var(--hk-white);
    border-radius: var(--hk-radius);
    padding: 48px 30px 40px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.04);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(var(--hk-primary-rgb), 0.05);
    position: relative;
    overflow: hidden;
}

.hk-team-card::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 20%;
    right: 20%;
    height: 3px;
    background: linear-gradient(90deg, var(--hk-primary), var(--hk-secondary));
    border-radius: 2px 2px 0 0;
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.hk-team-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 60px rgba(var(--hk-primary-rgb), 0.1);
}

.hk-team-card:hover::after {
    transform: scaleX(1);
}

.hk-team-avatar {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    margin: 0 auto 24px;
    overflow: hidden;
    border: 5px solid var(--hk-cream-dark);
    box-shadow: 0 10px 30px rgba(var(--hk-primary-rgb), 0.1);
    transition: all 0.5s ease;
    position: relative;
}

.hk-team-card:hover .hk-team-avatar {
    border-color: var(--hk-primary);
    transform: scale(1.05);
}

.hk-team-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hk-team-avatar-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--hk-primary), var(--hk-secondary));
    display: flex;
    align-items: center;
    justify-content: center;
}

.hk-team-avatar-placeholder svg {
    width: 48px;
    height: 48px;
    fill: var(--hk-white);
    opacity: 0.8;
}

.hk-team-card h4 {
    font-family: 'Playfair Display', serif;
    font-size: 1.35rem;
    font-weight: 700;
    color: var(--hk-dark-soft);
    margin-bottom: 6px;
}

.hk-team-card .hk-team-role {
    font-family: 'Inter', sans-serif;
    font-size: 0.85rem;
    color: var(--hk-primary);
    font-weight: 600;
    letter-spacing: 0.5px;
}

/* ——— CTA ——— */
.hk-cta {
    padding: 100px 0;
    background: linear-gradient(160deg, var(--hk-dark) 0%, #16213e 50%, #0f3460 100%);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.hk-cta-glow {
    position: absolute;
    width: 500px;
    height: 500px;
    border-radius: 50%;
    filter: blur(120px);
    pointer-events: none;
}

.hk-cta-glow-1 {
    top: -200px;
    left: -100px;
    background: rgba(var(--hk-primary-rgb), 0.12);
}

.hk-cta-glow-2 {
    bottom: -200px;
    right: -100px;
    background: rgba(var(--hk-secondary-rgb), 0.1);
}

.hk-cta-content {
    position: relative;
    z-index: 2;
}

.hk-cta h2 {
    font-family: 'Playfair Display', serif;
    font-size: 3rem;
    font-weight: 700;
    color: var(--hk-white);
    margin-bottom: 20px;
    line-height: 1.2;
}

.hk-cta p {
    font-family: 'Inter', sans-serif;
    font-size: 1.1rem;
    color: rgba(255,255,255,0.7);
    max-width: 560px;
    margin: 0 auto 40px;
    line-height: 1.85;
    font-weight: 300;
}

.hk-cta-button {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 18px 48px;
    background: linear-gradient(135deg, var(--hk-primary), var(--hk-secondary));
    color: var(--hk-white);
    font-family: 'Inter', sans-serif;
    font-size: 1rem;
    font-weight: 700;
    text-decoration: none;
    border-radius: 60px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 30px rgba(var(--hk-primary-rgb), 0.3);
    letter-spacing: 0.5px;
    position: relative;
    overflow: hidden;
}

.hk-cta-button::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, var(--hk-secondary), var(--hk-primary));
    border-radius: inherit;
    opacity: 0;
    transition: opacity 0.4s ease;
}

.hk-cta-button:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 50px rgba(var(--hk-primary-rgb), 0.4);
    color: var(--hk-white);
}

.hk-cta-button:hover::before {
    opacity: 1;
}

.hk-cta-button span,
.hk-cta-button svg {
    position: relative;
    z-index: 1;
}

.hk-cta-button svg {
    width: 20px;
    height: 20px;
    fill: currentColor;
    transition: transform 0.3s ease;
}

.hk-cta-button:hover svg {
    transform: translateX(4px);
}

/* ——— ANİMASYONLAR ——— */
@keyframes hkRevealUp {
    from { opacity: 0; transform: translateY(50px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes hkRevealScale {
    from { opacity: 0; transform: scale(0.9) translateY(30px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}

.hk-reveal {
    opacity: 0;
    transform: translateY(50px);
}

.hk-reveal.hk-visible {
    animation: hkRevealUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

.hk-reveal-scale {
    opacity: 0;
    transform: scale(0.9) translateY(30px);
}

.hk-reveal-scale.hk-visible {
    animation: hkRevealScale 0.7s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

.hk-delay-1 { animation-delay: 0.1s !important; }
.hk-delay-2 { animation-delay: 0.2s !important; }
.hk-delay-3 { animation-delay: 0.3s !important; }
.hk-delay-4 { animation-delay: 0.4s !important; }
.hk-delay-5 { animation-delay: 0.5s !important; }

/* ——— RESPONSIVE ——— */
@media (max-width: 1024px) {
    .hk-about-grid {
        grid-template-columns: 1fr;
        gap: 50px;
    }
    .hk-about-float-card {
        right: 20px;
        bottom: -20px;
    }
    .hk-mvv-grid {
        grid-template-columns: 1fr;
        gap: 24px;
        max-width: 500px;
        margin: 0 auto;
    }
    .hk-stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .hk-team-grid {
        grid-template-columns: 1fr;
        max-width: 400px;
        margin: 0 auto;
    }
    .hk-timeline-track::before { left: 30px; }
    .hk-timeline-item {
        grid-template-columns: 60px 1fr;
    }
    .hk-timeline-item:nth-child(odd) .hk-timeline-content,
    .hk-timeline-item:nth-child(even) .hk-timeline-content {
        grid-column: 2;
        text-align: left;
    }
    .hk-timeline-item:nth-child(odd) .hk-timeline-dot,
    .hk-timeline-item:nth-child(even) .hk-timeline-dot {
        grid-column: 1;
    }
    .hk-timeline-item:nth-child(odd) .hk-timeline-spacer,
    .hk-timeline-item:nth-child(even) .hk-timeline-spacer {
        display: none;
    }
}

@media (max-width: 600px) {
    .hk-hero h1 { font-size: 2.4rem; }
    .hk-hero { min-height: 400px; }
    .hk-section-title { font-size: 2rem; }
    .hk-stats-grid { grid-template-columns: 1fr 1fr; gap: 16px; }
    .hk-stat-number { font-size: 2.4rem; }
    .hk-about-features { grid-template-columns: 1fr; }
    .hk-about-float-card { position: relative; right: 0; bottom: 0; margin-top: 20px; }
    .hk-cta h2 { font-size: 2rem; }
}
</style>

<!-- ** Main ** -->
<div id="main">

    <!-- ======= HERO ======= -->
    <section class="hk-hero" id="hk-hero">
        <div class="hk-hero-particles" id="hk-particles"></div>
        <div class="hk-hero-content">
            <div class="hk-hero-badge hk-reveal">
                <span class="hk-hero-badge-dot"></span>
                Müfredat Materyal Havuzu
            </div>
            <h1 class="hk-reveal hk-delay-1"><?php echo esc_html($hero_title); ?></h1>
            <p class="hk-reveal hk-delay-2"><?php echo esc_html($hero_subtitle); ?></p>
        </div>
        <div class="hk-hero-wave">
            <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0 40C240 80 480 0 720 40C960 80 1200 0 1440 40V80H0V40Z" fill="var(--hk-cream)"/>
            </svg>
        </div>
    </section>

    <!-- ======= BİZ KİMİZ ======= -->
    <section class="hk-about" id="hk-about">
        <div class="hk-container">
            <div class="hk-about-grid">
                <div class="hk-about-visual hk-reveal">
                    <div class="hk-about-decor"></div>
                    <div class="hk-about-image-wrap">
                        <img src="<?php echo esc_url($about_image); ?>" alt="<?php echo esc_attr($about_title); ?>" />
                    </div>
                    <div class="hk-about-float-card hk-reveal-scale hk-delay-3">
                        <div class="hk-about-float-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        </div>
                        <div class="hk-about-float-text">
                            <strong><?php echo esc_html($stat1_number); ?></strong>
                            <span><?php echo esc_html($stat1_label); ?></span>
                        </div>
                    </div>
                </div>
                <div class="hk-about-text-area">
                    <div class="hk-section-label hk-reveal">Hakkımızda</div>
                    <h2 class="hk-section-title hk-reveal hk-delay-1"><?php echo esc_html($about_title); ?></h2>
                    <p class="hk-section-desc hk-reveal hk-delay-2"><?php echo wp_kses_post($about_text); ?></p>
                    <div class="hk-about-features hk-reveal hk-delay-3">
                        <div class="hk-about-feature">
                            <div class="hk-about-feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                            </div>
                            <span>Uzman Kadro</span>
                        </div>
                        <div class="hk-about-feature">
                            <div class="hk-about-feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21 5c-1.11-.35-2.33-.5-3.5-.5-1.95 0-4.05.4-5.5 1.5-1.45-1.1-3.55-1.5-5.5-1.5S2.45 4.9 1 6v14.65c0 .25.25.5.5.5.1 0 .15-.05.25-.05C3.1 20.45 5.05 20 6.5 20c1.95 0 4.05.4 5.5 1.5 1.35-.85 3.8-1.5 5.5-1.5 1.65 0 3.35.3 4.75 1.05.1.05.15.05.25.05.25 0 .5-.25.5-.5V6c-.6-.45-1.25-.75-2-1zm0 13.5c-1.1-.35-2.3-.5-3.5-.5-1.7 0-4.15.65-5.5 1.5V8c1.35-.85 3.8-1.5 5.5-1.5 1.2 0 2.4.15 3.5.5v11.5z"/></svg>
                            </div>
                            <span>Zengin İçerik</span>
                        </div>
                        <div class="hk-about-feature">
                            <div class="hk-about-feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                            </div>
                            <span>Geniş Topluluk</span>
                        </div>
                        <div class="hk-about-feature">
                            <div class="hk-about-feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM19 18H6c-2.21 0-4-1.79-4-4s1.82-4 4.03-4h.27C7.2 7.97 9.39 6 12 6c3.03 0 5.5 2.47 5.5 5.5v.5H19c1.66 0 3 1.34 3 3s-1.34 3-3 3z"/></svg>
                            </div>
                            <span>Kolay Erişim</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======= MİSYON / VİZYON / DEĞERLER ======= -->
    <section class="hk-mvv" id="hk-mvv">
        <div class="hk-container">
            <div class="hk-mvv-header">
                <div class="hk-section-label hk-reveal">Neden Biz?</div>
                <h2 class="hk-section-title hk-reveal hk-delay-1">Temel İlkelerimiz</h2>
            </div>
            <div class="hk-mvv-grid">
                <div class="hk-mvv-card hk-reveal-scale hk-delay-1">
                    <div class="hk-mvv-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/></svg>
                    </div>
                    <h3><?php echo esc_html($mission_title); ?></h3>
                    <p><?php echo wp_kses_post($mission_text); ?></p>
                </div>
                <div class="hk-mvv-card hk-reveal-scale hk-delay-2">
                    <div class="hk-mvv-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                    </div>
                    <h3><?php echo esc_html($vision_title); ?></h3>
                    <p><?php echo wp_kses_post($vision_text); ?></p>
                </div>
                <div class="hk-mvv-card hk-reveal-scale hk-delay-3">
                    <div class="hk-mvv-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    </div>
                    <h3><?php echo esc_html($values_title); ?></h3>
                    <p><?php echo wp_kses_post($values_text); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- ======= İSTATİSTİKLER ======= -->
    <section class="hk-stats" id="hk-stats">
        <div class="hk-stats-mesh"></div>
        <div class="hk-container">
            <div class="hk-stats-header">
                <div class="hk-section-label hk-reveal">Rakamlarla Biz</div>
                <h2 class="hk-section-title hk-reveal hk-delay-1">Büyüyen Topluluğumuz</h2>
            </div>
            <div class="hk-stats-grid">
                <?php
                $stats = [
                    ['number' => $stat1_number, 'label' => $stat1_label, 'icon' => '<path d="M21 5c-1.11-.35-2.33-.5-3.5-.5-1.95 0-4.05.4-5.5 1.5-1.45-1.1-3.55-1.5-5.5-1.5S2.45 4.9 1 6v14.65c0 .25.25.5.5.5.1 0 .15-.05.25-.05C3.1 20.45 5.05 20 6.5 20c1.95 0 4.05.4 5.5 1.5 1.35-.85 3.8-1.5 5.5-1.5 1.65 0 3.35.3 4.75 1.05.1.05.15.05.25.05.25 0 .5-.25.5-.5V6c-.6-.45-1.25-.75-2-1z"/>'],
                    ['number' => $stat2_number, 'label' => $stat2_label, 'icon' => '<path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>'],
                    ['number' => $stat3_number, 'label' => $stat3_label, 'icon' => '<path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/>'],
                    ['number' => $stat4_number, 'label' => $stat4_label, 'icon' => '<path d="M12 11.55C9.64 9.35 6.48 8 3 8v11c3.48 0 6.64 1.35 9 3.55 2.36-2.19 5.52-3.55 9-3.55V8c-3.48 0-6.64 1.35-9 3.55zM12 8c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3z"/>'],
                ];
                $i = 1;
                foreach ($stats as $stat) :
                ?>
                <div class="hk-stat-card hk-reveal-scale hk-delay-<?php echo $i; ?>">
                    <div class="hk-stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><?php echo $stat['icon']; ?></svg>
                    </div>
                    <div class="hk-stat-number" data-target="<?php echo esc_attr(preg_replace('/[^0-9]/', '', $stat['number'])); ?>" data-suffix="<?php echo esc_attr(preg_replace('/[0-9]/', '', $stat['number'])); ?>">0</div>
                    <div class="hk-stat-label"><?php echo esc_html($stat['label']); ?></div>
                </div>
                <?php $i++; endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ======= KİLOMETRE TAŞLARI ======= -->
    <?php if ($milestone1_year || $milestone2_year || $milestone3_year) : ?>
    <section class="hk-timeline" id="hk-timeline">
        <div class="hk-container">
            <div class="hk-timeline-header">
                <div class="hk-section-label hk-reveal">Yolculuğumuz</div>
                <h2 class="hk-section-title hk-reveal hk-delay-1">Kilometre Taşlarımız</h2>
            </div>
            <div class="hk-timeline-track">
                <?php
                $milestones = [
                    ['year' => $milestone1_year, 'text' => $milestone1_text],
                    ['year' => $milestone2_year, 'text' => $milestone2_text],
                    ['year' => $milestone3_year, 'text' => $milestone3_text],
                ];
                $d = 1;
                foreach ($milestones as $ms) :
                    if (empty($ms['year'])) continue;
                ?>
                <div class="hk-timeline-item hk-reveal hk-delay-<?php echo $d; ?>">
                    <div class="hk-timeline-content">
                        <div class="hk-timeline-year"><?php echo esc_html($ms['year']); ?></div>
                        <div class="hk-timeline-text"><?php echo wp_kses_post($ms['text']); ?></div>
                    </div>
                    <div class="hk-timeline-dot"><div class="hk-timeline-dot-inner"></div></div>
                    <div class="hk-timeline-spacer"></div>
                </div>
                <?php $d++; endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ======= EKİP ======= -->
    <?php if ($team1_name || $team2_name || $team3_name) : ?>
    <section class="hk-team" id="hk-team">
        <div class="hk-container">
            <div class="hk-team-header">
                <div class="hk-section-label hk-reveal">Ekibimiz</div>
                <h2 class="hk-section-title hk-reveal hk-delay-1">Arkamızdaki Güç</h2>
            </div>
            <div class="hk-team-grid">
                <?php
                $members = [
                    ['name' => $team1_name, 'role' => $team1_title, 'image' => $team1_image],
                    ['name' => $team2_name, 'role' => $team2_title, 'image' => $team2_image],
                    ['name' => $team3_name, 'role' => $team3_title, 'image' => $team3_image],
                ];
                $m = 1;
                foreach ($members as $member) :
                    if (empty($member['name'])) continue;
                ?>
                <div class="hk-team-card hk-reveal-scale hk-delay-<?php echo $m; ?>">
                    <div class="hk-team-avatar">
                        <?php if (!empty($member['image'])) : ?>
                            <img src="<?php echo esc_url($member['image']); ?>" alt="<?php echo esc_attr($member['name']); ?>" />
                        <?php else : ?>
                            <div class="hk-team-avatar-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            </div>
                        <?php endif; ?>
                    </div>
                    <h4><?php echo esc_html($member['name']); ?></h4>
                    <span class="hk-team-role"><?php echo esc_html($member['role']); ?></span>
                </div>
                <?php $m++; endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ======= CTA ======= -->
    <section class="hk-cta" id="hk-cta">
        <div class="hk-cta-glow hk-cta-glow-1"></div>
        <div class="hk-cta-glow hk-cta-glow-2"></div>
        <div class="hk-container">
            <div class="hk-cta-content">
                <h2 class="hk-reveal"><?php echo esc_html($cta_title); ?></h2>
                <p class="hk-reveal hk-delay-1"><?php echo wp_kses_post($cta_text); ?></p>
                <a href="<?php echo esc_url($cta_button_url); ?>" class="hk-cta-button hk-reveal hk-delay-2">
                    <span><?php echo esc_html($cta_button_text); ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/></svg>
                </a>
            </div>
        </div>
    </section>

</div>

<!-- ======= JAVASCRIPT ======= -->
<script>
(function() {
    'use strict';

    /* === Parçacık efekti === */
    var particleContainer = document.getElementById('hk-particles');
    if (particleContainer) {
        for (var i = 0; i < 20; i++) {
            var p = document.createElement('div');
            p.className = 'hk-particle';
            var size = Math.random() * 6 + 2;
            p.style.width = size + 'px';
            p.style.height = size + 'px';
            p.style.left = Math.random() * 100 + '%';
            p.style.animationDuration = (Math.random() * 15 + 10) + 's';
            p.style.animationDelay = (Math.random() * 10) + 's';
            particleContainer.appendChild(p);
        }
    }

    /* === Scroll ile ortaya çıkma animasyonu === */
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('hk-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.hk-reveal, .hk-reveal-scale').forEach(function(el) {
        observer.observe(el);
    });

    /* === Sayı sayma animasyonu === */
    var counterObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                var el = entry.target;
                var target = parseInt(el.getAttribute('data-target')) || 0;
                var suffix = el.getAttribute('data-suffix') || '';
                var duration = 2000;
                var start = 0;
                var startTime = null;

                function easeOutQuart(t) {
                    return 1 - Math.pow(1 - t, 4);
                }

                function step(timestamp) {
                    if (!startTime) startTime = timestamp;
                    var progress = Math.min((timestamp - startTime) / duration, 1);
                    var current = Math.floor(easeOutQuart(progress) * target);
                    el.textContent = current.toLocaleString('tr-TR') + suffix;
                    if (progress < 1) {
                        requestAnimationFrame(step);
                    }
                }
                requestAnimationFrame(step);
                counterObserver.unobserve(el);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.hk-stat-number').forEach(function(el) {
        counterObserver.observe(el);
    });
})();
</script>

<?php get_footer(); ?>
