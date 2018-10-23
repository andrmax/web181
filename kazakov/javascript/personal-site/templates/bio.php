<?php
$data = get_user();
$columns = array();
$fields = array(
    'dob'=>'Дата рождения',
    'address'=>'Адрес',
    'phone'=>'Телефон',
    'email'=>'Email',
    'site'=>'Сайт',
);
$meta = array();
foreach($fields as $key=>$value){
    if(!empty($data['meta'][$key])) {
        $meta[] = '<div class="columns__row"><div class="columns__label">'.$value.
            '</div><div class="columns__value">'.$data['meta'][$key].'</div></div>';
    }
}
$meta = implode("\n", $meta);

$socials = array();
foreach($fields as $key=>$value){
    if(!empty($data['meta'][$key])) {
        $socials[] = '<a class="social__link">'.$data['meta'][$key].'</a>';
    }
}
$socials = implode("\n", $socials);

?>
<div class="bio">
    <div class="bio__photo">
        <?php echo $data['image']; ?>

    </div>
    <div class="bio__description"><?php echo $data['bio']; ?></div>
    <div class="bio__info">
        <?php /*echo $data['colu']; */?>
        <div class="columns">
            <?php echo $meta; ?>
        </div>
    </div>
    <div class="bio__socials">
        <div class="socials"><?php echo $meta; ?></div>
    </div>
</div>