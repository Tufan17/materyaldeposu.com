# WordPress SEO Kural Dosyası (v1)

> **Amaç:** Bu dosyayı yeni bir WordPress projesine başlarken Claude'a ver.
> Claude bu kurallara uyarak temayı/projeyi SEO'yu merkeze alarak kurar.
> Felsefe: **"Az eklenti, doğru kod"** — SEO'yu plugin şişkinliğine değil,
> WP core native özelliklerine + temiz tema koduna yaslar.

---

## 0. TEMEL PRENSİP

1. **WP core native SEO'yu bozma.** Modern WordPress (5.5+) zaten şunları verir:
   - Otomatik XML sitemap → `/wp-sitemap.xml`
   - Otomatik `rel=canonical` (singular sayfalarda)
   - Otomatik `meta robots`
   Bunları devre dışı bırakma; üzerine ekle.
2. **SEO eklentisi opsiyoneldir.** Basit/orta projede Yoast/RankMath **gerekmez**;
   bu kurallar elle daha hafif bir sonuç verir. Sadece çok sayıda editör içerik
   giriyorsa (meta alanları GUI'den yönetilecekse) hafif bir SEO eklentisi düşün.
3. **`add_theme_support('title-tag')` her zaman aç.** Statik `<title>` yazma.
4. **`wp_head()` ve `wp_footer()` mutlaka çağrılmalı.** Yoksa hiçbir meta/analitik çalışmaz.

---

## 1. META YÖNETİMİ (zorunlu)

`header.php` içinde sayfa tipine göre **dinamik meta description** üret:

```php
<meta name="description" content="<?php
if (is_front_page() || is_home()) {
    echo esc_attr(get_bloginfo('description'));
} elseif (is_singular()) {
    $post = get_post();
    if ($post && $post->post_excerpt) {
        echo esc_attr(wp_strip_all_tags($post->post_excerpt));
    } elseif ($post) {
        echo esc_attr(wp_trim_words(wp_strip_all_tags($post->post_content), 25));
    }
} elseif (is_category() || is_tag() || is_tax()) {
    echo esc_attr(wp_strip_all_tags(term_description()));
} else {
    echo esc_attr(get_bloginfo('description'));
}
?>" />
```

- Description ~150-160 karakteri geçmesin.
- Her sayfa benzersiz title + description almalı.

---

## 2. OPEN GRAPH + TWITTER CARD (zorunlu — çoğu projede unutulur)

Sosyal paylaşım önizlemesi için `<head>`'e ekle. WhatsApp/LinkedIn/X görselli link ister.

```php
<?php
$og_title = wp_get_document_title();
$og_url   = ( is_singular() ) ? get_permalink() : home_url( add_query_arg( null, null ) );
$og_desc  = is_singular() && get_the_excerpt()
    ? esc_attr( wp_strip_all_tags( get_the_excerpt() ) )
    : esc_attr( get_bloginfo('description') );
$og_img   = ( is_singular() && has_post_thumbnail() )
    ? get_the_post_thumbnail_url( null, 'large' )
    : get_option('site_default_og_image'); // tema ayarından varsayılan görsel
?>
<meta property="og:type" content="<?php echo is_singular() ? 'article' : 'website'; ?>" />
<meta property="og:title" content="<?php echo esc_attr($og_title); ?>" />
<meta property="og:description" content="<?php echo $og_desc; ?>" />
<meta property="og:url" content="<?php echo esc_url($og_url); ?>" />
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<?php if ($og_img): ?>
<meta property="og:image" content="<?php echo esc_url($og_img); ?>" />
<?php endif; ?>
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?php echo esc_attr($og_title); ?>" />
<meta name="twitter:description" content="<?php echo $og_desc; ?>" />
<?php if ($og_img): ?>
<meta name="twitter:image" content="<?php echo esc_url($og_img); ?>" />
<?php endif; ?>
```

---

## 3. STRUCTURED DATA / JSON-LD (zorunlu — en büyük rich-snippet kazancı)

`wp_head` hook'una JSON-LD bas. En az şunları ekle:

### 3a. Organization / LocalBusiness (her sayfada)
```php
add_action('wp_head', function () {
    $schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'Organization', // yerel işletme ise 'LocalBusiness'
        'name'     => get_bloginfo('name'),
        'url'      => home_url('/'),
        'logo'     => get_option('site_logo_url'),
        // LocalBusiness ise: 'telephone', 'address' (PostalAddress), 'openingHours', 'geo'
    ];
    echo '<script type="application/ld+json">'
        . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        . '</script>';
});
```

### 3b. Article (blog yazılarında — `single.php`)
```php
if (is_singular('post')) {
    $article = [
        '@context'      => 'https://schema.org',
        '@type'         => 'Article',
        'headline'      => get_the_title(),
        'datePublished' => get_the_date('c'),
        'dateModified'  => get_the_modified_date('c'),
        'author'        => ['@type' => 'Person', 'name' => get_the_author()],
        'image'         => get_the_post_thumbnail_url(null, 'full'),
        'mainEntityOfPage' => get_permalink(),
    ];
    // echo <script application/ld+json> ...
}
```

### 3c. FAQPage (SSS içeriği varsa — ZORUNLU, rich result verir)
SSS custom post type / meta alanı varsa mutlaka `FAQPage` şeması üret:
```php
// mainEntity: her soru için ['@type'=>'Question','name'=>..,'acceptedAnswer'=>['@type'=>'Answer','text'=>..]]
```

### 3d. BreadcrumbList (arşiv/derin sayfalarda)
Breadcrumb gösteriyorsan `BreadcrumbList` şeması da ekle.

> **Kural:** Sitede görsel olarak gösterilen SSS / breadcrumb / ürün / yorum varsa,
> karşılığında JSON-LD şeması **her zaman** eklenmeli.

---

## 4. SEMANTİK HTML (zorunlu)

- Her sayfada **tek `<h1>`** (genelde `the_title()`). Alt başlıklar h2 → h3 sırayla, atlama yok.
- `<header>`, `<main>`, `<article>`, `<section>`, `<nav>`, `<aside>`, `<footer>` kullan.
- Butonlara `aria-label`, dekoratif olmayan görsellere anlamlı `alt`.
- Linklerde açıklayıcı metin ("buraya tıkla" değil).

---

## 5. GÖRSEL & PERFORMANS (Core Web Vitals = sıralama)

### 5a. WebP otomatik servis (bu projeden alınan iyi pratik)
Diskte `.webp` versiyonu varsa JPG/PNG yerine onu sun. `wp_get_attachment_url`,
`wp_calculate_image_srcset` ve `the_content` filtrelerine bağla. (Referans: bu projenin
`functions.php` içindeki `uygunusec_serve_webp` fonksiyonu.)

### 5b. Lazy-load & boyut
- Görsellerde `loading="lazy"` (WP zaten ekler, bozma) + `width`/`height` (CLS önler).
- LCP görselini (hero) `loading="eager"` + `fetchpriority="high"` yap, lazy YAPMA.

### 5c. CSS/JS teslimi — ⚠️ KRİTİK KURAL
- **Tailwind'i CDN'den (`cdn.tailwindcss.com`) prodüksiyonda KULLANMA.**
  Render-blocking + JS'te derleme = kötü CWV. Build edip statik CSS enqueue et.
- Google Fonts'u ya self-host et ya da `preconnect` + `font-display: swap` kullan.
- Script'leri `wp_enqueue_script` ile `true` (footer) parametresiyle yükle.

### 5d. Cache
Trafik varsa bir cache katmanı planla (sunucu düzeyi ya da hafif eklenti).
`WP_CACHE` ve object cache'i değerlendir.

---

## 6. URL & SİTE YAPISI

- Permalink yapısı: **Post name** (`/%postname%/`). Tarih/ID tabanlı yapıyı kullanma.
- Slug'lar kısa, anahtar kelime içeren, okunaklı: `/anlasmali-sirketler`, `/kasko-sigortasi`.
- Türkçe içerikte slug ASCII'ye normalize (ş→s, ı→i) — WP bunu yapar, kontrol et.
- İç linkleme: ilgili içerik blokları, kategori/etiket arşivleri, breadcrumb.
- 404 ve yönlendirmeler: eski URL'ler değişiyorsa 301 redirect planla.

---

## 7. INDEXLEME & DOĞRULAMA

- `robots.txt` ve `/wp-sitemap.xml`'i Google Search Console'a gönder.
- GSC doğrulama dosyasını/meta'sını ekle.
- `noindex` gereken sayfaları (teşekkür, sepet, arama sonucu) bilinçli işaretle.
- Analitik: GA4 (`gtag`) + gerekiyorsa GTM `<head>`'e ekle. `wp_head` hook'u üzerinden.
- Staging/geliştirme ortamında **"Arama motorlarını engelle"** açık olsun; canlıya alırken KAPAT.

---

## 8. İÇERİK MİMARİSİ (Custom Post Type / Taxonomy)

- Tekrar eden yapısal içerik (SSS, hizmetler, referanslar) için **Custom Post Type + Taxonomy** kur.
- Bu içerik hem editör dostu olur hem de şema (FAQPage/Service) üretmeyi kolaylaştırır.
- Meta box'larda `wp_nonce_field` + `wp_verify_nonce` + yetki kontrolü + `sanitize_*` zorunlu.

---

## 9. GÜVENLİK (SEO değil ama her projede zorunlu)

- **Şifre/API anahtarı ASLA tema koduna gömülmez.** (SMTP, API vs.)
  `wp-config.php` sabitleri veya ortam değişkeni kullan.
- Tüm çıktılar `esc_html` / `esc_attr` / `esc_url`; tüm girdiler `sanitize_*`.
- `xmlrpc.php` gereksizse kapat; login'i koru; `WP_DEBUG` canlıda `false`.

---

## 10. CLAUDE İÇİN İŞ AKIŞI (bu dosyayı aldığında)

1. **Önce mevcut kodu oku** (Context-First). Var olan tema pattern'ine uy, zorla değiştirme.
2. Yukarıdaki başlıkları bir **checklist** gibi işle; her biri için "var / eksik / eklendi" durumu çıkar.
3. Eksik olan SEO parçalarını (OG, JSON-LD, meta, WebP, semantik HTML) tamamla.
4. Performans risklerini (CDN Tailwind, external font, cache yok) raporla ve düzeltmeyi öner.
5. Güvenlik risklerini (hardcoded secret) mutlaka bildir.
6. Sonunda kısa bir **SEO uyum raporu** ver: neyin tamam, neyin eksik kaldığı.

---

### HIZLI CHECKLIST (kopyalanabilir)

- [ ] `add_theme_support('title-tag')` + `wp_head()`/`wp_footer()`
- [ ] Dinamik meta description (sayfa tipine göre)
- [ ] Open Graph + Twitter Card
- [ ] JSON-LD: Organization/LocalBusiness
- [ ] JSON-LD: Article (blog)
- [ ] JSON-LD: FAQPage (SSS varsa)
- [ ] JSON-LD: BreadcrumbList (breadcrumb varsa)
- [ ] Tek h1 + doğru başlık hiyerarşisi
- [ ] Görsellerde alt + width/height
- [ ] WebP otomatik servis
- [ ] LCP görseli eager + fetchpriority
- [ ] Tailwind build (CDN değil) + font optimizasyonu
- [ ] Permalink = post name, temiz slug
- [ ] İç linkleme + ilgili içerik
- [ ] XML sitemap + GSC + GA4/GTM
- [ ] Cache stratejisi
- [ ] Secret'lar wp-config'te, kodda değil
- [ ] Staging'de noindex, canlıda index
