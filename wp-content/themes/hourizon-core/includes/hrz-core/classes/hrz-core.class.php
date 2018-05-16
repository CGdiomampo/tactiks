<?php

class Hrz_Core {

	public $plugin_prefix;
	public $plugin_path;
	public $plugin_url;
	public $version;

	public $admin_page;
	public $cores;
	public $hook_titles;

	public $stored_data;
	
	public function __construct ( $plugin_prefix, $plugin_path, $plugin_url, $version ) {
		$this->plugin_prefix = $plugin_prefix;
		$this->plugin_path = $plugin_path;
		$this->plugin_url = $plugin_url;
		$this->version = $version;
		$this->woo_options_prefix = 'woo';

		$this->init();
	} // End Constructor
	
	/**
	 * Initialise the plugin.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function init () {
		// Create the necessary filters.
		add_action( 'after_setup_theme', array( $this, 'create_hooks' ), 10 );
		
		if ( is_admin() ) {
			$this->setup_hook_data();
			// Register the admin screen.
			//add_action( 'admin_menu', array( $this, 'hrz_admin_bar_menu' ), 11 );
			add_action( 'admin_menu', array( $this, 'register_admin_screen' ), 20 );

			// Make sure our data is added to the WooFramework settings exporter.
			add_filter( 'wooframework_export_query_inner', array( $this, 'add_exporter_data' ) );
		}

		// Setup default layouts.
		//$this->setup_layouts();

		// Setup default layout information.
		//$this->setup_layout_information();
		
	} // End init()
	
		/**
	 * Generate an unordered list of links to each section.
	 * @access  private
	 * @since   5.3.0
	 * @return  string Rendered menu HTML.
	 */
	private function _generate_sections_menu () {
		$html = '';
		$count = 0;

		if ( 1 < count( array_keys( $this->cores ) ) ) {
			$html .= '<ul id="settings-sections" class="subsubsub hide-if-no-js">' . "\n";
			foreach ( array_keys( $this->cores ) as $k ) {
				$count++;
				if ( in_array( $k, array_keys( $this->hook_titles ) ) ) {
					$title = $this->hook_titles[$k];
				} else {
					$title = ucwords( str_replace( '_', ' ', $k ) );
				}

				$css_class = $k . ' general';

				if ( $count == 1 ) { $css_class .= ' current'; }

				$html .= '<li><a href="#' . esc_attr( $k ) . '" class="tab ' . esc_attr( $css_class ) . '">' . $title . '</a>';
				if ( 1 < count( array_keys( $this->cores ) ) && $count < count( array_keys( $this->cores ) ) ) { $html .= ' | '; }
				$html .= '</li>' . "\n";
			}
			$html .= '</ul><div class="clear"></div>' . "\n";
		}

		echo $html;
	} // End _generate_sections_menu()
	
	/**
	 * Generate the HTML for the various sections.
	 * @access  private
	 * @since   5.3.0
	 * @return  string Rendered HTML.
	 */
	private function _generate_sections_html () {
		$html = '';

		if ( 0 < count( $this->cores ) ) {
			foreach ( $this->cores as $k => $v ) {
				if ( in_array( $k, array_keys( $this->hook_titles ) ) ) {
					$title = $this->hook_titles[$k];
				} else {
					$title = ucwords( str_replace( '_', ' ', $k ) );
				}

				$html .= '<div id="' . $k . '" class="content-section">' . "\n";
					$html .= '<h3 class="title">' . ucwords( $title ) . '</h3>' . "\n";
					if ( 0 < count( $v ) ) {
						$html .= '<table class="form-table">' . "\n";
						foreach ( $v as $i => $j ) {
							$html .= '<tr>' . "\n";
								$html .= '<th scope="row">' . $j['description'] . '</th>' . "\n";
								$html .= '<td>' . "\n";
									$html .= '<fieldset><legend class="screen-reader-text"><span>' . $j['description'] . '</span></legend>' . "\n";
									switch($j['type']){
										case "":
											$html .= '<textarea id="' . esc_attr( $i ) . '-content" name="' . esc_attr( $i ) . '[content]" rows="5" cols="50" class="large-text code">' . stripslashes( $j['content'] ) . '</textarea>' . "\n";
											$html .= '<label for="' . esc_attr( $i ) . '[shortcodes]"><input id="' . esc_attr( $i ) . '-shortcodes" name="' . esc_attr( $i ) . '[shortcodes]" type="checkbox" value="1"' . checked( $j['shortcodes'], 1, false ) . ' /> ' . __( 'Execute Shortcodes on this Hook', 'woothemes' ) . '</label>' . "\n";
										case "checkbox":
											$html .= '<input id="' . esc_attr( $i ) . '-shortcodes" name="' . esc_attr( $i ) . '[shortcodes]" type="checkbox" value="1"' . checked( $j['shortcodes'], 1, false ) . ' /> ' . "\n";
										break;
									}
									
									$html .= '</fieldset>' . "\n";
								$html .= '</td>' . "\n";
							$html .= '</tr>' . "\n";
						}
						$html .= '</table>' . "\n";
					}
				$html .= '</div>' . "\n";
			}
		}

		echo $html;
	} // End _generate_sections_html()
	
