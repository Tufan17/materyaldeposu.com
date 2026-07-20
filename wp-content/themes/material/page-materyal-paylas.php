<?php
/**
 * Template Name: Materyal Paylaş
 *
 * Gonderilen materyaller 'pending' olarak kaydedilir, yani yonetici
 * onaylayana kadar sitede yayinlanmaz.
 *
 * @package Material
 */

$material_message = '';
$material_status  = '';
$material_notes   = array();

/** Yuklenebilecek azami dosya boyutu. */
if ( ! defined( 'MATERIAL_UPLOAD_MAX_BYTES' ) ) {
	define( 'MATERIAL_UPLOAD_MAX_BYTES', 10485760 ); // 10 MB.
}

/**
 * Tek dosyalik $_FILES girdilerini media_handle_upload'in bekledigi
 * duz yapiya cevirir (input[multiple] dizi olarak geliyor).
 */
if ( ! function_exists( 'material_reindex_files' ) ) :
function material_reindex_files( $key ) {
	if ( empty( $_FILES[ $key ] ) || ! is_array( $_FILES[ $key ]['name'] ) ) {
		return array();
	}

	$files = array();

	foreach ( $_FILES[ $key ]['name'] as $index => $name ) {
		if ( '' === $name ) {
			continue;
		}

		$files[] = array(
			'name'     => $name,
			'type'     => $_FILES[ $key ]['type'][ $index ],
			'tmp_name' => $_FILES[ $key ]['tmp_name'][ $index ],
			'error'    => $_FILES[ $key ]['error'][ $index ],
			'size'     => $_FILES[ $key ]['size'][ $index ],
		);
	}

	return $files;
}
endif;

