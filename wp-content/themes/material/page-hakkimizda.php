<?php
/**
 * Template Name: Hakkımızda Sayfası
 * Description: Hakkimizda sayfasi icin ozel sablon.
 *
 * @package Material
 */

get_header();

$material_hero_title    = get_theme_mod( 'hakkimizda_hero_title', 'Hakkımızda' );
$material_hero_subtitle = get_theme_mod( 'hakkimizda_hero_subtitle', 'Eğitimde kaliteyi ve yenilikçiliği bir araya getiriyoruz.' );
$material_hero_bg       = get_theme_mod( 'hakkimizda_hero_bg', get_template_directory_uri() . '/wp-content/uploads/2023/11/lms-banner1.jpg' );

$material_about_title = get_theme_mod( 'hakkimizda_about_title', 'Biz Kimiz?' );
$material_about_text  = get_theme_mod( 'hakkimizda_about_text', 'Müfredat Materyal Havuzu olarak, eğitimcilere ve öğrencilere en kaliteli kaynakları sunmayı amaçlıyoruz. Deneyimli ekibimiz, modern eğitim anlayışıyla hazırlanmış materyalleri sizlere ulaştırmak için çalışmaktadır. Her geçen gün büyüyen arşivimizle, eğitimin her alanında ihtiyaç duyulan kaynaklara kolayca erişim sağlıyoruz.' );
$material_about_image = get_theme_mod( 'hakkimizda_about_image', get_template_directory_uri() . '/wp-content/uploads/2023/11/lms-banner2.jpg' );

// Misyon / vizyon / degerler kartlari.
$material_principles = array(
	array(
		'title' => get_theme_mod( 'hakkimizda_mission_title', 'Misyonumuz' ),
		'text'  => get_theme_mod( 'hakkimizda_mission_text', 'Eğitimcilere ve öğrencilere dünya standartlarında, güncel ve erişilebilir materyal kaynakları sunarak eğitim kalitesini artırmak.' ),
		'icon'  => 'M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82ZM12 3 1 9l11 6 9-4.91V17h2V9L12 3Z',
	),
	array(
		'title' => get_theme_mod( 'hakkimizda_vision_title', 'Vizyonumuz' ),
		'text'  => get_theme_mod( 'hakkimizda_vision_text', 'Türkiye\'nin en kapsamlı ve yenilikçi eğitim materyalleri platformu olmak, her öğretmenin ve öğrencinin ilk tercih ettiği kaynak merkezi haline gelmek.' ),
		'icon'  => 'M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5ZM12 17a5 5 0 1 1 0-10 5 5 0 0 1 0 10Zm0-8a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z',
	),
	array(
		'title' => get_theme_mod( 'hakkimizda_values_title', 'Değerlerimiz' ),
		'text'  => get_theme_mod( 'hakkimizda_values_text', 'Kalite, yenilikçilik, erişilebilirlik ve sürekli gelişim ilkelerimizle eğitim dünyasına katkıda bulunmak en önemli değerimizdir.' ),
		'icon'  => 'M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35Z',
	),
);

