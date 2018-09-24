let element = document.getElementById( 'list_2' );

console.log( element );

element.style.backgroundColor = '#f00';
element.style.color           = '#eee';

document.getElementById( 'list_1' ).style.backgroundColor = 'green';
document.getElementById( 'list_1' ).style.color           = 'white';


let items = document.getElementsByClassName( 'item' );
console.log( items );

//items.style.color = '#0f0';

// 1-й способ применения стилей ко всем найденным элементам
let count = items.length;

for ( let i = 0; i < count; i++ ) {
	items[ i ].style.color = '#0f0';
	console.log( i );
}

// универсальная функция перебора элементов
for ( let i in items ) {
	if ( items.hasOwnProperty( i ) ) {
		items[ i ].style.color = '#ff6bb5';
	}
}

// для html-коллекций функция forEach не работает напрямую
/*items.forEach( function ( element ) {
	element.style.color = '#0355ff';
} );*/

let item         = document.querySelector( '.item' );
item.style.color = '#1fb0ff';

let query_items = document.querySelectorAll( '.item' );
for ( let i in query_items ) {
	if ( query_items.hasOwnProperty( i ) ) {
		query_items[ i ].style.color = '#23ff82';
	}
}

function sum_numbers( element ) {

	// определение формы, внутри которой расположена кнопка,
	// по которой был произведен клик
	let form = element.closest( '.math-form' );

	let action   = form.getAttribute( 'data-action' );
	// поиск всех элементов у которых есть атрибут name
	let elements = form.querySelectorAll( '[name]' );
	let sum      = 0;
	switch ( action ) {
		case 'multiply':
			sum = 1;
			break;
		case 'sum':
			sum = 0;
			break;
	}

	for ( let j in elements ) {
		if ( elements.hasOwnProperty( j ) ) {
			switch ( action ) {
				case 'multiply':
					sum *= parseFloat( elements[ j ].value );
					break;
				case 'sum':
					sum += parseFloat( elements[ j ].value );
					break;
			}
		}
	}

	return sum;
}

let buttons = document.querySelectorAll( '.sum-submit' );
for ( let i in buttons ) {
	if ( buttons.hasOwnProperty( i ) ) {
		buttons[ i ].addEventListener( 'click', function ( event ) {
			event.preventDefault();

			console.log( event.target );
			let sum = sum_numbers( event.target );
			console.log( sum );
			//console.log( event );
		} );
	}
}
