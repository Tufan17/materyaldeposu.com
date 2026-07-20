<?php
/**
 * Ana sayfa sablonu.
 *
 * @package Material
 */

get_header();

$material_hero_bg = get_theme_mod(
	'hero_image',
	get_template_directory_uri() . '/wp-content/uploads/2023/11/fullscreen-slider.jpg'
);
?>

<?php // ============================ HERO ============================ ?>
<section class="relative isolate overflow-hidden">
	<img
		src="<?php echo esc_url( $material_hero_bg ); ?>"
		alt=""
		class="absolute inset-0 -z-20 h-full w-full object-cover"
		fetchpriority="high"
	>
	<div class="absolute inset-0 -z-10 bg-gradient-to-b from-ink/70 via-ink/55 to-ink/75"></div>

	<?php // pt-* seffaf header'in uzerine binmemesi icin fazladan pay birakiyor. ?>
	<div class="<?php material_the_class( 'shell' ); ?> pb-24 pt-36 text-center lg:pb-32 lg:pt-44">
		<p class="animate-fade-up text-xs font-bold uppercase tracking-[0.3em] text-sunset-300">
			<?php echo esc_html( get_theme_mod( 'hero_eyebrow', 'Materyal Deposu' ) ); ?>
		</p>

		<h1 class="<?php material_the_class( 'title', 'animate-fade-up mx-auto mt-5 max-w-4xl text-4xl text-white sm:text-5xl lg:text-6xl' ); ?>">
			<?php echo esc_html( get_theme_mod( 'hero_title', 'Türkiye’nin En Geniş Dijital Materyal Kütüphanesi' ) ); ?>
		</h1>

		<form
			role="search"
			method="get"
			action="<?php echo esc_url( home_url( '/materyal-arama/' ) ); ?>"
			class="mx-auto mt-10 flex w-full max-w-2xl items-center gap-2 rounded-full bg-white/95 p-2 shadow-lift backdrop-blur"
		>
			<label for="hero-search" class="screen-reader-text">Materyal ara</label>
			<input
				id="hero-search"
				type="search"
				name="q"
				value="<?php echo isset( $_GET['q'] ) ? esc_attr( wp_unslash( $_GET['q'] ) ) : ''; ?>"
				placeholder="Anahtar kelime ara..."
				class="min-w-0 flex-1 border-0 bg-transparent px-5 py-2.5 text-sm text-ink placeholder:text-slate/50 focus:outline-none focus:ring-0"
			>
			<button type="submit" class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-olive-500 text-white transition-colors hover:bg-olive-600">
				<span class="screen-reader-text">Ara</span>
				<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.2-5.2m2.2-5.3a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z"/>
				</svg>
			</button>
		</form>

		<a
			href="<?php echo esc_url( home_url( '/materyal-arama/' ) ); ?>"
			class="group mt-7 inline-flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-sunset-300 transition-colors hover:text-white"
		>
			Tüm Materyalleri Gör
			<svg class="h-4 w-4 transition-transform group-hover:translate-x-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
				<path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 0 1 .02-1.06L11.168 10 7.23 6.29a.75.75 0 1 1 1.04-1.08l4.5 4.25a.75.75 0 0 1 0 1.08l-4.5 4.25a.75.75 0 0 1-1.06-.02Z" clip-rule="evenodd"/>
			</svg>
		</a>

		<?php // --- Sayaclar --- ?>
		<?php
		$material_stats = array(
			array( wp_count_posts( 'materyaller' )->publish, 'Materyal' ),
			array( (int) get_theme_mod( 'stat_members', '1403' ), 'Üye' ),
			array( (int) get_theme_mod( 'stat_authors', '60' ), 'Eğitmen' ),
			array( (int) wp_count_terms( array( 'taxonomy' => 'sinif_grubu', 'hide_empty' => false ) ), 'Kategori' ),
		);
		?>
		<dl class="mx-auto mt-16 grid max-w-4xl grid-cols-2 gap-y-10 lg:grid-cols-4">
			<?php foreach ( $material_stats as $material_stat ) : ?>
				<div class="text-center">
					<dd class="font-display text-4xl font-extrabold text-white lg:text-5xl" data-counter-to="<?php echo esc_attr( (int) $material_stat[0] ); ?>">0</dd>
					<div class="mx-auto my-3 h-0.5 w-12 bg-sunset-500"></div>
					<dt class="text-sm font-semibold uppercase tracking-widest text-white/80"><?php echo esc_html( $material_stat[1] ); ?></dt>
				</div>
			<?php endforeach; ?>
		</dl>
	</div>
