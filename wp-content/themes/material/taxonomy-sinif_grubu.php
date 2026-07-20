<?php
/**
 * Sinif gruplari taksonomi sablonu.
 * Hiyerarsi: Sinif -> Ders -> Konu -> Materyal.
 *
 * @package Material
 */

get_header();

$material_term  = get_queried_object();
$material_ders  = isset( $_GET['ders'] ) ? sanitize_text_field( wp_unslash( $_GET['ders'] ) ) : '';
$material_konu  = isset( $_GET['konu'] ) ? sanitize_text_field( wp_unslash( $_GET['konu'] ) ) : '';

// Alt siniflar (orn. Lise -> 9, 10, 11).
$material_children = get_terms( array(
	'taxonomy'   => 'sinif_grubu',
	'parent'     => $material_term->term_id,
	'hide_empty' => false,
) );

if ( ! is_wp_error( $material_children ) && ! empty( $material_children ) ) {
	usort( $material_children, function ( $a, $b ) {
		$order_a = (int) get_term_meta( $a->term_id, 'sinif_grubu_order', true );
		$order_b = (int) get_term_meta( $b->term_id, 'sinif_grubu_order', true );

		return $order_a === $order_b ? strnatcmp( $a->name, $b->name ) : $order_a - $order_b;
	} );
}

// Baslik ve breadcrumb icin secili terimler.
$material_ders_term = $material_ders ? get_term_by( 'slug', $material_ders, 'dersler' ) : null;
$material_konu_term = $material_konu ? get_term_by( 'slug', $material_konu, 'konular' ) : null;

if ( $material_konu_term ) {
	$material_heading = $material_konu_term->name . ' Materyalleri';
} elseif ( $material_ders_term ) {
	$material_heading = $material_ders_term->name . ' Konuları';
} else {
	$material_heading = $material_term->name;
}
?>

<header class="relative isolate overflow-hidden border-b border-dune/50 bg-sand py-16 text-center lg:py-20">
	<div class="absolute -left-20 -top-20 -z-10 h-72 w-72 rounded-full bg-olive-500/5 blur-3xl"></div>
	<div class="absolute -bottom-24 -right-20 -z-10 h-72 w-72 rounded-full bg-sunset-500/5 blur-3xl"></div>

	<div class="<?php material_the_class( 'shell' ); ?>">

		<?php // ---------- Breadcrumb ---------- ?>
		<nav class="inline-flex flex-wrap items-center gap-2 rounded-full bg-olive-500/10 px-4 py-2 text-sm font-semibold text-olive-600" aria-label="Yol">
			<svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
				<path d="M19.9 9.75A2.25 2.25 0 0 0 17.7 8H10.5l-1.6-1.9a2.25 2.25 0 0 0-1.72-.8H4.5A2.25 2.25 0 0 0 2.25 7.55v9.2A2.25 2.25 0 0 0 4.5 19h13.13c1 0 1.87-.66 2.14-1.62l1.6-5.63c.4-1.42-.66-2.83-2.14-2.83h-.5l.17.83Z"/>
			</svg>

			<a href="<?php echo esc_url( get_term_link( $material_term ) ); ?>" class="transition-colors hover:text-olive-700">
				<?php echo esc_html( $material_term->name ); ?>
			</a>

			<?php if ( $material_ders_term ) : ?>
				<span class="text-olive-500/40">/</span>
				<a href="<?php echo esc_url( add_query_arg( 'ders', $material_ders, get_term_link( $material_term ) ) ); ?>" class="transition-colors hover:text-olive-700">
					<?php echo esc_html( $material_ders_term->name ); ?>
				</a>
			<?php endif; ?>

			<?php if ( $material_konu_term ) : ?>
				<span class="text-olive-500/40">/</span>
				<span class="text-slate"><?php echo esc_html( $material_konu_term->name ); ?></span>
			<?php endif; ?>
		</nav>

		<h1 class="<?php material_the_class( 'title', 'mt-5 text-3xl sm:text-4xl lg:text-5xl' ); ?>">
			<?php echo esc_html( $material_heading ); ?>
		</h1>
		<div class="mx-auto mt-5 h-1 w-16 rounded-full bg-olive-500"></div>
	</div>
</header>

