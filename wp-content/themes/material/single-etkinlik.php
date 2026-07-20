<?php
/**
 * Template Name: Etkinlik Detay Sayfası
 * Description: Etkinlik (Custom Post Type) icin detay sablonu.
 *
 * @package Material
 */

get_header(); ?>

<div class="<?php material_the_class( 'section', 'bg-cream' ); ?>">
	<div class="mx-auto w-full max-w-3xl px-5 lg:px-8">

		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'rounded-card bg-white p-8 shadow-card sm:p-12' ); ?>>

				<header class="text-center">
					<span class="<?php material_the_class( 'badge', material_class( 'badge-sunset', 'uppercase tracking-widest' ) ); ?>">
						<svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3a.75.75 0 0 1 1.5 0v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9H3.75v7.5c0 .83.67 1.5 1.5 1.5h13.5c.83 0 1.5-.67 1.5-1.5v-7.5Z" clip-rule="evenodd"/>
						</svg>
						Etkinlik Detayı
					</span>

					<h1 class="<?php material_the_class( 'title', 'mt-6 text-3xl sm:text-4xl lg:text-5xl' ); ?>">
						<?php the_title(); ?>
					</h1>

					<div class="mt-7 flex flex-wrap items-center justify-center gap-6 border-y border-dune/60 py-4 text-sm text-slate/80">
						<span class="flex items-center gap-2">
							<svg class="h-4 w-4 text-olive-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
								<path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3a.75.75 0 0 1 1.5 0v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9H3.75v7.5c0 .83.67 1.5 1.5 1.5h13.5c.83 0 1.5-.67 1.5-1.5v-7.5Z" clip-rule="evenodd"/>
							</svg>
							<?php echo esc_html( get_the_date( 'd F Y' ) ); ?>
						</span>
						<span class="flex items-center gap-2">
							<svg class="h-4 w-4 text-olive-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
								<path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.75 20.1a8.25 8.25 0 0 1 16.5 0 .75.75 0 0 1-.44.7 18.7 18.7 0 0 1-15.62 0 .75.75 0 0 1-.44-.7Z" clip-rule="evenodd"/>
							</svg>
							<?php the_author(); ?>
						</span>
					</div>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="mt-10 overflow-hidden rounded-2xl shadow-lift">
						<?php the_post_thumbnail( 'full', array( 'class' => 'block h-auto w-full' ) ); ?>
					</div>
				<?php endif; ?>

				<div class="<?php material_the_class( 'prose', 'mt-10' ); ?>">
					<?php the_content(); ?>
				</div>

				<footer class="mt-12 border-t border-dune/60 pt-8 text-center">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="<?php material_the_class( 'btn', material_class( 'btn-primary' ) ); ?>">
						<svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 0 1-.02 1.06L8.832 10l3.938 3.71a.75.75 0 1 1-1.04 1.08l-4.5-4.25a.75.75 0 0 1 0-1.08l4.5-4.25a.75.75 0 0 1 1.06.02Z" clip-rule="evenodd"/>
						</svg>
						Ana Sayfaya Dön
					</a>
				</footer>
			</article>
		<?php endwhile; ?>

	</div>
</div>

<?php get_footer(); ?>
