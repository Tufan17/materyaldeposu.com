<?php
// Taksonomi Hiyerarşisi, Ebeveyn atamaları ve Özel Metabox Yapısı

// ==========================================
// 1. DERSLER İÇİN "BAĞLI OLDUĞU SINIF" ALANI
// ==========================================
function add_dersler_bagli_sinif_field() {
    $siniflar = get_terms([
        'taxonomy'   => 'sinif_grubu',
        'hide_empty' => false,
    ]);
    ?>
    <div class="form-field">
        <label for="bagli_sinif">Bağlı Olduğu Sınıf</label>
        <select name="bagli_sinif" id="bagli_sinif" required>
            <option value="">-- Sınıf Seçin --</option>
            <?php foreach($siniflar as $sinif): ?>
                <option value="<?php echo esc_attr($sinif->term_id); ?>"><?php echo esc_html($sinif->name); ?></option>
            <?php endforeach; ?>
        </select>
        <p>Bu dersin hangi sınıfa ait olduğunu seçin.</p>
    </div>
    <?php
}
add_action('dersler_add_form_fields', 'add_dersler_bagli_sinif_field');

function edit_dersler_bagli_sinif_field($term) {
    $bagli_sinif = get_term_meta($term->term_id, 'bagli_sinif', true);
    $siniflar = get_terms([
        'taxonomy'   => 'sinif_grubu',
        'hide_empty' => false,
    ]);
    ?>
    <tr class="form-field">
        <th scope="row"><label for="bagli_sinif">Bağlı Olduğu Sınıf</label></th>
        <td>
            <select name="bagli_sinif" id="bagli_sinif" required>
                <option value="">-- Sınıf Seçin --</option>
                <?php foreach($siniflar as $sinif): ?>
                    <option value="<?php echo esc_attr($sinif->term_id); ?>" <?php selected($bagli_sinif, $sinif->term_id); ?>><?php echo esc_html($sinif->name); ?></option>
                <?php endforeach; ?>
            </select>
            <p class="description">Bu dersin hangi sınıfa ait olduğunu seçin.</p>
        </td>
    </tr>
    <?php
}
add_action('dersler_edit_form_fields', 'edit_dersler_bagli_sinif_field');

function save_dersler_bagli_sinif_field($term_id) {
    if (isset($_POST['bagli_sinif'])) {
        update_term_meta($term_id, 'bagli_sinif', sanitize_text_field($_POST['bagli_sinif']));
    }
}
add_action('created_dersler', 'save_dersler_bagli_sinif_field');
add_action('edited_dersler', 'save_dersler_bagli_sinif_field');

// ==========================================
// 2. KONULAR İÇİN "BAĞLI OLDUĞU DERS" ALANI
// ==========================================
function add_konular_bagli_ders_field() {
    $siniflar = get_terms(['taxonomy' => 'sinif_grubu', 'hide_empty' => false]);
    ?>
    <div class="form-field">
        <label for="bagli_sinif">Sınıf</label>
        <select name="bagli_sinif" id="bagli_sinif">
            <option value="">-- Sınıf Seçin --</option>
            <?php foreach($siniflar as $sinif): ?>
                <option value="<?php echo esc_attr($sinif->term_id); ?>"><?php echo esc_html($sinif->name); ?></option>
            <?php endforeach; ?>
        </select>
        <p>Önce konunun ait olduğu sınıfı seçin.</p>
    </div>
    <div class="form-field">
        <label for="bagli_ders">Bağlı Olduğu Ders</label>
        <select name="bagli_ders" id="bagli_ders" required disabled>
            <option value="">-- Önce Sınıf Seçin --</option>
        </select>
        <p>Bu konunun hangi derse ait olduğunu seçin.</p>
    </div>
    <script>
    jQuery(document).ready(function($){
        $('#bagli_sinif').on('change', function(){
            var sinif_id = $(this).val();
            $('#bagli_ders').html('<option value="">Yükleniyor...</option>').prop('disabled', true);
            if(sinif_id) {
                $.post(ajaxurl, { action: 'get_bagli_dersler', sinif_id: sinif_id, is_admin: 1 }, function(response) {
                    $('#bagli_ders').html(response).prop('disabled', false);
                });
            } else {
                $('#bagli_ders').html('<option value="">-- Önce Sınıf Seçin --</option>');
            }
        });
    });
    </script>
    <?php
}
add_action('konular_add_form_fields', 'add_konular_bagli_ders_field');

