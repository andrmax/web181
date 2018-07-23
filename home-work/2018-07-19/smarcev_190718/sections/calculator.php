<?php
$number = 0;
$result = '';
if ( ! empty( $_GET['number'] ) ) {
// определение первой цифры числа
    $number = $_GET['number'];
    $result = floor( $number / pow( 10, floor( log10( $number ) ) ) );
    $result = 'Первая цифра числа ' . $number . ': ' . $result;

}
?>

<div class="section-math">
    <div class="section-math__container">
        <form action="" class="section-math__form">
            <input type="text" class="section-math__input" name="number" placeholder="введите число"
                   value="<?php echo $number; ?>">
            <button class="section-math__submit">ok</button>
        </form>
        <div class="section-math__result"><?php echo $result; ?></div>
    </div>
</div>
