<?php
$atts = array(
    'main' => array(
        'caption' => 'Главная',
    ),
    'team' => array(
        'caption' => 'Наша команда',
    ),
    'galery' => array(
        'caption' => 'Наши работы',
    ),
    'reviews' => array(
        'caption' => 'Отзывы',
    ),
    'contacts' => array(
        'caption' => 'Контакты',
    ),
);
echo menu($atts);
?>
</div>
<div class="page">
    <div class="content <?php echo is_sidebar(); ?>">