// Istatistikler.
$material_stats = array(
	array(
		'number' => get_theme_mod( 'hakkimizda_stat1_number', '500+' ),
		'label'  => get_theme_mod( 'hakkimizda_stat1_label', 'Materyal' ),
		'icon'   => 'M21 5c-1.11-.35-2.33-.5-3.5-.5-1.95 0-4.05.4-5.5 1.5-1.45-1.1-3.55-1.5-5.5-1.5S2.45 4.9 1 6v14.65c0 .25.25.5.5.5.1 0 .15-.05.25-.05C3.1 20.45 5.05 20 6.5 20c1.95 0 4.05.4 5.5 1.5 1.35-.85 3.8-1.5 5.5-1.5 1.65 0 3.35.3 4.75 1.05.1.05.15.05.25.05.25 0 .5-.25.5-.5V6c-.6-.45-1.25-.75-2-1Z',
	),
	array(
		'number' => get_theme_mod( 'hakkimizda_stat2_number', '1200+' ),
		'label'  => get_theme_mod( 'hakkimizda_stat2_label', 'Kullanıcı' ),
		'icon'   => 'M16 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-8 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5Zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5Z',
	),
	array(
		'number' => get_theme_mod( 'hakkimizda_stat3_number', '50+' ),
		'label'  => get_theme_mod( 'hakkimizda_stat3_label', 'Eğitimci' ),
		'icon'   => 'M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82ZM12 3 1 9l11 6 9-4.91V17h2V9L12 3Z',
	),
	array(
		'number' => get_theme_mod( 'hakkimizda_stat4_number', '30+' ),
		'label'  => get_theme_mod( 'hakkimizda_stat4_label', 'Ders Alanı' ),
		'icon'   => 'M12 11.55C9.64 9.35 6.48 8 3 8v11c3.48 0 6.64 1.35 9 3.55 2.36-2.19 5.52-3.55 9-3.55V8c-3.48 0-6.64 1.35-9 3.55ZM12 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z',
	),
);

// Kilometre taslari.
$material_milestones = array_values( array_filter( array(
	array( 'year' => get_theme_mod( 'hakkimizda_milestone1_year', '2020' ), 'text' => get_theme_mod( 'hakkimizda_milestone1_text', 'Projemiz ilk temellerini attı ve eğitim materyalleri dijitalleştirilmeye başlandı.' ) ),
	array( 'year' => get_theme_mod( 'hakkimizda_milestone2_year', '2022' ), 'text' => get_theme_mod( 'hakkimizda_milestone2_text', 'Platform genişleyerek binlerce öğretmen ve öğrenciye ulaştı.' ) ),
	array( 'year' => get_theme_mod( 'hakkimizda_milestone3_year', '2024' ), 'text' => get_theme_mod( 'hakkimizda_milestone3_text', 'Yapay zeka destekli öneri sistemi ve gelişmiş arama altyapısı devreye alındı.' ) ),
), function ( $m ) {
	return ! empty( $m['year'] );
} ) );

// Ekip.
$material_team = array_values( array_filter( array(
	array( 'name' => get_theme_mod( 'hakkimizda_team1_name', '' ), 'role' => get_theme_mod( 'hakkimizda_team1_title', '' ), 'image' => get_theme_mod( 'hakkimizda_team1_image', '' ) ),
	array( 'name' => get_theme_mod( 'hakkimizda_team2_name', '' ), 'role' => get_theme_mod( 'hakkimizda_team2_title', '' ), 'image' => get_theme_mod( 'hakkimizda_team2_image', '' ) ),
	array( 'name' => get_theme_mod( 'hakkimizda_team3_name', '' ), 'role' => get_theme_mod( 'hakkimizda_team3_title', '' ), 'image' => get_theme_mod( 'hakkimizda_team3_image', '' ) ),
), function ( $m ) {
	return ! empty( $m['name'] );
} ) );

$material_cta_title  = get_theme_mod( 'hakkimizda_cta_title', 'Hemen Başlayın' );
$material_cta_text   = get_theme_mod( 'hakkimizda_cta_text', 'Binlerce materyale erişim sağlayın ve eğitim deneyiminizi üst seviyeye taşıyın.' );
$material_cta_btn    = get_theme_mod( 'hakkimizda_cta_button_text', 'Materyalleri Keşfet' );
$material_cta_url    = get_theme_mod( 'hakkimizda_cta_button_url', home_url( '/materyaller/' ) );

// Scroll-reveal: JS opacity-0/translate siniflarini kaldirinca gecis calisir.
$material_reveal = 'opacity-0 translate-y-8 transition-all duration-700 ease-out';
$material_pop    = 'opacity-0 scale-95 transition-all duration-700 ease-out';
?>

