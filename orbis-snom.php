<?php
/*
Plugin Name: Orbis SNOM
Plugin URI: http://pronamic.eu/wp-plugins/orbis-snom/
Description: Extends the Orbis plugin extends the Orbis plugin with some SNOM phone functions.

Version: 1.0.0
Requires at least: 3.0

Author: Pronamic
Author URI: http://www.pronamic.eu/

Text Domain: orbis_snom
Domain Path: /languages/

License: GPL

GitHub URI: https://github.com/wp-orbis/wp-orbis-snom
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

	if ( empty( $snom_url ) ) {
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

	if ( ! empty( $url ) && ! empty( $number ) ) : ?>

	<form method="post" action="<?php echo esc_attr( $url ); ?>" target="_blank" class="form-inline">
		<input name="NUMBER" type="hidden" value="<?php echo esc_attr( $number ); ?>" />
		<button name="DIAL" type="submit" class="btn">
			<i class="icon-headphones"></i>
			<?php _e( 'Call', 'orbis_snom' ); ?>
		</button>
	</form>

	<?php

	endif;
}

function orbis_snom_enqueue_scripts() {
	wp_enqueue_script(
		'orbis-snom',
		plugins_url( 'includes/snom.js', __FILE__ ),
		array( 'jquery' )
	);
}

add_action( 'wp_enqueue_scripts', 'orbis_snom_enqueue_scripts' );
