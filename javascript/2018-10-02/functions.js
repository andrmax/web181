(function () {
	'use strict';

	Object.defineProperty( Object.prototype, 'serialize', {
		value : function ( format ) {
			let inputs = this.querySelectorAll( '[name]' );
			let val;
			// массив, содержащий ключи элементов
			let arr    = [];
			let obj    = {};
			let s      = [];
			let a      = [];
			let out    = {};

			for ( let i in inputs ) {
				if ( inputs.hasOwnProperty( i ) ) {
					let that = inputs[ i ];

					val = that.value ? that.value : '';
					if ( undefined !== that.getAttribute( 'type' ) && 'checkbox' === that.getAttribute( 'type' ) ) {
						if ( undefined !== that.getAttribute( 'checked' ) ) {
							arr.push( { name : that.getAttribute( 'name' ), value : '' } );
						} else {
							arr.push( { name : that.getAttribute( 'name' ), value : val } );
						}
					} else {
						if ( undefined !== that.getAttribute( 'multiple' ) ) {

							if ( null === val ) {
								arr.push( { name : that.getAttribute( 'name' ), value : '' } );
							} else {
								arr.push( { name : that.getAttribute( 'name' ), value : val } );
							}
						} else {
							arr.push( { name : that.getAttribute( 'name' ), value : val } );
						}
					}
				}
			}


			for ( let i in arr ) {
				if ( arr.hasOwnProperty( i ) ) {

					if ( undefined === obj[ arr[ i ].name ] ) {

						obj[ arr[ i ].name ] = arr[ i ].value;
					} else {
						if ( !Array.isArray( obj[ arr[ i ].name ] ) ) {
							obj[ arr[ i ].name ] = [ obj[ arr[ i ].name ] ];
						}
						obj[ arr[ i ].name ].push( arr[ i ].value );
					}
				}
			}


			//if ( 'string' === format || 'attributes' === format ) {

			for ( let key in obj ) {
				if ( obj.hasOwnProperty( key ) ) {
					let value = obj[ key ];

					if ( true === Array.isArray( value ) ) {
						value = value.join( ',' );
					}
					s.push( key + '=' + value );
					a.push( key + '="' + value + '"' );
				}
			}


			//}

			s = encodeURI( s.join( '&' ) );
			a = a.join( ' ' );


			switch ( format ) {
				case 'string':
					out = s;
					break;
				case 'attributes':
					out = a;
					break;
				case 'array':
					out = arr;
					break;
				default:
					out = obj;
			}

			return out;
		}
	} );


	function on( e, selector, func ) {
		document.addEventListener( e, function ( event ) {
			if ( null !== event.target.closest( selector ) ) {
				func( event, selector );
			}
		} );

	}

	on( 'click', '[type="submit"]', function ( event ) {
		event.preventDefault();

		let element                                     = event.target.closest( 'form' );
		let url                                         = 'http://yandex.ru/search/';
		document.querySelector( '[name=result]' ).value = url + '?' + element.serialize( 'string' );
		let xhr                                         = new XMLHttpRequest();
		xhr.open( 'get', url );
		xhr.send( element.serialize( 'string' ) );

	} );


}());
