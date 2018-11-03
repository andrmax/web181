<?php
if ( is_admin() ) {
	$fields = fields_profile();
	$out    = array();

	foreach ( $fields as $key => $field ) {

		$value    = ! empty( $field['value'] ) ? $field['value'] : '';
		$required = ! empty( $field['required'] ) ? ' required="required"' : '';
		$out[]    = '<div class="form__group">
		<label for="' . $key . '" class="form__label">' . $field['label'] . '</label>
		<input id="' . $key . '" type="' . $field['type'] . '" class="form__control" name="' . $key . '" value="' . $value . '"' . $required . '>
	</div>';
	}
	$out = implode( "\n", $out );
	?>
	<form action="" class="form js-form-profile">
		<?php echo $out; ?>
		<button class="form__button">OK</button>
		<input type="hidden" name="action" value="update_profile">
		<div class="form__info js-form__info"></div>
	</form>
	<?php
}else{
	?>
	<form action="" method="post" class="form">
		<input type="password" name="pass" value="">
		<button class="form__button">OK</button>
	</form>
<?php
}
