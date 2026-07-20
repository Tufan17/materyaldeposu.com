<?php
/**
 * Site alt bilgisi.
 *
 * @package Material
 */

$material_socials = array(
	'Twitter'  => array( get_theme_mod( 'social_twitter', 'https://twitter.com/i/flow/login' ), 'M18.9 1.2h3.7l-8.1 9.2 9.5 12.5h-7.4l-5.8-7.6-6.7 7.6H.4l8.6-9.8L0 1.2h7.6l5.2 6.9 6.1-6.9Zm-1.3 19.5h2L6.5 3.3H4.3l13.3 17.4Z' ),
	'Youtube'  => array( get_theme_mod( 'social_youtube', 'https://www.youtube.com/' ), 'M23.5 6.5a3 3 0 0 0-2.1-2.1C19.5 3.9 12 3.9 12 3.9s-7.5 0-9.4.5A3 3 0 0 0 .5 6.5C0 8.4 0 12 0 12s0 3.6.5 5.5a3 3 0 0 0 2.1 2.1c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.1c.5-1.9.5-5.5.5-5.5s0-3.6-.5-5.5ZM9.6 15.6V8.4l6.2 3.6-6.2 3.6Z' ),
	'Facebook' => array( get_theme_mod( 'social_facebook', 'https://www.facebook.com/' ), 'M24 12.07C24 5.4 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.05V9.41c0-3.02 1.79-4.69 4.53-4.69 1.31 0 2.68.24 2.68.24v2.97h-1.51c-1.49 0-1.96.93-1.96 1.89v2.25h3.33l-.53 3.49h-2.8V24C19.61 23.1 24 18.1 24 12.07Z' ),
	'Skype'    => array( get_theme_mod( 'social_skype', 'https://www.skype.com/en/' ), 'M21.7 14.4a9.9 9.9 0 0 0 .2-2 9.9 9.9 0 0 0-11.5-9.8A5.7 5.7 0 0 0 2.3 10a9.9 9.9 0 0 0 11.4 11.6 5.7 5.7 0 0 0 8-7.2ZM12.2 18c-3.3 0-4.8-1.6-4.8-2.9 0-.6.5-1.1 1.2-1.1 1.6 0 1.2 2.3 3.6 2.3 1.2 0 1.9-.7 1.9-1.4 0-.4-.2-.9-1-1.1l-2.7-.7c-2.2-.5-2.6-1.7-2.6-2.9 0-2.4 2.3-3.3 4.4-3.3 2 0 4.3 1.1 4.3 2.5 0 .6-.5 1-1.2 1-1.3 0-1.1-1.8-3.4-1.8-1.1 0-1.7.5-1.7 1.2s.9 1 1.6 1.2l2 .4c2.2.5 2.8 1.8 2.8 3.1 0 1.9-1.5 3.5-4.4 3.5Z' ),
);
?>

	</main><?php // #main ?>

	<footer class="mt-auto bg-sand text-slate">

		<div class="flex justify-center pt-12">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img
					src="<?php echo esc_url( material_logo_url() ); ?>"
					alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
					width="98" height="98"
					class="h-16 w-auto"
				>
			</a>
		</div>

		<div class="mx-auto grid max-w-shell gap-10 px-5 py-12 sm:grid-cols-2 lg:grid-cols-4 lg:px-8">

			<?php // --- Hakkimizda --- ?>
			<section>
				<h2 class="mb-5 font-display text-xl font-bold text-ink"><?php echo esc_html( get_theme_mod( 'footer_about_title', 'Hakkımızda' ) ); ?></h2>
				<div class="space-y-3 text-sm leading-relaxed">
					<p><?php echo esc_html( get_theme_mod( 'footer_about_p1', 'Eğitim alanında öncü, yenilikçi ve kaliteli içerikler sunmayı hedefleyen platformumuza hoş geldiniz.' ) ); ?></p>
					<p><?php echo esc_html( get_theme_mod( 'footer_about_p2', 'Öğrencilerimiz ve öğretmenlerimiz için en güncel materyalleri tek bir çatı altında topluyoruz.' ) ); ?></p>
				</div>
				<a
					href="<?php echo esc_url( home_url( '/materyaller/' ) ); ?>"
					class="mt-6 inline-flex items-center rounded-md border-2 border-olive-500 px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-olive-600 transition-colors hover:bg-olive-500 hover:text-white"
				>
					Hemen Öğrenmeye Başla
				</a>
			</section>

			<?php // --- Son materyaller --- ?>
			<section>
				<h2 class="mb-5 font-display text-xl font-bold text-ink">Son Materyaller</h2>
				<?php
				$material_recent = new WP_Query( array(
					'post_type'           => 'materyaller',
					'posts_per_page'      => 3,
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
				) );

				if ( $material_recent->have_posts() ) : ?>
					<ul class="space-y-4">
						<?php while ( $material_recent->have_posts() ) : $material_recent->the_post(); ?>
							<li class="border-b border-dune pb-4 last:border-0 last:pb-0">
								<a href="<?php the_permalink(); ?>" class="block text-sm font-semibold text-ink transition-colors hover:text-olive-600">
									<?php the_title(); ?>
								</a>
								<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" class="mt-1 block text-xs text-slate/70">
									<?php echo esc_html( get_the_date() ); ?>
								</time>
							</li>
						<?php endwhile; ?>
					</ul>
				<?php else : ?>
					<p class="text-sm text-slate/70">Henüz materyal eklenmemiş.</p>
				<?php endif;
				wp_reset_postdata();
				?>
			</section>

			<?php // --- Hizli baglantilar --- ?>
			<section>
				<h2 class="mb-5 font-display text-xl font-bold text-ink">Hızlı Bağlantılar</h2>
				<?php
				$material_quick_links = array(
					'Tüm Materyaller'     => home_url( '/materyaller/' ),
					'Hakkımızda'          => home_url( '/hakkimizda/' ),
					'İletişim'            => home_url( '/iletisim/' ),
					'Gizlilik Politikası' => get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/gizlilik-politikasi/' ),
				);
				?>
				<ul class="space-y-3">
					<?php foreach ( $material_quick_links as $material_label => $material_url ) : ?>
						<li>
							<a href="<?php echo esc_url( $material_url ); ?>" class="group inline-flex items-center gap-2 text-sm transition-colors hover:text-olive-600">
								<svg class="h-3 w-3 text-olive-500 transition-transform group-hover:translate-x-0.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 0 1 .02-1.06L11.168 10 7.23 6.29a.75.75 0 1 1 1.04-1.08l4.5 4.25a.75.75 0 0 1 0 1.08l-4.5 4.25a.75.75 0 0 1-1.06-.02Z" clip-rule="evenodd"/>
								</svg>
								<?php echo esc_html( $material_label ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</section>

			<?php // --- Iletisim --- ?>
			<section>
				<h2 class="mb-5 font-display text-xl font-bold text-ink">Bize Ulaşın</h2>
				<ul class="space-y-4 text-sm">
					<li class="flex gap-3">
						<svg class="mt-0.5 h-4 w-4 shrink-0 text-sunset-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M11.54 22.35a1.5 1.5 0 0 0 .92 0C16.4 21 20.25 16.6 20.25 10.5a8.25 8.25 0 1 0-16.5 0c0 6.1 3.85 10.5 7.79 11.85ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
						</svg>
						<span><?php echo esc_html( get_theme_mod( 'contact_address', 'Eğitim Vadisi, Kampüs Sok. No:1 Ankara' ) ); ?></span>
					</li>
					<li class="flex gap-3">
						<svg class="mt-0.5 h-4 w-4 shrink-0 text-sunset-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M1.5 4.5a3 3 0 0 1 3-3h1.37c.65 0 1.22.42 1.42 1.04l1.1 3.29a1.5 1.5 0 0 1-.54 1.68l-1.13.82a11.3 11.3 0 0 0 5.42 5.42l.82-1.13a1.5 1.5 0 0 1 1.68-.54l3.29 1.1c.62.2 1.04.77 1.04 1.42v1.37a3 3 0 0 1-3 3h-.75C10.1 19.5 1.5 10.9 1.5 5.25V4.5Z" clip-rule="evenodd"/>
						</svg>
						<?php $material_phone = get_theme_mod( 'contact_phone', '+90 (555) 123 45 67' ); ?>
						<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $material_phone ) ); ?>" class="transition-colors hover:text-olive-600">
							<?php echo esc_html( $material_phone ); ?>
						</a>
					</li>
					<li class="flex gap-3">
						<svg class="mt-0.5 h-4 w-4 shrink-0 text-sunset-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
							<path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-9.4 5.76a1.5 1.5 0 0 1-1.2 0L1.5 8.67Z"/>
							<path d="M22.5 6.9V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3V6.9l10.5 6.44L22.5 6.9Z"/>
						</svg>
						<?php $material_email = get_theme_mod( 'contact_email', 'info@kamp.com' ); ?>
						<a href="mailto:<?php echo esc_attr( $material_email ); ?>" class="transition-colors hover:text-olive-600">
							<?php echo esc_html( $material_email ); ?>
						</a>
					</li>
				</ul>
			</section>
		</div>

		<?php // --- Alt serit --- ?>
		<div class="bg-olive-500 text-olive-50">
			<div class="mx-auto flex max-w-shell flex-col items-center justify-between gap-4 px-5 py-5 text-xs sm:flex-row lg:px-8">
				<p>
					<?php printf( 'Copyright &copy; %s %s. Tüm hakları saklıdır.', esc_html( gmdate( 'Y' ) ), esc_html( get_bloginfo( 'name' ) ) ); ?>
				</p>

				<ul class="flex items-center gap-2">
					<?php foreach ( $material_socials as $material_name => $material_social ) :
						list( $material_url, $material_path ) = $material_social;
						if ( ! $material_url ) {
							continue;
						}
						?>
						<li>
							<a
								href="<?php echo esc_url( $material_url ); ?>"
								target="_blank" rel="noopener noreferrer"
								class="flex h-8 w-8 items-center justify-center rounded-full transition-colors hover:bg-white/15"
							>
								<span class="screen-reader-text"><?php echo esc_html( $material_name ); ?></span>
								<svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
									<path d="<?php echo esc_attr( $material_path ); ?>"/>
								</svg>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</footer>
</div><?php // .flex.min-h-screen ?>

<?php wp_footer(); ?>
</body>
</html>
