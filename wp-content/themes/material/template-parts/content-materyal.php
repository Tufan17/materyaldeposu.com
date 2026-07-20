<?php
/**
 * Materyal kart bileseni (grid gorunumu).
 *
 * @package Material
 */

$material_tur   = material_first_term_name( get_the_ID(), 'materyal_turu' );
$material_sinif = material_first_term_name( get_the_ID(), 'sinif_grubu' );
$material_ders  = material_first_term_name( get_the_ID(), 'dersler' );
?>

<article <?php post_class( material_class( 'card', material_class( 'card-hover', 'flex flex-col' ) ) ); ?>>

	<a href="<?php the_permalink(); ?>" class="block overflow-hidden">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="aspect-[16/10] overflow-hidden bg-sand">
				<?php the_post_thumbnail( 'medium_large', array( 'class' => 'h-full w-full object-cover transition-transform duration-500 hover:scale-105' ) ); ?>
			</div>
		<?php else : ?>
			<div class="flex aspect-[16/10] items-center justify-center bg-gradient-to-br from-olive-50 to-sand text-olive-500">
				<svg class="h-14 w-14" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.6c0-1.14-.9-2.06-2-2.06h-2.5a1.5 1.5 0 0 1-1.5-1.5V5.56c0-1.14-.9-2.06-2-2.06H8.25m3.75 0H6.9c-.77 0-1.4.65-1.4 1.44v15.12c0 .8.63 1.44 1.4 1.44h10.2c.77 0 1.4-.65 1.4-1.44V10.5A7 7 0 0 0 12 3.5Z"/>
				</svg>
			</div>
		<?php endif; ?>
	</a>

	<div class="flex flex-1 flex-col p-6">

		<div class="mb-4 flex flex-wrap gap-2">
			<?php if ( $material_tur ) : ?>
				<span class="<?php material_the_class( 'badge', material_class( 'badge-olive' ) ); ?>"><?php echo esc_html( $material_tur ); ?></span>
			<?php endif; ?>
			<?php if ( $material_sinif ) : ?>
				<span class="<?php material_the_class( 'badge', material_class( 'badge-azure' ) ); ?>"><?php echo esc_html( $material_sinif ); ?></span>
			<?php endif; ?>
			<?php if ( $material_ders ) : ?>
				<span class="<?php material_the_class( 'badge', material_class( 'badge-sunset' ) ); ?>"><?php echo esc_html( $material_ders ); ?></span>
			<?php endif; ?>
		</div>

		<h2 class="font-display text-xl font-bold leading-snug text-ink">
			<a href="<?php the_permalink(); ?>" class="transition-colors hover:text-olive-600"><?php the_title(); ?></a>
		</h2>

		<p class="mt-3 flex-1 text-sm leading-relaxed text-slate">
			<?php echo esc_html( wp_trim_words( get_the_excerpt(), 15 ) ); ?>
		</p>

		<a href="<?php the_permalink(); ?>" class="<?php material_the_class( 'btn', material_class( 'btn-primary', 'mt-6 w-full' ) ); ?>">
			Materyali İncele
		</a>
	</div>
</article>
