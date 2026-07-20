<?php
/**
 * Genel sayfa sablonu.
 *
 * @package Material
 */

get_header();

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/page-header', null, array(
		'title' => get_the_title(),
	) );
	?>

	<div class="<?php material_the_class( 'section', 'bg-cream' ); ?>">
		<div class="<?php material_the_class( 'shell' ); ?>">
			<div class="<?php material_the_class( 'prose', 'mx-auto max-w-3xl' ); ?>">
				<?php the_content(); ?>
			</div>
		</div>
	</div>

<?php endwhile;

get_footer();
