(function () {
	'use strict';

	function tmpl( str, data ) {
		// Figure out if we're getting a template, or if we need to
		// load the template - and be sure to cache the result.
		let fn = !/\W/.test( str ) ?
			cache[ str ] = cache[ str ] ||
				tmpl( document.getElementById( str ).innerHTML ) :

			// Generate a reusable function that will serve as a template
			// generator (and which will be cached).
			new Function( "obj",
				"var p=[],print=function(){p.push.apply(p,arguments);};" +

				// Introduce the data as local variables using with(){}
				"with(obj){p.push('" +

				// Convert the template into pure JavaScript
				str
				//.toString()
					.replace( /[\r\t\n]/g, " " )
					.split( "<%" ).join( "\t" )
					.replace( /((^|%>)[^\t]*)'/g, "$1\r" )
					.replace( /\t=(.*?)%>/g, "',$1,'" )
					.split( "\t" ).join( "');" )
					.split( "%>" ).join( "p.push('" )
					.split( "\r" ).join( "\\'" )
				+ "');}return p.join('');" );
		// Provide some basic currying to the user
		return data ? fn( data ) : fn;
	}


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


	/**
	 * Функция для отправки асинхронного запроса и получения ответа
	 *
	 * @param options
	 * @returns {Promise<any>}
	 */
	function ajax( options ) {
		// при асинхронном запросе мы используем промисы - обещания
		return new Promise( function ( resolve, reject ) {
				let xhr    = new XMLHttpRequest();
				let params = options.data;
				let url    = options.url;

				// указаны ли параметры и являются ли они объектом
				if ( params && 'object' === typeof params ) {

					// преобразование объекта в кодированную строку
					params = Object.keys( params ).map( function ( key ) {
						return encodeURIComponent( key ) + '=' + encodeURIComponent( params[ key ] );
					} ).join( '&' );
				} else {
					params = '';
				}

				// если запрос делается не методом POST
				if ( params && 'POST' !== options.method ) {
					url = options.url + '?' + params;
				}

				// предварительные настройки подключения
				xhr.open( options.method, url );

				// при ответе
				xhr.onload = function () {

					// проверяем все ли хорошо
					if ( this.status >= 200 && this.status < 300 ) {

						// возвращаем результат запроса
						resolve( xhr.response );
					} else {

						// если све плохо, возвращаем текст ошики
						reject( {
							status : this.status,
							statusText : xhr.statusText
						} );
					}
				};

				// при отправке запроса методом POST указываем необходимый заголовок
				if ( 'POST' === options.method ) {
					xhr.setRequestHeader( "Content-type", "application/x-www-form-urlcoded" );
				}

				// если есть какие-то дополнительные заголовки
				if ( options.headers ) {

					// устанавливаем их
					Object.keys( options.headers ).forEach( function ( key ) {
						xhr.setRequestHeader( key, options.headers[ key ] );
					} );
				}

				// совершаем запрос
				xhr.send( params );
			}
		);
	}


	/**
	 * Обработка ввода текста в поле ввода
	 */
	on( 'submit', '.js-form-profile', function ( event ) {
		event.preventDefault();

		let form = event.target;
		// получение данных формы
		let data = form.closest( 'form' ).serialize();

		// вывод данных в консоль
		console.log( data );

		// отправка запроса
		ajax( {
			method : 'GET',
			url : 'includes/ajax.php',
			headers : {
				'Access-Control-Allow-Origin' : '*',
			},
			data : data
		} ).then( function ( result ) {
			// запрос выполнен успешно

			// преобразование полученных данных из строки в фомате json в объект
			result = JSON.parse( result );
			console.log( result );

			if ( result.hasOwnProperty( 'success' ) && true === result[ 'success' ] ) {
				form.querySelector( '.js-form__info' ).innerHTML = 'Данные сохранены';
			}

		} ).catch( function ( err ) {
			// запрос выполнен не успешно

			// вывод возникшей ошибки
			if ( err.hasOwnProperty( 'statusText' ) ) {
				console.error( 'Возникла ошибка', err.statusText );
			} else {
				console.error( err );
			}
		} );

	} );


}());
