<?php
/**
 * Date: 18.10.18
 * @author Isaenko Alexey <info@oiplug.com>
 */


function get_user(){


	$data = array(
		'image'=>'<img src="assets/images/photo.png" alt="" class="bio__image">',
		'bio'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid dignissimos dolorum enim eveniet, exercitationem, hic ipsa iure laboriosam laborum maiores omnis, placeat possimus quibusdam quod veritatis! Doloribus eaque exercitationem voluptatem?',
		'meta'=>array(
			'dob'=>1920,
			'address'=>'Moscow',
			'phone'=>'+7 (903) 123 45 67',
			'email'=>'minita@yandex.ru',
			'site'=>'minita.ru',
			'vk_link'=>'https://vk.com/minita.ru',
			'vk_image'=>'',
			'fb_link'=>'https://facebook.com/minitaru',
			'fb_image'=>'',
		),
	);

	return $data;
}


function get_resume(){


	$fields = array(
		array(
			'start'=>'2015-03-01',
			'end'=>'2015-12-01',
			'position'=>'Механик',
			'location'=>'Сызрань',
			'description'=>'Работал в автосервисе, делал все.',
		),
		array(
			'start'=>'2016-01-01',
			'end'=>'2016-03-01',
			'position'=>'Механик-электрик',
			'location'=>'Саратов',
			'description'=>'Выкручивал лампочки',
		),
		array(
			'start'=>'2016-04-01',
			'end'=>'0000-00-00',
			'position'=>'Механик-танцор',
			'location'=>'Москва',
			'description'=>'Ничего не делаю, но деньги получаю.',
		),
	);

	return $fields;
}


/*
 * 1) Разработать архитектуру БД таким образом, чтобы туда можно было поместить данные, которые мы предварительно разместили в массивах.
 *
 * Таблица пользователя:
 * id пользователя
 * ФИО
 * Био
 * День рожденья
 * Email
 * Номер телефона
 *
 * Дополнительные данные пользователя(user_meta):
 * id строки
 * ключ строки
 * значение строки
 *
 * Резюме:
 * id места работы
 * Дата начала работы
 * Дата окончания
 * Должность
 * Локация
 * Описание
 *
 * Разделы сайта:
 * id раздела
 * Название(имя раздела на русском языке)
 * Имя раздела, которое фигурирует в url'е
 */

// eof
