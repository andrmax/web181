<?php
/**
 * Date: 24.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

function save_post() {
	if ( ! empty( $_POST['save_post'] ) ) {
		$data = $_POST;
		if ( ! empty( $data['title'] ) && ! empty( $data['content'] ) ) {

                                        //Задача 3

            //JSON_UNESCAPED_UNICODE позволяет избавиться от кодов кириллических символов при сохранении в файл в формате JSON
			$data = json_encode( $data, JSON_UNESCAPED_UNICODE );
			file_put_contents( 'blog/' . date( 'Y-m-d-H-i-s' ) . '.txt', $data );
			header( 'location: ?event=post_saved' );
		} else {
			return '<div class="error">Все поля формы должны быть заполнены</div>';
		}
	}
	return '';
}

function get_posts() {
	$files = scandir( 'blog' );
	rsort( $files );
	foreach ( $files as $date ) {
		if ( '.' != $date && '..' != $date ) {
			$file_content = file_get_contents( 'blog/' . $date );
			$data         = explode( ';', $file_content );

			// todo: преобразование строки содержащей дату в привычный формат: 1) преобразовать строку в timestamp 2) преобразовать timestamp в привычный формат даты

            //                                  Задача №1 - Изменение формата даты


            $srch = array(//Массив искомых символов в строке названия файла (совпадает с датой)
                '-',
                '.txt',
            );
            $rpl = array(//Массив вставляемых символов на замену
                ':',
                '',
            );
            $date_1 = str_replace($srch,$rpl,$date);//промежуточное изменение формата даты в строке

            //окончательное приведение к КОРРЕКТНОЙ ЗАПИСИ, которую принимает парсер strtotime(), DateTime и date_create()
            $date_2 = substr($date_1, 0, 10).' '.substr($date_1, -8, 8);

            $date_3 = date_create($date_2);// Создает и возвращает новый экземпляр класса DateTime
            $date_4 = date_timestamp_get($date_3);//создаем переменную в формате даты

            //создаем переменную в формате строки(запись даты и времени в указанном формате)
            $date_5 = date('H:i:s d.m.Y', $date_4);

            //     Задача №1 Вариант №2 (закомментировать строки 67-70, раскомментировать строку 74):

            /*$date_5 = date_format($date_3, 'H:i:s d.m.Y');//Сразу создаем переменную в формате строки в нужном формате*/

			$file_content = json_decode( $file_content, true );
			if ( is_array( $file_content ) ) {
			    $recording_time = $date_5;
			    $caption = $file_content['title'];
			    $message = $file_content['content'];
			    echo '<div class="record_echo">';
			    echo '<div class="recording_time">'.$recording_time.'</div>';
			    echo '<div class="caption_echo">'.$caption.'</div>';
			    echo '<div class="message_echo">'.$message.'</div>';
			    echo '</div>';
			} else {
				echo '<div>' . $file_content . '</div>';
			}

		}
	}
}

include 'form.php';

// eof