function edit_konular_bagli_ders_field($term) {
    $bagli_ders = get_term_meta($term->term_id, 'bagli_ders', true);
    $bagli_sinif = $bagli_ders ? get_term_meta($bagli_ders, 'bagli_sinif', true) : '';
    
    $siniflar = get_terms(['taxonomy' => 'sinif_grubu', 'hide_empty' => false]);
    $dersler = $bagli_sinif ? get_terms(['taxonomy' => 'dersler', 'hide_empty' => false, 'meta_query' => [['key' => 'bagli_sinif', 'value' => $bagli_sinif]]]) : [];
    ?>
    <tr class="form-field">
        <th scope="row"><label for="bagli_sinif">Sınıf</label></th>
        <td>
            <select name="bagli_sinif" id="bagli_sinif">
                <option value="">-- Sınıf Seçin --</option>
                <?php foreach($siniflar as $sinif): ?>
                    <option value="<?php echo esc_attr($sinif->term_id); ?>" <?php selected($bagli_sinif, $sinif->term_id); ?>><?php echo esc_html($sinif->name); ?></option>
                <?php endforeach; ?>
            </select>
            <p class="description">Önce konunun ait olduğu sınıfı seçin.</p>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row"><label for="bagli_ders">Bağlı Olduğu Ders</label></th>
        <td>
            <select name="bagli_ders" id="bagli_ders" required <?php echo empty($bagli_sinif) ? 'disabled' : ''; ?>>
                <option value="">-- <?php echo empty($bagli_sinif) ? 'Önce Sınıf Seçin' : 'Ders Seçin'; ?> --</option>
                <?php foreach($dersler as $ders): ?>
                    <option value="<?php echo esc_attr($ders->term_id); ?>" <?php selected($bagli_ders, $ders->term_id); ?>><?php echo esc_html($ders->name); ?></option>
                <?php endforeach; ?>
            </select>
            <p class="description">Bu konunun hangi derse ait olduğunu seçin.</p>
        </td>
    </tr>
    <script>
    jQuery(document).ready(function($){
        $('#bagli_sinif').on('change', function(){
            var sinif_id = $(this).val();
            $('#bagli_ders').html('<option value="">Yükleniyor...</option>').prop('disabled', true);
            if(sinif_id) {
                $.post(ajaxurl, { action: 'get_bagli_dersler', sinif_id: sinif_id, is_admin: 1 }, function(response) {
                    $('#bagli_ders').html(response).prop('disabled', false);
                });
            } else {
                $('#bagli_ders').html('<option value="">-- Önce Sınıf Seçin --</option>');
            }
        });
    });
    </script>
    <?php
}
add_action('konular_edit_form_fields', 'edit_konular_bagli_ders_field');

function save_konular_bagli_ders_field($term_id) {
    if (isset($_POST['bagli_ders'])) {
        update_term_meta($term_id, 'bagli_ders', sanitize_text_field($_POST['bagli_ders']));
    }
}
add_action('created_konular', 'save_konular_bagli_ders_field');
add_action('edited_konular', 'save_konular_bagli_ders_field');

