<?php
/**
 * Template Name: Materyaller Sayfası
 * Description: Materyaller arsiv sablonu (ana materyal sayfasi).
 *
 * @package Material
 */

get_header();

// En ust seviye kademeler (Ilkokul, Ortaokul, Lise ...).
$material_kademeler = get_terms( array(
	'taxonomy'   => 'sinif_grubu',
	'parent'     => 0,
	'hide_empty' => false,
) );

if ( ! is_wp_error( $material_kademeler ) ) {
	usort( $material_kademeler, function ( $a, $b ) {
		return (int) get_term_meta( $a->term_id, 'sinif_grubu_order', true )
			- (int) get_term_meta( $b->term_id, 'sinif_grubu_order', true );
	} );
}

get_template_part( 'template-parts/page-header', null, array(
	'eyebrow' => 'Eğitim Materyalleri',
	'title'   => 'Tüm Materyaller',
	'lead'    => 'İhtiyacınız olan eğitim kademesini seçerek ilgili sınıf seviyelerine ve materyallere ulaşabilirsiniz.',
) );
?>

<div class="<?php material_the_class( 'section', 'bg-cream' ); ?>">
	<div class="<?php material_the_class( 'shell' ); ?>">

		<?php // ---------- Kademe kartlari ---------- ?>
		<?php if ( ! empty( $material_kademeler ) && ! is_wp_error( $material_kademeler ) ) : ?>
			<ul class="mb-20 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
				<?php foreach ( $material_kademeler as $material_kademe ) :
					$material_icon_url = get_term_meta( $material_kademe->term_id, 'sinif_grubu_icon_url', true );
					?>
					<li>
						<a href="<?php echo esc_url( get_term_link( $material_kademe ) ); ?>" class="group relative block overflow-hidden rounded-card border border-olive-500/10 bg-white px-8 py-12 text-center shadow-card transition-all duration-300 hover:-translate-y-2 hover:border-olive-500/30 hover:shadow-lift">

							<span class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-olive-500 to-sunset-500"></span>

							<div class="mx-auto flex h-24 w-24 items-center justify-center overflow-hidden rounded-3xl bg-gradient-to-br from-olive-500/10 to-sunset-500/10 text-olive-500 transition-transform duration-300 group-hover:rotate-6 group-hover:scale-110">
								<?php if ( $material_icon_url ) : ?>
									<img src="<?php echo esc_url( $material_icon_url ); ?>" alt="" class="h-full w-full object-cover">
								<?php else : ?>
									<svg class="h-11 w-11" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
										<path d="M12 3 1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3Z"/>
									</svg>
								<?php endif; ?>
							</div>

							<h2 class="mt-6 font-display text-2xl font-bold text-ink">
								<?php echo esc_html( $material_kademe->name ); ?>
							</h2>

							<span class="mt-4 inline-flex items-center gap-2 rounded-full bg-olive-50 px-6 py-2.5 text-[15px] font-semibold text-olive-600 transition-colors group-hover:bg-gradient-to-r group-hover:from-olive-500 group-hover:to-sunset-500 group-hover:text-white">
								Sınıfları Gör
								<svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 0 1 .02-1.06L11.168 10 7.23 6.29a.75.75 0 1 1 1.04-1.08l4.5 4.25a.75.75 0 0 1 0 1.08l-4.5 4.25a.75.75 0 0 1-1.06-.02Z" clip-rule="evenodd"/>
								</svg>
							</span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<?php
		// ---------- Son eklenen materyaller ----------
		// Sayfa sablonu oldugumuz icin ana sorgu sayfanin kendisini dondurur;
		// materyalleri ayri sorgulamak gerekiyor.
		$material_query = new WP_Query( array(
			'post_type'      => 'materyaller',
			'post_status'    => 'publish',
			'posts_per_page' => 12,
			'paged'          => max( 1, get_query_var( 'paged' ) ),
		) );
		?>
		<?php if ( $material_query->have_posts() ) : ?>
			<h2 class="mb-8 border-b-2 border-olive-500/20 pb-4 font-display text-2xl font-bold text-ink sm:text-3xl">
				Son Eklenen Materyaller
			</h2>

			<div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
				<?php while ( $material_query->have_posts() ) : $material_query->the_post(); ?>
					<?php get_template_part( 'template-parts/content', 'materyal' ); ?>
				<?php endwhile; ?>
			</div>

			<?php
			material_pagination( $material_query );
			wp_reset_postdata();
			?>

		<?php else : ?>
			<div class="rounded-card bg-white px-6 py-20 text-center shadow-card">
				<svg class="mx-auto h-16 w-16 text-dune" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.6c0-1.14-.9-2.06-2-2.06h-2.5a1.5 1.5 0 0 1-1.5-1.5V5.56c0-1.14-.9-2.06-2-2.06H8.25m3.75 0H6.9c-.77 0-1.4.65-1.4 1.44v15.12c0 .8.63 1.44 1.4 1.44h10.2c.77 0 1.4-.65 1.4-1.44V10.5A7 7 0 0 0 12 3.5Z"/>
				</svg>
				<h3 class="mt-6 font-display text-2xl font-bold text-ink">Henüz Materyal Yok</h3>
				<p class="mt-2 text-slate">Sisteme henüz materyal eklenmemiş.</p>
			</div>
		<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>
