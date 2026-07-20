<?php
/**
 * WP menu markup'ina Tailwind class'lari basan walker.
 *
 * wp_nav_menu kendi markup'ini urettigi icin sablondan class veremiyoruz;
 * inline style yazmamak icin siniflari burada enjekte ediyoruz.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Material_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * Masaustu yatay menu mu, mobil dikey menu mu.
	 *
	 * @var string 'desktop'|'mobile'
	 */
	protected $mode;

	public function __construct( $mode = 'desktop' ) {
		$this->mode = $mode;
	}

	/**
	 * Alt menu kabugu (<ul class="sub-menu">).
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		if ( 'mobile' === $this->mode ) {
			$classes = 'mt-1 ml-3 flex flex-col gap-1 border-l border-dune pl-3';
		} else {
			$classes = 'invisible absolute left-0 top-full z-50 mt-0 w-56 translate-y-2 rounded-xl border '
				. 'border-dune/60 bg-white p-2 opacity-0 shadow-lift transition-all duration-200 '
				. 'group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 '
				. 'focus-within:visible focus-within:translate-y-0 focus-within:opacity-100';

			// Ikinci ve sonraki seviyeler yana acilir.
			if ( $depth >= 1 ) {
				$classes = str_replace(
					array( 'left-0 top-full', 'translate-y-2', 'group-hover:translate-y-0' ),
					array( 'left-full top-0', 'translate-x-2', 'group-hover:translate-x-0' ),
					$classes
				);
			}
		}

		$output .= '<ul class="' . esc_attr( $classes ) . '">';
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '</ul>';
	}

	/**
	 * Tek bir menu ogesi.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$has_children = in_array( 'menu-item-has-children', (array) $item->classes, true );
		// current_page_parent bilerek disarida: WP bunu ozel yazi turlerinde de
		// blog sayfasina veriyor ve yanlis ogeyi aktif gosteriyor.
		$is_current   = in_array( 'current-menu-item', (array) $item->classes, true )
			|| in_array( 'current-menu-ancestor', (array) $item->classes, true );

		if ( 'mobile' === $this->mode ) {
			$li_class = 'w-full';
			$a_class  = 'block rounded-lg px-3 py-2.5 text-sm font-semibold tracking-wide transition-colors '
				. ( $is_current ? 'bg-olive-500 text-white' : 'text-ink hover:bg-sand hover:text-olive-600' );
		} else {
			$li_class = 'group relative' . ( $has_children ? '' : '' );
			$a_class  = 'flex items-center gap-1.5 rounded-lg px-3 py-2 text-[13px] font-bold uppercase tracking-wider transition-colors '
				. ( $is_current
					? 'bg-white text-olive-600 shadow-pill'
					: 'text-ink/80 hover:text-olive-600' );

			// Acilir menu icindeki ogeler kutu degil, satir gorunumunde.
			if ( $depth >= 1 ) {
				$a_class = 'flex items-center justify-between gap-2 rounded-lg px-3 py-2 text-[13px] font-semibold normal-case tracking-normal transition-colors '
					. ( $is_current ? 'bg-olive-50 text-olive-600' : 'text-slate hover:bg-sand hover:text-olive-600' );
			}
		}

		$atts = array(
			'href'   => ! empty( $item->url ) ? $item->url : '#',
			'title'  => ! empty( $item->attr_title ) ? $item->attr_title : '',
			'target' => ! empty( $item->target ) ? $item->target : '',
			'rel'    => ! empty( $item->xfn ) ? $item->xfn : '',
			'class'  => $a_class,
		);

		$attributes = '';
		foreach ( $atts as $key => $value ) {
			if ( '' !== $value ) {
				$attributes .= ' ' . $key . '="' . esc_attr( $value ) . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );

		$caret = '';
		if ( $has_children && 'mobile' !== $this->mode ) {
			$rotate = $depth >= 1 ? '-rotate-90' : 'transition-transform group-hover:rotate-180';
			$caret  = '<svg class="h-3 w-3 shrink-0 ' . esc_attr( $rotate ) . '" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">'
				. '<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>'
				. '</svg>';
		}

		$output .= '<li class="' . esc_attr( $li_class ) . '">';
		$output .= '<a' . $attributes . '>' . esc_html( $title ) . $caret . '</a>';
	}

	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		$output .= '</li>';
	}
}
