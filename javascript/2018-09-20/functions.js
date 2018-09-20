(function ( d ) {
	'use strict';

	function active_slide() {
		let list   = d.getElementsByClassName( 'js-slider__list' );
		let slides = list[ 0 ].getElementsByTagName( 'li' );
		let count  = slides.length;
		let j      = -1;
		setInterval( function () {
			for ( let i in slides ) {
				if ( slides.hasOwnProperty( i ) ) {
					if ( slides[ i ].classList.contains( 'active' ) ) {
						j = parseInt( i ) + 1;
					}
					slides[ i ].classList.remove( 'active' );
					console.log( 'i=' + i + ', j=' + j + ', count=' + count );
					if ( parseInt( i ) === j ) {

						slides[ i ].classList.add( 'active' );
						//j = -1;
						if ( j === count ) {
							j = 0;
						}
					}
				}
			}
		}, 3000 );
	}



	function turnon_the_slide( shift ) {
		let list   = d.getElementsByClassName( 'js-slider__list' );
		let slides = list[ 0 ].getElementsByTagName( 'li' );
		let count  = slides.length;
		let index  = -1;
		for ( let i in slides ) {
			if ( slides.hasOwnProperty( i ) ) {
				slides[ i ].setAttribute( 'data-index', i );
				if ( slides[ i ].classList.contains( 'active' ) ) {
					index = i;
				}
				slides[ i ].classList.remove( 'active' );
			}
		}
		index = parseInt( index ) + parseInt( shift );
		if ( index < 0 ) {
			index = count - 1;
		}
		if ( index >= count ) {
			index = 0;
		}

		let active = list[ 0 ].querySelector( '[data-index="' + index + '"]' );
		active.classList.add( 'active' );
	}

	let navs = d.getElementsByClassName( 'js-slider__nav' );
	for ( let i in navs ) {
		if ( navs.hasOwnProperty( i ) ) {
			navs[ i ].addEventListener( 'click', function ( event ) {
				let shift = event.target.getAttribute( 'data-shift' );
				console.log( 'sdgb' );
				turnon_the_slide( shift );
			} );
		}
	}

	setInterval( function () {
		turnon_the_slide( 1 );
	}, 3000 );

}( document ));
