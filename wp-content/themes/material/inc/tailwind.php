<?php
/**
 * Tailwind CSS altyapisi.
 *
 * Tema Play CDN uzerinden calisir; tasarim token'lari (renk, font, golge)
 * burada tek yerden tanimlanir ki sablonlarda inline style yazmaya gerek kalmasin.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Tailwind CDN'i ve tema config'ini <head> icine basar.
 *
 * wp_head'den once calismasi gerekiyor, cunku config script'i CDN'den
 * hemen sonra ve ilk render'dan once yuklenmeli.
 */
function material_tailwind_head() {
	?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">

	<script src="https://cdn.tailwindcss.com?plugins=typography,forms"></script>
	<script>
	tailwind.config = {
		theme: {
			extend: {
				colors: {
					olive: {
						50:  '#f4f5ee',
						100: '#e6e9d5',
						200: '#ced4ac',
						300: '#b3bc82',
						400: '#9aa563',
						500: '#838C48',
						600: '#6c7439',
						700: '#535a2e',
						800: '#3e4324',
						900: '#2b2f19',
					},
					sunset: {
						50:  '#fdf5ed',
						100: '#f9e6d1',
						200: '#f2c9a1',
						300: '#e9a86e',
						400: '#e1934f',
						500: '#DA853D',
						600: '#c06a28',
						700: '#9a5120',
						800: '#733d19',
						900: '#4d2911',
					},
					azure: '#0171BB',
					cream: '#FDF6EA',
					sand:  '#F5E9D4',
					dune:  '#E2D6C1',
					ink:   '#303030',
					slate: '#4F4F4F',
				},
				fontFamily: {
					display: ['"Playfair Display"', 'Georgia', 'serif'],
					sans:    ['Inter', 'system-ui', '-apple-system', 'Segoe UI', 'sans-serif'],
				},
				borderRadius: {
					card: '24px',
				},
				boxShadow: {
					card:  '0 20px 50px rgba(0,0,0,0.06)',
					lift:  '0 18px 40px rgba(0,0,0,0.12)',
					pill:  '0 4px 10px rgba(131,140,72,0.12)',
				},
				maxWidth: {
					shell: '1250px',
				},
				keyframes: {
					'fade-up': {
						'0%':   { opacity: '0', transform: 'translateY(18px)' },
						'100%': { opacity: '1', transform: 'translateY(0)' },
					},
				},
				animation: {
					'fade-up': 'fade-up .5s ease-out both',
				},
			},
		},
	};
	</script>
	<?php
}
add_action( 'material_head', 'material_tailwind_head' );

/**
 * WP'nin kendi urettigi markup'a (the_content, arsiv listeleri, yorumlar)
 * Tailwind ile ulasilamayan yerler icin minimum kancalar.
 *
 * Burada yalnizca Tailwind'in class ile ifade edemedigi seyler var:
 * CDN yuklenene kadarki FOUC ve WP'nin zorunlu .screen-reader-text sozlesmesi.
 */
function material_base_styles() {
	?>
	<style>
		[x-cloak] { display: none !important; }
		.screen-reader-text {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute !important;
			height: 1px; width: 1px;
			overflow: hidden; word-wrap: normal !important;
		}
		.screen-reader-text:focus {
			clip: auto !important;
			display: block; top: 5px; left: 5px;
			width: auto; height: auto; z-index: 100000;
		}
	</style>
	<?php
}
add_action( 'material_head', 'material_base_styles' );

/**
 * Elementor / LMS temasindan kalan stil ve script'leri devre disi birakir.
 *
 * Tema tamamen Tailwind'e tasindigi icin bu dosyalar yalnizca cakisma uretiyor.
 */
function material_dequeue_legacy_assets() {
	$handles = array(
		'elementor-frontend',
		'elementor-common',
		'elementor-icons',
		'elementor-post-16',
		'elementor-post-46',
		'elementor-post-47',
		'wdt-elementor-sections',
		'wdt-elementor-widgets',
		'wdt-e-animations',
		'lms-elementor',
		'dtlms-skin',
		'wdt-skin',
		'classic-theme-styles',
		'global-styles',
		'wp-block-library',
	);

	foreach ( $handles as $handle ) {
		wp_dequeue_style( $handle );
		wp_deregister_style( $handle );
	}
}
add_action( 'wp_enqueue_scripts', 'material_dequeue_legacy_assets', 100 );

/**
 * WP emoji script/stil'lerini kaldirir - Tailwind sayfasinda gereksiz agirlik.
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