</section>

<?php // ======================= ONE CIKAN OZELLIKLER ======================= ?>
<section class="<?php material_the_class( 'section', 'bg-cream' ); ?>">
	<div class="<?php material_the_class( 'shell' ); ?>">
		<?php
		$material_feature_titles = array(
			1 => 'En İyi Simülasyonlar',
			2 => 'Grup Seminerleri',
			3 => 'Analiz Edilmiş Müfredat',
			4 => 'Uygulamalı Eğitim',
		);
		?>
		<ul class="grid grid-cols-2 gap-8 lg:grid-cols-4">
			<?php for ( $material_i = 1; $material_i <= 4; $material_i++ ) :
				$material_custom_icon = get_theme_mod( 'feature_icon_' . $material_i, '' );
				?>
				<li class="group text-center">
					<div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-sand text-sunset-500 shadow-pill transition-all duration-300 group-hover:-translate-y-1.5 group-hover:bg-sunset-500 group-hover:text-white group-hover:shadow-lift">
						<?php
						if ( $material_custom_icon ) {
							echo wp_kses_post( $material_custom_icon );
						} else {
							material_icon( 'feature-' . $material_i, 'h-11 w-11' );
						}
						?>
					</div>
					<h3 class="mt-5 text-sm font-bold text-ink sm:text-base">
						<?php echo esc_html( get_theme_mod( 'feature_title_' . $material_i, $material_feature_titles[ $material_i ] ) ); ?>
					</h3>
				</li>
			<?php endfor; ?>
		</ul>
	</div>
</section>

<?php // ======================= SINIF KADEMELERI ======================= ?>
<?php
$material_kademeler = get_terms( array(
	'taxonomy'   => 'sinif_grubu',
	'parent'     => 0,
	'hide_empty' => false,
) );

if ( ! is_wp_error( $material_kademeler ) && ! empty( $material_kademeler ) ) :
	usort( $material_kademeler, function ( $a, $b ) {
		return (int) get_term_meta( $a->term_id, 'sinif_grubu_order', true )
			- (int) get_term_meta( $b->term_id, 'sinif_grubu_order', true );
	} );

	// Kademe dairelerinin donusumlu renkleri.
	$material_kademe_colors = array(
		'bg-sunset-500',
		'bg-azure',
		'bg-olive-400',
		'bg-sky-600',
		'bg-purple-600',
	);
	?>
	<section class="<?php material_the_class( 'section', 'bg-white' ); ?>">
		<div class="<?php material_the_class( 'shell' ); ?>">
			<header class="mb-14 text-center">
				<p class="<?php material_the_class( 'eyebrow' ); ?>">Seviyeni Seç</p>
				<h2 class="<?php material_the_class( 'title', 'mt-3 text-3xl sm:text-4xl' ); ?>">Sınıf Kademeleri</h2>
				<div class="mx-auto mt-5 h-1 w-16 rounded-full bg-olive-500"></div>
			</header>

			<ul class="grid grid-cols-2 gap-8 sm:grid-cols-3 lg:grid-cols-<?php echo esc_attr( min( count( $material_kademeler ), 5 ) ); ?>">
				<?php foreach ( $material_kademeler as $material_index => $material_kademe ) :
					$material_icon_url = get_term_meta( $material_kademe->term_id, 'sinif_grubu_icon_url', true );
					$material_color    = $material_kademe_colors[ $material_index % count( $material_kademe_colors ) ];
					?>
					<li>
						<a href="<?php echo esc_url( get_term_link( $material_kademe ) ); ?>" class="group block text-center">
							<div class="mx-auto flex h-20 w-20 items-center justify-center overflow-hidden rounded-full <?php echo esc_attr( $material_color ); ?> text-white shadow-lift transition-transform duration-300 group-hover:-translate-y-1.5 group-hover:scale-105">
								<?php if ( $material_icon_url ) : ?>
									<img src="<?php echo esc_url( $material_icon_url ); ?>" alt="" class="h-full w-full object-cover">
								<?php else : ?>
									<svg class="h-11 w-11" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
										<path d="M12 3 1 9l3-1.64L12 3ZM12 14.9 3.11 10.06 1 11.22l11 6 11-6-2.11-1.16L12 14.9ZM23 14.77l-11 6-11-6V17l11 6 11-6v-2.23Z"/>
									</svg>
								<?php endif; ?>
							</div>
							<h3 class="mt-4 text-base font-bold text-ink transition-colors group-hover:text-sunset-500">
								<?php echo esc_html( $material_kademe->name ); ?>
							</h3>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
