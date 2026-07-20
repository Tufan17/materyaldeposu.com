<?php
/**
 * Tekil blog yazisi sablonu (yan menulu).
 *
 * @package Material
 */

get_header(); ?>

<div class="relative isolate overflow-hidden bg-cream py-16 lg:py-24">

	<?php // Arka plan susleri. ?>
	<div class="pointer-events-none absolute -left-24 -top-24 -z-10 h-[500px] w-[500px] rounded-full bg-olive-500/[0.06] blur-3xl"></div>
	<div class="pointer-events-none absolute -right-36 bottom-[5%] -z-10 h-96 w-96 rounded-full bg-sunset-500/[0.06] blur-3xl"></div>

	<div class="mx-auto w-full max-w-[1200px] px-5 lg:px-8">
		<?php while ( have_posts() ) : the_post(); ?>

			<div class="flex flex-col items-start gap-10 lg:flex-row">

				<?php // ================= ANA ICERIK ================= ?>
				<article <?php post_class( 'w-full min-w-0 flex-1 overflow-hidden rounded-card border border-olive-500/10 bg-white shadow-card' ); ?>>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="relative h-72 w-full overflow-hidden sm:h-[450px]">
							<?php the_post_thumbnail( 'full', array( 'class' => 'block h-full w-full object-cover' ) ); ?>
							<div class="pointer-events-none absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/40 to-transparent"></div>
						</div>
					<?php endif; ?>

					<header class="relative px-7 pb-8 pt-12 sm:px-12">
						<?php $material_categories = get_the_category(); ?>
						<?php if ( ! empty( $material_categories ) ) : ?>
							<div class="absolute -top-5 left-7 flex flex-wrap gap-2.5 sm:left-12">
								<?php foreach ( $material_categories as $material_category ) : ?>
									<a
										href="<?php echo esc_url( get_category_link( $material_category->term_id ) ); ?>"
										class="rounded-full bg-olive-500 px-4 py-2 text-[13px] font-bold text-white shadow-pill transition-transform hover:-translate-y-0.5"
									>
										<?php echo esc_html( $material_category->name ); ?>
									</a>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<h1 class="<?php material_the_class( 'title', 'text-3xl sm:text-4xl' ); ?>">
							<?php the_title(); ?>
						</h1>

						<div class="mt-6 flex flex-wrap items-center gap-5 border-t border-dune/60 pt-5 text-sm text-slate/80">
							<span class="flex items-center gap-2.5">
								<?php echo get_avatar( get_the_author_meta( 'ID' ), 32, '', '', array( 'class' => 'rounded-full' ) ); ?>
								<strong class="font-semibold text-ink"><?php the_author(); ?></strong>
							</span>
							<span class="flex items-center gap-2">
								<svg class="h-4 w-4 text-dune" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3a.75.75 0 0 1 1.5 0v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9H3.75v7.5c0 .83.67 1.5 1.5 1.5h13.5c.83 0 1.5-.67 1.5-1.5v-7.5Z" clip-rule="evenodd"/>
								</svg>
								<?php echo esc_html( get_the_date() ); ?>
							</span>
						</div>
					</header>

					<div class="px-7 pb-12 sm:px-12">
						<div class="<?php material_the_class( 'prose', 'prose-lg prose-img:rounded-xl prose-img:shadow-card' ); ?>">
							<?php
							the_content();
							wp_link_pages( array(
								'before' => '<div class="mt-10 border-t border-dune/60 pt-5 font-bold">Sayfalar:',
								'after'  => '</div>',
							) );
							?>
						</div>
					</div>

					<?php // ---------- Etiketler + paylas ---------- ?>
					<?php
					$material_permalink = rawurlencode( get_permalink() );
					$material_the_title = rawurlencode( get_the_title() );

					$material_share = array(
						'Facebook' => array(
							'url'   => 'https://www.facebook.com/sharer/sharer.php?u=' . $material_permalink,
							'class' => 'bg-blue-50 text-[#3b5998] hover:bg-[#3b5998] hover:text-white',
							'path'  => 'M24 12.07C24 5.4 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.05V9.41c0-3.02 1.79-4.69 4.53-4.69 1.31 0 2.68.24 2.68.24v2.97h-1.51c-1.49 0-1.96.93-1.96 1.89v2.25h3.33l-.53 3.49h-2.8V24C19.61 23.1 24 18.1 24 12.07Z',
						),
						'Twitter'  => array(
							'url'   => 'https://twitter.com/intent/tweet?url=' . $material_permalink . '&text=' . $material_the_title,
							'class' => 'bg-sky-50 text-[#1da1f2] hover:bg-[#1da1f2] hover:text-white',
							'path'  => 'M18.9 1.2h3.7l-8.1 9.2 9.5 12.5h-7.4l-5.8-7.6-6.7 7.6H.4l8.6-9.8L0 1.2h7.6l5.2 6.9 6.1-6.9Zm-1.3 19.5h2L6.5 3.3H4.3l13.3 17.4Z',
						),
						'WhatsApp' => array(
							'url'   => 'https://wa.me/?text=' . rawurlencode( get_the_title() . ' - ' . get_permalink() ),
							'class' => 'bg-emerald-50 text-[#25d366] hover:bg-[#25d366] hover:text-white',
							'path'  => 'M17.5 14.4c-.3-.2-1.8-.9-2-1-.3-.1-.5-.2-.7.1-.2.3-.7 1-.9 1.2-.2.2-.3.2-.6.1-.3-.2-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.5-.5c.1-.2.2-.3.3-.5 0-.2 0-.4 0-.5 0-.2-.7-1.6-.9-2.2-.3-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.2.2 2.1 3.3 5.2 4.6.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.1-.3-.2-.6-.4M12 2a10 10 0 0 0-8.5 15.3L2 22.5l5.4-1.4A10 10 0 1 0 12 2Zm0 18.3c-1.6 0-3.2-.4-4.5-1.2l-.3-.2-3.2.8.9-3.1-.2-.3a8.3 8.3 0 1 1 7.3 4Z',
						),
					);

					$material_tags = get_the_tags();
					?>
					<footer class="flex flex-wrap items-center justify-between gap-6 border-t border-dune/60 bg-cream/60 px-7 py-7 sm:px-12">

						<div class="flex min-w-0 flex-1 flex-wrap items-center gap-2">
							<?php if ( $material_tags ) : ?>
								<svg class="mr-1 h-4 w-4 shrink-0 text-olive-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M5.25 2.25a3 3 0 0 0-3 3v4.32c0 .8.32 1.56.88 2.12l9 9a3 3 0 0 0 4.24 0l4.32-4.32a3 3 0 0 0 0-4.24l-9-9a3 3 0 0 0-2.12-.88H5.25Zm2.25 5.25a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" clip-rule="evenodd"/>
								</svg>
								<?php foreach ( $material_tags as $material_tag ) : ?>
									<a
										href="<?php echo esc_url( get_tag_link( $material_tag->term_id ) ); ?>"
										class="rounded-lg border border-dune bg-white px-3.5 py-1.5 text-[13px] text-slate transition-colors hover:border-olive-500 hover:text-olive-600"
									>
										<?php echo esc_html( $material_tag->name ); ?>
									</a>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>

						<div class="flex items-center gap-3">
							<span class="text-sm font-bold text-ink">Paylaş:</span>
							<?php foreach ( $material_share as $material_label => $material_net ) : ?>
								<a
									href="<?php echo esc_url( $material_net['url'] ); ?>"
									target="_blank" rel="noopener noreferrer"
									class="flex h-10 w-10 items-center justify-center rounded-xl transition-colors <?php echo esc_attr( $material_net['class'] ); ?>"
								>
									<span class="screen-reader-text"><?php echo esc_html( $material_label ); ?></span>
									<svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
										<path d="<?php echo esc_attr( $material_net['path'] ); ?>"/>
									</svg>
								</a>
							<?php endforeach; ?>
						</div>
					</footer>

					<?php if ( comments_open() || get_comments_number() ) : ?>
						<div class="px-7 py-10 sm:px-12">
							<?php comments_template(); ?>
						</div>
					<?php endif; ?>
				</article>

				<?php // ================= YAN MENU ================= ?>
				<aside class="w-full shrink-0 lg:sticky lg:top-28 lg:w-[350px]">
					<div class="rounded-2xl border border-olive-500/10 bg-white p-7 shadow-card">
						<h2 class="mb-6 inline-block border-b-2 border-olive-500 pb-3.5 font-display text-2xl font-extrabold text-ink">
							Son Yazılar
						</h2>

						<?php
						$material_recent = new WP_Query( array(
							'post_type'      => 'post',
							'posts_per_page' => 4,
							'post_status'    => 'publish',
							'post__not_in'   => array( get_the_ID() ),
							'no_found_rows'  => true,
						) );
						?>

						<?php if ( $material_recent->have_posts() ) : ?>
							<ul class="flex flex-col gap-5">
								<?php while ( $material_recent->have_posts() ) : $material_recent->the_post(); ?>
									<li>
										<a href="<?php the_permalink(); ?>" class="flex items-center gap-4 transition-transform duration-200 hover:translate-x-1.5">
											<div class="h-[90px] w-[90px] shrink-0 overflow-hidden rounded-xl bg-sand">
												<?php if ( has_post_thumbnail() ) : ?>
													<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'h-full w-full object-cover' ) ); ?>
												<?php else : ?>
													<div class="h-full w-full bg-olive-500/20"></div>
												<?php endif; ?>
											</div>
											<div class="min-w-0 flex-1">
												<h3 class="line-clamp-2 text-[15px] font-bold leading-snug text-ink">
													<?php the_title(); ?>
												</h3>
												<span class="mt-1.5 flex items-center gap-1.5 text-xs text-slate/70">
													<svg class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
														<path fill-rule="evenodd" d="M12 2.25a9.75 9.75 0 1 0 0 19.5 9.75 9.75 0 0 0 0-19.5ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .28.16.54.41.67l4 2a.75.75 0 1 0 .68-1.34l-3.59-1.8V6Z" clip-rule="evenodd"/>
													</svg>
													<?php echo esc_html( get_the_date( 'd M Y' ) ); ?>
												</span>
											</div>
										</a>
									</li>
								<?php endwhile; ?>
							</ul>
						<?php else : ?>
							<p class="text-sm text-slate/70">Farklı bir yazı bulunamadı.</p>
						<?php endif;
						wp_reset_postdata();
						?>
					</div>
				</aside>
			</div>
		<?php endwhile; ?>
	</div>
</div>

<?php get_footer(); ?>