<?php // ==================== HERO ==================== ?>
<section class="relative isolate overflow-hidden">
	<img src="<?php echo esc_url( $material_hero_bg ); ?>" alt="" class="absolute inset-0 -z-20 h-full w-full object-cover">
	<div class="absolute inset-0 -z-10 bg-gradient-to-br from-ink/85 via-olive-900/80 to-ink/85"></div>

	<?php // pt-* seffaf header'in uzerine binmemesi icin fazladan pay birakiyor. ?>
	<div class="<?php material_the_class( 'shell' ); ?> pb-28 pt-36 text-center lg:pb-36 lg:pt-44">
		<p data-reveal class="<?php echo esc_attr( $material_reveal ); ?> inline-flex items-center gap-2.5 rounded-full border border-white/15 bg-white/10 px-5 py-2 text-sm font-semibold text-white backdrop-blur">
			<span class="h-2 w-2 animate-pulse rounded-full bg-sunset-400"></span>
			Müfredat Materyal Havuzu
		</p>

		<h1 data-reveal data-reveal-delay="120" class="<?php echo esc_attr( $material_reveal ); ?> <?php material_the_class( 'title', 'mt-7 text-4xl text-white sm:text-5xl lg:text-6xl' ); ?>">
			<?php echo esc_html( $material_hero_title ); ?>
		</h1>

		<p data-reveal data-reveal-delay="240" class="<?php echo esc_attr( $material_reveal ); ?> mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-white/85">
			<?php echo esc_html( $material_hero_subtitle ); ?>
		</p>
	</div>

	<svg class="absolute inset-x-0 bottom-0 h-12 w-full text-cream sm:h-20" viewBox="0 0 1440 80" preserveAspectRatio="none" fill="currentColor" aria-hidden="true">
		<path d="M0 40C240 80 480 0 720 40C960 80 1200 0 1440 40V80H0V40Z"/>
	</svg>
</section>

