<?php
/*
Plugin Name: Orbis SNOM
Plugin URI: http://pronamic.eu/wp-plugins/orbis-snom/
Description: Extends the Orbis plugin extends the Orbis plugin with some SNOM phone functions.

Version: 0.1
Requires at least: 3.0

Author: Pronamic
Author URI: http://pronamic.eu/
License: GPL
*/

function orbis_snom_user_profile( $user ) {
	?>
	<h3><?php _e( 'SNOM', 'orbis_snom' ); ?></h3>

	<table class="form-table">
		<tr>
			<th>
				<label for="orbis_snom_web_user_interface_url">
					<?php _e( 'Web User Interface URL', 'orbis_snom' ); ?>
				</label>
			</th>
			<td>
				<input id="orbis_snom_web_user_interface_url" type="text" name="_orbis_snom_web_user_interface_url" value="<?php echo esc_attr( get_user_meta( $user->ID, '_orbis_snom_web_user_interface_url', true ) ); ?>" />
			</td>
		</tr>
	</table>
	<?php
}

add_action( 'show_user_profile', 'orbis_snom_user_profile' );
add_action( 'edit_user_profile', 'orbis_snom_user_profile' );

function orbis_snom_user_update( $user_id ) {
	$snom_url = filter_input( INPUT_POST, '_orbis_snom_web_user_interface_url', FILTER_SANITIZE_STRING );

	if( empty ( $snom_url ) ) {
		delete_user_meta( $user_id , '_orbis_snom_web_user_interface_url' );
	} else {
		update_user_meta( $user_id, '_orbis_snom_web_user_interface_url', $snom_url );
	}
}

add_action( 'personal_options_update', 'orbis_snom_user_update' );
add_action( 'edit_user_profile_update', 'orbis_snom_user_update' );

function orbis_snom_call_form( $number = '' ) {
	$current_user = wp_get_current_user();

	$url = get_user_meta( $current_user->ID, '_orbis_snom_web_user_interface_url', true );

	?>
	<form method="post" action="<?php echo esc_attr( $url ); ?>" target="_blank">
		<div>
			<input name="NUMBER" type="text" value="<?php echo esc_attr( $number ); ?>" />
			<input name="DIAL" type="submit" value="<?php esc_attr_e( 'Call', 'orbis_snom' ); ?>" class="btn" />
		</div>
	</form>
	<?php		
}