<?php endif; ?>

<?php // ======================= SON MATERYALLER ======================= ?>
<?php
$material_latest = new WP_Query( array(
	'post_type'      => 'materyaller',
	'posts_per_page' => 6,
	'no_found_rows'  => true,
) );

if ( $material_latest->have_posts() ) : ?>
	<section class="<?php material_the_class( 'section', 'bg-cream' ); ?>">
		<div class="<?php material_the_class( 'shell' ); ?>">
			<header class="mb-14 text-center">
				<p class="<?php material_the_class( 'eyebrow' ); ?>">Yeni Eklenenler</p>
				<h2 class="<?php material_the_class( 'title', 'mt-3 text-3xl sm:text-4xl' ); ?>">Son Materyaller</h2>
				<div class="mx-auto mt-5 h-1 w-16 rounded-full bg-olive-500"></div>
			</header>

			<ul class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
				<?php while ( $material_latest->have_posts() ) : $material_latest->the_post(); ?>
					<li><?php get_template_part( 'template-parts/content', 'materyal' ); ?></li>
				<?php endwhile; ?>
			</ul>
		</div>
	</section>
<?php endif;
wp_reset_postdata();
?>

<?php // ======================= MATERYAL PAYLAS CTA ======================= ?>
<section class="<?php material_the_class( 'shell', 'py-8' ); ?>">
	<div class="relative isolate overflow-hidden rounded-card bg-gradient-to-br from-olive-500 to-olive-700 px-6 py-14 text-center text-white shadow-lift sm:px-12">
		<div class="absolute -left-16 -top-24 -z-10 h-72 w-72 rounded-full bg-white/5"></div>
		<div class="absolute -bottom-24 -right-16 -z-10 h-64 w-64 rounded-full bg-white/5"></div>

		<p class="text-xs font-bold uppercase tracking-[0.2em] text-sunset-300">Bilgiyi Çoğaltalım</p>
		<h2 class="<?php material_the_class( 'title', 'mx-auto mt-4 max-w-3xl text-3xl text-white sm:text-4xl' ); ?>">
			Siz de Eğitim Materyallerinizi Paylaşın!
		</h2>
		<p class="mx-auto mt-4 max-w-2xl text-base leading-relaxed text-white/90">
			Elinizdeki dökümanları, testleri ve notları diğer öğrencilerimiz ve öğretmenlerimizle
			paylaşarak büyüyen bilgi havuzumuza katkıda bulunun.
		</p>
		<a href="<?php echo esc_url( home_url( '/materyal-paylas/' ) ); ?>" class="<?php material_the_class( 'btn', material_class( 'btn-white', 'mt-8' ) ); ?>">
			Hemen Materyal Ekle
			<svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
				<path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 0 1 .02-1.06L11.168 10 7.23 6.29a.75.75 0 1 1 1.04-1.08l4.5 4.25a.75.75 0 0 1 0 1.08l-4.5 4.25a.75.75 0 0 1-1.06-.02Z" clip-rule="evenodd"/>
			</svg>
		</a>
	</div>
</section>

