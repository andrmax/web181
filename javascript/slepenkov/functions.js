(function ( $ ) {
	$( 'div' ).on( 'click', function ( event ) {
		$( this ).css( 'color', 'green' );
	} );

	$( '.js-red' ).on( 'click', function ( event ) {
		$( 'div' ).css( 'backgroundColor', 'red' );
		console.log( $( this ).width() );
		console.log( $( this ).css( 'width' ) );
	} );

	let i = 3;
	$( '.js-add' ).on( 'click', function () {
		$( '.box' ).append( '<div>Text ' + (++i) + '</div>' );
	} );

	$( '.js-add-item' ).on( 'click', function () {
		let clone = $( '.js-example' ).clone();
		clone.removeClass( 'js-example' );
		clone.removeClass( 'hidden' );

		clone.attr( 'data-index', ++i );
		$( '.js-items' ).append( clone );
	} );

	$( document ).on( 'click', '.js-remove', function () {
		$( this ).closest( '.input-group' ).remove();
	} );

	$( '.js-get-data' ).on( 'click', function () {
		$.post( "ajax.txt", function ( data ) {

		} )
		 .done( function ( data ) {
			 $( ".result" ).html( data );
			 console.log( "second success" );
		 } )
		 .fail( function () {
			 console.log( "error" );
		 } )
		 .always( function () {
			 console.log( "finished" );
		 } );
	} );


	// Запомним в куках, что посетитель к нам уже заходил

	$( '.js-set-cookie' ).on( 'click', function () {
		document.cookie = "newcookie=1234;";
	} );

	let cookie = document.cookie;
	cookie     = cookie.split( ';' );

	let cookie_obj = {};
	for ( let i in cookie ) {
		if ( cookie.hasOwnProperty( i ) ) {
			cookie[ i ]                    = cookie[ i ].trim();
			cookie[ i ]                    = cookie[ i ].split( '=' );
			cookie_obj[ cookie[ i ][ 0 ] ] = cookie[ i ][ 1 ];
		}
	}

	console.log( cookie_obj );

	if ( undefined !== cookie_obj[ 'newcookie' ] ) {
		$( '.modal' ).hide();
	} else {
		$( '.modal' ).css( 'backgroundColor', 'purple' );
	}


	// получение значения элемента найденного с помощью селектора на чистом JS
	console.log( document.querySelector( '[name=fio]' ).value );

	// получение значения элемента найденного с помощью селектора на jquery
	console.log( $( '[name=fio]' ).val() );

	// получение значений полей формы
	$( '#form' ).on( 'submit', function ( event ) {
		event.preventDefault();
		let data = $( this ).serialize();
		console.log( data );
	} );


	$( '.box div' ).each( function ( i ) {
		$( this ).html( i );
	} );


}( jQuery ));