// ==========================================
// 3. ADMIN PANEL METABOX İŞLEMLERİ
// ==========================================
add_action('admin_menu', function() {
    // Varsayılan kafa karıştırıcı checkbox taxonomy kutularını gizle
    remove_meta_box('tagsdiv-sinif_grubu', 'materyaller', 'side');
    remove_meta_box('sinif_grubudiv', 'materyaller', 'side');
    remove_meta_box('tagsdiv-dersler', 'materyaller', 'side');
    remove_meta_box('derslerdiv', 'materyaller', 'side');
    remove_meta_box('tagsdiv-konular', 'materyaller', 'side');
    remove_meta_box('konulardiv', 'materyaller', 'side');

    // Özel kutumuzu ekle
    add_meta_box('materyal_hiyerarsi_box', 'Materyal Konumu (Sınıf > Ders > Konu)', 'render_materyal_hiyerarsi_box', 'materyaller', 'side', 'high');
});

function render_materyal_hiyerarsi_box($post) {
    // Mevcut değerleri al
    $secili_siniflar = wp_get_post_terms($post->ID, 'sinif_grubu', ['fields' => 'ids']);
    $secili_dersler  = wp_get_post_terms($post->ID, 'dersler', ['fields' => 'ids']);
    $secili_konular  = wp_get_post_terms($post->ID, 'konular', ['fields' => 'ids']);

    $secili_sinif = !empty($secili_siniflar) ? $secili_siniflar[0] : '';
    $secili_ders  = !empty($secili_dersler) ? $secili_dersler[0] : '';
    $secili_konu  = !empty($secili_konular) ? $secili_konular[0] : '';

    $siniflar = get_terms([
        'taxonomy'   => 'sinif_grubu',
        'hide_empty' => false,
    ]);
    
    wp_nonce_field('materyal_hiyerarsi_nonce', 'hiyerarsi_nonce');
    ?>
    <style>
        .mh-field { margin-bottom: 15px; }
        .mh-field label { display: block; font-weight: bold; margin-bottom: 5px; }
        .mh-field select { width: 100%; max-width: 100%; }
        #mh_loading { display: none; color: #0073aa; font-weight: bold; margin-bottom: 10px; }
    </style>

    <div id="mh_loading">Yükleniyor...</div>

    <div class="mh-field">
        <label>1. Sınıf Seçin</label>
        <select name="mh_sinif" id="mh_sinif">
            <option value="">-- Sınıf Seç --</option>
            <?php foreach($siniflar as $sinif): ?>
                <option value="<?php echo esc_attr($sinif->term_id); ?>" <?php selected($secili_sinif, $sinif->term_id); ?>><?php echo esc_html($sinif->name); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mh-field">
        <label>2. Ders Seçin</label>
        <select name="mh_ders" id="mh_ders" <?php echo empty($secili_sinif) ? 'disabled' : ''; ?>>
            <option value="">-- Ders Seç --</option>
            <?php 
            if(!empty($secili_sinif)) {
                $dersler = get_terms(['taxonomy' => 'dersler', 'hide_empty' => false, 'meta_query' => [ ['key' => 'bagli_sinif', 'value' => $secili_sinif] ]]);
                foreach($dersler as $ders): ?>
                    <option value="<?php echo esc_attr($ders->term_id); ?>" <?php selected($secili_ders, $ders->term_id); ?>><?php echo esc_html($ders->name); ?></option>
                <?php endforeach; 
            } ?>
        </select>
    </div>

    <div class="mh-field">
        <label>3. Konu Seçin</label>
        <select name="mh_konu" id="mh_konu" <?php echo empty($secili_ders) ? 'disabled' : ''; ?>>
            <option value="">-- Konu Seç --</option>
            <?php 
            if(!empty($secili_ders)) {
                $konular = get_terms(['taxonomy' => 'konular', 'hide_empty' => false, 'meta_query' => [ ['key' => 'bagli_ders', 'value' => $secili_ders] ]]);
                foreach($konular as $konu): ?>
                    <option value="<?php echo esc_attr($konu->term_id); ?>" <?php selected($secili_konu, $konu->term_id); ?>><?php echo esc_html($konu->name); ?></option>
                <?php endforeach; 
            } ?>
        </select>
    </div>

    <script>
    jQuery(document).ready(function($){
        $('#mh_sinif').on('change', function(){
            var sinif_id = $(this).val();
            $('#mh_ders').html('<option value="">-- Ders Seç --</option>').prop('disabled', true);
            $('#mh_konu').html('<option value="">-- Konu Seç --</option>').prop('disabled', true);
            
            if(sinif_id) {
                $('#mh_loading').show();
                $.post(ajaxurl, {
                    action: 'get_bagli_dersler',
                    sinif_id: sinif_id,
                    is_admin: 1
                }, function(response) {
                    $('#mh_loading').hide();
                    $('#mh_ders').html(response).prop('disabled', false);
                });
            }
        });

        $('#mh_ders').on('change', function(){
            var ders_id = $(this).val();
            $('#mh_konu').html('<option value="">-- Konu Seç --</option>').prop('disabled', true);
            
            if(ders_id) {
                $('#mh_loading').show();
                $.post(ajaxurl, {
                    action: 'get_bagli_konular',
                    ders_id: ders_id,
                    is_admin: 1
                }, function(response) {
                    $('#mh_loading').hide();
                    $('#mh_konu').html(response).prop('disabled', false);
                });
            }
        });
    });
    </script>
    <?php
}

