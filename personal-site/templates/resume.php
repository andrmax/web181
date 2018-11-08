<?php
$data = get_resume();

$resume_rows = array();
if ( ! empty( $data ) ) {
	foreach ( $data as $key => $value ) {

		if ( ! empty( $value['start'] ) ) {
			$period = date( 'm.Y', strtotime( $value['start'] ) );

			if ( '0000-00-00' != $value['start'] ) {
				$period .= '-' . date( 'm.Y', strtotime( $value['end'] ) );
			} else {
				$period .= '- НВ';
			}
		}

		$html = '<div class="resume__row" data-id="' . $value['resume_id'] . '">' .
		        '<div class="resume__period">' . $period . '</div>'
		        . '<div class="resume__position">' . $value['position'] . '</div>'
		        . '<div class="resume__location">' . $value['location'] . '</div>'
		        . '<div class="resume__description">' . $value['description'] . '</div>';

		if ( is_admin() ) {
			$html .= '<div class="resume__remove js-resume__remove">✕</div>'
			         . '<div class="resume__edit js-resume__edit">✎</div>';
		}
		$html .= '</div>';

		$resume_rows[] = $html;

	}
}
$resume = implode( "\n", $resume_rows );

?>
<div class="resume">
	<?php echo $resume; ?>
</div>
