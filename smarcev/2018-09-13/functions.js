//Объявление переменной. Присваивание переменной значения из html кода по id = list2. Id должен быть уникальным
let element = document.getElementById( 'list_2' );
 //Вывод элемента в консоль
console.log( element );

//Нашему элементу присваивается цвет фона и шрифта
element.style.backgroundColor = '#f00';
element.style.color           = '#eee';

//Определение стилей непосредственно с помощью командной строки. Не через переменную.
document.getElementById( 'list_1' ).style.backgroundColor = 'green';
document.getElementById( 'list_1' ).style.color           = 'white';

//Присваивание переменной items коллекции с классом item
let items = document.getElementsByClassName( 'item' );
console.log( items );

//items.style.color = '#0f0';

// 1-й способ применения стилей ко всем найденным элементам
//Количество элементов в коллекции
let count = items.length;

//Каждому элементу в коллекции присваиваем стиль шрифта и выводим в консоль количество элементов
for ( let i = 0; i < count; i++ ) {
	items[ i ].style.color = '#0f0';
	console.log( i );
}

// универсальная функция перебора элементов
for ( let i in items ) {
	// условие определяет существование элемента (в данном случае i -  количество элементов)
	if ( items.hasOwnProperty( i ) ) {
		items[ i ].style.color = '#ff6bb5';
	}
}

// для html-коллекций функция forEach не работает напрямую
/*items.forEach( function ( element ) {
	element.style.color = '#0355ff';
} );*/
//переменной item присваивается только коллекция с первым найденным селектором item
let item         = document.querySelector( '.item' );
item.style.color = '#1fb0ff';
//переменной query_item присваивается только коллекция со всеми найденными селекторами item
let query_items = document.querySelectorAll( '.item' );
for ( let i in query_items ) {
	if ( query_items.hasOwnProperty( i ) ) {
		query_items[ i ].style.color = '#23ff82';
	}
}

function sum_numbers( element ) {

	// определение формы, внутри которой расположена кнопка,
	// по которой был произведен клик
	//Метод closest бежит от текущего элемента вверх по цепочке родителей и проверяет,
	// подходит ли элемент под указанный CSS-селектор. Если подходит – останавливается и возвращает его
	//.math_form - селектор самой формы
	let form = element.closest( '.math-form' );
//Чтение атрибута, проверка наличия и запись.
	let action   = form.getAttribute( 'data-action' );
	// поиск всех элементов у которых есть атрибут name
	let elements = form.querySelectorAll( '[name]' );
	let sum      = 0;
	//проверка чему равен атрибут в форме multiplay - умножение, sum - сумма
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
					/*Функция parseFloat преобразуют строку символ за символом, пока это возможно.*/
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
		//Метод EaddEventListener() регистрирует определенный обработчик события, вызванного на EventTarget.
		//click - прослушиваемое событие. function ( event ) функция, которая
		// принимает уведомление, когда событие указанного типа произошло.
		//function ( event ) - браузер записывает в «объект события», который передаётся первым аргументом в обработчик.
		buttons[ i ].addEventListener( 'click', function ( event ) {
            //вызов preventDefault() предотвращает действие браузера.
			//todo: код может отличить реальное нажатие от программного, является проверка свойства event.isTrusted.
            event.preventDefault();
			//event.target – это исходный элемент, на котором произошло событие, в процессе всплытия он неизменен.
			console.log( event.target );
			//Передается в функцию исходный элемент, на котором произошло событие click
			let sum = sum_numbers( event.target );
			console.log( sum );
			//console.log( event );
		} );
	}
}
