<?php

/**
 * Title: Orbis SNOM admin
 * Description:
 * Copyright: Copyright (c) 2005 - 2014
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Orbis_Snom_Admin {
	/**
	 * Plugin
	 *
	 * @var Orbis_Twitter_Plugin
	 */
	private $plugin;

	//////////////////////////////////////////////////

	/**
	 * Constructs and initialize an Orbis core admin
	 *
	 * @param Orbis_Plugin $plugin
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;

		// Actions
		add_action( 'show_user_profile', array( $this, 'user_profile' ) );
		add_action( 'edit_user_profile', array( $this, 'user_profile' ) );

		add_action( 'personal_options_update', array( $this, 'user_update' ) );
		add_action( 'edit_user_profile_update', array( $this, 'user_update' ) );
	}

	//////////////////////////////////////////////////

	/**
	 * User update
	 */
	function user_update( $user_id ) {
		$snom_url = filter_input( INPUT_POST, '_orbis_snom_web_user_interface_url', FILTER_SANITIZE_STRING );

		if ( empty( $snom_url ) ) {
			delete_user_meta( $user_id , '_orbis_snom_web_user_interface_url' );
		} else {
			update_user_meta( $user_id, '_orbis_snom_web_user_interface_url', $snom_url );
		}
	}

	//////////////////////////////////////////////////

	/**
	 * User profile
	 */
	public function user_profile( $user ) {
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
}
