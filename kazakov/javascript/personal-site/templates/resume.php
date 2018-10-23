<?php
$data = get_resume();

$meta = array();
foreach($fields as $key=>$value){
    if(!empty($data['meta'][$key])) {
        $meta[] = '<div class="columns__row"><div class="columns__label">'.$value.
            '</div><div class="columns__value">'.$data['meta'][$key].'</div></div>';
    }
}
$meta = implode("\n", $meta);

$resume_rows = array();
foreach($data as $key=>$value){
    if(!empty($value['start'])) {
        $period = date('m.Y', strtotime($value['start']) );
        if('Н.В.' != $value['end']){
            $period .= '-'.date('m.Y', strtotime($value['end']) );
        }else{
            $period .= ' - Н.В.';
        }
    }

        $resume_rows[] = '<div class="resume__row">
        <div class="resume__org">'.$value['org'].'</div>
        <div class="resume__period">'.$period.'</div>
        <div class="resume__position">'.$value['position'].'</div>
        <div class="resume__location">'.$value['location'].'</div>
        <div class="resume__description">'.$value['description'].'</div>
        </div>';
}
$resume = implode("\n", $resume_rows);

?>
<div class="resume">
    <?php echo $resume; ?>
</div>