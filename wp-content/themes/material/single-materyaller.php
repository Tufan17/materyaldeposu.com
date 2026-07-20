<?php
/**
 * Tekil materyal detay sablonu.
 *
 * @package Material
 */

get_header(); ?>

<div class="relative isolate overflow-hidden bg-cream py-20 lg:py-28">

	<?php // Arka plan susleri. ?>
	<div class="absolute -left-24 -top-12 -z-10 h-96 w-96 rounded-full bg-olive-500/5 blur-3xl"></div>
	<div class="absolute -right-24 bottom-[10%] -z-10 h-72 w-72 rounded-full bg-sunset-500/5 blur-3xl"></div>

	<div class="<?php material_the_class( 'shell' ); ?>">
		<?php while ( have_posts() ) : the_post();

			$material_taxonomies = array(
				array( 'sinif_grubu', 'badge-olive' ),
				array( 'dersler', 'badge-sunset' ),
				array( 'konular', 'badge-azure' ),
			);
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( material_class( 'card' ) ); ?>>

				<?php // ---------- Baslik alani ---------- ?>
				<header class="border-b border-black/5 bg-gradient-to-br from-olive-500/5 to-sunset-500/5 px-6 py-12 text-center sm:px-10 lg:py-14">

					<div class="mb-6 flex flex-wrap justify-center gap-2.5">
						<?php foreach ( $material_taxonomies as $material_tax ) :
							$material_name = material_first_term_name( get_the_ID(), $material_tax[0] );
							if ( ! $material_name ) {
								continue;
							}
							?>
							<span class="<?php material_the_class( 'badge', material_class( $material_tax[1] ) ); ?>">
								<?php echo esc_html( $material_name ); ?>
							</span>
						<?php endforeach; ?>
					</div>

					<h1 class="<?php material_the_class( 'title', 'mx-auto max-w-4xl text-3xl sm:text-4xl lg:text-5xl' ); ?>">
						<?php the_title(); ?>
					</h1>
				</header>

				<?php // ---------- Icerik ---------- ?>
				<div class="flex flex-col items-center px-6 py-10 sm:px-10">

					<div class="flex h-20 w-20 items-center justify-center rounded-full bg-olive-500/10 text-olive-500">
						<svg class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.6c0-1.14-.9-2.06-2-2.06h-2.5a1.5 1.5 0 0 1-1.5-1.5V5.56c0-1.14-.9-2.06-2-2.06H8.25m3.75 0H6.9c-.77 0-1.4.65-1.4 1.44v15.12c0 .8.63 1.44 1.4 1.44h10.2c.77 0 1.4-.65 1.4-1.44V10.5A7 7 0 0 0 12 3.5Z"/>
						</svg>
					</div>

					<div class="<?php material_the_class( 'prose', 'mt-7 max-w-2xl text-center text-lg leading-relaxed' ); ?>">
						<?php
						$material_content = apply_filters( 'the_content', get_the_content() );
						// Icerikteki gorseller ayri "indirilebilir dosyalar" bolumunde listeleniyor.
						$material_content = preg_replace( '/<img[^>]+>/i', '', $material_content );
						$material_content = preg_replace( '/<a[^>]*href="[^"]*wp-content\/uploads[^"]*"[^>]*>.*?<\/a>/i', '', $material_content );
						$material_content = preg_replace( '/\[caption[^\]]*\].*?\[\/caption\]/is', '', $material_content );
						$material_content = preg_replace( '/<p>\s*(?:<br\s*\/?>)?\s*<\/p>/i', '', $material_content );

						echo $material_content; // phpcs:ignore WordPress.Security.EscapeOutput -- the_content filtresinden geciyor.
						?>
					</div>

					<?php // ---------- Indirilebilir dosyalar ---------- ?>
					<?php
					$material_files = array();

					// Paylas formundan gelen dosyalar (coklu alan + eski tekil alan)
					// ve posta iliştirilmiş diger medyalar birlestiriliyor.
					$material_meta_ids = (array) get_post_meta( get_the_ID(), 'yuklenen_dosya_ids', true );
					$material_meta_ids = array_filter( array_merge(
						$material_meta_ids,
						array( get_post_meta( get_the_ID(), 'yuklenen_dosya_id', true ) )
					) );

					foreach ( $material_meta_ids as $material_meta_id ) {
						$material_meta_post = get_post( $material_meta_id );
						if ( $material_meta_post ) {
							$material_files[ $material_meta_id ] = $material_meta_post;
						}
					}

					foreach ( (array) get_attached_media( '', get_the_ID() ) as $material_att ) {
						$material_files[ $material_att->ID ] = $material_att;
					}

					if ( ! empty( $material_files ) ) :
						/*
						 * Dosya turune gore ikon + Tailwind renk sinifi.
						 * Sinif adlari tam yazilmali, aksi halde Tailwind uretmez.
						 */
						$material_file_types = array(
							'image'    => array( 'text-azure',      'hover:border-azure' ),
							'pdf'      => array( 'text-red-600',    'hover:border-red-600' ),
							'word'     => array( 'text-blue-600',   'hover:border-blue-600' ),
							'document' => array( 'text-blue-600',   'hover:border-blue-600' ),
							'video'    => array( 'text-sunset-500', 'hover:border-sunset-500' ),
							'zip'      => array( 'text-purple-700', 'hover:border-purple-700' ),
							'rar'      => array( 'text-purple-700', 'hover:border-purple-700' ),
						);
						?>
						<section class="mt-10 w-full max-w-3xl rounded-2xl border border-dune/60 bg-cream/60 p-7">
							<h2 class="mb-6 flex items-center gap-2.5 font-display text-xl font-bold text-ink">
								<svg class="h-5 w-5 text-olive-500" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="m18.4 12.8-7.1 7.1a4.5 4.5 0 0 1-6.4-6.4l7.9-7.9a3 3 0 1 1 4.2 4.2l-7.8 7.9a1.5 1.5 0 0 1-2.1-2.1l7.2-7.2"/>
								</svg>
								İndirilebilir Dosyalar
							</h2>

							<ul class="grid gap-4 sm:grid-cols-2">
								<?php foreach ( $material_files as $material_att_id => $material_att ) :
									$material_mime  = (string) get_post_mime_type( $material_att_id );
									$material_color = 'text-slate';
									$material_hover = 'hover:border-olive-500';

									foreach ( $material_file_types as $material_key => $material_style ) {
										if ( false !== strpos( $material_mime, $material_key ) ) {
											list( $material_color, $material_hover ) = $material_style;
											break;
										}
									}
									?>
									<li>
										<a
											href="<?php echo esc_url( wp_get_attachment_url( $material_att_id ) ); ?>"
											target="_blank" rel="noopener" download
											class="flex items-center gap-4 rounded-xl border border-dune/60 bg-white px-5 py-4 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-card <?php echo esc_attr( $material_hover ); ?>"
										>
											<svg class="h-7 w-7 shrink-0 <?php echo esc_attr( $material_color ); ?>" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
												<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.6c0-1.14-.9-2.06-2-2.06h-2.5a1.5 1.5 0 0 1-1.5-1.5V5.56c0-1.14-.9-2.06-2-2.06H8.25m3.75 0H6.9c-.77 0-1.4.65-1.4 1.44v15.12c0 .8.63 1.44 1.4 1.44h10.2c.77 0 1.4-.65 1.4-1.44V10.5A7 7 0 0 0 12 3.5Z"/>
											</svg>
											<span class="break-words text-sm font-semibold leading-snug text-ink">
												<?php echo esc_html( wp_trim_words( $material_att->post_title, 5 ) ); ?>
											</span>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</section>
					<?php endif; ?>

					<?php // ---------- Paylas ---------- ?>
					<div class="mt-10 flex w-full flex-wrap justify-center gap-4">
						<?php
						$material_share_url = add_query_arg(
							'text',
							get_the_title() . ' - ' . get_permalink(),
							'https://api.whatsapp.com/send'
						);
						?>
						<a
							href="<?php echo esc_url( $material_share_url ); ?>"
							target="_blank" rel="noopener noreferrer"
							class="<?php material_the_class( 'btn', 'bg-[#25D366] px-11 py-4 text-base text-white shadow-pill hover:-translate-y-0.5 hover:bg-[#1da851] hover:shadow-lift' ); ?>"
						>
							<svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
								<path d="M17.5 14.4c-.3-.2-1.8-.9-2-1-.3-.1-.5-.2-.7.1-.2.3-.7 1-.9 1.2-.2.2-.3.2-.6.1-.3-.2-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.5-.5c.1-.2.2-.3.3-.5 0-.2 0-.4 0-.5 0-.2-.7-1.6-.9-2.2-.3-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.2.2 2.1 3.3 5.2 4.6.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.1-.3-.2-.6-.4M12 2a10 10 0 0 0-8.5 15.3L2 22.5l5.4-1.4A10 10 0 1 0 12 2Zm0 18.3c-1.6 0-3.2-.4-4.5-1.2l-.3-.2-3.2.8.9-3.1-.2-.3a8.3 8.3 0 1 1 7.3 4Z"/>
							</svg>
							Sınıfta Paylaş
						</a>
					</div>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
</div>

<?php get_footer(); ?>
