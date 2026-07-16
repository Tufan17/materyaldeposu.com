<?php
function material_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'material_theme_setup');

// PDF Gereksinimleri: Custom Post Types ve Taxonomies
function materyal_havuzu_kurulum() {
    // 1. Özel Yazı Türü: Materyaller
    $labels = array(
        'name'               => 'Materyaller',
        'singular_name'      => 'Materyal',
        'menu_name'          => 'Materyaller',
        'add_new'            => 'Yeni Ekle',
        'add_new_item'       => 'Yeni Materyal Ekle',
        'edit_item'          => 'Materyali Düzenle',
        'new_item'           => 'Yeni Materyal',
        'view_item'          => 'Materyali Görüntüle',
        'search_items'       => 'Materyal Ara',
        'not_found'          => 'Materyal bulunamadı',
        'not_found_in_trash' => 'Çöp kutusunda materyal bulunamadı'
    );
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'materyal'),
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-book-alt',
        'show_in_rest'        => true, // Gutenberg desteği için
    );
    register_post_type('materyaller', $args);


    // 2. Sınıflandırma: Sınıf Grubu (Kategori 1)
    register_taxonomy('sinif_grubu', array('materyaller'), array(
        'hierarchical'      => false,
        'labels'            => array(
            'name'              => 'Sınıf Grupları',
            'singular_name'     => 'Sınıf Grubu',
            'search_items'      => 'Sınıf Grubu Ara',
            'all_items'         => 'Tüm Sınıf Grupları',
            'parent_item'       => 'Üst Sınıf Grubu',
            'parent_item_colon' => 'Üst Sınıf Grubu:',
            'edit_item'         => 'Sınıf Grubunu Düzenle',
            'update_item'       => 'Sınıf Grubunu Güncelle',
            'add_new_item'      => 'Yeni Sınıf Grubu Ekle',
            'new_item_name'     => 'Yeni Sınıf Grubu Adı',
            'menu_name'         => 'Sınıf Grupları',
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'sinif'),
        'show_in_rest'      => true,
    ));

    // 3. Sınıflandırma: Dersler (Kategori 2)
    register_taxonomy('dersler', array('materyaller'), array(
        'hierarchical'      => false,
        'labels'            => array(
            'name'              => 'Dersler',
            'singular_name'     => 'Ders',
            'menu_name'         => 'Dersler',
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'ders'),
        'show_in_rest'      => true,
    ));

    // 4. Sınıflandırma: Konular / Üniteler (Kategori 3)
    register_taxonomy('konular', array('materyaller'), array(
        'hierarchical'      => false,
        'labels'            => array(
            'name'              => 'Konular',
            'singular_name'     => 'Konu',
            'menu_name'         => 'Konular',
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'konu'),
        'show_in_rest'      => true,
    ));

    // 5. Sınıflandırma: Materyal Türü (Etiket)
    register_taxonomy('materyal_turu', array('materyaller'), array(
        'hierarchical'      => false,
        'labels'            => array(
            'name'              => 'Materyal Türleri',
            'singular_name'     => 'Materyal Türü',
            'menu_name'         => 'Materyal Türleri',
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'tur'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'materyal_havuzu_kurulum');


// Menüleri kaydet
function material_register_menus() {
    register_nav_menus(
        array(
            'primary-menu' => __( 'Ana Menü (Header)', 'material' )
        )
    );
}
add_action( 'init', 'material_register_menus' );

// Menü linklerine span eklemek için walker veya filtre
function material_nav_menu_link_attributes($atts, $item, $args) {
    if($args->theme_location == 'primary-menu') {
        // We will add the span inside the title instead
    }
    return $atts;
}

function material_nav_menu_title($title, $item, $args, $depth) {
    if($args->theme_location == 'primary-menu') {
        return '<span data-text="' . esc_attr($title) . '">' . $title . '</span>';
    }
    return $title;
}
add_filter('nav_menu_item_title', 'material_nav_menu_title', 10, 4);


// Homepage Customizer Settings
function material_theme_customizer( $wp_customize ) {
    $wp_customize->add_panel( 'material_homepage_panel', array(
        'title'       => __( 'Ana Sayfa Ayarları', 'material' ),
        'priority'    => 30,
    ) );

    // 4 Features Section
    $wp_customize->add_section( 'material_features_section', array(
        'title' => __( 'Öne Çıkan Özellikler (4 Kutu)', 'material' ),
        'panel' => 'material_homepage_panel',
    ) );

    for ($i = 1; $i <= 4; $i++) {
        $default_titles = ['En İyi Simülasyonlar', 'Grup Seminerleri', 'Analiz Edilmiş Müfredat', 'Uygulamalı Eğitim'];
        
        $wp_customize->add_setting( 'feature_title_' . $i, array(
            'default' => $default_titles[$i-1],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'feature_title_' . $i, array(
            'label' => __( 'Kutu ' . $i . ' Başlığı', 'material' ),
            'section' => 'material_features_section',
            'type' => 'text',
        ) );

        $wp_customize->add_setting( 'feature_icon_' . $i, array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post', // allow SVG
        ) );
        $wp_customize->add_control( 'feature_icon_' . $i, array(
            'label' => __( 'Kutu ' . $i . ' İkonu (SVG kodu)', 'material' ),
            'section' => 'material_features_section',
            'type' => 'textarea',
            'description' => 'Boş bırakılırsa varsayılan ikon görünür.',
        ) );
    }

    // Banner Section
    $wp_customize->add_section( 'material_banner_section', array(
        'title' => __( 'Banner Görselleri', 'material' ),
        'panel' => 'material_homepage_panel',
    ) );

    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting( 'banner_image_' . $i, array(
            'default' => get_template_directory_uri() . '/wp-content/uploads/2023/11/lms-banner' . $i . '.jpg',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'banner_image_' . $i, array(
            'label' => __( 'Banner Görseli ' . $i, 'material' ),
            'section' => 'material_banner_section',
        ) ) );
    }
}
add_action( 'customize_register', 'material_theme_customizer' );

// Hakkımızda Sayfası Customizer Ayarları
function material_hakkimizda_customizer( $wp_customize ) {
    // Panel
    $wp_customize->add_panel( 'hakkimizda_panel', array(
        'title'    => __( 'Hakkımızda Sayfası', 'material' ),
        'priority' => 31,
    ) );

    // ===== Hero Section =====
    $wp_customize->add_section( 'hakkimizda_hero_section', array(
        'title' => __( 'Hero Alanı', 'material' ),
        'panel' => 'hakkimizda_panel',
    ) );

    $wp_customize->add_setting( 'hakkimizda_hero_title', array(
        'default'           => 'Hakkımızda',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hakkimizda_hero_title', array(
        'label'   => __( 'Hero Başlığı', 'material' ),
        'section' => 'hakkimizda_hero_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'hakkimizda_hero_subtitle', array(
        'default'           => 'Eğitimde kaliteyi ve yenilikçiliği bir araya getiriyoruz.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hakkimizda_hero_subtitle', array(
        'label'   => __( 'Hero Alt Başlığı', 'material' ),
        'section' => 'hakkimizda_hero_section',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'hakkimizda_hero_bg', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hakkimizda_hero_bg', array(
        'label'   => __( 'Hero Arka Plan Görseli', 'material' ),
        'section' => 'hakkimizda_hero_section',
    ) ) );

    // ===== Biz Kimiz Section =====
    $wp_customize->add_section( 'hakkimizda_about_section', array(
        'title' => __( 'Biz Kimiz Alanı', 'material' ),
        'panel' => 'hakkimizda_panel',
    ) );

    $wp_customize->add_setting( 'hakkimizda_about_title', array(
        'default'           => 'Biz Kimiz?',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hakkimizda_about_title', array(
        'label'   => __( 'Başlık', 'material' ),
        'section' => 'hakkimizda_about_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'hakkimizda_about_text', array(
        'default'           => 'Müfredat Materyal Havuzu olarak, eğitimcilere ve öğrencilere en kaliteli kaynakları sunmayı amaçlıyoruz. Deneyimli ekibimiz, modern eğitim anlayışıyla hazırlanmış materyalleri sizlere ulaştırmak için çalışmaktadır. Her geçen gün büyüyen arşivimizle, eğitimin her alanında ihtiyaç duyulan kaynaklara kolayca erişim sağlıyoruz.',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'hakkimizda_about_text', array(
        'label'   => __( 'Açıklama Metni', 'material' ),
        'section' => 'hakkimizda_about_section',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'hakkimizda_about_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hakkimizda_about_image', array(
        'label'   => __( 'Biz Kimiz Görseli', 'material' ),
        'section' => 'hakkimizda_about_section',
    ) ) );

    // ===== Misyon / Vizyon / Değerler =====
    $wp_customize->add_section( 'hakkimizda_mvv_section', array(
        'title' => __( 'Misyon / Vizyon / Değerler', 'material' ),
        'panel' => 'hakkimizda_panel',
    ) );

    $mvv_fields = array(
        'mission' => array( 'Misyon', 'Misyonumuz', 'Eğitimcilere ve öğrencilere dünya standartlarında, güncel ve erişilebilir materyal kaynakları sunarak eğitim kalitesini artırmak.' ),
        'vision'  => array( 'Vizyon', 'Vizyonumuz', 'Türkiye\'nin en kapsamlı ve yenilikçi eğitim materyalleri platformu olmak, her öğretmenin ve öğrencinin ilk tercih ettiği kaynak merkezi haline gelmek.' ),
        'values'  => array( 'Değerler', 'Değerlerimiz', 'Kalite, yenilikçilik, erişilebilirlik ve sürekli gelişim ilkelerimizle eğitim dünyasına katkıda bulunmak en önemli değerimizdir.' ),
    );

    foreach ( $mvv_fields as $key => $defaults ) {
        $wp_customize->add_setting( 'hakkimizda_' . $key . '_title', array(
            'default'           => $defaults[1],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'hakkimizda_' . $key . '_title', array(
            'label'   => $defaults[0] . ' Başlığı',
            'section' => 'hakkimizda_mvv_section',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( 'hakkimizda_' . $key . '_text', array(
            'default'           => $defaults[2],
            'sanitize_callback' => 'wp_kses_post',
        ) );
        $wp_customize->add_control( 'hakkimizda_' . $key . '_text', array(
            'label'   => $defaults[0] . ' Metni',
            'section' => 'hakkimizda_mvv_section',
            'type'    => 'textarea',
        ) );
    }

    // ===== İstatistikler =====
    $wp_customize->add_section( 'hakkimizda_stats_section', array(
        'title' => __( 'İstatistikler', 'material' ),
        'panel' => 'hakkimizda_panel',
    ) );

    $stat_defaults = array(
        1 => array( '500+', 'Materyal' ),
        2 => array( '1200+', 'Kullanıcı' ),
        3 => array( '50+', 'Eğitimci' ),
        4 => array( '30+', 'Ders Alanı' ),
    );

    for ( $i = 1; $i <= 4; $i++ ) {
        $wp_customize->add_setting( 'hakkimizda_stat' . $i . '_number', array(
            'default'           => $stat_defaults[$i][0],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'hakkimizda_stat' . $i . '_number', array(
            'label'   => 'İstatistik ' . $i . ' Sayı',
            'section' => 'hakkimizda_stats_section',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( 'hakkimizda_stat' . $i . '_label', array(
            'default'           => $stat_defaults[$i][1],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'hakkimizda_stat' . $i . '_label', array(
            'label'   => 'İstatistik ' . $i . ' Etiket',
            'section' => 'hakkimizda_stats_section',
            'type'    => 'text',
        ) );
    }

    // ===== Ekip =====
    $wp_customize->add_section( 'hakkimizda_team_section', array(
        'title'       => __( 'Ekip Üyeleri', 'material' ),
        'panel'       => 'hakkimizda_panel',
        'description' => 'Ekip üyesi bilgilerini doldurun. Boş bırakılan üyeler gösterilmez.',
    ) );

    for ( $i = 1; $i <= 3; $i++ ) {
        $wp_customize->add_setting( 'hakkimizda_team' . $i . '_name', array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'hakkimizda_team' . $i . '_name', array(
            'label'   => 'Üye ' . $i . ' Adı',
            'section' => 'hakkimizda_team_section',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( 'hakkimizda_team' . $i . '_title', array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'hakkimizda_team' . $i . '_title', array(
            'label'   => 'Üye ' . $i . ' Unvanı',
            'section' => 'hakkimizda_team_section',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( 'hakkimizda_team' . $i . '_image', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hakkimizda_team' . $i . '_image', array(
            'label'   => 'Üye ' . $i . ' Fotoğrafı',
            'section' => 'hakkimizda_team_section',
        ) ) );
    }

    // ===== Kilometre Taşları (Timeline) =====
    $wp_customize->add_section( 'hakkimizda_timeline_section', array(
        'title'       => __( 'Kilometre Taşları', 'material' ),
        'panel'       => 'hakkimizda_panel',
        'description' => 'Yolculuğunuzdaki önemli adımları ekleyin. Boş bırakılanlar gösterilmez.',
    ) );

    for ( $i = 1; $i <= 3; $i++ ) {
        $default_years = ['2020', '2022', '2024'];
        $default_texts = [
            'Projemiz ilk temellerini attı ve eğitim materyalleri dijitalleştirilmeye başlandı.',
            'Platform genişleyerek binlerce öğretmen ve öğrenciye ulaştı.',
            'Yapay zeka destekli öneri sistemi ve gelişmiş arama altyapısı devreye alındı.'
        ];

        $wp_customize->add_setting( 'hakkimizda_milestone' . $i . '_year', array(
            'default'           => $default_years[$i-1],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'hakkimizda_milestone' . $i . '_year', array(
            'label'   => 'Adım ' . $i . ' Yılı / Başlığı',
            'section' => 'hakkimizda_timeline_section',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( 'hakkimizda_milestone' . $i . '_text', array(
            'default'           => $default_texts[$i-1],
            'sanitize_callback' => 'wp_kses_post',
        ) );
        $wp_customize->add_control( 'hakkimizda_milestone' . $i . '_text', array(
            'label'   => 'Adım ' . $i . ' Açıklaması',
            'section' => 'hakkimizda_timeline_section',
            'type'    => 'textarea',
        ) );
    }

    // ===== CTA (Eylem Çağrısı) =====
    $wp_customize->add_section( 'hakkimizda_cta_section', array(
        'title' => __( 'Eylem Çağrısı (CTA)', 'material' ),
        'panel' => 'hakkimizda_panel',
    ) );

    $wp_customize->add_setting( 'hakkimizda_cta_title', array(
        'default'           => 'Hemen Başlayın',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hakkimizda_cta_title', array(
        'label'   => __( 'CTA Başlığı', 'material' ),
        'section' => 'hakkimizda_cta_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'hakkimizda_cta_text', array(
        'default'           => 'Binlerce materyale erişim sağlayın ve eğitim deneyiminizi üst seviyeye taşıyın.',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'hakkimizda_cta_text', array(
        'label'   => __( 'CTA Metni', 'material' ),
        'section' => 'hakkimizda_cta_section',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'hakkimizda_cta_button_text', array(
        'default'           => 'Materyalleri Keşfet',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'hakkimizda_cta_button_text', array(
        'label'   => __( 'Buton Metni', 'material' ),
        'section' => 'hakkimizda_cta_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'hakkimizda_cta_button_url', array(
        'default'           => '/materyaller/',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'hakkimizda_cta_button_url', array(
        'label'   => __( 'Buton Bağlantısı (URL)', 'material' ),
        'section' => 'hakkimizda_cta_section',
        'type'    => 'url',
    ) );
}
add_action( 'customize_register', 'material_hakkimizda_customizer' );

// ===== İletişim Sayfası Özelleştirici Ayarları =====
function material_iletisim_customizer( $wp_customize ) {
    $wp_customize->add_panel( 'iletisim_panel', array(
        'title'       => __( 'İletişim Sayfası', 'material' ),
        'priority'    => 161,
        'description' => 'İletişim sayfası ayarlarını buradan yönetebilirsiniz.',
    ) );

    $wp_customize->add_section( 'iletisim_bilgileri_section', array(
        'title' => __( 'İletişim Bilgileri', 'material' ),
        'panel' => 'iletisim_panel',
    ) );

    // Telefon
    $wp_customize->add_setting( 'iletisim_phone', array(
        'default'           => '+90 (555) 123 45 67',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'iletisim_phone', array(
        'label'   => __( 'Telefon Numarası', 'material' ),
        'section' => 'iletisim_bilgileri_section',
        'type'    => 'text',
    ) );

    // E-Posta
    $wp_customize->add_setting( 'iletisim_email', array(
        'default'           => 'iletisim@siteadresi.com',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'iletisim_email', array(
        'label'   => __( 'E-Posta Adresi', 'material' ),
        'section' => 'iletisim_bilgileri_section',
        'type'    => 'email',
    ) );

    // Adres
    $wp_customize->add_setting( 'iletisim_address', array(
        'default'           => 'Eğitim Vadisi, Teknoloji Cad. No:1, İstanbul',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'iletisim_address', array(
        'label'   => __( 'Adres', 'material' ),
        'section' => 'iletisim_bilgileri_section',
        'type'    => 'textarea',
    ) );

    // Harita URL
    $wp_customize->add_setting( 'iletisim_map_iframe', array(
        'default'           => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d192697.79327595676!2d28.871754050228723!3d41.00549580879685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caa7040068086b%3A0xe1ccfe98bc01b0d0!2zxLBzdGFuYnVs!5e0!3m2!1str!2str!4v1689252390000!5m2!1str!2str',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'iletisim_map_iframe', array(
        'label'   => __( 'Google Maps Embed URL (src kısmı)', 'material' ),
        'description' => 'Google Haritalar üzerinden Paylaş -> Harita Yerleştir seçeneğindeki "src=" içerisindeki URL\'i buraya yapıştırın.',
        'section' => 'iletisim_bilgileri_section',
        'type'    => 'url',
    ) );

    // Ana Sayfa İstatistikleri Bölümü
    $wp_customize->add_section( 'homepage_stats_section', array(
        'title'       => __( 'Ana Sayfa Sayaçları', 'material' ),
        'priority'    => 31,
    ) );

    // Üye Sayısı
    $wp_customize->add_setting( 'stat_members', array(
        'default'           => '1403',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'stat_members', array(
        'label'   => __( 'Üye Sayısı', 'material' ),
        'section' => 'homepage_stats_section',
        'type'    => 'number',
    ) );

    // Eğitmen Sayısı
    $wp_customize->add_setting( 'stat_authors', array(
        'default'           => '60',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'stat_authors', array(
        'label'   => __( 'Eğitmen Sayısı', 'material' ),
        'section' => 'homepage_stats_section',
        'type'    => 'number',
    ) );

    // --- ANA SAYFA BÖLÜM METİNLERİ ---
    $wp_customize->add_section( 'homepage_texts_section', array(
        'title'       => __( 'Ana Sayfa Metinleri & Bülten', 'material' ),
        'priority'    => 32,
    ) );

    // Bülten Başlığı
    $wp_customize->add_setting( 'nl_title', array(
        'default'           => 'Bizimle İletişime Geçin',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'nl_title', array(
        'label'   => __( 'Bülten Başlığı', 'material' ),
        'section' => 'homepage_texts_section',
        'type'    => 'text',
    ) );

    // Bülten Açıklaması
    $wp_customize->add_setting( 'nl_desc', array(
        'default'           => 'Eğitimlerimizden ve gelişmelerden haberdar olmak için e-posta bültenimize abone olabilirsiniz. Size sadece en önemli güncellemeleri göndereceğiz.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'nl_desc', array(
        'label'   => __( 'Bülten Açıklaması', 'material' ),
        'section' => 'homepage_texts_section',
        'type'    => 'textarea',
    ) );

    // --- İŞLEYİŞİMİZ (ADIMLAR) ---
    $wp_customize->add_section( 'homepage_process_section', array(
        'title'       => __( 'Ana Sayfa - İşleyişimiz Adımları', 'material' ),
        'priority'    => 33,
    ) );

    for ($i = 1; $i <= 4; $i++) {
        $default_titles = ['', 'İstediğiniz Eğitimi Bulun', 'Örnek Dersleri İnceleyin', 'Müfredata Göz Atın', 'Eğitime Kayıt Olun'];
        $default_descs = ['', 
            'Size en uygun olan eğitim içeriklerini detaylı filtreleme seçeneklerimizle hemen bulun.', 
            'Karar vermeden önce örnek ders videolarını izleyerek eğitmenlerimiz ve içerik hakkında bilgi sahibi olun.', 
            'Eğitimin içeriğini, işlenecek konuları ve kazanımları detaylı müfredat sayfamızdan önceden görün.', 
            'Seçtiğiniz eğitime güvenli ödeme yöntemleriyle kolayca kayıt olun ve öğrenmeye hemen başlayın.'
        ];

        // Başlık
        $wp_customize->add_setting( 'step'.$i.'_title', array(
            'default'           => $default_titles[$i],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'step'.$i.'_title', array(
            'label'   => __( 'Adım 0'.$i.' Başlığı', 'material' ),
            'section' => 'homepage_process_section',
            'type'    => 'text',
        ) );

        // Açıklama
        $wp_customize->add_setting( 'step'.$i.'_desc', array(
            'default'           => $default_descs[$i],
            'sanitize_callback' => 'sanitize_textarea_field',
        ) );
        $wp_customize->add_control( 'step'.$i.'_desc', array(
            'label'   => __( 'Adım 0'.$i.' Açıklaması', 'material' ),
            'section' => 'homepage_process_section',
            'type'    => 'textarea',
        ) );
    }
}
add_action( 'customize_register', 'material_iletisim_customizer' );

// Sınıf Grubu (sinif_grubu) için Özel İkon/Görsel Alanı - Media Script
function sinif_grubu_enqueue_media($hook) {
    if ( $hook == 'edit-tags.php' || $hook == 'term.php' ) {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'sinif_grubu_enqueue_media');

function sinif_grubu_add_form_fields() {
    ?>
    <div class="form-field">
        <label for="sinif_grubu_icon_url">Kategori İkonu/Resmi</label>
        <div style="display:flex; gap:10px; align-items:center;">
            <input type="text" name="sinif_grubu_icon_url" id="sinif_grubu_icon_url" value="" style="width: 70%;">
            <button type="button" class="button sinif_grubu_media_btn">Ortamdan Seç</button>
        </div>
        <p class="description">Ana sayfada bu kategori için gösterilecek ikon veya resmi Medya Kütüphanesinden seçin.</p>
    </div>
    <div class="form-field">
        <label for="sinif_grubu_order">Sıra No</label>
        <input type="number" name="sinif_grubu_order" id="sinif_grubu_order" value="0">
        <p class="description">Kategorilerin sayfada görünme sırasını belirlemek için sayı girin (Örn: 1, 2, 3...). En küçük sayı ilk sırada çıkar.</p>
    </div>
    <script>
        jQuery(document).ready(function($){
            var mediaUploaderAdd;
            $('.sinif_grubu_media_btn').click(function(e) {
                e.preventDefault();
                var button = $(this);
                if (mediaUploaderAdd) { mediaUploaderAdd.open(); return; }
                mediaUploaderAdd = wp.media.frames.file_frame = wp.media({
                    title: 'İkon veya Resim Seç',
                    button: { text: 'Bunu Kullan' }, multiple: false
                });
                mediaUploaderAdd.on('select', function() {
                    var attachment = mediaUploaderAdd.state().get('selection').first().toJSON();
                    button.prev('input').val(attachment.url);
                });
                mediaUploaderAdd.open();
            });
        });
    </script>
    <?php
}
add_action('sinif_grubu_add_form_fields', 'sinif_grubu_add_form_fields');

function sinif_grubu_edit_form_fields($term) {
    $icon_url = get_term_meta($term->term_id, 'sinif_grubu_icon_url', true);
    ?>
    <tr class="form-field">
        <th scope="row"><label for="sinif_grubu_icon_url">Kategori İkonu/Resmi</label></th>
        <td>
            <div style="display:flex; gap:10px; align-items:center;">
                <input type="text" name="sinif_grubu_icon_url" id="sinif_grubu_icon_url" value="<?php echo esc_attr($icon_url); ?>" style="width: 70%;">
                <button type="button" class="button sinif_grubu_media_btn">Ortamdan Seç</button>
            </div>
            <p class="description">Ana sayfada bu kategori için gösterilecek ikon veya resmi Medya Kütüphanesinden seçin.</p>
            <script>
                jQuery(document).ready(function($){
                    var mediaUploaderEdit;
                    $('.sinif_grubu_media_btn').click(function(e) {
                        e.preventDefault();
                        var button = $(this);
                        if (mediaUploaderEdit) { mediaUploaderEdit.open(); return; }
                        mediaUploaderEdit = wp.media.frames.file_frame = wp.media({
                            title: 'İkon veya Resim Seç',
                            button: { text: 'Bunu Kullan' }, multiple: false
                        });
                        mediaUploaderEdit.on('select', function() {
                            var attachment = mediaUploaderEdit.state().get('selection').first().toJSON();
                            button.prev('input').val(attachment.url);
                        });
                        mediaUploaderEdit.open();
                    });
                });
            </script>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row"><label for="sinif_grubu_order">Sıra No</label></th>
        <td>
            <?php $order = get_term_meta($term->term_id, 'sinif_grubu_order', true); ?>
            <input type="number" name="sinif_grubu_order" id="sinif_grubu_order" value="<?php echo esc_attr($order !== '' ? $order : '0'); ?>">
            <p class="description">Kategorilerin sayfada görünme sırasını belirlemek için sayı girin (Örn: 1, 2, 3...). En küçük sayı ilk sırada çıkar.</p>
        </td>
    </tr>
    <?php
}
add_action('sinif_grubu_edit_form_fields', 'sinif_grubu_edit_form_fields');

function sinif_grubu_save_term_fields($term_id) {
    if (isset($_POST['sinif_grubu_icon_url'])) {
        update_term_meta($term_id, 'sinif_grubu_icon_url', sanitize_text_field($_POST['sinif_grubu_icon_url']));
    }
    if (isset($_POST['sinif_grubu_order'])) {
        update_term_meta($term_id, 'sinif_grubu_order', intval($_POST['sinif_grubu_order']));
    }
}
add_action('edited_sinif_grubu', 'sinif_grubu_save_term_fields');
add_action('created_sinif_grubu', 'sinif_grubu_save_term_fields');

// Blog sayfasında 12 yazı göster
function material_blog_posts_per_page( $query ) {
    if ( !is_admin() && $query->is_main_query() && ( $query->is_home() || $query->is_category() || $query->is_tag() ) ) {
        $query->set( 'posts_per_page', 12 );
    }
}
add_action( 'pre_get_posts', 'material_blog_posts_per_page' );

// Etkinlikler için Custom Post Type
function create_etkinlik_cpt() {
    register_post_type('etkinlik',
        array(
            'labels'      => array(
                'name'          => __('Etkinlikler', 'material'),
                'singular_name' => __('Etkinlik', 'material'),
                'add_new'       => __('Yeni Etkinlik Ekle', 'material'),
                'add_new_item'  => __('Yeni Etkinlik', 'material'),
                'edit_item'     => __('Etkinliği Düzenle', 'material'),
                'view_item'     => __('Etkinliği Görüntüle', 'material'),
                'all_items'     => __('Tüm Etkinlikler', 'material'),
            ),
            'public'      => true,
            'has_archive' => true,
            'menu_icon'   => 'dashicons-calendar-alt',
            'supports'    => array('title', 'editor', 'thumbnail', 'excerpt'),
        )
    );
}
add_action('init', 'create_etkinlik_cpt');

// İlk kurulumda örnek etkinlikleri ekle
function insert_dummy_events() {
    if (get_option('dummy_events_inserted')) {
        return;
    }
    
    $events = array(
        array(
            'title'   => 'Büyük Yılbaşı Çekilişi',
            'content' => 'Yeni yıla harika hediyelerle giriyoruz! Tüm öğrencilerimizin katılımına açık olan çekilişimizde sürpriz ödüller dağıtacağız. Katılmak için hemen başvurun.',
            'excerpt' => 'Sürpriz ödüllü büyük çekilişe katılmayı unutmayın!',
        ),
        array(
            'title'   => 'Zeka Oyunları Turnuvası',
            'content' => 'Satranç, mangala ve sudoku gibi oyunlarda yeteneklerini sergilemek isteyen öğrencileri bekliyoruz. Dereceye girenlere madalya ve sürpriz hediyeler verilecektir.',
            'excerpt' => 'Zekana güveniyorsan bu turnuva tam sana göre!',
        ),
        array(
            'title'   => 'Yeni Dönem Tanışma Toplantısı',
            'content' => 'Öğretmenlerimiz ve öğrencilerimizle bir araya gelerek yeni dönem hedeflerimizi konuşuyoruz. Tüm veli ve öğrencilerimiz davetlidir.',
            'excerpt' => 'Yeni döneme hep birlikte, güçlü bir başlangıç yapıyoruz.',
        )
    );

    foreach ($events as $event) {
        $post_data = array(
            'post_title'    => $event['title'],
            'post_content'  => $event['content'],
            'post_excerpt'  => $event['excerpt'],
            'post_status'   => 'publish',
            'post_type'     => 'etkinlik',
        );
        wp_insert_post($post_data);
    }
    
    flush_rewrite_rules(); // Yeni CPT için URL yapılarını yenile (404 hatasını çözer)
    update_option('dummy_events_inserted', true);
}
add_action('init', 'insert_dummy_events');

function material_flush_rewrite_once() {
    if ( ! get_option( 'material_flushed_etkinlik_cpt' ) ) {
        flush_rewrite_rules();
        update_option( 'material_flushed_etkinlik_cpt', true );
    }
}
add_action( 'init', 'material_flush_rewrite_once', 99 );

// Materyal Paylaş sayfasını otomatik oluştur
function create_materyal_paylas_page() {
    $page_slug = 'materyal-paylas';
    $page_title = 'Materyal Paylaş';

    // Sayfa zaten var mı kontrol et
    $page = get_page_by_path($page_slug);

    if ( ! $page ) {
        $page_id = wp_insert_post( array(
            'post_title'     => $page_title,
            'post_name'      => $page_slug,
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'comment_status' => 'closed',
            'ping_status'    => 'closed',
        ) );

        if ( $page_id && ! is_wp_error( $page_id ) ) {
            // Şablonu ata
            update_post_meta( $page_id, '_wp_page_template', 'page-materyal-paylas.php' );
        }
    }
}
add_action( 'init', 'create_materyal_paylas_page' );

// Materyal Arama sayfasını otomatik oluştur
function create_materyal_arama_page() {
    $page_slug = 'materyal-arama';
    $page_title = 'Materyal Arama';

    $page = get_page_by_path($page_slug);

    if ( ! $page ) {
        $page_id = wp_insert_post( array(
            'post_title'     => $page_title,
            'post_name'      => $page_slug,
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'comment_status' => 'closed',
            'ping_status'    => 'closed',
        ) );

        if ( $page_id && ! is_wp_error( $page_id ) ) {
            update_post_meta( $page_id, '_wp_page_template', 'page-materyal-arama.php' );
        }
    }
}
add_action( 'init', 'create_materyal_arama_page' );

// Yeni ve Temiz Dummy Data (Sınıf > Ders > Konu > Materyal Hiyerarşisi)
function add_structured_dummy_data() {
    if ( get_option( 'structured_dummy_data_inserted' ) ) {
        return;
    }

    // Eski eklediğim materyalleri sileyim (Kullanıcının lise sınıflarını silmeden)
    $old_posts = get_posts(array(
        'post_type' => 'materyaller',
        'numberposts' => -1,
        's' => 'Rakamlar' // İçinde Rakamlar geçenleri sil
    ));
    foreach ($old_posts as $p) {
        wp_delete_post($p->ID, true);
    }

    // 9. Sınıf var mı kontrol et, yoksa ekle
    $sinif9 = term_exists( '9. Sınıf', 'sinif_grubu' );
    if ( ! $sinif9 ) {
        $sinif9 = wp_insert_term( '9. Sınıf', 'sinif_grubu' );
    }

    // Ders oluştur (Matematik ve Fizik)
    $matematik = term_exists( 'Matematik', 'dersler' );
    if ( ! $matematik ) { $matematik = wp_insert_term( 'Matematik', 'dersler' ); }
    $fizik = term_exists( 'Fizik', 'dersler' );
    if ( ! $fizik ) { $fizik = wp_insert_term( 'Fizik', 'dersler' ); }

    // Konu oluştur (Kümeler ve Vektörler)
    $kumeler = term_exists( 'Kümeler', 'konular' );
    if ( ! $kumeler ) { $kumeler = wp_insert_term( 'Kümeler', 'konular' ); }
    
    $mantik = term_exists( 'Mantık', 'konular' );
    if ( ! $mantik ) { $mantik = wp_insert_term( 'Mantık', 'konular' ); }

    $vektorler = term_exists( 'Vektörler', 'konular' );
    if ( ! $vektorler ) { $vektorler = wp_insert_term( 'Vektörler', 'konular' ); }

    // Dummy Materyalleri Ekle
    $dummy_materials = array(
        // Matematik -> Kümeler
        array('title' => 'Kümeler Alt Küme Konu Anlatımı', 'ders' => $matematik, 'konu' => $kumeler),
        array('title' => 'Kümeler Çıkmış Sorular', 'ders' => $matematik, 'konu' => $kumeler),
        // Matematik -> Mantık
        array('title' => 'Önermeler ve Doğruluk Değerleri Testi', 'ders' => $matematik, 'konu' => $mantik),
        // Fizik -> Vektörler
        array('title' => 'Vektörlerde Toplama İşlemi Föyü', 'ders' => $fizik, 'konu' => $vektorler),
    );

    foreach ( $dummy_materials as $mat ) {
        $post_id = wp_insert_post( array(
            'post_title'   => $mat['title'],
            'post_content' => 'Bu, sistemin yeni hiyerarşisini test etmek için oluşturulmuş örnek bir materyaldir.',
            'post_status'  => 'publish',
            'post_type'    => 'materyaller'
        ) );

        if ( $post_id && ! is_wp_error( $post_id ) ) {
            wp_set_object_terms( $post_id, (int)$sinif9['term_id'], 'sinif_grubu' );
            wp_set_object_terms( $post_id, (int)$mat['ders']['term_id'], 'dersler' );
            wp_set_object_terms( $post_id, (int)$mat['konu']['term_id'], 'konular' );
        }
    }

    update_option( 'structured_dummy_data_inserted', true );
}
add_action( 'init', 'add_structured_dummy_data' );

// --- WP SEO KURALLARI BAŞLANGICI --- //

// 1. JSON-LD Yapısal Veri (Schema.org) Eklenmesi
add_action('wp_head', function () {
    // A. Organization (Kurum) Şeması (Tüm sayfalarda)
    $schema_org = [
        '@context' => 'https://schema.org',
        '@type'    => 'Organization',
        'name'     => get_bloginfo('name'),
        'url'      => home_url('/'),
        'logo'     => get_template_directory_uri() . '/wp-content/uploads/2023/11/lms-logo.png',
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($schema_org, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";

    // B. Article Şeması (Sadece Blog ve Materyal Detay Sayfalarında)
    if (is_singular(['post', 'materyaller'])) {
        $article = [
            '@context'      => 'https://schema.org',
            '@type'         => 'Article',
            'headline'      => get_the_title(),
            'datePublished' => get_the_date('c'),
            'dateModified'  => get_the_modified_date('c'),
            'author'        => ['@type' => 'Person', 'name' => get_the_author()],
            'image'         => get_the_post_thumbnail_url(null, 'full') ?: get_template_directory_uri() . '/wp-content/uploads/2023/11/lms-logo.png',
            'mainEntityOfPage' => get_permalink(),
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($article, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
    }
});

// 2. Otomatik WebP Servis Edici Filtre (Performans)
function uygunusec_serve_webp($url) {
    if (strpos($url, '.jpg') !== false || strpos($url, '.png') !== false || strpos($url, '.jpeg') !== false) {
        $webp_url = preg_replace('/\.(jpe?g|png)$/i', '.webp', $url);
        
        // URL'yi sunucu lokal yoluna çevir ve WebP var mı kontrol et
        $upload_dir = wp_upload_dir();
        $base_url = $upload_dir['baseurl'];
        $base_dir = $upload_dir['basedir'];
        
        if (strpos($webp_url, $base_url) !== false) {
            $local_path = str_replace($base_url, $base_dir, $webp_url);
            if (file_exists($local_path)) {
                return $webp_url;
            }
        }
    }
    return $url;
}
add_filter('wp_get_attachment_url', 'uygunusec_serve_webp');
add_filter('the_content', function($content) {
    return preg_replace_callback('/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/i', function($match) {
        $img_tag = $match[0];
        $original_url = $match[1];
        $webp_url = uygunusec_serve_webp($original_url);
        if ($original_url !== $webp_url) {
            $img_tag = str_replace($original_url, $webp_url, $img_tag);
        }
        return $img_tag;
    }, $content);
});

// Her sayfa başlığının (title) sonuna "- Materyal Deposu" eklenmesini garanti altına alan filtre
add_filter( 'document_title_parts', function( $title_parts ) {
    $title_parts['site'] = 'Materyal Deposu';
    return $title_parts;
} );

// --- WP SEO KURALLARI BİTİŞİ --- //

// --- HİYERARŞİK TAKSONOMİ VE METABOX (Drill-Down) --- //
require_once get_template_directory() . '/inc/taxonomy-hierarchy.php';
