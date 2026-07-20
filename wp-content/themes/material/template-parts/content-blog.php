<?php
/**
 * Blog yazisi kart bileseni (arsiv/grid gorunumu).
 *
 * @package Material
 */

// Gorseli olmayan yazilar icin donusumlu yedek gorseller.
$material_fallbacks = array( 'blog12.jpg', 'blog11.jpg', 'blog7.jpg', 'lms-banner1.jpg', 'lms-banner2.jpg', 'lms-banner3.jpg' );
$material_fallback  = get_template_directory_uri() . '/wp-content/uploads/2023/11/'
	. $material_fallbacks[ get_the_ID() % count( $material_fallbacks ) ];
?>

<article <?php post_class( material_class( 'card', material_class( 'card-hover', 'flex flex-col' ) ) ); ?>>

	<div class="relative aspect-[16/10] overflow-hidden bg-sand">
		<a href="<?php the_permalink(); ?>" class="block h-full w-full">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'large', array( 'class' => 'h-full w-full object-cover transition-transform duration-500 hover:scale-105' ) ); ?>
			<?php else : ?>
				<img
					src="<?php echo esc_url( $material_fallback ); ?>"
					alt="<?php the_title_attribute(); ?>"
					loading="lazy"
					class="h-full w-full object-cover transition-transform duration-500 hover:scale-105"
				>
			<?php endif; ?>
		</a>

		<time
			datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"
			class="absolute bottom-4 left-4 flex h-14 w-14 flex-col items-center justify-center rounded-xl bg-olive-500 text-white shadow-lift"
		>
			<span class="font-display text-lg font-extrabold leading-none"><?php echo esc_html( get_the_date( 'd' ) ); ?></span>
			<span class="mt-0.5 text-[10px] font-bold uppercase tracking-wider"><?php echo esc_html( get_the_date( 'M' ) ); ?></span>
		</time>
	</div>

	<div class="flex flex-1 flex-col p-6">
		<h2 class="font-display text-xl font-bold leading-snug text-ink">
			<a href="<?php the_permalink(); ?>" class="line-clamp-2 transition-colors hover:text-olive-600">
				<?php the_title(); ?>
			</a>
		</h2>

		<p class="mt-3 flex-1 text-sm leading-relaxed text-slate">
			<?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?>
		</p>

		<div class="mt-5 flex flex-wrap items-center gap-x-4 gap-y-2 border-t border-dune/60 pt-4 text-xs text-slate/80">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="flex items-center gap-1.5 font-semibold transition-colors hover:text-olive-600">
				<svg class="h-3.5 w-3.5 text-olive-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
					<path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.75 20.1a8.25 8.25 0 0 1 16.5 0 .75.75 0 0 1-.44.7 18.7 18.7 0 0 1-15.62 0 .75.75 0 0 1-.44-.7Z" clip-rule="evenodd"/>
				</svg>
				<?php the_author(); ?>
			</a>

			<?php $material_cats = get_the_category(); ?>
			<?php if ( ! empty( $material_cats ) ) : ?>
				<span class="flex flex-wrap items-center gap-1.5">
					<svg class="h-3.5 w-3.5 shrink-0 text-olive-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
						<path fill-rule="evenodd" d="M5.25 2.25a3 3 0 0 0-3 3v4.32c0 .8.32 1.56.88 2.12l9 9a3 3 0 0 0 4.24 0l4.32-4.32a3 3 0 0 0 0-4.24l-9-9a3 3 0 0 0-2.12-.88H5.25Zm2.25 5.25a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" clip-rule="evenodd"/>
					</svg>
					<?php foreach ( $material_cats as $material_cat ) : ?>
						<a href="<?php echo esc_url( get_category_link( $material_cat->term_id ) ); ?>" rel="tag" class="transition-colors hover:text-olive-600">
							<?php echo esc_html( $material_cat->name ); ?>
						</a>
					<?php endforeach; ?>
				</span>
			<?php endif; ?>
		</div>
	</div>
</article>
