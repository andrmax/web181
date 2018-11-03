<?php
$data = fields_profile();

$meta = array();
$bio  = array();
foreach ( $data as $key => $value ) {
	if ( false !== strpos( $key, 'usermeta' ) ) {
		if ( ! empty( $value['value'] ) ) {
			$meta[] = '<div class="columns__row"><div class="columns__label">' . $value['label'] . '</div><div class="columns__value">' . $value['value'] . '</div></div>';
		}
	} else {
		if ( ! empty( $value['value'] ) ) {
			switch ( $key ) {
				case 'fio':
					$bio[] = '<h1>' . $value['value'] . '</h1>';
					break;
				case 'bio':
					$bio[] = '<p>' . $value['value'] . '</p>';
					break;
				default:
					switch ( $key ) {
						case 'birthday':
							$value['value'] = date( 'd.m.Y', strtotime( $value['value'] ) );
							break;
						case 'email':
							if ( false !== strpos( $value['value'], '@' ) ) {
								$value['value'] = '<a href="mailto:' . $value['value'] . '">' .
								                  $value['value'] . '</a>';
							}

							break;
					}

					$meta[] = '<div class="columns__row"><div class="columns__label">' . $value['label'] . '</div><div class="columns__value">' . $value['value'] . '</div></div>';
			}
		}
	}
}
$meta = implode( "\n", $meta );
$bio  = implode( "\n", $bio );
?>
<div class="bio">
	<div class="bio__photo">
		<?php //echo $data['image']; ?>
	</div>
	<div class="bio__description"><?php echo $bio; ?></div>
	<div class="bio__info">
		<div class="columns">
			<?php echo $meta; ?>
		</div>
	</div>
</div>
