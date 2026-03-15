<?php
/**
 * Ask user to review Guidant after they've been using it for a while.
 *
 * @package Guidant
 */

// If this file is called directly, exit.
if (!defined('WPINC')) {
    die;
}

/**
 * Class Guidant_Ask_Review
 */
if (!class_exists('Guidant_Ask_Review')) {
    class Guidant_Ask_Review {

		const NOTICE_ID = 'guidant_review_plugin_notice';
	
		/**
		 * Enable test mode: in wp-config.php add: define( 'GUIDANT_REVIEW_TEST', true );
		 * Then use: ?guidant_show_review=1 to force show notice, ?guidant_review_reset=1 to reset state.
		 */
	
		/**
		 * Current time (Unix timestamp).
		 *
		 * @var int
		 */
		public $current_time = 0;
	
		/**
		 * Plugin install date (Unix timestamp).
		 *
		 * @var int
		 */
		public $install_date = 0;
	
		/**
		 * Constructor.
		 */
		public function __construct() {
			$this->current_time = $this->get_current_time();
			$this->install_date = (int) get_option( 'guidant_install_date', 0 );
			if ( 0 === $this->install_date ) {
				$this->install_date = $this->current_time;
				update_option( 'guidant_install_date', $this->current_time, false );
			}
		}
	
		/**
		 * Register hooks. Call this once after instantiating.
		 */
		public function hooks() {
			add_action( 'admin_init', [ $this, 'register_hooks' ] );
		}
	
		/**
		 * Register admin and AJAX hooks.
		 */
		public function register_hooks() {
			$this->maybe_handle_test_reset();
	
			if ( get_option( 'guidant_already_reviewed' ) && ! $this->is_force_show_test() ) {
				return;
			}
	
			add_action( 'admin_notices', [ $this, 'maybe_show_notice' ] );
			add_action( 'admin_footer', [ $this, 'review_notice_js' ], 15 );
			add_action( 'wp_ajax_guidant_already_reviewed', [ $this, 'ajax_already_reviewed' ] );
			add_action( 'wp_ajax_guidant_review_maybe_later', [ $this, 'ajax_maybe_later' ] );
		}
	
		/**
		 * Check if test mode is on and URL has force-show or reset params.
		 */
		protected function is_test_mode() {
			return defined( 'GUIDANT_REVIEW_TEST' ) && GUIDANT_REVIEW_TEST && current_user_can( 'manage_options' );
		}
	
		/**
		 * Force show notice for testing (ignore dates and already_reviewed).
		 */
		protected function is_force_show_test() {
			return $this->is_test_mode() && isset( $_GET['guidant_show_review'] ) && '1' === $_GET['guidant_show_review'];
		}
	
		/**
		 * Reset all review options for testing. Only when GUIDANT_REVIEW_TEST is true.
		 */
		protected function maybe_handle_test_reset() {
			if ( ! $this->is_test_mode() || ! isset( $_GET['guidant_review_reset'] ) || '1' !== $_GET['guidant_review_reset'] ) {
				return;
			}
			delete_option( 'guidant_already_reviewed' );
			delete_option( 'guidant_review_notice_date' );
			delete_option( 'guidant_review_notice_delayed' );
			wp_safe_redirect( remove_query_arg( [ 'guidant_review_reset', 'guidant_show_review' ] ) );
			exit;
		}
	
		/**
		 * Get current time as Unix timestamp (WP timezone).
		 *
		 * @return int
		 */
		protected function get_current_time() {
			return (int) strtotime( current_time( 'mysql' ) );
		}
	
		/**
		 * Whether the review notice should be shown.
		 *
		 * @return bool
		 */
		protected function should_show_notice() {
			if ( ! current_user_can( 'manage_options' ) ) {
				return false;
			}
			if ( $this->is_force_show_test() ) {
				return true;
			}
			$review_notice_date = $this->get_review_notice_date();
			return $this->current_time > $review_notice_date;
		}
	
		/**
		 * Get the timestamp after which the notice may be shown.
		 *
		 * @return int
		 */
		public function get_review_notice_date() {
			$review_notice_date = get_option( 'guidant_review_notice_date' );
			if ( false !== $review_notice_date ) {
				return (int) $review_notice_date;
			}
	
			$delay_days = 30; // remind later after 30 days
			if ( ! get_option( 'guidant_review_notice_delayed' ) ) {
				$delay_days = 10; // show notice after 10 days of this class is instantiated
			}
	
			$review_notice_date = $this->current_time + ( $delay_days * DAY_IN_SECONDS );
			update_option( 'guidant_review_notice_date', $review_notice_date, false );
	
			return $review_notice_date;
		}
	
		/**
		 * Show the review notice if conditions are met.
		 */
		public function maybe_show_notice() {
			if ( ! $this->should_show_notice() ) {
				return;
			}
	
			$this->render_notice();
		}
	
		/**
		 * Render the admin notice HTML.
		 */
		protected function render_notice() {
			$review_url = $this->get_review_url();
			$plugin_name = __( 'WP Guidant', 'guidant' );
			?>
			<div id="<?php echo esc_attr( self::NOTICE_ID ); ?>" class="notice notice-info is-dismissible guidant-review-notice">
				<div class="guidant-review-notice-inner">
					<p>
						<?php
						printf(
							/* translators: %s: plugin name */
							esc_html__( "Hi there 👋, Looks like you are using %s.", 'guidant' ),
							'<strong>' . esc_html( $plugin_name ) . '</strong>'
						);
						?>
					</p>
					<p>
						<?php esc_html_e( 'If you enjoy it, a quick review helps us improve the plugin.', 'guidant' ); ?>
					</p>
					<p>
						<a href="<?php echo esc_url( $review_url ); ?>" class="guidant-dismiss-review guidant-review-action guidant-review-out" target="_blank" rel="noopener noreferrer">
							<strong><?php esc_html_e( 'Leave review', 'guidant' ); ?></strong>
						</a>
						<br>
						<a href="#" class="guidant-dismiss-review guidant-maybe-later-action"><?php esc_html_e( 'Remind later', 'guidant' ); ?></a>
						<br>
						<a href="#" class="guidant-dismiss-review guidant-already-reviewed-action"><?php esc_html_e( 'Dismiss', 'guidant' ); ?></a>
					</p>
				</div>
			</div>
			<?php
		}
	
		/**
		 * Get the review URL (WordPress.org or custom).
		 *
		 * @return string
		 */
		protected function get_review_url() {
			$url = 'https://wordpress.org/support/plugin/guidant/reviews/?filter=5#new-post';
			return (string) apply_filters( 'guidant_review_url', $url );
		}
	
		/**
		 * Inline JS for the review notice (dismiss, AJAX).
		 */
		public function review_notice_js() {
			if ( ! $this->should_show_notice() ) {
				return;
			}
			$ajax_url = esc_url( admin_url( 'admin-ajax.php' ) );
			$nonce    = wp_create_nonce( 'guidant_review_nonce' );
			?>
			<script>
				(function( $ ) {
					$( function() {
						var notice = $( '#<?php echo esc_js( self::NOTICE_ID ); ?>' );
						if ( ! notice.length ) return;
	
						$( '.guidant-dismiss-review' ).on( 'click', function( e ) {
							var $this = $( this );
							if ( ! $this.hasClass( 'guidant-review-action' ) ) {
								e.preventDefault();
							}
							if ( $this.hasClass( 'guidant-maybe-later-action' ) ) {
								$.post( '<?php echo $ajax_url; ?>', {
									action: 'guidant_review_maybe_later',
									security: '<?php echo esc_js( $nonce ); ?>'
								} );
								notice.fadeOut( function() { $( this ).remove(); } );
								return false;
							}
							$.post( '<?php echo $ajax_url; ?>', {
								action: 'guidant_already_reviewed',
								security: '<?php echo esc_js( $nonce ); ?>'
							} );
							notice.fadeOut( function() { $( this ).remove(); } );
						} );
	
						notice.on( 'click', '.notice-dismiss', function() {
							$.post( '<?php echo $ajax_url; ?>', {
								action: 'guidant_review_maybe_later',
								security: '<?php echo esc_js( $nonce ); ?>'
							} );
						} );
					} );
				})( jQuery );
			</script>
			<style>
				#<?php echo esc_attr( self::NOTICE_ID ); ?>.guidant-review-notice {
					border-left-color: #de5819;
					padding: 12px 20px;
				}
				.guidant-review-notice-inner a {
					color: #de5819;
				}
			</style>
			<?php
		}
	
		/**
		 * AJAX: set "already reviewed" and optionally "maybe later".
		 */
		public function ajax_already_reviewed() {
			check_ajax_referer( 'guidant_review_nonce', 'security' );
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_send_json_error( [ 'message' => __( 'Unauthorized', 'guidant' ) ] );
			}
			update_option( 'guidant_already_reviewed', $this->get_current_time(), false );
			wp_send_json_success( 'success' );
		}
	
		/**
		 * AJAX: maybe later (dismiss and delay next show).
		 */
		public function ajax_maybe_later() {
			check_ajax_referer( 'guidant_review_nonce', 'security' );
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_send_json_error( [ 'message' => __( 'Unauthorized', 'guidant' ) ] );
			}
			delete_option( 'guidant_review_notice_date' );
			update_option( 'guidant_review_notice_delayed', true, false );
			wp_send_json_success( 'success' );
		}
	}
}
