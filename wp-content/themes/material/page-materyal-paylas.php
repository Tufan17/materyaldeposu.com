<?php
/**
 * Template Name: Materyal Paylaş
 *
 * @package Material
 */

$material_message = '';
$material_status  = '';

if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['submit_materyal'] ) ) {

	if ( ! isset( $_POST['materyal_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['materyal_nonce'] ), 'materyal_paylas_action' ) ) {
		$material_message = 'Güvenlik doğrulaması başarısız oldu.';
		$material_status  = 'error';
	} else {
		$material_title  = sanitize_text_field( wp_unslash( $_POST['materyal_baslik'] ) );
		$material_sinif  = intval( $_POST['sinif_grubu'] );
		$material_ders   = intval( $_POST['dersler'] );
		$material_konu   = intval( $_POST['konular'] );
		$material_diger  = sanitize_text_field( wp_unslash( $_POST['diger_konu'] ) );
		$material_body   = wp_kses_post( wp_unslash( $_POST['materyal_icerik'] ) );

		if ( empty( $material_title ) ) {
			$material_message = 'Lütfen bir başlık giriniz.';
			$material_status  = 'error';
		} else {
			// "Diger" secildiyse yeni konu terimi olustur.
			if ( -1 === $material_konu && ! empty( $material_diger ) ) {
				$material_new_term = wp_insert_term( $material_diger, 'konular' );
				if ( ! is_wp_error( $material_new_term ) ) {
					$material_konu = $material_new_term['term_id'];
				}
			}

			$material_post_id = wp_insert_post( array(
				'post_title'   => $material_title,
				'post_content' => $material_body,
				'post_status'  => 'pending',
				'post_type'    => 'materyaller',
			) );

			if ( $material_post_id ) {
				if ( $material_sinif ) {
					wp_set_object_terms( $material_post_id, $material_sinif, 'sinif_grubu' );
				}
				if ( $material_ders ) {
					wp_set_object_terms( $material_post_id, $material_ders, 'dersler' );
				}
				if ( $material_konu && -1 !== $material_konu ) {
					wp_set_object_terms( $material_post_id, $material_konu, 'konular' );
				}

				if ( ! empty( $_FILES['materyal_dosya']['name'] ) ) {
					require_once ABSPATH . 'wp-admin/includes/image.php';
					require_once ABSPATH . 'wp-admin/includes/file.php';
					require_once ABSPATH . 'wp-admin/includes/media.php';

					$material_attachment_id = media_handle_upload( 'materyal_dosya', $material_post_id );

					if ( ! is_wp_error( $material_attachment_id ) ) {
						update_post_meta( $material_post_id, 'yuklenen_dosya_id', $material_attachment_id );
					}
				}

				$material_message = 'Teşekkürler! Materyaliniz başarıyla gönderildi ve onay için sıraya alındı.';
				$material_status  = 'success';
			} else {
				$material_message = 'Sistemsel bir hata oluştu, lütfen tekrar deneyin.';
				$material_status  = 'error';
			}
		}
	}
}

get_header();

// Form alanlarinin ortak Tailwind sinifi.
$material_field_class = 'w-full rounded-lg border border-dune bg-white px-4 py-3 text-[15px] text-ink transition-all placeholder:text-slate/50 focus:border-olive-500 focus:outline-none focus:ring-4 focus:ring-olive-500/10';
$material_label_class = 'mb-2 block font-semibold text-ink';
?>

<div class="<?php material_the_class( 'section', 'bg-cream' ); ?>">
	<div class="mx-auto w-full max-w-7xl px-5 lg:px-8">
		<div class="rounded-card bg-white p-8 shadow-card sm:p-12">

			<header class="text-center">
				<span class="<?php material_the_class( 'badge', material_class( 'badge-olive', 'uppercase tracking-widest' ) ); ?>">
					<svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
						<path d="M18 8a3 3 0 1 0-2.83-4H15a3 3 0 0 0 .17 1L8.9 8.6a3 3 0 1 0 0 6.8l6.27 3.6A3 3 0 1 0 18 16a3 3 0 0 0-1.83.62L10.1 13.1a3 3 0 0 0 0-2.2l6.07-3.52A3 3 0 0 0 18 8Z"/>
					</svg>
					Bilgiyi Paylaşın
				</span>

				<h1 class="<?php material_the_class( 'title', 'mt-6 text-3xl sm:text-4xl lg:text-5xl' ); ?>">Materyal Paylaş</h1>

				<p class="mt-5 text-base leading-relaxed text-slate">
					Elinizdeki eğitim dokümanlarını, soruları ve notları buradaki formu kullanarak tüm
					öğrencilerle ve öğretmenlerle paylaşabilirsiniz. Gönderiniz onaylandıktan sonra
					sistemde yayınlanacaktır.
				</p>
			</header>

			<?php if ( $material_message ) : ?>
				<p class="mt-8 rounded-xl px-5 py-4 text-center font-semibold <?php echo 'success' === $material_status ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700'; ?>">
					<?php echo esc_html( $material_message ); ?>
				</p>
			<?php endif; ?>

			<?php if ( 'success' !== $material_status ) : ?>
				<form action="" method="post" enctype="multipart/form-data" class="mt-10 space-y-5">
					<?php wp_nonce_field( 'materyal_paylas_action', 'materyal_nonce' ); ?>

					<div>
						<label for="materyal-baslik" class="<?php echo esc_attr( $material_label_class ); ?>">Materyal Başlığı *</label>
						<input
							id="materyal-baslik" type="text" name="materyal_baslik" required
							placeholder="Örn: 9. Sınıf Matematik 1. Dönem 1. Yazılı Soruları"
							class="<?php echo esc_attr( $material_field_class ); ?>"
						>
					</div>

					<div class="grid gap-5 sm:grid-cols-2">
						<?php
						$material_selects = array(
							array( 'sinif_grubu', 'Sınıf Seçiniz', 'sinif_grubu' ),
							array( 'dersler', 'Ders Seçiniz', 'dersler' ),
						);
						?>
						<?php foreach ( $material_selects as $material_select ) : ?>
							<div>
								<label for="materyal-<?php echo esc_attr( $material_select[0] ); ?>" class="<?php echo esc_attr( $material_label_class ); ?>">
									<?php echo esc_html( $material_select[1] ); ?>
								</label>
								<select
									id="materyal-<?php echo esc_attr( $material_select[0] ); ?>"
									name="<?php echo esc_attr( $material_select[0] ); ?>"
									class="<?php echo esc_attr( $material_field_class ); ?>"
								>
									<option value="">-- Seçiniz --</option>
									<?php foreach ( get_terms( array( 'taxonomy' => $material_select[2], 'hide_empty' => false ) ) as $material_term ) : ?>
										<option value="<?php echo esc_attr( $material_term->term_id ); ?>"><?php echo esc_html( $material_term->name ); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						<?php endforeach; ?>
					</div>

					<div>
						<label for="konu_secimi" class="<?php echo esc_attr( $material_label_class ); ?>">Konu Seçiniz</label>
						<select id="konu_secimi" name="konular" class="<?php echo esc_attr( $material_field_class ); ?>">
							<option value="">-- Seçiniz --</option>
							<?php foreach ( get_terms( array( 'taxonomy' => 'konular', 'hide_empty' => false ) ) as $material_k ) : ?>
								<option value="<?php echo esc_attr( $material_k->term_id ); ?>"><?php echo esc_html( $material_k->name ); ?></option>
							<?php endforeach; ?>
							<option value="-1">+ Diğer (Listede Yok)</option>
						</select>
					</div>

					<div id="diger_konu_alani" class="hidden">
						<label for="diger-konu" class="<?php echo esc_attr( $material_label_class ); ?>">Lütfen Konuyu Yazınız</label>
						<input
							id="diger-konu" type="text" name="diger_konu"
							placeholder="Yeni konu adını giriniz..."
							class="w-full rounded-lg border border-olive-500 bg-white px-4 py-3 text-[15px] text-ink focus:outline-none focus:ring-4 focus:ring-olive-500/10"
						>
					</div>

					<div>
						<span class="<?php echo esc_attr( $material_label_class ); ?>">Açıklama / İçerik</span>
						<?php
						wp_editor( '', 'materyal_icerik', array(
							'media_buttons' => false,
							'textarea_rows' => 6,
						) );
						?>
					</div>

					<div>
						<label for="materyal-dosya" class="<?php echo esc_attr( $material_label_class ); ?>">Doküman / Dosya Yükle (Varsa)</label>
						<input
							id="materyal-dosya" type="file" name="materyal_dosya"
							class="w-full rounded-lg border border-dashed border-dune bg-cream/50 p-2.5 text-[15px] text-slate file:mr-4 file:rounded-md file:border-0 file:bg-olive-500 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-olive-600"
						>
						<small class="mt-1.5 block text-slate/70">İzin verilen formatlar: PDF, Word, Excel, ZIP (Max: 10MB)</small>
					</div>

					<div class="pt-3 text-center">
						<button type="submit" name="submit_materyal" class="<?php material_the_class( 'btn', material_class( 'btn-primary', 'px-10 py-4 text-base' ) ); ?>">
							Materyali Gönder
						</button>
					</div>
				</form>
			<?php endif; ?>

		</div>
	</div>
</div>

<script>
/* "Diger" secilince serbest konu alanini ac. */
( function () {
	var select = document.getElementById( 'konu_secimi' );
	var field  = document.getElementById( 'diger_konu_alani' );

	if ( ! select || ! field ) {
		return;
	}

	select.addEventListener( 'change', function () {
		var isOther = select.value === '-1';
		var input   = field.querySelector( 'input' );

		field.classList.toggle( 'hidden', ! isOther );

		if ( isOther ) {
			input.setAttribute( 'required', 'required' );
		} else {
			input.removeAttribute( 'required' );
		}
	} );
} )();
</script>

<?php get_footer(); ?>
