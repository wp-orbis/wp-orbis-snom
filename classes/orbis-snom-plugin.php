<?php

class Orbis_Snom_Plugin extends Orbis_Plugin {
	public function __construct( $file ) {
		parent::__construct( $file );

		$this->set_name( 'orbis_snom' );
		$this->set_db_version( '1.0.0' );

		// Actions
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_footer', array( $this, 'footer' ) );

		// Admin
		if ( is_admin() ) {

		}
	}

	public function loaded() {
		$this->load_textdomain( 'orbis_snom', '/languages/' );
	}

	public function enqueue_scripts() {
		wp_enqueue_style(
			'orbis-snom',
			$this->plugin_url( 'assets/plugin/orbis-snom.css' ),
			array(),
			'1.0.0'
		);

		wp_enqueue_script(
			'orbis-snom',
			$this->plugin_url( 'assets/plugin/orbis-snom.js' ),
			array( 'jquery' ),
			'1.0.0',
			true
		);

		if ( is_user_logged_in() ) {
			$user_id = get_current_user_id();

			$url = get_user_meta( $user_id, '_orbis_snom_web_user_interface_url', true );

			wp_localize_script(
				'orbis-snom',
				'orbisSnom',
				array(
					'commandUrl' =>	$url . 'command.htm',
				)
			);
		}
	}

	public function footer() {
		$url = null;

		if ( is_user_logged_in() ) {
			$user_id = get_current_user_id();

			$url  = get_user_meta( $user_id, '_orbis_snom_web_user_interface_url', true );
			$url .= 'index.htm';
		}

		// @see http://www.codecademy.com/courses/web-intermediate-en-jfhjJ/4/4

		if ( $url ) : ?>

			<div id="orbis-snom">
				<iframe id="orbis-snom-iframe" src="<?php echo esc_attr( $url ); ?>"></iframe>

				<form class="form-inline" role="form">
					<div class="form-group">
						<label class="sr-only" for="orbis-snom-input">Email address</label>

						<input type="text" class="form-control" id="orbis-snom-input" />
					</div>

					<div id="orbis-snom-numbers">
						<button type="button" class="btn btn-default">1</button>
						<button type="button" class="btn btn-default">2</button>
						<button type="button" class="btn btn-default">3</button> <br />
						<button type="button" class="btn btn-default">4</button>
						<button type="button" class="btn btn-default">5</button>
						<button type="button" class="btn btn-default">6</button> <br />
						<button type="button" class="btn btn-default">7</button>
						<button type="button" class="btn btn-default">8</button>
						<button type="button" class="btn btn-default">9</button> <br />
						<button type="button" class="btn btn-default">*</button>
						<button type="button" class="btn btn-default">0</button>
						<button type="button" class="btn btn-default">#</button>
					</div>
				</form>
			</div>

		<?php endif;
	}
}
