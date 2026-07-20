<?php
/**
 * Site basligi ve <head>.
 *
 * @package Material
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">

<?php // --- SEO: meta description --- ?>
<meta name="description" content="<?php
if ( is_front_page() || is_home() ) {
	echo esc_attr( get_bloginfo( 'description' ) );
} elseif ( is_singular() ) {
	$material_post = get_post();
	if ( $material_post && $material_post->post_excerpt ) {
		echo esc_attr( wp_strip_all_tags( $material_post->post_excerpt ) );
	} elseif ( $material_post ) {
		echo esc_attr( wp_trim_words( wp_strip_all_tags( $material_post->post_content ), 25 ) );
	}
} elseif ( is_category() || is_tag() || is_tax() ) {
	echo esc_attr( wp_strip_all_tags( term_description() ) );
} else {
	echo esc_attr( get_bloginfo( 'description' ) );
}
?>">

<?php
// --- SEO: Open Graph / Twitter ---
$og_title = wp_get_document_title();
$og_url   = is_singular() ? get_permalink() : home_url( add_query_arg( null, null ) );
$og_desc  = is_singular() && get_the_excerpt()
	? esc_attr( wp_strip_all_tags( get_the_excerpt() ) )
	: esc_attr( get_bloginfo( 'description' ) );
$og_img   = ( is_singular() && has_post_thumbnail() )
	? get_the_post_thumbnail_url( null, 'large' )
	: get_option( 'site_default_og_image' );
?>
<meta property="og:type" content="<?php echo is_singular() ? 'article' : 'website'; ?>">
<meta property="og:title" content="<?php echo esc_attr( $og_title ); ?>">
<meta property="og:description" content="<?php echo $og_desc; ?>">
<meta property="og:url" content="<?php echo esc_url( $og_url ); ?>">
<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
<?php if ( $og_img ) : ?>
<meta property="og:image" content="<?php echo esc_url( $og_img ); ?>">
<?php endif; ?>
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo esc_attr( $og_title ); ?>">
<meta name="twitter:description" content="<?php echo $og_desc; ?>">
<?php if ( $og_img ) : ?>
<meta name="twitter:image" content="<?php echo esc_url( $og_img ); ?>">
<?php endif; ?>

<link rel="icon" sizes="32x32" href="<?php echo esc_url( material_logo_url() ); ?>">

<?php do_action( 'material_head' ); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-cream font-sans text-slate antialiased' ); ?>>
<?php wp_body_open(); ?>

<a class="screen-reader-text" href="#main"><?php esc_html_e( 'Icerige atla', 'material' ); ?></a>

<div class="flex min-h-screen flex-col">

	<header
		id="site-header"
		data-site-header
		class="sticky top-0 z-50 border-b border-dune/50 bg-cream/85 backdrop-blur-md transition-shadow duration-300"
	>
		<div class="mx-auto flex max-w-shell items-center justify-between gap-6 px-5 py-3 lg:px-8">

			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="shrink-0">
				<img
					src="<?php echo esc_url( material_logo_url() ); ?>"
					alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
					width="98" height="98"
					class="h-14 w-auto lg:h-16"
				>
			</a>

			<nav class="hidden lg:block" aria-label="<?php esc_attr_e( 'Ana menu', 'material' ); ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary-menu',
					'container'      => false,
					'menu_class'     => 'flex items-center gap-1',
					'menu_id'        => 'primary-menu',
					'fallback_cb'    => false,
					'walker'         => new Material_Nav_Walker( 'desktop' ),
				) );
				?>
			</nav>

			<button
				type="button"
				data-menu-toggle
				aria-controls="mobile-menu"
				aria-expanded="false"
				class="inline-flex items-center justify-center rounded-lg p-2 text-ink transition-colors hover:bg-sand lg:hidden"
			>
				<span class="screen-reader-text"><?php esc_html_e( 'Menuyu ac', 'material' ); ?></span>
				<svg data-menu-icon-open class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/>
				</svg>
				<svg data-menu-icon-close class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
				</svg>
			</button>
		</div>

		<div id="mobile-menu" data-mobile-menu class="hidden border-t border-dune/50 bg-cream lg:hidden">
			<nav class="mx-auto max-w-shell px-5 py-4" aria-label="<?php esc_attr_e( 'Mobil menu', 'material' ); ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary-menu',
					'container'      => false,
					'menu_class'     => 'flex flex-col gap-1',
					'menu_id'        => 'mobile-primary-menu',
					'depth'          => 1,
					'fallback_cb'    => false,
					'walker'         => new Material_Nav_Walker( 'mobile' ),
				) );
				?>
			</nav>
		</div>
	</header>

	<main id="main" class="flex-1">
