<?php
/**
 * Blog listesi / genel yedek sablon.
 *
 * @package Material
 */

get_header();

get_template_part( 'template-parts/page-header', null, array(
	'eyebrow' => 'Gunluk',
	'title'   => 'Blog',
	'lead'    => 'Egitim, materyal ve platform haberlerine dair yazilarimiz.',
) );
?>

<div class="<?php material_the_class( 'section', 'bg-cream' ); ?>">
	<div class="<?php material_the_class( 'shell' ); ?>">

		<?php if ( have_posts() ) : ?>
			<div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', 'blog' ); ?>
				<?php endwhile; ?>
			</div>

			<?php material_pagination(); ?>

		<?php else : ?>
			<p class="py-16 text-center text-base text-slate">Henüz yazı bulunmamaktadır.</p>
		<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>
