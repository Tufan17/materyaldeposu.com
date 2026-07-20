<?php
/**
 * Template Name: Gelişmiş Materyal Arama
 *
 * @package Material
 */

get_header();

$material_q     = isset( $_GET['q'] ) ? sanitize_text_field( wp_unslash( $_GET['q'] ) ) : '';
$material_sinif = isset( $_GET['sinif'] ) ? sanitize_text_field( wp_unslash( $_GET['sinif'] ) ) : '';
$material_ders  = isset( $_GET['ders'] ) ? sanitize_text_field( wp_unslash( $_GET['ders'] ) ) : '';

$material_siniflar = get_terms( array( 'taxonomy' => 'sinif_grubu', 'hide_empty' => false ) );
$material_dersler  = get_terms( array( 'taxonomy' => 'dersler', 'hide_empty' => false ) );

$material_args = array(
	'post_type'      => 'materyaller',
	'post_status'    => 'publish',
	'posts_per_page' => 24,
	'paged'          => max( 1, get_query_var( 'paged' ) ),
	's'              => $material_q,
);

$material_tax_query = array( 'relation' => 'AND' );

if ( $material_sinif ) {
	$material_tax_query[] = array( 'taxonomy' => 'sinif_grubu', 'field' => 'slug', 'terms' => $material_sinif );
}
if ( $material_ders ) {
	$material_tax_query[] = array( 'taxonomy' => 'dersler', 'field' => 'slug', 'terms' => $material_ders );
}
if ( count( $material_tax_query ) > 1 ) {
	$material_args['tax_query'] = $material_tax_query; // phpcs:ignore WordPress.DB.SlowDBQuery
}

$material_results  = new WP_Query( $material_args );
$material_filtered = $material_q || $material_sinif || $material_ders;

// Filtre alanlarinin ortak Tailwind sinifi.
$material_field_class = 'w-full rounded-xl border border-dune bg-white px-4 py-3 text-sm text-ink transition-all placeholder:text-slate/50 focus:border-olive-500 focus:outline-none focus:ring-4 focus:ring-olive-500/10';

get_template_part( 'template-parts/page-header', null, array(
	'eyebrow' => 'Arşiv',
	'title'   => 'Materyal Kütüphanesi',
	'lead'    => 'Aradığınız dökümanlara, slaytlara ve videolara hızlıca ulaşmak için filtreleri kullanın.',
) );
?>

