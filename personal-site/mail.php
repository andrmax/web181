<?php
/**
 * Date: 14.11.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

$to      = 'sh-v@ya.ru';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: webmaster@oiplug.com' . "\r\n" .
           'Reply-To: webmaster@oiplug.com' . "\r\n" .
           "Content-Type: text/plain; charset=\"UTF-8\"\r\n"
           .'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

// eof
