<?php
/**
 * Sayfa/arsiv basligi seridi.
 *
 * Kullanim:
 *   get_template_part( 'template-parts/page-header', null, array(
 *       'eyebrow' => 'Kutuphane',
 *       'title'   => 'Materyaller',
 *       'lead'    => 'Aciklama metni',
 *   ) );
 *
 * @package Material
 */

$material_eyebrow = isset( $args['eyebrow'] ) ? $args['eyebrow'] : '';
$material_title   = isset( $args['title'] ) ? $args['title'] : get_the_title();
$material_lead    = isset( $args['lead'] ) ? $args['lead'] : '';
?>

<header class="relative isolate overflow-hidden border-b border-dune/50 bg-sand py-16 text-center lg:py-20">
	<div class="absolute -left-20 -top-20 -z-10 h-72 w-72 rounded-full bg-olive-500/5 blur-3xl"></div>
	<div class="absolute -bottom-24 -right-20 -z-10 h-72 w-72 rounded-full bg-sunset-500/5 blur-3xl"></div>

	<div class="<?php material_the_class( 'shell' ); ?>">
		<?php if ( $material_eyebrow ) : ?>
			<p class="<?php material_the_class( 'eyebrow' ); ?>"><?php echo esc_html( $material_eyebrow ); ?></p>
		<?php endif; ?>

		<h1 class="<?php material_the_class( 'title', 'mt-3 text-3xl sm:text-4xl lg:text-5xl' ); ?>">
			<?php echo esc_html( $material_title ); ?>
		</h1>

		<div class="mx-auto mt-5 h-1 w-16 rounded-full bg-olive-500"></div>

		<?php if ( $material_lead ) : ?>
			<p class="mx-auto mt-6 max-w-2xl text-base leading-relaxed text-slate">
				<?php echo esc_html( $material_lead ); ?>
			</p>
		<?php endif; ?>
	</div>
</header>