<div class="<?php material_the_class( 'section', 'bg-cream' ); ?>">
	<div class="mx-auto w-full max-w-[1300px] px-5 lg:px-8">
		<div class="flex flex-col items-start gap-10 lg:flex-row">

			<?php // ---------------- Filtre paneli ---------------- ?>
			<aside class="w-full shrink-0 lg:sticky lg:top-28 lg:w-[300px]">
				<div class="rounded-2xl border border-olive-500/10 bg-white p-7 shadow-card">
					<h2 class="mb-6 flex items-center gap-2 border-b-2 border-olive-500/20 pb-3 text-xl font-bold text-ink">
						<svg class="h-5 w-5 text-olive-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M2.6 4.2A1 1 0 0 1 3.5 3.5h13a1 1 0 0 1 .78 1.63l-4.78 5.9v4.22a1 1 0 0 1-.55.9l-3 1.5a1 1 0 0 1-1.45-.9v-5.72L2.72 4.83a1 1 0 0 1-.12-.63Z" clip-rule="evenodd"/>
						</svg>
						Detaylı Arama
					</h2>

					<form method="get" action="<?php echo esc_url( get_permalink() ); ?>" class="space-y-5">

						<div>
							<label for="filtre-q" class="mb-2 block text-sm font-semibold text-slate">Anahtar Kelime</label>
							<input
								id="filtre-q" type="search" name="q"
								value="<?php echo esc_attr( $material_q ); ?>"
								placeholder="Ne arıyorsunuz?"
								class="<?php echo esc_attr( $material_field_class ); ?>"
							>
						</div>

						<div>
							<label for="filter_sinif" class="mb-2 block text-sm font-semibold text-slate">Sınıf Grubu</label>
							<select id="filter_sinif" name="sinif" class="<?php echo esc_attr( $material_field_class ); ?>">
								<option value="">Tüm Sınıflar</option>
								<?php foreach ( $material_siniflar as $material_s ) : ?>
									<option value="<?php echo esc_attr( $material_s->slug ); ?>" data-id="<?php echo esc_attr( $material_s->term_id ); ?>" <?php selected( $material_sinif, $material_s->slug ); ?>>
										<?php echo esc_html( $material_s->name ); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>

						<div>
							<label for="filter_ders" class="mb-2 block text-sm font-semibold text-slate">Ders</label>
							<select id="filter_ders" name="ders" class="<?php echo esc_attr( $material_field_class ); ?>">
								<option value="">Tüm Dersler</option>
								<?php foreach ( $material_dersler as $material_d ) : ?>
									<option value="<?php echo esc_attr( $material_d->slug ); ?>" data-id="<?php echo esc_attr( $material_d->term_id ); ?>" <?php selected( $material_ders, $material_d->slug ); ?>>
										<?php echo esc_html( $material_d->name ); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>

						<button
							type="submit"
							class="w-full rounded-xl bg-gradient-to-r from-olive-600 to-olive-500 py-3.5 text-base font-bold text-white shadow-pill transition-all hover:-translate-y-0.5 hover:shadow-lift"
						>
							Sonuçları Getir
						</button>

						<?php if ( $material_filtered ) : ?>
							<a href="<?php echo esc_url( get_permalink() ); ?>" class="block text-center text-sm font-semibold text-sunset-500 transition-colors hover:text-sunset-600">
								Filtreleri Temizle
							</a>
						<?php endif; ?>
					</form>
				</div>
			</aside>

			<?php // ---------------- Sonuclar ---------------- ?>
			<div class="min-w-0 flex-1">

				<div class="mb-8 flex flex-wrap items-center justify-between gap-4">
					<h2 class="font-display text-2xl font-bold text-ink">Arama Sonuçları</h2>
					<span class="rounded-full bg-sunset-500/10 px-4 py-1.5 text-sm font-bold text-sunset-600">
						<?php echo esc_html( $material_results->found_posts ); ?> Materyal Bulundu
					</span>
				</div>

				<?php if ( $material_results->have_posts() ) : ?>
					<ul class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
						<?php while ( $material_results->have_posts() ) : $material_results->the_post();
							$material_tur = material_first_term_name( get_the_ID(), 'materyal_turu' );
							$material_tur = $material_tur ? $material_tur : 'Döküman';
							?>
							<li class="relative flex flex-col rounded-2xl border border-black/[0.03] bg-white p-6 shadow-card transition-all duration-300 hover:-translate-y-1.5 hover:shadow-lift">
								<svg class="absolute right-5 top-4 h-5 w-5 text-olive-500/20" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.6c0-1.14-.9-2.06-2-2.06h-2.5a1.5 1.5 0 0 1-1.5-1.5V5.56c0-1.14-.9-2.06-2-2.06H8.25m3.75 0H6.9c-.77 0-1.4.65-1.4 1.44v15.12c0 .8.63 1.44 1.4 1.44h10.2c.77 0 1.4-.65 1.4-1.44V10.5A7 7 0 0 0 12 3.5Z"/>
								</svg>

								<span class="w-fit rounded-full bg-olive-500/10 px-2.5 py-1 text-[11px] font-bold text-olive-600">
									<?php echo esc_html( $material_tur ); ?>
								</span>

								<h3 class="mt-3 font-display text-lg font-bold leading-snug text-ink">
									<a href="<?php the_permalink(); ?>" class="transition-colors hover:text-olive-600"><?php the_title(); ?></a>
								</h3>

								<p class="mt-2.5 flex-1 text-sm leading-relaxed text-slate/90">
									<?php echo esc_html( wp_trim_words( get_the_content(), 12 ) ); ?>
								</p>

								<a href="<?php the_permalink(); ?>" class="mt-5 block rounded-xl border border-dune bg-cream/40 py-2.5 text-center text-sm font-semibold text-ink transition-colors hover:border-sunset-500/20 hover:bg-sunset-500/10 hover:text-sunset-600">
									İncele
								</a>
							</li>
						<?php endwhile;
						wp_reset_postdata(); ?>
					</ul>

					<?php material_pagination( $material_results ); ?>

				<?php else : ?>
					<div class="rounded-2xl border border-dashed border-dune bg-white px-6 py-16 text-center">
						<svg class="mx-auto h-12 w-12 text-dune" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.2-5.2m2.2-5.3a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z"/>
						</svg>
						<h3 class="mt-5 font-display text-xl font-bold text-ink">Sonuç Bulunamadı</h3>
						<p class="mt-2 text-slate">Seçtiğiniz filtrelere uygun materyal yok. Lütfen filtreleri değiştirerek tekrar deneyin.</p>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>

<script>
/* Sinif secilince ders listesini daralt. */
( function () {
	var sinif = document.getElementById( 'filter_sinif' );
	var ders  = document.getElementById( 'filter_ders' );

	if ( ! sinif || ! ders || typeof materialAjax === 'undefined' ) {
		return;
	}

	sinif.addEventListener( 'change', function () {
		var option  = sinif.options[ sinif.selectedIndex ];
		var sinifId = option ? option.getAttribute( 'data-id' ) : '';

		if ( ! sinifId ) {
			ders.innerHTML = '<option value="">Tüm Dersler</option>';
			return;
		}

		ders.innerHTML = '<option value="">Yükleniyor...</option>';

		fetch( materialAjax.url, {
			method: 'POST',
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
			body: new URLSearchParams( {
				action: 'get_bagli_dersler',
				sinif_id: sinifId,
				is_admin: '0'
			} )
		} )
			.then( function ( r ) { return r.text(); } )
			.then( function ( html ) {
				ders.innerHTML = html.replace( '-- Ders Seç --', 'Tüm Dersler' );
			} )
			.catch( function () {
				ders.innerHTML = '<option value="">Tüm Dersler</option>';
			} );
	} );
} )();
</script>

<?php get_footer(); ?>
