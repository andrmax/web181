/*let $ = 'text1\n' + "text2\n"
+ 'text3';
alert( $  );*/
'use strict';
/*
let massiv = [23,65];
massiv.forEach(alert);
*/
/*

alert(typeof x);
if(undefined === typeof x ){
	let x = 1;
	alert(x);
}

let asd = 'sdf'*2;
alert(asd);
*/
/*

let z = [
	3,
	[ 'esfgs', 'Text' ]
];
console.log( z );

let obj = {
	key : 45,
	name : 'Vasya',
	age : 73,
	scores : [ 5, 3, 5, 8 ],
};
console.log( obj );

let myFirstVar    = 3; // эта переменная означает..
let secondCoolVar = 4; // --//--
let third         = 5;

//let a=3,b=4,c=5;

for ( let i = 0, a = 3; i < 10; i++ ) {
	console.log( i + ') ' + i * a );
}


let num = '5';
if(5 === num){
	console.log( 'ok' );
}
*/

for(let i = 0; i<10;i++){
	console.log( i );
}

let mass = [ 4, 5, 3456, 75, 46 ];

for ( let i in mass ) {
	if ( mass.hasOwnProperty( i ) ) {
		console.log( mass[ i ] );
	}
}
