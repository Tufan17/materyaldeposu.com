/**
 * Tema etkilesimleri: mobil menu, sticky header golgesi, sayac animasyonu.
 * Gorunum tamamen Tailwind siniflari uzerinden degistirilir.
 */
( function () {
	'use strict';

	/* --- Mobil menu --- */
	var toggle = document.querySelector( '[data-menu-toggle]' );
	var menu   = document.querySelector( '[data-mobile-menu]' );

	if ( toggle && menu ) {
		toggle.addEventListener( 'click', function () {
			var isOpen = toggle.getAttribute( 'aria-expanded' ) === 'true';

			toggle.setAttribute( 'aria-expanded', String( ! isOpen ) );
			menu.classList.toggle( 'hidden', isOpen );

			var iconOpen  = toggle.querySelector( '[data-menu-icon-open]' );
			var iconClose = toggle.querySelector( '[data-menu-icon-close]' );

			if ( iconOpen && iconClose ) {
				iconOpen.classList.toggle( 'hidden', ! isOpen );
				iconClose.classList.toggle( 'hidden', isOpen );
			}
		} );
	}

	/* --- Header: sayfa kaydirilinca opaklas ---
	 * Overlay modda (hero'lu sayfalar) header gorselin uzerinde seffaf ve
	 * beyaz metinle durur; kaydirilinca sabitlenip krem zemine gecer.
	 */
	var header = document.querySelector( '[data-site-header]' );

	if ( header ) {
		var isOverlay = header.hasAttribute( 'data-header-overlay' );

		// Seffaf durumda acik olan siniflar / opak durumda acik olan siniflar.
		var transparentClasses = isOverlay
			? [ 'absolute', 'bg-transparent', 'border-transparent', 'text-white' ]
			: [];

		var solidClasses = isOverlay
			? [ 'fixed', 'bg-cream/95', 'border-dune/50', 'text-ink', 'backdrop-blur-md', 'shadow-lift' ]
			: [ 'shadow-lift', 'bg-cream/95' ];

		var syncHeader = function () {
			var scrolled = window.scrollY > 24;

			transparentClasses.forEach( function ( cls ) {
				header.classList.toggle( cls, ! scrolled );
			} );
			solidClasses.forEach( function ( cls ) {
				header.classList.toggle( cls, scrolled );
			} );
		};

		syncHeader();
		window.addEventListener( 'scroll', syncHeader, { passive: true } );
	}

	/* --- Scroll reveal ---
	 * [data-reveal] tasiyan ogeler baslangicta opacity-0 + translate ile durur;
	 * gorunur olunca bu siniflar kaldirilir ve CSS gecisi devreye girer.
	 */
	var revealables = document.querySelectorAll( '[data-reveal]' );

	if ( revealables.length && 'IntersectionObserver' in window ) {
		var revealObserver = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( ! entry.isIntersecting ) {
					return;
				}

				var el    = entry.target;
				var delay = parseInt( el.getAttribute( 'data-reveal-delay' ), 10 ) || 0;

				setTimeout( function () {
					el.classList.remove( 'opacity-0', 'translate-y-8', 'scale-95' );
				}, delay );

				revealObserver.unobserve( el );
			} );
		}, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' } );

		revealables.forEach( function ( el ) {
			revealObserver.observe( el );
		} );
	} else {
		revealables.forEach( function ( el ) {
			el.classList.remove( 'opacity-0', 'translate-y-8', 'scale-95' );
		} );
	}

	/* --- Sayaclar: gorunur olunca hedefe kadar say --- */
	var counters = document.querySelectorAll( '[data-counter-to]' );

	if ( counters.length && 'IntersectionObserver' in window ) {
		var run = function ( el ) {
			var target   = parseInt( el.getAttribute( 'data-counter-to' ), 10 ) || 0;
			var suffix   = el.getAttribute( 'data-counter-suffix' ) || '';
			var duration = 1200;
			var started  = null;

			var step = function ( now ) {
				if ( ! started ) {
					started = now;
				}

				var progress = Math.min( ( now - started ) / duration, 1 );
				// easeOutCubic
				var eased = 1 - Math.pow( 1 - progress, 3 );

				el.textContent = Math.round( target * eased ).toLocaleString( 'tr-TR' ) + suffix;

				if ( progress < 1 ) {
					requestAnimationFrame( step );
				}
			};

			requestAnimationFrame( step );
		};

		var observer = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting ) {
					run( entry.target );
					observer.unobserve( entry.target );
				}
			} );
		}, { threshold: 0.4 } );

		counters.forEach( function ( el ) {
			observer.observe( el );
		} );
	} else {
		counters.forEach( function ( el ) {
			el.textContent = el.getAttribute( 'data-counter-to' )
				+ ( el.getAttribute( 'data-counter-suffix' ) || '' );
		} );
	}
} )();
