'use strict';

console.clear();
console.log( 'zxcvbn' );
let body = document.getElementsByClassName( 'main' )[ 0 ];
body.innerHTML += '<b>123</b>';
for ( let i = 0; i <= 30; i++ ) {
	console.log( i + ') qwerty' );
}

let new_element = document.createElement( 'div' );
new_element.classList.add( 'post' );

let titles = [
	'Title 1',
	'Header 2',
	'Title 3',
];
for ( let i in titles ) {
	if ( titles.hasOwnProperty( i ) ) {
		new_element.innerText = titles[ i ];
		body.appendChild( new_element );
	}
}

//  body.innerHTML += new_element;

let new_list = document.querySelectorAll( 'ul, ol' );

for ( let z in new_list ) {
	if ( new_list.hasOwnProperty( z ) ) {

		let list_items = new_list[ z ].querySelectorAll( 'li' );

		let j = 1;
		for ( let i in list_items ) {

			if ( list_items.hasOwnProperty( i ) ) {

				j = parseInt( i ) + 1;
				list_items[ i ].innerHTML += ' (' + j + ')';
				console.log( i + ' = ' + j );
			}
		}
	}
}

let submits = document.querySelectorAll( '[type=submit]' );
for ( let i in submits ) {
	if ( submits.hasOwnProperty( i ) ) {
		submits[ i ].addEventListener( 'click', function ( event ) {
			event.preventDefault();
			let element = event.target;
			let form    = element.closest( 'form' );

			// происходит запрос на сервер

			let new_element = document.createElement( 'div' );
			new_element.innerHTML = 'Данные сохраняются';
			form.appendChild( new_element );

			element.setAttribute( 'disabled', 'disabled' );
			element.classList.add( 'preloader2' );


			// имитация завершения процесса сохранения
			setTimeout( function () {
				element.removeAttribute( 'disabled' );
				element.classList.remove( 'preloader2' );
				new_element.parentNode.removeChild( new_element );
			}, 1000 );

		} );
	}
}

function generateTree(elem) {
    let child = elem.firstElementChild;		// Находим дочерние элементы и передаем их в переменную child
    let ul = document.createElement('ul');		// Создаем элемент с тегом ul и передаем его в создаваемую переменную ul
    while(child) {								// Перебираем элементы переменной child
        let li = document.createElement('li');	// Создаем элемент с тегом li и передаем его в создаваемую переменную li
        li.innerHTML = child.tagName;			// Устанавливаем содержимое переменной li в виде тегов дочерних элементов из переменной child
        let list = generateTree(child);		// Генерируем структуру (дерево) из элементов переменной child и передаем его в создаваемую переменную list
        li.appendChild(list);					// Добавляем структуру из переменной list в переменную li
        ul.appendChild(li);						// Добавляем структуру из переменной li в переменную ul
        child = child.nextElementSibling;		//
    }
    elem.appendChild(ul);						//
    return ul;									// Возвращаем ul в функцию
}

generateTree(document.documentElement);		//