<?php

/**
 * CustomPress_Core
 *
 * @copyright PSOURCE 2020 {@link https://n3rds.work}
 * @author DerN3rd (PSOURCE)
 * @license GNU General Public License (Version 2 - GPLv2) {@link http://www.gnu.org/licenses/gpl-2.0.html}
 */

if ( ! class_exists( 'CustomPress_Core' ) ):

	class CustomPress_Core {

		/** @public string $plugin_version Plugin version */
		public $plugin_version = CPT_VERSION;
		/** @public string $plugin_url Plugin URL */
		public $plugin_url = CPT_PLUGIN_URL;
		/** @public string $plugin_dir Path to plugin directory */
		public $plugin_dir = CPT_PLUGIN_DIR;
		/** @public string $text_domain The text domain for strings localization */
		public $text_domain = CPT_TEXT_DOMAIN;
		/** @public string $options_name The options name */
		public $options_name = 'cp_options';

		function __construct() {
			add_action( 'plugins_loaded', array( &$this, 'on_plugins_loaded' ), 0 );

			add_filter( 'pre_get_posts', array( &$this, 'display_custom_post_types' ) );
			add_action( 'wp_ajax_cp_get_post_types', array( &$this, 'ajax_action_callback' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'on_enqueue_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'on_enqueue_scripts' ) );

			register_activation_hook( $this->plugin_dir . 'loader.php', array( &$this, 'plugin_activate' ) );
			register_deactivation_hook( $this->plugin_dir . 'loader.php', array( &$this, 'plugin_deactivate' ) );
			$plugin = plugin_basename( __FILE__ );

			add_filter( "plugin_action_links_$plugin", array( &$this, 'plugin_settings_link' ) );
			add_filter( 'enable_subsite_content_types', array( &$this, 'enable_subsite_content_types' ) );
			add_filter( 'the_category', array( $this, 'filter_the_category' ), 10, 3 );
			add_filter( 'the_tags', array( $this, 'filter_the_tags' ), 10, 4 );
		}
		
		/**
		 * Loads "custompress-[xx_XX].mo" language file from the "languages" directory
		 *
		 * @return void
		 */
		function on_plugins_loaded() {
			add_action( 'init', array( $this, 'load_textdomain' ) );

			// maybe check upgrade version here
			$this->maybe_upgrade_version();
		}

		/**
		 * Load the plugin textdomain for translations.
		 *
		 * @return void
		 */
		function load_textdomain() {
			load_plugin_textdomain( $this->text_domain, false, plugin_basename( $this->plugin_dir . 'languages' ) );
		}


		/**
		 * Maybe upgrade to new version
		 */
		function maybe_upgrade_version(){

			// check older
			if ( is_multisite() ) {
				$db_version = get_site_option( 'ct_db_version', '1.4.1' );
			} else {
				$db_version = get_option( 'ct_db_version', '1.4.1' );
			}

			if ( version_compare( '1.4.1', $db_version, '>=' ) ) {
				// update format custom field date type

				if ( is_multisite() ) {
					// Retrive net work custom fields
					$network_custom_fields          = get_site_option( 'ct_custom_fields', array() );
					$filtered_network_custom_fields = false;

					// retrive all ids blog sites
					$blog_sites = $this->get_blog_sites( array(
						'fields' => 'ids'
					) );

					foreach ( $blog_sites as $blog_id ) {
						switch_to_blog( $blog_id );

						// go
						if ( ! empty( $network_custom_fields ) ) {
							$network_custom_fields          = $this->update_db_date_format( $network_custom_fields, $filtered_network_custom_fields !== false );
							$filtered_network_custom_fields = true;
						}

						$custom_fields = get_option( 'ct_custom_fields', array() );

						if ( ! empty( $custom_fields ) ) {
							$custom_fields = $this->update_db_date_format( $custom_fields );
							// re-update blog site custom fields
							update_option( 'ct_custom_fields', $custom_fields );
						}

						restore_current_blog();
					}


					// re-update network custom fields
					if ( $filtered_network_custom_fields ) {
						update_site_option( 'ct_custom_fields', $network_custom_fields );
					}

					// update new version
					update_site_option( 'ct_db_version', '1.4.1' );
				} else {
					// normal wp site
					$custom_fields = get_option( 'ct_custom_fields', array() );
					if ( ! empty( $custom_fields ) ) {
						$custom_fields = $this->update_db_date_format( $custom_fields );
						// re-update blog site custom fields
						update_option( 'ct_custom_fields', $custom_fields );
					}

					// update new version
					update_option( 'ct_db_version', '1.4.1' );
				}

			}

			// Another upgrade here...

			// add hook for upgrade
			do_action( 'ct_upgrade', $db_version, $this->plugin_version );

        }

        /**
		 * Retrive all sites in the current network.
		 *
		 * @since  1.4.1
		 * @return array
		 */
        function get_blog_sites($args=array()){
        	// get sites only visible from 4.6.0
        	$args = wp_parse_args( array(
				'limit' 	=> 0,
				'public'    => true,
				'spam'      => false,
				'deleted'   => false,
				// only plubic
				'archived' 	=> false,
				'mature'	=> false
			), $args );
                        
			$args = apply_filters(
				'ct_get_blog_site_args',
				$args
			);

			// get sites only visible from 4.6.0
			if ( function_exists('get_sites') ) {
				$sites = get_sites( $args );
			} else {
				$sites = wp_get_sites( $args );
			}

			return $sites;
        }

        /**
         * Update db date formate
         * @param  array  $custom_fields list custom fields setting
         * @param  boolean $filtered
         * @return array
         */
        function update_db_date_format($custom_fields, $filtered=false){
	        if ( ! empty ( $custom_fields ) ) {
		        global $wpdb;

		        // retrive specific date format
		        $special_formats = ct_get_special_date_formats();

		        foreach ( $custom_fields as $key => $field ) {
			        // pass if it's not datepicker type
			        if ( 'datepicker' !== $field['field_type'] || empty( $field['field_date_format'] ) ) {
				        continue;
			        }

			        if ( ! $filtered ) {
				        if ( isset( $special_formats[ $field['field_date_format'] ] ) ) {
					        $field['field_special_date_format'] = $special_formats[ $field['field_date_format'] ];
					        $field['field_return_format']       = $field['field_date_format'];
				        } else {
					        $field['field_return_format'] = ct_convert_date_to_php( $field['field_date_format'] );
				        }

				        // update fields
				        $custom_fields[ $key ] = $field;
			        }

			        $key = ct_get_field_id( $field );

			        $date_values = $wpdb->get_results(
				        $wpdb->prepare(
					        "
        					SELECT *
        					FROM $wpdb->postmeta
        					WHERE meta_key = %s AND meta_value <> ''
        					",
					        $key
				        )
			        );

			        if ( ! empty( $date_values ) ) {
				        $query = array();

				        $is_special_date = ! empty( $field['field_special_date_format'] );

				        if ( $is_special_date ) {
					        $date_special_format = $field['field_special_date_format'];

					        $arr_strformat = explode( ' ', array_shift( $date_special_format ) );

				        }

				        foreach ( $date_values as $meta_obj ) {

					        if ( $is_special_date ) {
						        $arr_strmeta_value = explode( ' ', $meta_obj->meta_value );
						        $arr_strmeta_value = array_diff( $arr_strmeta_value, $arr_strformat );
						        $date              = DateTime::createFromFormat( join( '/', $date_special_format ), join( '/', $arr_strmeta_value ) );
					        } else {
						        $date = DateTime::createFromFormat( $field['field_date_format'], $meta_obj->meta_value );
					        }

					        // pass if false
					        if ( ! $date ) {
						        continue;
					        }

					        $query[] = '(' . $meta_obj->meta_id . ',' . $meta_obj->post_id . ',"' . $meta_obj->meta_key . '",' . $date->format( 'Ymd' ) . ')';
				        }

				        if ( ! empty( $query ) ) {
					        $query = "INSERT INTO $wpdb->postmeta (meta_id, post_id, meta_key, meta_value) VALUES " . join( ',', $query ) . ' ON DUPLICATE KEY UPDATE meta_value=VALUES(meta_value)';
					        // re-update post meta
					        $wpdb->query( $query );
				        }

			        }


		        }
	        }

        	// return for re-update option
        	return $custom_fields;
        }

		function on_enqueue_scripts() {
			// People use both "_" and "-" versions for locale IDs en_GB en-GB
			//Translate it all to dashes because that's the way the standard translation files for datepicker are named.
			$wplang = str_replace( '_', '-', get_locale() );
			$lang   = ( $wplang == '' ) ? '' : substr( $wplang, 0, 2 ); // Non specific locale

			// Specific locale exceptions
			$lang = ( in_array( $wplang, array(
				'ar-DZ',
				'cy-GB',
				'en-AU',
				'en-GB',
				'en-NZ',
				'fr-CH',
				'nl-BE',
				'pt-BR',
				'sr-SR',
				'zh-CN',
				'zh-HK',
				'zh-TW'
			) ) ) ? $wplang : $lang;

			if ( ! empty( $lang ) ) {
				// If it can't find one too bad.
				wp_register_script( 'jquery-ui-datepicker-lang', $this->plugin_url . "datepicker/js/i18n/jquery.ui.datepicker-$lang.js", array(
					'jquery',
					'jquery-ui-datepicker'
				), '1.8.18' );
			}

			// Dynamic CSS switching for date picker
			wp_register_script( 'dynamic-css', $this->plugin_url . "datepicker/js/cp-dynamic-css.js", array(), 'CP-' . CPT_VERSION );
			//wp_enqueue_script('dynamic-css');

			wp_register_script( 'jquery-validate', $this->plugin_url . "ui-admin/js/jquery.validate.js", array( 'jquery' ), '1.8.18' );

			wp_register_script( 'jquery-combobox', $this->plugin_url . "datepicker/js/jquery.combobox/jquery.combobox.js", array( 'jquery' ), '1.8.18' );

			wp_register_style( 'jquery-combobox', $this->plugin_url . "datepicker/js/jquery.combobox/style.css", array(), '0.5' );

			$theme = $this->get_options( 'datepicker_theme' );
			if ( empty( $theme ) ) {
				$theme = 'flick';
			} elseif ( is_array( $theme ) ) {
				$theme = array_filter( $theme );
				$theme = array_shift( $theme );
			}
			// Verify it is a string value.
			$theme = ( empty( $theme ) || ! is_string( $theme ) ) ? 'flick' : $theme;

			wp_register_style( 'jquery-ui-datepicker', $this->plugin_url . "datepicker/css/{$theme}/datepicker.css", array(), '0.5' );
		}

		/**
		 * Plugin activation.
		 *
		 * @return void
		 */
		function plugin_activate() {

		}

		/**
		 * Deactivate plugin. If $this->flush_plugin_data is set to "true"
		 * all plugin data will be deleted
		 *
		 * @return void
		 */
		function plugin_deactivate() {
			/* if true all plugin data will be deleted */
			if ( false ) {
				delete_option( $this->options_name );
				delete_option( 'ct_custom_post_types' );
				delete_option( 'ct_custom_taxonomies' );
				delete_option( 'ct_custom_fields' );
				delete_option( 'ct_flush_rewrite_rules' );
				delete_site_option( $this->options_name );
				delete_site_option( 'ct_custom_post_types' );
				delete_site_option( 'ct_custom_taxonomies' );
				delete_site_option( 'ct_custom_fields' );
				delete_site_option( 'ct_flush_rewrite_rules' );
			}
		}

		/**
		 * Set Settings link for plugin.
		 *
		 * @param array $links
		 *
		 * @return array
		 */
		function plugin_settings_link( $links ) {
			$settings_link = '<a href="admin.php?page=cp_main">Settings</a>';
			array_unshift( $links, $settings_link );

			return $links;
		}

		/**
		 * Allow users to be able to register content types for their sites or
		 * disallow it ( only super admin can add content types )
		 *
		 * @param <type> $bool
		 *
		 * @return bool
		 */
		function enable_subsite_content_types( $bool ) {
			$option = get_site_option( 'allow_per_site_content_types' );

			if ( ! is_multisite() || ! empty( $option ) ) {
				return true;
			} else {
				return $bool;
			}
		}

		/**
		 * Display custom post types on home page.
		 *
		 * @param object $query
		 *
		 * @return object $query
		 */
		function display_custom_post_types( $query ) {
			global $wp_query;
			//if ( is_main_site() || get_site_option('allow_per_site_content_types') )

			if ( is_admin() ) {
				return $query;
			}

			$options = $this->get_options();

			//Home Page
			if ( isset( $options['display_post_types']['home']['post_type'] ) && is_array( $options['display_post_types']['home']['post_type'] ) ) {
				$post_types = $options['display_post_types']['home']['post_type'];
				if ( is_home() && ! in_array( 'default', $post_types ) ) {
					if ( count( $post_types ) == 1 ) {
						$post_types = $post_types[0];
					}
					$wp_query->query_vars['post_type'] = $post_types;
				}
			}

			//Archive Page
			if ( isset( $options['display_post_types']['archive']['post_type'] ) && is_array( $options['display_post_types']['archive']['post_type'] ) ) {
				$post_types = $options['display_post_types']['archive']['post_type'];
				if ( is_archive() && ! in_array( 'default', $post_types ) ) {
					if ( count( $post_types ) == 1 ) {
						$post_types = $post_types[0];
					}
					$wp_query->query_vars['post_type'] = $post_types;
				}
			}

			//Front Page
			if ( isset( $options['display_post_types']['front_page']['post_type'] ) && is_array( $options['display_post_types']['front_page']['post_type'] ) ) {
				$post_types = $options['display_post_types']['front_page']['post_type'];
				if ( is_front_page() && ! in_array( 'default', $post_types ) ) {
					if ( count( $post_types ) == 1 ) {
						$post_types = $post_types[0];
					}
					$wp_query->query_vars['post_type'] = $post_types;
				}
			}

			//Search Page
			if ( isset( $options['display_post_types']['search']['post_type'] ) && is_array( $options['display_post_types']['search']['post_type'] ) ) {
				$post_types = $options['display_post_types']['search']['post_type'];
				if ( is_search() && ! in_array( 'default', $post_types ) ) {
					if ( count( $post_types ) == 1 ) {
						$post_types = $post_types[0];
					}
					$wp_query->query_vars['post_type'] = $post_types;
				}
			}

		}

		/**
		 * Make AJAX POST request for getting the post type info associated with
		 * a particular page.
		 */
		function ajax_actions() { ?>
			<script type="text/javascript">
				jQuery(document).ready(function ($) {
					// bind event to function
					$(window).bind('load', handle_ajax_requests);
					//$('#cp-select-page').bind('change', cp_ajax_post_process_request)

					function handle_ajax_requests() {
						// clear attributes
						//$('.cp-main input[name="post_type[]"]').attr( 'checked', false );
						// assign variables
						var data = {
							action: 'cp_get_post_types',
							cp_ajax_page_name: 'home'
							//@todo
							//cp_ajax_page_name: $('#cp-select-page option:selected').val()
						};
						// make the post request and process the response
						$.post(ajaxurl, data, function (response) {
							$.each(response, function (i, item) {
								if (item != null) {
									$('.cp-main input[name="post_type[]"][value="' + item + '"]').attr('checked', true);
								}
							});
						});
					}
				});

			</script>
		<?php
		}

		/**
		 * Ajax callback which gets the post types associated with each page.
		 *
		 * @return JSON Encoded data
		 */
		function ajax_action_callback() {

			//$params is the $_POST variable with slashes stripped
			$params = array_map( 'stripslashes_deep', $_POST );

			$page_name = $params['cp_ajax_page_name'];
			$options   = $this->get_options();
			if ( isset( $options['display_post_types'][ $page_name ]['post_type'] ) ) {
				/* json encode the response */
				$response = json_encode( $options['display_post_types'][ $page_name ]['post_type'] );
				/* response output */
				header( "Content-Type: application/json" );
				echo $response;
				die();
			} else {
				die();
			}
		}

		/**
		 * Create a copy of the single.php file with the post type name added
		 *
		 * @param string $post_type
		 */
		function create_post_type_files( $post_type ) {
			$file = TEMPLATEPATH . '/single.php';
			if ( ! empty( $post_type ) ) {
				foreach ( $post_type as $post_type ) {
					$newfile = TEMPLATEPATH . '/single-' . strtolower( $post_type ) . '.php';
					if ( ! file_exists( $newfile ) ) {
						if ( @copy( $file, $newfile ) ) {
							chmod( $newfile, 0777 );
						} else {
							echo '<div class="error">Kopieren fehlgeschlagen ' . $file . '. Bitte setze Deine aktiven Themenordner-Berechtigungen auf 777.</div>';
						}
					}
				}
			}
		}

		/**
		 * Save plugin options.
		 *
		 * @param  array $params The $_POST array
		 *
		 * @return die() if _wpnonce is not verified
		 */
		function save_options( $params ) {
			if ( wp_verify_nonce( $params['_wpnonce'], 'verify' ) ) {
				/* Remove unwanted parameters */
				unset( $params['_wpnonce'], $params['_wp_http_referer'], $params['save'] );

				/* Update options by merging the old ones */
				$options = $this->get_options();
				$options = array_merge( $options, array( $params['key'] => $params ) );
				update_option( $this->options_name, $options );
			} else {
				die( __( 'Sicherheitsüberprüfung fehlgeschlagen!', $this->text_domain ) );
			}
		}

		/**
		 * Get plugin options.
		 *
		 * @param  string|NULL $key The key for that plugin option.
		 *
		 * @return array $options Plugin options or empty array if no options are found
		 */
		function get_options( $key = null ) {
			$options = get_option( $this->options_name );
			$options = is_array( $options ) ? $options : array();
			/* Check if specific plugin option is requested and return it */
			if ( isset( $key ) && array_key_exists( $key, $options ) ) {
				return $options[ $key ];
			} else {
				return $options;
			}
		}

		/**
		 * Renders an admin section of display code.
		 *
		 * @param  string $name Name of the admin file(without extension)
		 * @param  string $vars Array of variable name=>value that is available to the display code(optional)
		 *
		 * @return void
		 */
		function render_admin( $name, $vars = array() ) {
			foreach ( $vars as $key => $val ) {
				$$key = $val;
			}

			if ( file_exists( "{$this->plugin_dir}ui-admin/{$name}.php" ) ) {
				include "{$this->plugin_dir}ui-admin/{$name}.php";
			} else {
				echo "<p>Rendern der Admin-Vorlage {$this->plugin_dir}ui-admin/{$name}.php fehlschlagen</p>";
			}
		}

		/**
		 * get_jquery_ui_css -  Returns a piece of javascript that will load or switch the jQuery-ui css Stylesheet to the current theme. This is used so the theme won't be loaded unless ther is a ui conpnent on the page.
		 *
		 */
		function jquery_ui_css( $theme = '' ) {
			$theme = ( empty( $theme ) ) ? $this->get_options( 'datepicker_theme' ) : $theme;
			$theme = ( empty( $theme ) ) ? 'flick' : $theme;
			?>
			<script>jQuery(document).ready(function () {
					jQuery("#jquery-ui-datepicker-css").prop("href", "<?php echo $this->plugin_url . "datepicker/css/{$theme}/datepicker.css"; ?>");
				});</script>
		<?php
		}

		/**
		 * Combine custom taxonomies with categories
		 *
		 */
		function filter_the_category( $thelist = '', $separator = '', $parents = '' ) {
			global $post;

			if ( ! defined( 'WP_ADMIN' ) && ! empty( $separator ) ) {
				//get hierarchical category taxonomies
				$categories = array_values( get_taxonomies( array(
					'public'       => true,
					'hierarchical' => true
				), 'names' ) );

				// Retrieves categories list of current post.
				$list = array();
				foreach ( $categories as $category ) {
					$list[] = get_the_term_list( $post->ID, $category, '', $separator, '' );
				}
				$list    = array_filter( $list );
				$thelist = implode( $separator, $list );
			}

			return $thelist;
		}

		/**
		 * Combine custom taxonomies with tags
		 *
		 */
		function filter_the_tags( $tag_list = '', $before = '', $sep = '', $after = '' ) {
			global $post;

			if ( ! defined( 'WP_ADMIN' ) ) {
				//get non-hierarchical tag taxonomies
				$tags = array_values( get_taxonomies( array( 'public' => true, 'hierarchical' => false ), 'names' ) );

				// Retrieves tag list of current post, separated by commas.
				$tag_list = array();
				foreach ( $tags as $tag ) {
					$tag_list[] = get_the_term_list( $post->ID, $tag, '', $sep, '' );
				}
				$tag_list = array_filter( $tag_list );
				$tag_list = $before . implode( $sep, $tag_list ) . $after;
			}

			return $tag_list;
		}

		/**
		 * Returns an array of all plural capabilities for a given post type
		 * Generated from the default capabilities list for any post type and the capability type id.
		 *
		 * @param string $post_type - Post type name to generate array for.
		 *
		 * @return array of all capability names
		 */
		function all_capabilities( $post_type = null ) {

			if ( empty( $post_type ) ) {
				return array();
			}

			$post_type_obj = get_post_type_object( $post_type );

			if ( empty( $post_type_obj->cap ) ) {
				return array();
			}

			$all_caps = array_keys( get_object_vars( $post_type_obj->cap ) );

			//Get plural capability type
			$plural_base = $post_type_obj->capability_type . 's';

			//Replace default "post" with the defined capability type
			$all_caps = str_replace( 'post', $post_type_obj->capability_type, $all_caps );

			//Select only the plural versions
			foreach ( $all_caps as $key => &$capability ) {
				if ( strstr( $capability, $plural_base ) != $plural_base ) {
					unset( $all_caps[ $key ] );
				}
			}

			return $all_caps;
		}

	}

endif;