<?php // ======================= YAKLASAN ETKINLIKLER ======================= ?>
<?php
$material_events = new WP_Query( array(
	'post_type'      => 'etkinlik',
	'posts_per_page' => 3,
	'post_status'    => 'publish',
	'no_found_rows'  => true,
) );

if ( $material_events->have_posts() ) : ?>
	<section class="<?php material_the_class( 'section', 'bg-white' ); ?>">
		<div class="<?php material_the_class( 'shell' ); ?>">
			<header class="mb-14 text-center">
				<p class="<?php material_the_class( 'eyebrow' ); ?>">Takvim</p>
				<h2 class="<?php material_the_class( 'title', 'mt-3 text-3xl sm:text-4xl' ); ?>">Yaklaşan Etkinlikler</h2>
				<div class="mx-auto mt-5 h-1 w-16 rounded-full bg-olive-500"></div>
			</header>

			<ul class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
				<?php while ( $material_events->have_posts() ) : $material_events->the_post(); ?>
					<li class="flex flex-col rounded-2xl border-l-4 border-olive-500 bg-white p-7 shadow-card transition-all duration-300 hover:-translate-y-1.5 hover:shadow-lift">
						<p class="text-xs font-bold uppercase tracking-widest text-sunset-500">Yakında</p>
						<h3 class="mt-3 font-display text-xl font-bold leading-snug text-ink">
							<?php the_title(); ?>
						</h3>
						<p class="mt-4 flex-1 text-sm leading-relaxed text-slate">
							<?php echo esc_html( wp_trim_words( get_the_excerpt(), 15 ) ); ?>
						</p>
						<a href="<?php the_permalink(); ?>" class="mt-6 inline-flex w-fit items-center gap-1.5 border-b-2 border-olive-500/30 pb-0.5 text-sm font-semibold text-olive-600 transition-colors hover:border-olive-500">
							Detayları İncele
							<svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
								<path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 0 1 .02-1.06L11.168 10 7.23 6.29a.75.75 0 1 1 1.04-1.08l4.5 4.25a.75.75 0 0 1 0 1.08l-4.5 4.25a.75.75 0 0 1-1.06-.02Z" clip-rule="evenodd"/>
							</svg>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</section>
<?php endif;
wp_reset_postdata();
?>

<?php // ======================= BLOGDAN SON YAZILAR ======================= ?>
<?php
$material_posts = new WP_Query( array(
	'post_type'           => 'post',
	'posts_per_page'      => 3,
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
	'no_found_rows'       => true,
) );

if ( $material_posts->have_posts() ) : ?>
	<section class="<?php material_the_class( 'section', 'bg-cream' ); ?>">
		<div class="<?php material_the_class( 'shell' ); ?>">
			<header class="mb-14 text-center">
				<p class="<?php material_the_class( 'eyebrow' ); ?>">Günlük</p>
				<h2 class="<?php material_the_class( 'title', 'mt-3 text-3xl sm:text-4xl' ); ?>">Blogdan Son Yazılar</h2>
				<div class="mx-auto mt-5 h-1 w-16 rounded-full bg-olive-500"></div>
			</header>

			<ul class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
				<?php while ( $material_posts->have_posts() ) : $material_posts->the_post(); ?>
					<li><?php get_template_part( 'template-parts/content', 'blog' ); ?></li>
				<?php endwhile; ?>
			</ul>

			<?php
			// Yazilar sayfasi Customizer'da atanmissa onu, degilse /blog/ kullan.
			$material_blog_url = get_option( 'page_for_posts' )
				? get_permalink( get_option( 'page_for_posts' ) )
				: home_url( '/blog/' );
			?>
			<div class="mt-12 text-center">
				<a href="<?php echo esc_url( $material_blog_url ); ?>" class="<?php material_the_class( 'btn', material_class( 'btn-outline' ) ); ?>">
					Tüm Yazıları Gör
					<svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
						<path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 0 1 .02-1.06L11.168 10 7.23 6.29a.75.75 0 1 1 1.04-1.08l4.5 4.25a.75.75 0 0 1 0 1.08l-4.5 4.25a.75.75 0 0 1-1.06-.02Z" clip-rule="evenodd"/>
					</svg>
				</a>
			</div>
		</div>
	</section>