<?php // ==================== BIZ KIMIZ ==================== ?>
<section class="<?php material_the_class( 'section', 'bg-cream' ); ?>">
	<div class="<?php material_the_class( 'shell' ); ?>">
		<div class="grid items-center gap-14 lg:grid-cols-2">

			<div data-reveal class="<?php echo esc_attr( $material_reveal ); ?> relative">
				<div class="absolute -left-5 -top-5 -z-10 h-full w-full rounded-card border-2 border-olive-500/20"></div>
				<div class="overflow-hidden rounded-card shadow-lift">
					<img src="<?php echo esc_url( $material_about_image ); ?>" alt="<?php echo esc_attr( $material_about_title ); ?>" class="h-full w-full object-cover">
				</div>

				<div data-reveal data-reveal-delay="360" class="<?php echo esc_attr( $material_pop ); ?> absolute -bottom-7 -right-4 flex items-center gap-4 rounded-2xl bg-white px-6 py-5 shadow-lift sm:-right-7">
					<span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-sunset-500/10 text-sunset-500">
						<svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
							<path d="m12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2Z"/>
						</svg>
					</span>
					<span class="leading-tight">
						<strong class="block font-display text-2xl font-extrabold text-ink"><?php echo esc_html( $material_stats[0]['number'] ); ?></strong>
						<span class="text-sm text-slate"><?php echo esc_html( $material_stats[0]['label'] ); ?></span>
					</span>
				</div>
			</div>

			<div>
				<p data-reveal class="<?php echo esc_attr( $material_reveal ); ?> <?php material_the_class( 'eyebrow' ); ?>">Hakkımızda</p>

				<h2 data-reveal data-reveal-delay="120" class="<?php echo esc_attr( $material_reveal ); ?> <?php material_the_class( 'title', 'mt-3 text-3xl sm:text-4xl' ); ?>">
					<?php echo esc_html( $material_about_title ); ?>
				</h2>

				<div data-reveal data-reveal-delay="240" class="<?php echo esc_attr( $material_reveal ); ?> mt-6 text-base leading-relaxed text-slate">
					<?php echo wp_kses_post( wpautop( $material_about_text ) ); ?>
				</div>

				<?php
				$material_features = array(
					array( 'Uzman Kadro', 'M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Zm-2 15-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9Z' ),
					array( 'Zengin İçerik', 'M21 5c-1.11-.35-2.33-.5-3.5-.5-1.95 0-4.05.4-5.5 1.5-1.45-1.1-3.55-1.5-5.5-1.5S2.45 4.9 1 6v14.65c0 .25.25.5.5.5.1 0 .15-.05.25-.05C3.1 20.45 5.05 20 6.5 20c1.95 0 4.05.4 5.5 1.5 1.35-.85 3.8-1.5 5.5-1.5 1.65 0 3.35.3 4.75 1.05.1.05.15.05.25.05.25 0 .5-.25.5-.5V6c-.6-.45-1.25-.75-2-1Z' ),
					array( 'Geniş Topluluk', 'M16 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-8 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5Zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5Z' ),
					array( 'Kolay Erişim', 'M19.35 10.04A7.49 7.49 0 0 0 12 4a7.48 7.48 0 0 0-6.65 4.04A5.99 5.99 0 0 0 0 14a6 6 0 0 0 6 6h13a5 5 0 0 0 .35-9.96Z' ),
				);
				?>
				<ul data-reveal data-reveal-delay="360" class="<?php echo esc_attr( $material_reveal ); ?> mt-8 grid gap-4 sm:grid-cols-2">
					<?php foreach ( $material_features as $material_feature ) : ?>
						<li class="flex items-center gap-3 rounded-xl border border-dune/60 bg-white px-5 py-4">
							<span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-olive-500/10 text-olive-500">
								<svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
									<path d="<?php echo esc_attr( $material_feature[1] ); ?>"/>
								</svg>
							</span>
							<span class="text-sm font-semibold text-ink"><?php echo esc_html( $material_feature[0] ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</section>

<?php // ==================== TEMEL ILKELER ==================== ?>
<section class="<?php material_the_class( 'section', 'bg-white' ); ?>">
	<div class="<?php material_the_class( 'shell' ); ?>">
		<header class="mb-14 text-center">
			<p data-reveal class="<?php echo esc_attr( $material_reveal ); ?> <?php material_the_class( 'eyebrow' ); ?>">Neden Biz?</p>
			<h2 data-reveal data-reveal-delay="120" class="<?php echo esc_attr( $material_reveal ); ?> <?php material_the_class( 'title', 'mt-3 text-3xl sm:text-4xl' ); ?>">Temel İlkelerimiz</h2>
			<div class="mx-auto mt-5 h-1 w-16 rounded-full bg-olive-500"></div>
		</header>

		<ul class="grid gap-8 lg:grid-cols-3">
			<?php foreach ( $material_principles as $material_index => $material_principle ) : ?>
				<li
					data-reveal data-reveal-delay="<?php echo esc_attr( $material_index * 120 ); ?>"
					class="<?php echo esc_attr( $material_pop ); ?> group rounded-card border border-olive-500/10 bg-cream/50 p-9 shadow-card hover:-translate-y-2 hover:shadow-lift"
				>
					<span class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-olive-500 to-olive-600 text-white shadow-pill transition-transform duration-300 group-hover:scale-110">
						<svg class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
							<path d="<?php echo esc_attr( $material_principle['icon'] ); ?>"/>
						</svg>
					</span>
					<h3 class="mt-6 font-display text-2xl font-bold text-ink"><?php echo esc_html( $material_principle['title'] ); ?></h3>
					<p class="mt-3 text-base leading-relaxed text-slate"><?php echo wp_kses_post( $material_principle['text'] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<?php // ==================== ISTATISTIKLER ==================== ?>
<section class="relative isolate overflow-hidden bg-gradient-to-br from-olive-800 to-ink py-20 lg:py-28">
	<div class="absolute -left-32 -top-32 -z-10 h-96 w-96 rounded-full bg-olive-500/20 blur-3xl"></div>
	<div class="absolute -bottom-32 -right-32 -z-10 h-96 w-96 rounded-full bg-sunset-500/15 blur-3xl"></div>

	<div class="<?php material_the_class( 'shell' ); ?>">
		<header class="mb-14 text-center">
			<p data-reveal class="<?php echo esc_attr( $material_reveal ); ?> text-xs font-bold uppercase tracking-[0.2em] text-sunset-300">Rakamlarla Biz</p>
			<h2 data-reveal data-reveal-delay="120" class="<?php echo esc_attr( $material_reveal ); ?> <?php material_the_class( 'title', 'mt-3 text-3xl text-white sm:text-4xl' ); ?>">Büyüyen Topluluğumuz</h2>
		</header>

		<dl class="grid grid-cols-2 gap-8 lg:grid-cols-4">
			<?php foreach ( $material_stats as $material_index => $material_stat ) : ?>
				<div
					data-reveal data-reveal-delay="<?php echo esc_attr( $material_index * 100 ); ?>"
					class="<?php echo esc_attr( $material_pop ); ?> rounded-2xl border border-white/10 bg-white/5 p-7 text-center backdrop-blur"
				>
					<span class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-white/10 text-sunset-300">
						<svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
							<path d="<?php echo esc_attr( $material_stat['icon'] ); ?>"/>
						</svg>
					</span>
					<dd
						class="mt-4 font-display text-4xl font-extrabold text-white"
						data-counter-to="<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $material_stat['number'] ) ); ?>"
						data-counter-suffix="<?php echo esc_attr( preg_replace( '/[0-9]/', '', $material_stat['number'] ) ); ?>"
					>0</dd>
					<dt class="mt-2 text-sm font-semibold uppercase tracking-wider text-white/70"><?php echo esc_html( $material_stat['label'] ); ?></dt>
				</div>
			<?php endforeach; ?>
		</dl>
	</div>
</section>

<?php // ==================== KILOMETRE TASLARI ==================== ?>
<?php if ( ! empty( $material_milestones ) ) : ?>
	<section class="<?php material_the_class( 'section', 'bg-cream' ); ?>">
		<div class="<?php material_the_class( 'shell' ); ?>">
			<header class="mb-14 text-center">
				<p data-reveal class="<?php echo esc_attr( $material_reveal ); ?> <?php material_the_class( 'eyebrow' ); ?>">Yolculuğumuz</p>
				<h2 data-reveal data-reveal-delay="120" class="<?php echo esc_attr( $material_reveal ); ?> <?php material_the_class( 'title', 'mt-3 text-3xl sm:text-4xl' ); ?>">Kilometre Taşlarımız</h2>
				<div class="mx-auto mt-5 h-1 w-16 rounded-full bg-olive-500"></div>
			</header>

			<ol class="relative mx-auto max-w-3xl border-l-2 border-olive-500/20 pl-10">
				<?php foreach ( $material_milestones as $material_index => $material_ms ) : ?>
					<li
						data-reveal data-reveal-delay="<?php echo esc_attr( $material_index * 140 ); ?>"
						class="<?php echo esc_attr( $material_reveal ); ?> relative pb-12 last:pb-0"
					>
						<span class="absolute -left-[3.15rem] flex h-6 w-6 items-center justify-center rounded-full border-4 border-cream bg-olive-500"></span>
						<span class="font-display text-2xl font-extrabold text-sunset-500"><?php echo esc_html( $material_ms['year'] ); ?></span>
						<p class="mt-2 text-base leading-relaxed text-slate"><?php echo wp_kses_post( $material_ms['text'] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>
<?php endif; ?>

<?php // ==================== EKIP ==================== ?>
<?php if ( ! empty( $material_team ) ) : ?>
	<section class="<?php material_the_class( 'section', 'bg-white' ); ?>">
		<div class="<?php material_the_class( 'shell' ); ?>">
			<header class="mb-14 text-center">
				<p data-reveal class="<?php echo esc_attr( $material_reveal ); ?> <?php material_the_class( 'eyebrow' ); ?>">Ekibimiz</p>
				<h2 data-reveal data-reveal-delay="120" class="<?php echo esc_attr( $material_reveal ); ?> <?php material_the_class( 'title', 'mt-3 text-3xl sm:text-4xl' ); ?>">Arkamızdaki Güç</h2>
				<div class="mx-auto mt-5 h-1 w-16 rounded-full bg-olive-500"></div>
			</header>

			<ul class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
				<?php foreach ( $material_team as $material_index => $material_member ) : ?>
					<li
						data-reveal data-reveal-delay="<?php echo esc_attr( $material_index * 120 ); ?>"
						class="<?php echo esc_attr( $material_pop ); ?> rounded-card border border-olive-500/10 bg-cream/50 p-9 text-center shadow-card hover:-translate-y-2 hover:shadow-lift"
					>
						<div class="mx-auto flex h-28 w-28 items-center justify-center overflow-hidden rounded-full bg-olive-500/10 text-olive-500 ring-4 ring-white">
							<?php if ( ! empty( $material_member['image'] ) ) : ?>
								<img src="<?php echo esc_url( $material_member['image'] ); ?>" alt="<?php echo esc_attr( $material_member['name'] ); ?>" class="h-full w-full object-cover">
							<?php else : ?>
								<svg class="h-14 w-14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
									<path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4Z"/>
								</svg>
							<?php endif; ?>
						</div>
						<h3 class="mt-6 font-display text-xl font-bold text-ink"><?php echo esc_html( $material_member['name'] ); ?></h3>
						<?php if ( $material_member['role'] ) : ?>
							<p class="mt-1.5 text-sm font-semibold uppercase tracking-wider text-sunset-500"><?php echo esc_html( $material_member['role'] ); ?></p>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
<?php endif; ?>

<?php // ==================== CTA ==================== ?>
<section class="relative isolate overflow-hidden bg-gradient-to-br from-olive-500 to-olive-700 py-20 text-center text-white lg:py-24">
	<div class="absolute -left-24 -top-32 -z-10 h-96 w-96 rounded-full bg-white/5 blur-3xl"></div>
	<div class="absolute -bottom-32 -right-24 -z-10 h-80 w-80 rounded-full bg-sunset-400/10 blur-3xl"></div>

	<div class="<?php material_the_class( 'shell' ); ?>">
		<h2 data-reveal class="<?php echo esc_attr( $material_reveal ); ?> <?php material_the_class( 'title', 'mx-auto max-w-3xl text-3xl text-white sm:text-4xl' ); ?>">
			<?php echo esc_html( $material_cta_title ); ?>
		</h2>

		<div data-reveal data-reveal-delay="120" class="<?php echo esc_attr( $material_reveal ); ?> mx-auto mt-5 max-w-2xl text-lg leading-relaxed text-white/90">
			<?php echo wp_kses_post( $material_cta_text ); ?>
		</div>

		<a
			href="<?php echo esc_url( $material_cta_url ); ?>"
			data-reveal data-reveal-delay="240"
			class="<?php echo esc_attr( $material_reveal ); ?> <?php material_the_class( 'btn', material_class( 'btn-white', 'mt-9 px-9 py-4 text-base' ) ); ?>"
		>
			<?php echo esc_html( $material_cta_btn ); ?>
			<svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
				<path d="m12 4-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8Z"/>
			</svg>
		</a>
	</div>
</section>

<?php get_footer(); ?>
