<div class="content">Контент - главная</div>
<?php

$array = array(
	array(
		'text' => 'text 1',
	),
	array(
		'text' => 'text 2',
		'sub'  => array(
			array(
				'text' => 'text 2 1',
				'sub'  => array(
					array(
						'text' => 'text 2 1 1',
					),
					array(
						'text' => 'text 2 1 2',
					),
					array(
						'text' => 'text 2 1 3',
					),
				)

			),
			array(
				'text' => 'text 2 2',
			),
			array(
				'text' => 'text 2 3',
				'sub'  => array(
					array(
						'text' => 'text 2 3 1',
					),
					array(
						'text' => 'text 2 3 2',
					),
					array(
						'text' => 'text 2 3 3',
					),
				)

			),
		)
	),
	array(
		'text' => 'text 3',
	),
);

if ( 5 === '5' ) {
	echo 'Все норм!';
}else{
	echo 'Все вообще не норм!';
}
echo recursive( $array );
