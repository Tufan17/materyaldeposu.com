<?php
/**
 * Sablonlarin paylastigi yardimcilar.
 *
 * @package Material
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Site logosunun URL'i. Customizer'da ozel logo varsa onu, yoksa temanin
 * varsayilan logosunu dondurur.
 */
function material_logo_url() {
	$custom = get_theme_mod( 'custom_logo' );
	if ( $custom ) {
		$src = wp_get_attachment_image_url( $custom, 'full' );
		if ( $src ) {
			return $src;
		}
	}

	return get_template_directory_uri() . '/wp-content/uploads/2023/11/lms-logo.png';
}

/**
 * Sik kullanilan Tailwind bilesen siniflari.
 *
 * Ayni buton/rozet/kart kombinasyonunu her sablonda elle yazmak yerine
 * tek yerden okunur tutmak icin.
 *
 * @param string $name  Bilesen adi.
 * @param string $extra Ek siniflar.
 * @return string
 */
function material_class( $name, $extra = '' ) {
	$map = array(
		'shell'         => 'mx-auto w-full max-w-shell px-5 lg:px-8',
		'section'       => 'py-16 lg:py-24',

		'btn'           => 'inline-flex items-center justify-center gap-2 rounded-full px-7 py-3.5 text-sm font-bold transition-all duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-olive-500 focus-visible:ring-offset-2',
		'btn-primary'   => 'bg-olive-500 text-white shadow-pill hover:-translate-y-0.5 hover:bg-olive-600 hover:shadow-lift',
		'btn-accent'    => 'bg-sunset-500 text-white shadow-pill hover:-translate-y-0.5 hover:bg-sunset-600 hover:shadow-lift',
		'btn-white'     => 'bg-white text-olive-600 shadow-lift hover:-translate-y-0.5',
		'btn-outline'   => 'border-2 border-olive-500 text-olive-600 hover:bg-olive-500 hover:text-white',

		'card'          => 'overflow-hidden rounded-card border border-olive-500/10 bg-white shadow-card',
		'card-hover'    => 'transition-all duration-300 hover:-translate-y-1.5 hover:shadow-lift',

		'badge'         => 'inline-flex items-center gap-1.5 rounded-full border bg-white px-4 py-1.5 text-[13px] font-bold shadow-pill',
		'badge-olive'   => 'border-olive-500/10 text-olive-600',
		'badge-sunset'  => 'border-sunset-500/10 text-sunset-600',
		'badge-azure'   => 'border-azure/10 text-azure',

		'eyebrow'       => 'text-xs font-bold uppercase tracking-[0.2em] text-sunset-500',
		'title'         => 'font-display font-extrabold leading-tight text-ink',
		'prose'         => 'prose prose-slate max-w-none prose-headings:font-display prose-headings:text-ink prose-a:text-olive-600 prose-a:no-underline hover:prose-a:underline prose-strong:text-ink',

		'input'         => 'w-full rounded-full border border-dune bg-white px-6 py-3.5 text-sm text-ink placeholder:text-slate/50 focus:border-olive-500 focus:outline-none focus:ring-2 focus:ring-olive-500/20',
	);

	$base = isset( $map[ $name ] ) ? $map[ $name ] : '';

	return trim( $base . ( $extra ? ' ' . $extra : '' ) );
}

/**
 * material_class() ciktisini dogrudan basar.
 */
function material_the_class( $name, $extra = '' ) {
	echo esc_attr( material_class( $name, $extra ) );
}

/**
 * Tailwind ile bicimlendirilmis sayfalama.
 *
 * paginate_links() kendi markup'ini urettigi icin diziyi alip yeniden sariyoruz.
 *
 * @param WP_Query|null $query Varsayilan sorgu disinda bir sorgu icin.
 */
function material_pagination( $query = null ) {
	$args = array( 'type' => 'array' );

	if ( $query instanceof WP_Query ) {
		$args['total']   = $query->max_num_pages;
		$args['current'] = max( 1, get_query_var( 'paged' ) );
	}

	$links = paginate_links( $args );

	if ( empty( $links ) ) {
		return;
	}

	$base    = 'inline-flex h-10 min-w-10 items-center justify-center rounded-lg border px-3.5 text-sm font-semibold transition-colors';
	$idle    = ' border-dune bg-white text-ink hover:border-olive-500 hover:bg-olive-500 hover:text-white';
	$current = ' border-olive-500 bg-olive-500 text-white';

	echo '<nav class="mt-14 flex justify-center" aria-label="Sayfalama"><ul class="flex flex-wrap items-center gap-2">';

	foreach ( $links as $link ) {
		$is_current = false !== strpos( $link, 'current' );
		$link       = str_replace(
			'page-numbers',
			'page-numbers ' . $base . ( $is_current ? $current : $idle ),
			$link
		);

		echo '<li>' . $link . '</li>'; // phpcs:ignore WordPress.Security.EscapeOutput -- paginate_links ciktisi.
	}

	echo '</ul></nav>';
}

/**
 * Bir taksonomi teriminin ilk adini guvenle dondurur.
 *
 * @return string|null
 */
function material_first_term_name( $post_id, $taxonomy ) {
	$terms = get_the_terms( $post_id, $taxonomy );
	if ( ! $terms || is_wp_error( $terms ) ) {
		return null;
	}

	return $terms[0]->name;
}