if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['submit_materyal'] ) ) {

	if ( ! isset( $_POST['materyal_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['materyal_nonce'] ), 'materyal_paylas_action' ) ) {
		$material_message = 'Güvenlik doğrulaması başarısız oldu.';
		$material_status  = 'error';
	} else {
		$material_title = sanitize_text_field( wp_unslash( $_POST['materyal_baslik'] ) );
		$material_sinif = isset( $_POST['sinif_grubu'] ) ? intval( $_POST['sinif_grubu'] ) : 0;
		$material_ders  = isset( $_POST['dersler'] ) ? intval( $_POST['dersler'] ) : 0;
		$material_konu  = isset( $_POST['konular'] ) ? intval( $_POST['konular'] ) : 0;
		$material_diger = isset( $_POST['diger_konu'] ) ? sanitize_text_field( wp_unslash( $_POST['diger_konu'] ) ) : '';
		$material_body  = isset( $_POST['materyal_icerik'] ) ? wp_kses_post( wp_unslash( $_POST['materyal_icerik'] ) ) : '';

		// Sinif secilmediyse kademeyi kullan (kademenin alt sinifi olmayabilir).
		if ( ! $material_sinif && isset( $_POST['sinif_kademe'] ) ) {
			$material_sinif = intval( $_POST['sinif_kademe'] );
		}

		if ( empty( $material_title ) ) {
			$material_message = 'Lütfen bir başlık giriniz.';
			$material_status  = 'error';
		} else {
			// "Diger" secildiyse yeni konu terimi olustur.
			if ( -1 === $material_konu && ! empty( $material_diger ) ) {
				$material_new_term = wp_insert_term( $material_diger, 'konular' );

				if ( ! is_wp_error( $material_new_term ) ) {
					$material_konu = $material_new_term['term_id'];
					// Yeni konuyu secilen derse bagla ki hiyerarsi bozulmasin.
					if ( $material_ders ) {
						update_term_meta( $material_konu, 'bagli_ders', $material_ders );
					}
				} else {
					$material_konu = 0;
				}
			}

			$material_post_id = wp_insert_post( array(
				'post_title'   => $material_title,
				'post_content' => $material_body,
				'post_status'  => 'pending', // Yonetici onayina duser.
				'post_type'    => 'materyaller',
			) );

			if ( $material_post_id && ! is_wp_error( $material_post_id ) ) {

				if ( $material_sinif ) {
					wp_set_object_terms( $material_post_id, $material_sinif, 'sinif_grubu' );
				}
				if ( $material_ders ) {
					wp_set_object_terms( $material_post_id, $material_ders, 'dersler' );
				}
				if ( $material_konu > 0 ) {
					wp_set_object_terms( $material_post_id, $material_konu, 'konular' );
				}

				// ---------- Coklu dosya yukleme ----------
				$material_files = material_reindex_files( 'materyal_dosya' );

				if ( $material_files ) {
					require_once ABSPATH . 'wp-admin/includes/image.php';
					require_once ABSPATH . 'wp-admin/includes/file.php';
					require_once ABSPATH . 'wp-admin/includes/media.php';

					$material_allowed     = get_allowed_mime_types();
					$material_uploaded_ids = array();

					foreach ( $material_files as $material_file ) {

						if ( $material_file['size'] > MATERIAL_UPLOAD_MAX_BYTES ) {
							$material_notes[] = sprintf( '"%s" 10 MB sınırını aştığı için yüklenmedi.', $material_file['name'] );
							continue;
						}

						$material_check = wp_check_filetype_and_ext( $material_file['tmp_name'], $material_file['name'], $material_allowed );

						if ( empty( $material_check['type'] ) ) {
							$material_notes[] = sprintf( '"%s" desteklenmeyen bir dosya türü olduğu için yüklenmedi.', $material_file['name'] );
							continue;
						}

						// media_handle_upload tek dosya bekliyor; gecici olarak yerine koyuyoruz.
						$_FILES['materyal_dosya_tek'] = $material_file;

						$material_attachment_id = media_handle_upload( 'materyal_dosya_tek', $material_post_id );

						if ( is_wp_error( $material_attachment_id ) ) {
							$material_notes[] = sprintf( '"%s" yüklenemedi: %s', $material_file['name'], $material_attachment_id->get_error_message() );
						} else {
							$material_uploaded_ids[] = $material_attachment_id;
						}

						unset( $_FILES['materyal_dosya_tek'] );
					}

					if ( $material_uploaded_ids ) {
						update_post_meta( $material_post_id, 'yuklenen_dosya_ids', $material_uploaded_ids );
						// Eski tekil alan, geriye donuk uyumluluk icin.
						update_post_meta( $material_post_id, 'yuklenen_dosya_id', $material_uploaded_ids[0] );
					}
				}

				$material_message = 'Teşekkürler! Materyaliniz gönderildi ve yönetici onayına alındı. Onaylandıktan sonra sitede yayınlanacak.';
				$material_status  = 'success';

				/**
				 * Yeni materyal onaya dustugunde tetiklenir.
				 *
				 * @param int $material_post_id Olusturulan materyalin ID'si.
				 */
				do_action( 'material_pending_submission', $material_post_id );
			} else {
				$material_message = 'Sistemsel bir hata oluştu, lütfen tekrar deneyin.';
				$material_status  = 'error';
			}
		}
	}
}

get_header();

// ---------- Kademe > Sinif > Ders > Konu agaci ----------
// Secim kutulari bu agaca gore istemci tarafinda daraltiliyor; her adimda
// AJAX beklemek yerine terim sayisi az oldugu icin tek seferde gomuyoruz.
$material_kademeler = get_terms( array(
	'taxonomy'   => 'sinif_grubu',
	'parent'     => 0,
	'hide_empty' => false,
) );

if ( is_wp_error( $material_kademeler ) ) {
	$material_kademeler = array();
}

usort( $material_kademeler, function ( $a, $b ) {
	return (int) get_term_meta( $a->term_id, 'sinif_grubu_order', true )
		- (int) get_term_meta( $b->term_id, 'sinif_grubu_order', true );
} );

/*
 * Hiyerarsi kati: her ders yalnizca bagli oldugu sinifta, her konu yalnizca
 * bagli oldugu derste listelenir. Bir dersin/konunun formda gorunmesi icin
 * yoneticinin terim duzenleme ekranindan "Bagli Oldugu Sinif/Ders" alanini
 * doldurmus olmasi gerekir. Listede olmayan konu icin "+ Diger" secenegi var.
 */
$material_tree = array(
	'siniflar' => array(), // kademe_id => [ {id, name} ]
	'dersler'  => array(), // sinif_id  => [ {id, name} ]
	'konular'  => array(), // ders_id   => [ {id, name} ]
);

foreach ( $material_kademeler as $material_kademe ) {
	$material_children = get_terms( array(
		'taxonomy'   => 'sinif_grubu',
		'parent'     => $material_kademe->term_id,
		'hide_empty' => false,
	) );

	if ( is_wp_error( $material_children ) ) {
		$material_children = array();
	}

	usort( $material_children, function ( $a, $b ) {
		$order_a = (int) get_term_meta( $a->term_id, 'sinif_grubu_order', true );
		$order_b = (int) get_term_meta( $b->term_id, 'sinif_grubu_order', true );

		return $order_a === $order_b ? strnatcmp( $a->name, $b->name ) : $order_a - $order_b;
	} );

	$material_tree['siniflar'][ $material_kademe->term_id ] = array_map( function ( $t ) {
		return array( 'id' => $t->term_id, 'name' => $t->name );
	}, $material_children );
}

foreach ( get_terms( array( 'taxonomy' => 'dersler', 'hide_empty' => false ) ) as $material_d ) {
	$material_bagli = (int) get_term_meta( $material_d->term_id, 'bagli_sinif', true );

	if ( ! $material_bagli ) {
		continue;
	}

	$material_tree['dersler'][ $material_bagli ][] = array( 'id' => $material_d->term_id, 'name' => $material_d->name );
}

foreach ( get_terms( array( 'taxonomy' => 'konular', 'hide_empty' => false ) ) as $material_k ) {
	$material_bagli = (int) get_term_meta( $material_k->term_id, 'bagli_ders', true );

	if ( ! $material_bagli ) {
		continue;
	}

	$material_tree['konular'][ $material_bagli ][] = array( 'id' => $material_k->term_id, 'name' => $material_k->name );
}

// Form alanlarinin ortak Tailwind sinifi.
$material_field_class = 'w-full rounded-lg border border-dune bg-white px-4 py-3 text-[15px] text-ink transition-all placeholder:text-slate/50 focus:border-olive-500 focus:outline-none focus:ring-4 focus:ring-olive-500/10 disabled:cursor-not-allowed disabled:bg-cream/60 disabled:text-slate/50';
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

				<p class="mx-auto mt-5 max-w-2xl text-base leading-relaxed text-slate">
					Elinizdeki eğitim dokümanlarını, soruları ve notları buradaki formu kullanarak tüm
					öğrencilerle ve öğretmenlerle paylaşabilirsiniz. Gönderiniz onaylandıktan sonra
					sistemde yayınlanacaktır.
				</p>
			</header>

			<?php if ( $material_message ) : ?>
				<div class="mx-auto mt-8 max-w-3xl rounded-xl px-5 py-4 text-center <?php echo 'success' === $material_status ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700'; ?>">
					<p class="font-semibold"><?php echo esc_html( $material_message ); ?></p>

					<?php if ( $material_notes ) : ?>
						<ul class="mt-3 space-y-1 text-sm">
							<?php foreach ( $material_notes as $material_note ) : ?>
								<li><?php echo esc_html( $material_note ); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ( 'success' !== $material_status ) : ?>
				<form action="" method="post" enctype="multipart/form-data" class="mx-auto mt-10 max-w-3xl space-y-5">
					<?php wp_nonce_field( 'materyal_paylas_action', 'materyal_nonce' ); ?>

					<div>
						<label for="materyal-baslik" class="<?php echo esc_attr( $material_label_class ); ?>">Materyal Başlığı *</label>
						<input
							id="materyal-baslik" type="text" name="materyal_baslik" required
							placeholder="Örn: 9. Sınıf Matematik 1. Dönem 1. Yazılı Soruları"
							class="<?php echo esc_attr( $material_field_class ); ?>"
						>
					</div>

					<?php // ---------- Kademe > Sinif ---------- ?>
					<div class="grid gap-5 sm:grid-cols-2">
						<div>
							<label for="sinif_kademe" class="<?php echo esc_attr( $material_label_class ); ?>">Kademe Seçiniz</label>
							<select id="sinif_kademe" name="sinif_kademe" class="<?php echo esc_attr( $material_field_class ); ?>">
								<option value="">-- Seçiniz --</option>
								<?php foreach ( $material_kademeler as $material_kademe ) : ?>
									<option value="<?php echo esc_attr( $material_kademe->term_id ); ?>">
										<?php echo esc_html( $material_kademe->name ); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>

						<div>
							<label for="sinif_grubu" class="<?php echo esc_attr( $material_label_class ); ?>">Sınıf Seçiniz</label>
							<select id="sinif_grubu" name="sinif_grubu" class="<?php echo esc_attr( $material_field_class ); ?>" disabled>
								<option value="">-- Önce Kademe Seçin --</option>
							</select>
						</div>
					</div>

					<?php // ---------- Ders > Konu ---------- ?>
					<div class="grid gap-5 sm:grid-cols-2">
						<div>
							<label for="dersler" class="<?php echo esc_attr( $material_label_class ); ?>">Ders Seçiniz</label>
							<select id="dersler" name="dersler" class="<?php echo esc_attr( $material_field_class ); ?>" disabled>
								<option value="">-- Önce Sınıf Seçin --</option>
							</select>
						</div>

						<div>
							<label for="konular" class="<?php echo esc_attr( $material_label_class ); ?>">Konu Seçiniz</label>
							<select id="konular" name="konular" class="<?php echo esc_attr( $material_field_class ); ?>" disabled>
								<option value="">-- Önce Ders Seçin --</option>
							</select>
						</div>
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

					<?php // ---------- Coklu dosya ---------- ?>
					<div>
						<label for="materyal-dosya" class="<?php echo esc_attr( $material_label_class ); ?>">
							Doküman / Dosya Yükle (Birden fazla seçebilirsiniz)
						</label>
						<input
							id="materyal-dosya" type="file" name="materyal_dosya[]" multiple
							class="w-full rounded-lg border border-dashed border-dune bg-cream/50 p-2.5 text-[15px] text-slate file:mr-4 file:rounded-md file:border-0 file:bg-olive-500 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-olive-600"
						>
						<small class="mt-1.5 block text-slate/70">
							PDF, Word, Excel, görsel veya ZIP — dosya başına en fazla 10 MB.
						</small>

						<ul id="dosya_listesi" class="mt-3 hidden space-y-2 text-sm"></ul>
					</div>

					<div class="pt-3 text-center">
						<button type="submit" name="submit_materyal" class="<?php material_the_class( 'btn', material_class( 'btn-primary', 'px-10 py-4 text-base' ) ); ?>">
							Materyali Gönder
						</button>
						<p class="mt-3 text-sm text-slate/70">Gönderiniz yönetici onayından sonra yayınlanır.</p>
					</div>
				</form>
			<?php endif; ?>

		</div>
	</div>
</div>

<script>
/* Kademe > Sinif > Ders > Konu kademeli secim ve secilen dosyalarin listesi. */
( function () {
	'use strict';

	var tree = <?php echo wp_json_encode( $material_tree ); ?>;

	var kademe = document.getElementById( 'sinif_kademe' );
	var sinif  = document.getElementById( 'sinif_grubu' );
	var ders   = document.getElementById( 'dersler' );
	var konu   = document.getElementById( 'konular' );
	var diger  = document.getElementById( 'diger_konu_alani' );

	if ( ! kademe || ! sinif || ! ders || ! konu ) {
		return;
	}

	/**
	 * Bir select'i verilen seceneklerle doldurur.
	 *
	 * @param {HTMLSelectElement} select
	 * @param {Array}  items       [{id, name}]
	 * @param {string} emptyLabel  Hicbir sey secilmemisken gosterilecek metin.
	 * @param {string} blockedLabel Ust adim secilmemisken gosterilecek metin.
	 */
	function fill( select, items, emptyLabel, blockedLabel ) {
		select.innerHTML = '';

		if ( ! items ) {
			select.appendChild( new Option( blockedLabel, '' ) );
			select.disabled = true;
			return;
		}

		select.appendChild( new Option( emptyLabel, '' ) );

		items.forEach( function ( item ) {
			select.appendChild( new Option( item.name, item.id ) );
		} );

		select.disabled = false;
	}

	function resetKonu() {
		fill( konu, null, '', '-- Önce Ders Seçin --' );
		toggleDiger();
	}

	function resetDers() {
		fill( ders, null, '', '-- Önce Sınıf Seçin --' );
		resetKonu();
	}

	function toggleDiger() {
		if ( ! diger ) {
			return;
		}

		var isOther = konu.value === '-1';
		var input   = diger.querySelector( 'input' );

		diger.classList.toggle( 'hidden', ! isOther );

		if ( isOther ) {
			input.setAttribute( 'required', 'required' );
		} else {
			input.removeAttribute( 'required' );
		}
	}

	kademe.addEventListener( 'change', function () {
		var children = tree.siniflar[ kademe.value ];

		if ( ! kademe.value ) {
			fill( sinif, null, '', '-- Önce Kademe Seçin --' );
			resetDers();
			return;
		}

		// Kademenin alt sinifi yoksa kademenin kendisi sinif olarak kullanilir.
		if ( ! children || ! children.length ) {
			fill( sinif, [ { id: kademe.value, name: kademe.options[ kademe.selectedIndex ].text } ], '-- Seçiniz --', '' );
			sinif.selectedIndex = 1;
			sinif.dispatchEvent( new Event( 'change' ) );
			return;
		}

		fill( sinif, children, '-- Seçiniz --', '' );
		resetDers();
	} );

	sinif.addEventListener( 'change', function () {
		if ( ! sinif.value ) {
			resetDers();
			return;
		}

		// Yalnizca bu sinifa bagli dersler.
		var dersler = tree.dersler[ sinif.value ];

		if ( ! dersler || ! dersler.length ) {
			fill( ders, null, '', '-- Bu sınıfa ait ders yok --' );
			resetKonu();
			return;
		}

		fill( ders, dersler, '-- Seçiniz --', '' );
		resetKonu();
	} );

	ders.addEventListener( 'change', function () {
		if ( ! ders.value ) {
			resetKonu();
			return;
		}

		// Yalnizca bu derse bagli konular; listede yoksa "+ Diger" ile eklenir.
		var items = ( tree.konular[ ders.value ] || [] ).slice();

		items.push( { id: -1, name: '+ Diğer (Listede Yok)' } );

		fill( konu, items, '-- Seçiniz --', '' );
		toggleDiger();
	} );

	konu.addEventListener( 'change', toggleDiger );

	/* Secilen dosyalari listele. */
	var fileInput = document.getElementById( 'materyal-dosya' );
	var fileList  = document.getElementById( 'dosya_listesi' );

	if ( fileInput && fileList ) {
		fileInput.addEventListener( 'change', function () {
			fileList.innerHTML = '';
			fileList.classList.toggle( 'hidden', ! fileInput.files.length );

			Array.prototype.forEach.call( fileInput.files, function ( file ) {
				var tooBig = file.size > <?php echo (int) MATERIAL_UPLOAD_MAX_BYTES; ?>;
				var li     = document.createElement( 'li' );

				li.className = 'flex items-center justify-between gap-3 rounded-lg border px-4 py-2 '
					+ ( tooBig ? 'border-red-200 bg-red-50 text-red-700' : 'border-dune bg-cream/50 text-slate' );

				var name = document.createElement( 'span' );
				name.className = 'truncate';
				name.textContent = file.name;

				var size = document.createElement( 'span' );
				size.className = 'shrink-0 font-semibold';
				size.textContent = tooBig
					? '10 MB üstü'
					: ( file.size / 1048576 ).toFixed( 1 ) + ' MB';

				li.appendChild( name );
				li.appendChild( size );
				fileList.appendChild( li );
			} );
		} );
	}
} )();
</script>

<?php get_footer(); ?>
