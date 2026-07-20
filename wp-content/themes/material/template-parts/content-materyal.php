<?php
/**
 * Materyal kart bileseni (grid gorunumu).
 *
 * Materyallerin cogunda one cikan gorsel olmadigi icin kart gorsele
 * dayanmiyor: gorsel varsa ustte gosteriliyor, yoksa kart tur ikonu ve
 * rozetlerle kendi basina duruyor.
 *
 * @package Material
 */

$material_tur   = material_first_term_name( get_the_ID(), 'materyal_turu' );
$material_sinif = material_first_term_name( get_the_ID(), 'sinif_grubu' );
$material_ders  = material_first_term_name( get_the_ID(), 'dersler' );
$material_konu  = material_first_term_name( get_the_ID(), 'konular' );
?>

<article <?php post_class( material_class( 'card', material_class( 'card-hover', 'group flex flex-col' ) ) ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="block aspect-[16/10] overflow-hidden bg-sand">
			<?php the_post_thumbnail( 'medium_large', array( 'class' => 'h-full w-full object-cover transition-transform duration-500 group-hover:scale-105' ) ); ?>
		</a>
	<?php endif; ?>

	<div class="flex flex-1 flex-col p-6">

		<div class="flex items-start justify-between gap-4">
			<div class="flex flex-wrap gap-2">
				<?php if ( $material_sinif ) : ?>
					<span class="<?php material_the_class( 'badge', material_class( 'badge-olive' ) ); ?>"><?php echo esc_html( $material_sinif ); ?></span>
				<?php endif; ?>
				<?php if ( $material_ders ) : ?>
					<span class="<?php material_the_class( 'badge', material_class( 'badge-sunset' ) ); ?>"><?php echo esc_html( $material_ders ); ?></span>
				<?php endif; ?>
			</div>

			<?php // Tur ikonu: gorsel olmayan kartlara gorsel bir cipa veriyor. ?>
			<span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-olive-500/10 text-olive-500 transition-colors group-hover:bg-olive-500 group-hover:text-white">
				<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.6c0-1.14-.9-2.06-2-2.06h-2.5a1.5 1.5 0 0 1-1.5-1.5V5.56c0-1.14-.9-2.06-2-2.06H8.25m3.75 0H6.9c-.77 0-1.4.65-1.4 1.44v15.12c0 .8.63 1.44 1.4 1.44h10.2c.77 0 1.4-.65 1.4-1.44V10.5A7 7 0 0 0 12 3.5Z"/>
				</svg>
			</span>
		</div>

		<h2 class="mt-4 font-display text-xl font-bold leading-snug text-ink">
			<a href="<?php the_permalink(); ?>" class="transition-colors hover:text-olive-600"><?php the_title(); ?></a>
		</h2>

		<?php $material_excerpt = wp_trim_words( get_the_excerpt(), 18 ); ?>
		<?php if ( $material_excerpt ) : ?>
			<p class="mt-2.5 flex-1 text-sm leading-relaxed text-slate">
				<?php echo esc_html( $material_excerpt ); ?>
			</p>
		<?php else : ?>
			<div class="flex-1"></div>
		<?php endif; ?>

		<div class="mt-5 flex flex-wrap items-center justify-between gap-3 border-t border-dune/60 pt-4">
			<span class="flex min-w-0 items-center gap-1.5 text-xs text-slate/80">
				<?php if ( $material_tur ) : ?>
					<svg class="h-3.5 w-3.5 shrink-0 text-olive-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
						<path fill-rule="evenodd" d="M5.25 2.25a3 3 0 0 0-3 3v4.32c0 .8.32 1.56.88 2.12l9 9a3 3 0 0 0 4.24 0l4.32-4.32a3 3 0 0 0 0-4.24l-9-9a3 3 0 0 0-2.12-.88H5.25Zm2.25 5.25a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" clip-rule="evenodd"/>
					</svg>
					<span class="truncate"><?php echo esc_html( $material_konu ? $material_konu : $material_tur ); ?></span>
				<?php endif; ?>
			</span>

			<a href="<?php the_permalink(); ?>" class="inline-flex shrink-0 items-center gap-1.5 text-sm font-bold text-olive-600 transition-colors hover:text-olive-700">
				İncele
				<svg class="h-4 w-4 transition-transform group-hover:translate-x-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
					<path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 0 1 .02-1.06L11.168 10 7.23 6.29a.75.75 0 1 1 1.04-1.08l4.5 4.25a.75.75 0 0 1 0 1.08l-4.5 4.25a.75.75 0 0 1-1.06-.02Z" clip-rule="evenodd"/>
				</svg>
			</a>
		</div>
	</div>
</article>