	/**
	 * Register the admin screen within WordPress.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function register_admin_screen () {
		if ( function_exists( 'add_submenu_page' ) ) {
			//$this->admin_page = add_submenu_page('woothemes', __( 'cores', 'woothemes' ), __( 'cores', 'woothemes' ), 'manage_options', 'woo-hook-manager', array( &$this, 'admin_screen' ) );
			$this->admin_page = add_submenu_page('woothemes', __( 'Core Functions', 'woothemes' ), __( 'Core Functions', 'woothemes' ), 'manage_options', 'core-functions-manager', array( $this, 'admin_screen' ) );
	
			// Admin screen logic.
			add_action( 'load-' . $this->admin_page, array( $this, 'admin_screen_logic' ) );

			// Add contextual help tabs.
			add_action( 'load-' . $this->admin_page, array( $this, 'admin_screen_help' ) );

			// Add JavaScripts.
			add_action( 'load-' . $this->admin_page, array( $this, 'enqueue_scripts' ) );
		}
	} // End register_admin_screen()
	
		/**
	 * Load the admin screen markup.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function admin_screen () {
		// Keep the screen XHTML separate and load it from that file.
		include_once( $this->plugin_path . '/screens/admin.php' );
	} // End admin_screen()
	
		/**
	 * Load contextual help for the admin screen.
	 * @access  public
	 * @since   1.0.0
	 * @return  string Modified contextual help string.
	 */
	public function admin_screen_help () {
		$screen = get_current_screen();
		if ( $screen->id != $this->admin_page ) return;

		$overview =
			  '<p>' . __( 'Fill in the area you\'d like to customise and hit the "Save Changes" button. It\'s as easy as that!', 'woothemes' ) . '</p>' .
			  '<p><strong>' . __( 'For more information:', 'woothemes' ) . '</strong></p>' .
			  '<p>' . sprintf( __( '<a href="%s" target="_blank">WooThemes Help Desk</a>', 'woothemes' ), 'http://support.woothemes.com/' ) . '</p>';

		$screen->add_help_tab( array( 'id' => 'filters_overview', 'title' => __( 'Overview', 'woothemes' ), 'content' => $overview ) );
	} // End admin_screen_help()
	