<div class="<?php material_the_class( 'section', 'min-h-[50vh] bg-cream' ); ?>">
	<div class="<?php material_the_class( 'shell' ); ?>">

		<?php if ( ! empty( $material_children ) && ! is_wp_error( $material_children ) ) : ?>

			<?php // ---------- ASAMA 1: alt siniflar ---------- ?>
			<ul class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
				<?php foreach ( $material_children as $material_child ) : ?>
					<li>
						<a href="<?php echo esc_url( get_term_link( $material_child ) ); ?>" class="group block rounded-2xl border border-olive-500/10 bg-white px-8 py-10 text-center shadow-card transition-all duration-300 hover:-translate-y-1.5 hover:shadow-lift">
							<div class="mx-auto flex h-[70px] w-[70px] items-center justify-center rounded-[18px] bg-gradient-to-br from-olive-500/10 to-sunset-500/10 text-olive-500 transition-transform duration-300 group-hover:scale-110">
								<svg class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
									<path d="M12 3 1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3Zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9ZM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72Z"/>
								</svg>
							</div>
							<h2 class="mt-5 font-display text-xl font-bold text-ink"><?php echo esc_html( $material_child->name ); ?></h2>
							<span class="mt-2.5 inline-flex items-center gap-1.5 text-sm font-semibold text-sunset-500">
								Kategoriyi İncele
								<svg class="h-4 w-4 transition-transform group-hover:translate-x-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 0 1 .02-1.06L11.168 10 7.23 6.29a.75.75 0 1 1 1.04-1.08l4.5 4.25a.75.75 0 0 1 0 1.08l-4.5 4.25a.75.75 0 0 1-1.06-.02Z" clip-rule="evenodd"/>
								</svg>
							</span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>

		<?php
		else :

			// ---------- Alt sinif yok: ders > konu > materyal ----------
			$material_tax_query = array(
				'relation' => 'AND',
				array( 'taxonomy' => 'sinif_grubu', 'field' => 'term_id', 'terms' => $material_term->term_id ),
			);

			if ( $material_ders ) {
				$material_tax_query[] = array( 'taxonomy' => 'dersler', 'field' => 'slug', 'terms' => $material_ders );
			}
			if ( $material_konu ) {
				$material_tax_query[] = array( 'taxonomy' => 'konular', 'field' => 'slug', 'terms' => $material_konu );
			}

			$material_posts = get_posts( array(
				'post_type'      => 'materyaller',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'tax_query'      => $material_tax_query, // phpcs:ignore WordPress.DB.SlowDBQuery
			) );

			/**
			 * Sonuc kumesinde gecen taksonomi terimlerini toplar.
			 */
			$material_collect = function ( $posts, $taxonomy ) {
				$ids = array();
				foreach ( $posts as $p ) {
					$terms = wp_get_post_terms( $p->ID, $taxonomy, array( 'fields' => 'ids' ) );
					if ( ! is_wp_error( $terms ) ) {
						foreach ( $terms as $id ) {
							$ids[ $id ] = true;
						}
					}
				}
				return array_keys( $ids );
			};
			?>

			<?php if ( empty( $material_ders ) ) : ?>

				<?php // ---------- ASAMA 2: dersler ---------- ?>
				<?php $material_ders_ids = $material_collect( $material_posts, 'dersler' ); ?>

				<?php if ( ! empty( $material_ders_ids ) ) : ?>
					<ul class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
						<?php foreach ( get_terms( array( 'taxonomy' => 'dersler', 'include' => $material_ders_ids, 'hide_empty' => false ) ) as $material_d ) : ?>
							<li>
								<a
									href="<?php echo esc_url( add_query_arg( 'ders', $material_d->slug, get_term_link( $material_term ) ) ); ?>"
									class="group block rounded-2xl border-l-4 border-sunset-500 bg-white px-6 py-7 text-center shadow-card transition-all duration-300 hover:-translate-y-1 hover:shadow-lift"
								>
									<h2 class="text-lg font-bold text-ink"><?php echo esc_html( $material_d->name ); ?></h2>
									<span class="mt-2.5 inline-flex items-center gap-1.5 text-[13px] text-slate/80">
										Konuları Gör
										<svg class="h-3.5 w-3.5 transition-transform group-hover:translate-x-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
											<path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 0 1 .02-1.06L11.168 10 7.23 6.29a.75.75 0 1 1 1.04-1.08l4.5 4.25a.75.75 0 0 1 0 1.08l-4.5 4.25a.75.75 0 0 1-1.06-.02Z" clip-rule="evenodd"/>
										</svg>
									</span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php else : ?>
					<p class="rounded-2xl bg-white px-6 py-14 text-center text-slate shadow-card">
						Bu sınıfa ait henüz ders veya materyal eklenmemiş.
					</p>
				<?php endif; ?>

			<?php elseif ( empty( $material_konu ) ) : ?>

				<?php // ---------- ASAMA 3: konular ---------- ?>
				<?php $material_konu_ids = $material_collect( $material_posts, 'konular' ); ?>

				<?php if ( ! empty( $material_konu_ids ) ) : ?>
					<ul class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
						<?php foreach ( get_terms( array( 'taxonomy' => 'konular', 'include' => $material_konu_ids, 'hide_empty' => false ) ) as $material_k ) : ?>
							<li>
								<a
									href="<?php echo esc_url( add_query_arg( array( 'ders' => $material_ders, 'konu' => $material_k->slug ), get_term_link( $material_term ) ) ); ?>"
									class="flex items-center justify-between gap-4 rounded-xl bg-white px-6 py-5 shadow-card transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lift"
								>
									<span class="font-semibold text-ink"><?php echo esc_html( $material_k->name ); ?></span>
									<span class="flex shrink-0 items-center gap-1 rounded-full bg-olive-500/10 px-3 py-1.5 text-xs font-bold text-olive-600">
										Materyaller
										<svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
											<path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 0 1 .02-1.06L11.168 10 7.23 6.29a.75.75 0 1 1 1.04-1.08l4.5 4.25a.75.75 0 0 1 0 1.08l-4.5 4.25a.75.75 0 0 1-1.06-.02Z" clip-rule="evenodd"/>
										</svg>
									</span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php else : ?>
					<p class="rounded-2xl bg-white px-6 py-14 text-center text-slate shadow-card">Bu derse ait konu bulunamadı.</p>
				<?php endif; ?>

			<?php else : ?>

				<?php // ---------- ASAMA 4: materyaller ---------- ?>
				<?php if ( ! empty( $material_posts ) ) : ?>
					<ul class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
						<?php foreach ( $material_posts as $post ) : setup_postdata( $post );
							$material_tur = material_first_term_name( get_the_ID(), 'materyal_turu' );
							$material_tur = $material_tur ? $material_tur : 'Döküman';
							?>
							<li class="relative flex flex-col rounded-2xl bg-white p-8 shadow-card transition-all duration-300 hover:-translate-y-1.5 hover:shadow-lift">
								<svg class="absolute right-5 top-5 h-6 w-6 text-olive-500/20" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.6c0-1.14-.9-2.06-2-2.06h-2.5a1.5 1.5 0 0 1-1.5-1.5V5.56c0-1.14-.9-2.06-2-2.06H8.25m3.75 0H6.9c-.77 0-1.4.65-1.4 1.44v15.12c0 .8.63 1.44 1.4 1.44h10.2c.77 0 1.4-.65 1.4-1.44V10.5A7 7 0 0 0 12 3.5Z"/>
								</svg>

								<span class="w-fit rounded-full bg-olive-500 px-3 py-1 text-xs font-bold text-white">
									<?php echo esc_html( $material_tur ); ?>
								</span>

								<h2 class="mt-4 font-display text-xl font-bold leading-snug text-ink">
									<a href="<?php the_permalink(); ?>" class="transition-colors hover:text-olive-600"><?php the_title(); ?></a>
								</h2>

								<p class="mt-3 flex-1 text-sm leading-relaxed text-slate">
									<?php echo esc_html( wp_trim_words( get_the_content(), 15 ) ); ?>
								</p>

								<a href="<?php the_permalink(); ?>" class="mt-6 block rounded-xl bg-sunset-500/10 py-3 text-center font-bold text-sunset-600 transition-colors hover:bg-sunset-500 hover:text-white">
									İncele &amp; İndir
								</a>
							</li>
						<?php endforeach;
						wp_reset_postdata(); ?>
					</ul>
				<?php else : ?>
					<p class="rounded-2xl bg-white px-6 py-14 text-center text-slate shadow-card">Bu konuya ait henüz materyal yüklenmemiş.</p>
				<?php endif; ?>

			<?php endif; ?>

		<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>