<?php endif;
wp_reset_postdata();
?>

<?php // ======================= NASIL CALISIR (4 ADIM) ======================= ?>
<?php
$material_steps = array(
	array( 'step1_title', 'İstediğiniz Eğitimi Bulun', 'step1_desc', 'Size en uygun olan eğitim içeriklerini detaylı filtreleme seçeneklerimizle hemen bulun.' ),
	array( 'step2_title', 'Örnek Dersleri İnceleyin', 'step2_desc', 'Karar vermeden önce örnek ders videolarını izleyerek eğitmenlerimiz ve içerik hakkında bilgi sahibi olun.' ),
	array( 'step3_title', 'Müfredata Göz Atın', 'step3_desc', 'Eğitimin içeriğini, işlenecek konuları ve kazanımları detaylı müfredat sayfamızdan önceden görün.' ),
	array( 'step4_title', 'Eğitime Kayıt Olun', 'step4_desc', 'Seçtiğiniz eğitime güvenli ödeme yöntemleriyle kolayca kayıt olun ve öğrenmeye hemen başlayın.' ),
);
?>
<section class="<?php material_the_class( 'section', 'bg-sand' ); ?>">
	<div class="<?php material_the_class( 'shell' ); ?>">
		<header class="mb-14 text-center">
			<p class="<?php material_the_class( 'eyebrow' ); ?>">Nasıl Çalışır</p>
			<h2 class="<?php material_the_class( 'title', 'mt-3 text-3xl sm:text-4xl' ); ?>">Dört Adımda Başlayın</h2>
			<div class="mx-auto mt-5 h-1 w-16 rounded-full bg-olive-500"></div>
		</header>

		<ol class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
			<?php foreach ( $material_steps as $material_index => $material_step ) : ?>
				<li class="group relative rounded-2xl bg-white p-7 shadow-card transition-all duration-300 hover:-translate-y-1.5 hover:shadow-lift">
					<div class="flex items-center justify-between">
						<span class="font-display text-4xl font-extrabold text-olive-100 transition-colors group-hover:text-olive-200">
							<?php echo esc_html( sprintf( '%02d', $material_index + 1 ) ); ?>
						</span>
						<span class="text-olive-500">
							<?php material_icon( 'step-' . ( $material_index + 1 ), 'h-8 w-8' ); ?>
						</span>
					</div>
					<h3 class="mt-4 font-display text-lg font-bold leading-snug text-ink">
						<?php echo esc_html( get_theme_mod( $material_step[0], $material_step[1] ) ); ?>
					</h3>
					<p class="mt-3 text-sm leading-relaxed text-slate">
						<?php echo esc_html( get_theme_mod( $material_step[2], $material_step[3] ) ); ?>
					</p>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>

<?php // ======================= ILETISIM DAVETI ======================= ?>
<section class="<?php material_the_class( 'section', 'bg-cream' ); ?>">
	<div class="<?php material_the_class( 'shell' ); ?>">
		<div class="mx-auto max-w-3xl text-center">
			<h2 class="<?php material_the_class( 'title', 'text-3xl sm:text-4xl' ); ?>">
				<?php echo esc_html( get_theme_mod( 'nl_title', 'Bizimle İletişime Geçin' ) ); ?>
			</h2>
			<div class="mx-auto mt-5 h-1 w-16 rounded-full bg-olive-500"></div>
			<p class="mt-6 text-base leading-relaxed text-slate">
				<?php echo esc_html( get_theme_mod( 'nl_desc', 'Eğitimlerimizden ve gelişmelerden haberdar olmak için e-posta bültenimize abone olabilirsiniz. Size sadece en önemli güncellemeleri göndereceğiz.' ) ); ?>
			</p>
			<a href="<?php echo esc_url( home_url( '/iletisim/' ) ); ?>" class="<?php material_the_class( 'btn', material_class( 'btn-primary', 'mt-8' ) ); ?>">
				İletişim Formu
			</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
