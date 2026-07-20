<?php
/**
 * Template Name: İletişim Sayfası
 * Description: Iletisim sayfasi icin ozel sablon.
 *
 * @package Material
 */

get_header();

$material_phone   = get_theme_mod( 'iletisim_phone', '+90 (555) 123 45 67' );
$material_email   = get_theme_mod( 'iletisim_email', 'iletisim@siteadresi.com' );
$material_address = get_theme_mod( 'iletisim_address', 'Eğitim Vadisi, Teknoloji Cad. No:1, İstanbul' );
$material_map     = get_theme_mod( 'iletisim_map_iframe', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d192697.79327595676!2d28.871754050228723!3d41.00549580879685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caa7040068086b%3A0xe1ccfe98bc01b0d0!2zxLBzdGFuYnVs!5e0!3m2!1str!2str!4v1689252390000!5m2!1str!2str' );

// Iletisim kartlari.
$material_cards = array(
	array(
		'title' => 'Adresimiz',
		'icon'  => 'M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7Zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5Z',
		'tone'  => 'from-olive-500/10 to-sunset-500/10 text-olive-600',
		'body'  => '<p class="text-base leading-relaxed text-slate">' . esc_html( $material_address ) . '</p>',
	),
	array(
		'title' => 'Telefon',
		'icon'  => 'M6.62 10.79a15.1 15.1 0 0 0 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2Z',
		'tone'  => 'from-sunset-500/10 to-olive-500/10 text-sunset-600',
		'body'  => '<p class="text-base leading-relaxed text-slate"><a href="tel:'
			. esc_attr( preg_replace( '/[^0-9+]/', '', $material_phone ) )
			. '" class="transition-colors hover:text-olive-600">' . esc_html( $material_phone )
			. '</a><br>Pzt - Cum, 09:00 - 18:00</p>',
	),
	array(
		'title' => 'E-Posta',
		'icon'  => 'M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Zm0 4-8 5-8-5V6l8 5 8-5v2Z',
		'tone'  => 'from-azure/10 to-olive-500/10 text-azure',
		'body'  => '<p class="text-base leading-relaxed text-slate"><a href="mailto:'
			. esc_attr( $material_email ) . '" class="transition-colors hover:text-olive-600">'
			. esc_html( $material_email ) . '</a><br>7/24 Bize yazabilirsiniz</p>',
	),
);
?>

<?php // ---------------- Hero ---------------- ?>
<?php // pt-* seffaf header'in uzerine binmemesi icin fazladan pay birakiyor. ?>
<section class="relative isolate overflow-hidden bg-gradient-to-br from-olive-900 to-olive-700 px-5 pb-28 pt-36 text-center text-white lg:pt-44">
	<div class="absolute -left-24 -top-40 -z-10 h-[500px] w-[500px] rounded-full bg-sunset-500/20 blur-3xl"></div>
	<div class="absolute -bottom-40 -right-16 -z-10 h-96 w-96 rounded-full bg-sand/20 blur-3xl"></div>

	<div class="mx-auto max-w-3xl">
		<p class="inline-block rounded-full bg-sunset-400/15 px-5 py-2 text-sm font-extrabold uppercase tracking-[0.2em] text-sunset-300">
			Bize Ulaşın
		</p>
		<h1 class="<?php material_the_class( 'title', 'mt-6 text-4xl text-white sm:text-5xl lg:text-6xl' ); ?>">
			İletişimde Kalalım
		</h1>
		<p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-white/90">
			Sorularınız, önerileriniz veya iş birlikleri için bizimle iletişime geçmekten
			çekinmeyin. Size yardımcı olmaktan memnuniyet duyarız.
		</p>
	</div>
</section>

<div class="bg-cream pb-24">
	<div class="<?php material_the_class( 'shell', '-mt-14' ); ?>">

		<?php // ---------------- Iletisim kartlari ---------------- ?>
		<ul class="grid gap-8 lg:grid-cols-3">
			<?php foreach ( $material_cards as $material_card ) : ?>
				<li class="rounded-card border border-black/[0.04] bg-white px-8 py-12 text-center shadow-card transition-all duration-300 hover:-translate-y-2.5 hover:border-sunset-500/20 hover:shadow-lift">
					<div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br <?php echo esc_attr( $material_card['tone'] ); ?>">
						<svg class="h-11 w-11" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
							<path d="<?php echo esc_attr( $material_card['icon'] ); ?>"/>
						</svg>
					</div>
					<h2 class="mt-6 font-display text-2xl font-bold text-ink"><?php echo esc_html( $material_card['title'] ); ?></h2>
					<div class="mt-4">
						<?php echo $material_card['body']; // phpcs:ignore WordPress.Security.EscapeOutput -- yukarida kacisliyor. ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php // ---------------- Form + harita ---------------- ?>
		<div class="mt-20 grid overflow-hidden rounded-[30px] border border-black/[0.03] bg-white shadow-lift lg:grid-cols-2">

			<div class="p-8 sm:p-12 lg:p-14">
				<h2 class="<?php material_the_class( 'title', 'text-3xl sm:text-4xl' ); ?>">Bize Mesaj Gönderin</h2>
				<p class="mt-3 text-base text-slate">Formu doldurun, size en kısa sürede geri dönüş yapalım.</p>

				<form action="#" method="post" class="mt-10 space-y-5">
					<?php
					$material_fields = array(
						array( 'ad', 'Adınız Soyadınız', 'text', 'Örn: Ahmet Yılmaz' ),
						array( 'eposta', 'E-Posta Adresiniz', 'email', 'ornek@email.com' ),
					);
					?>
					<div class="grid gap-5 sm:grid-cols-2">
						<?php foreach ( $material_fields as $material_field ) : ?>
							<div>
								<label for="iletisim-<?php echo esc_attr( $material_field[0] ); ?>" class="mb-2 block text-sm font-semibold text-ink">
									<?php echo esc_html( $material_field[1] ); ?>
								</label>
								<input
									id="iletisim-<?php echo esc_attr( $material_field[0] ); ?>"
									name="<?php echo esc_attr( $material_field[0] ); ?>"
									type="<?php echo esc_attr( $material_field[2] ); ?>"
									placeholder="<?php echo esc_attr( $material_field[3] ); ?>"
									class="w-full rounded-xl border border-dune bg-cream/50 px-5 py-3.5 text-[15px] text-ink transition-all placeholder:text-slate/50 focus:border-olive-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-olive-500/10"
								>
							</div>
						<?php endforeach; ?>
					</div>

					<div>
						<label for="iletisim-konu" class="mb-2 block text-sm font-semibold text-ink">Konu</label>
						<input
							id="iletisim-konu" name="konu" type="text"
							placeholder="Mesajınızın konusu nedir?"
							class="w-full rounded-xl border border-dune bg-cream/50 px-5 py-3.5 text-[15px] text-ink transition-all placeholder:text-slate/50 focus:border-olive-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-olive-500/10"
						>
					</div>

					<div>
						<label for="iletisim-mesaj" class="mb-2 block text-sm font-semibold text-ink">Mesajınız</label>
						<textarea
							id="iletisim-mesaj" name="mesaj" rows="5"
							placeholder="Size nasıl yardımcı olabiliriz?"
							class="w-full resize-y rounded-xl border border-dune bg-cream/50 px-5 py-3.5 text-[15px] text-ink transition-all placeholder:text-slate/50 focus:border-olive-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-olive-500/10"
						></textarea>
					</div>

					<button
						type="submit"
						class="w-full rounded-xl bg-gradient-to-r from-olive-600 to-olive-500 px-8 py-4 text-base font-bold text-white shadow-pill transition-all hover:-translate-y-0.5 hover:shadow-lift"
					>
						Mesajı Gönder
					</button>
				</form>
			</div>

			<div class="relative min-h-[350px] bg-sand lg:min-h-full">
				<iframe
					src="<?php echo esc_url( $material_map ); ?>"
					title="Harita"
					class="absolute inset-0 h-full w-full border-0"
					allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
				></iframe>
			</div>
		</div>

	</div>
</div>

<?php get_footer(); ?>