	/**
	 * Logic to run on the admin screen.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function admin_screen_logic () {
		$is_processed = false;

		// Save logic.
		if ( isset( $_POST['submit'] ) && check_admin_referer( 'core-functions-update' ) ) {
			echo "ADSF";
			$fields_to_skip = array( 'submit', '_wp_http_referer', '_wpnonce' );

			$posted_data = $_POST;

			foreach ( $posted_data as $k => $v ) {
				// Remove the fields we want to skip.
				if ( in_array( $k, $fields_to_skip ) ) {
					unset( $posted_data[$k] );
				} else {
					// Make sure the "shortcodes" and "php" keys are available, even if not posted.
					if ( ! array_key_exists( 'shortcodes', $v ) ) { $posted_data[$k]['shortcodes'] = 0; }
					if ( ! array_key_exists( 'php', $v ) ) { $posted_data[$k]['php'] = 0; }
				}
			}

			if ( is_array( $posted_data ) ) {
				$is_updated = update_option( $this->plugin_prefix . 'stored_hooks', $posted_data );

				// Redirect to make sure the latest changes are reflected.
				wp_safe_redirect( admin_url( 'admin.php?page=core-functions-manager&updated=true' ) );
				exit;
			}
			$is_processed = true;
		}
	} // End admin_screen_logic()
	
	/**
	 * Enqueue scripts for the admin screen.
	 * @access  public
	 * @since   5.3.0
	 * @return  void
	 */
	public function enqueue_scripts () {
		wp_register_script( 'woothemes-cores-tabs-navigation', $this->plugin_url . 'assets/js/tabs-navigation.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'woothemes-cores-tabs-navigation' );
	} // End enqueue_scripts()
	
	 	/**
 	 * Sets up the default and saved data for the various hook areas.
 	 * @access  public
 	 * @since   1.0.0
 	 * @return  void
 	 */
	public function setup_hook_data () {
		// Stored data.
		$stored_values = get_option( $this->plugin_prefix . 'stored_cores' );

		$this->cores = array();
		
		// Javascript Cores
		$this->cores['javascript'] = array(
								'bootstrapjs' => array(
										'content' => '',
										'shortcodes' => 0,
										'php' => '',
										'type' => 'checkbox',
										'description' => __( 'Enable Bootstrap', 'woothemes' )
									),
								'superfish' => array(
										'content' => '',
										'shortcodes' => 0,
										'php' => '',
										'type' => 'checkbox',
										'description' => __( 'Enable Superfish', 'woothemes' )
									),
								);

		// Header cores
		$this->cores['header'] = array(
								'woo_top' => array(
										'content' => '',
										'shortcodes' => 0,
										'php' => '',
										'description' => __( 'Executed below the opening <code>&lt;body&gt;</code> tag.', 'woothemes' )
									),
								'woo_header_before' => array(
										'content' => '',
										'shortcodes' => 0,
										'php' => '',
										'description' => __( 'Executed before the opening <code>#header</code> DIV tag.', 'woothemes' )
									)
,
								'woo_header_inside' => array(
										'content' => '',
										'shortcodes' => 0,
										'php' => '',
										'description' => __( 'Executed at the top, inside the <code>#header</code> DIV tag.', 'woothemes' )
									),
								'woo_header_after' => array(
										'content' => '',
										'shortcodes' => 0,
										'php' => '',
										'description' => __( 'Executed after the closing <code>#header</code> DIV tag.', 'woothemes' )
									)
							);

		// Navigation cores
		$this->cores['nav'] = array(
								'woo_nav_before' => array(
										'content' => '',
										'shortcodes' => 0,
										'php' => '',
										'description' => __( 'Executed before the opening <code>#navigation</code> DIV tag.', 'woothemes' )
									),
								'woo_nav_inside' => array(
										'content' => '',
										'shortcodes' => 0,
										'php' => '',
										'description' => __( 'Executed at the top, inside the <code>#navigation</code> DIV tag.', 'woothemes' )
									),
								'woo_nav_after' => array(
										'content' => '',
										'shortcodes' => 0,
										'php' => '',
										'description' => __( 'Executed after the closing <code>#navigation</code> DIV tag.', 'woothemes' )
									)
							);

		// Allow child themes/plugins to add their own hook sections.
		$this->cores = apply_filters( 'woo_hook_manager_cores', $this->cores );

		// Assigned stored data to the appropriate hook area.
		foreach ( $this->cores as $id => $arr ) {
			foreach ( $this->cores[$id] as $k => $v ) {
				if ( is_array( $stored_values ) && array_key_exists( $k, $stored_values ) ) {
					if ( is_array( $stored_values[$k] ) ) {
						foreach ( $stored_values[$k] as $i => $j ) {
							$this->cores[$id][$k][$i] = $j;
						}
					}
				}
			}
		}

		// Setup custom titles for certain cores sections.
		$this->_setup_hook_titles();
	} // End setup_hook_data()
	
	 	/**
 	 * Setup custom titles for certain sections.
 	 * @access  private
 	 * @since   1.0.0
 	 * @return  void
 	 */
	private function _setup_hook_titles () {
		$this->hook_titles = array();
		$this->hook_titles['nav'] = __( 'Navigation', 'woothemes' );
		$this->hook_titles['wordpress'] = __( 'WordPress', 'woothemes' );
	} // End _setup_hook_titles()
	
		/**
	 * Create the hooks using the saved content.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function create_hooks () {
		if ( ! is_admin() ) {
			$stored_hooks = get_option( $this->plugin_prefix . 'stored_hooks' );

			// Create the hooks, using an internal function to create the hook data.
			if ( is_array( $stored_hooks ) ) {

				$this->stored_data = $stored_hooks; // Store this data locally to avoid a second query in $this->execute_hook().

				foreach ( $stored_hooks as $k => $v ) {
					add_action($k, array( $this, 'execute_hook' ) );
				}
			}
		}
	} // End create_hooks()
	
	/**
	 * Executes the necessary hooks.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function execute_hook () {
		$hook = current_filter();
		$content = $this->stored_data[$hook]['content'];

		if( ! $hook || ! $content ) return;

		// Moved stripslashes here so that the do_shortcode function will accept parameters
		$content = stripslashes( $content );

		// If we are being instructed to execute shortcodes, execute them.
		if ( array_key_exists( 'shortcodes', $this->stored_data[$hook] ) && $this->stored_data[$hook]['shortcodes'] ) {
			$content = do_shortcode( $content );
		}

		echo $content;
	} // End execute_hook()
	
	
	

} // End Class

?>