add_action('save_post_materyaller', function($post_id) {
    if (!isset($_POST['hiyerarsi_nonce']) || !wp_verify_nonce($_POST['hiyerarsi_nonce'], 'materyal_hiyerarsi_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    $sinif_id = isset($_POST['mh_sinif']) ? intval($_POST['mh_sinif']) : 0;
    $ders_id  = isset($_POST['mh_ders']) ? intval($_POST['mh_ders']) : 0;
    $konu_id  = isset($_POST['mh_konu']) ? intval($_POST['mh_konu']) : 0;

    wp_set_post_terms($post_id, $sinif_id ? [$sinif_id] : [], 'sinif_grubu', false);
    wp_set_post_terms($post_id, $ders_id ? [$ders_id] : [], 'dersler', false);
    wp_set_post_terms($post_id, $konu_id ? [$konu_id] : [], 'konular', false);
});

// ==========================================
// 4. AJAX UÇ NOKTALARI
// ==========================================
function material_ajax_bagli_dersler() {
    $sinif_id = isset($_POST['sinif_id']) ? intval($_POST['sinif_id']) : 0;
    
    // Eğer admin panelindeysek (ve id istiyorsak) kontrolü
    $is_admin = isset($_POST['is_admin']) && $_POST['is_admin'] == 1;

    $dersler = get_terms([
        'taxonomy'   => 'dersler',
        'hide_empty' => false,
        'meta_query' => [
            [
                'key'   => 'bagli_sinif',
                'value' => $sinif_id
            ]
        ]
    ]);
    
    echo '<option value="">-- Ders Seç --</option>';
    if (!is_wp_error($dersler)) {
        foreach($dersler as $ders) {
            $val = $is_admin ? esc_attr($ders->term_id) : esc_attr($ders->slug);
            echo '<option value="' . $val . '" data-id="' . esc_attr($ders->term_id) . '">' . esc_html($ders->name) . '</option>';
        }
    }
    wp_die();
}
// Giris yapmamis ziyaretciler de arama sayfasindaki ders filtresini kullaniyor.
add_action('wp_ajax_get_bagli_dersler', 'material_ajax_bagli_dersler');
add_action('wp_ajax_nopriv_get_bagli_dersler', 'material_ajax_bagli_dersler');

add_action('wp_ajax_get_bagli_konular', function() {
    $ders_id = isset($_POST['ders_id']) ? intval($_POST['ders_id']) : 0;
    $is_admin = isset($_POST['is_admin']) && $_POST['is_admin'] == 1;

    $konular = get_terms([
        'taxonomy'   => 'konular',
        'hide_empty' => false,
        'meta_query' => [
            [
                'key'   => 'bagli_ders',
                'value' => $ders_id
            ]
        ]
    ]);
    
    echo '<option value="">-- Konu Seç --</option>';
    if (!is_wp_error($konular)) {
        foreach($konular as $konu) {
            $val = $is_admin ? esc_attr($konu->term_id) : esc_attr($konu->slug);
            echo '<option value="' . $val . '" data-id="' . esc_attr($konu->term_id) . '">' . esc_html($konu->name) . '</option>';
        }
    }
    wp_die();
});
add_action('wp_ajax_nopriv_get_bagli_konular', 'wp_ajax_get_bagli_konular');

// ==========================================
// 5. ADMIN TABLOLARINA ÖZEL SÜTUNLAR EKLENMESİ
// ==========================================

// Dersler Tablosu
add_filter('manage_edit-dersler_columns', function($columns) {
    $new_columns = [];
    foreach($columns as $key => $value) {
        if ($key === 'posts') {
            $new_columns['bagli_sinif'] = 'Bağlı Olduğu Sınıf';
        }
        $new_columns[$key] = $value;
    }
    return $new_columns;
});

add_filter('manage_dersler_custom_column', function($content, $column_name, $term_id) {
    if ($column_name === 'bagli_sinif') {
        $sinif_id = get_term_meta($term_id, 'bagli_sinif', true);
        if ($sinif_id) {
            $sinif = get_term($sinif_id);
            if (!is_wp_error($sinif) && $sinif) {
                return esc_html($sinif->name);
            }
        }
        return '<span style="color:#aaa;">-</span>';
    }
    return $content;
}, 10, 3);

// Konular Tablosu
add_filter('manage_edit-konular_columns', function($columns) {
    $new_columns = [];
    foreach($columns as $key => $value) {
        if ($key === 'posts') {
            $new_columns['bagli_sinif'] = 'Bağlı Olduğu Sınıf';
            $new_columns['bagli_ders'] = 'Bağlı Olduğu Ders';
        }
        $new_columns[$key] = $value;
    }
    return $new_columns;
});

add_filter('manage_konular_custom_column', function($content, $column_name, $term_id) {
    if ($column_name === 'bagli_sinif') {
        $ders_id = get_term_meta($term_id, 'bagli_ders', true);
        if ($ders_id) {
            $sinif_id = get_term_meta($ders_id, 'bagli_sinif', true);
            if ($sinif_id) {
                $sinif = get_term($sinif_id);
                if (!is_wp_error($sinif) && $sinif) {
                    return esc_html($sinif->name);
                }
            }
        }
        return '<span style="color:#aaa;">-</span>';
    }
    if ($column_name === 'bagli_ders') {
        $ders_id = get_term_meta($term_id, 'bagli_ders', true);
        if ($ders_id) {
            $ders = get_term($ders_id);
            if (!is_wp_error($ders) && $ders) {
                return esc_html($ders->name);
            }
        }
        return '<span style="color:#aaa;">-</span>';
    }
    return $content;
}, 10, 3);

// Materyaller Tablosu
add_filter('manage_materyaller_posts_columns', function($columns) {
    $new_columns = [];
    foreach($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['tax_sinif'] = 'Sınıf';
            $new_columns['tax_ders']  = 'Ders';
            $new_columns['tax_konu']  = 'Konu';
        }
    }
    return $new_columns;
});

add_action('manage_materyaller_posts_custom_column', function($column, $post_id) {
    if ($column === 'tax_sinif') {
        $terms = get_the_terms($post_id, 'sinif_grubu');
        if (!empty($terms) && !is_wp_error($terms)) {
            echo esc_html($terms[0]->name);
        } else {
            echo '<span style="color:#aaa;">-</span>';
        }
    }
    if ($column === 'tax_ders') {
        $terms = get_the_terms($post_id, 'dersler');
        if (!empty($terms) && !is_wp_error($terms)) {
            echo esc_html($terms[0]->name);
        } else {
            echo '<span style="color:#aaa;">-</span>';
        }
    }
    if ($column === 'tax_konu') {
        $terms = get_the_terms($post_id, 'konular');
        if (!empty($terms) && !is_wp_error($terms)) {
            echo esc_html($terms[0]->name);
        } else {
            echo '<span style="color:#aaa;">-</span>';
        }
    }
}, 10, 2);
