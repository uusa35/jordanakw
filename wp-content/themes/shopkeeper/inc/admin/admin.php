<?php 
if( ! class_exists( 'Getbowtied_Admin_Pages' ) ) {

	class Getbowtied_Admin_Pages {		
	
		// =============================================================================
		// Construct
		// =============================================================================

		function __construct() {	

			add_action( 'admin_menu', 				array( $this, 'getbowtied_theme_admin_menu' ) );
			add_action( 'admin_menu', 				array( $this, 'getbowtied_customizer_menu' ) );
			add_action( 'register_sidebar', 		array( $this, 'getbowtied_theme_admin_init' ) );

		}

		function getbowtied_theme_admin_menu() {			
			$getbowtied_menu_welcome = add_menu_page(
				getbowtied_parent_theme_name(),
				getbowtied_parent_theme_name(),
				'administrator',
				'getbowtied_theme',
				array( $this, 'getbowtied_theme_welcome_page' ),
				'',
				3
			);
		}

		function getbowtied_customizer_menu() {		
			$customize_url = add_query_arg(
		        'return',
		        urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ),
		        'customize.php'
		    );	

			add_submenu_page(
				'getbowtied_theme',
		        __( 'Customize' ),
		        __( 'Customize' ),
		        'customize',
		        esc_url( $customize_url ),
		        ''
		    );

		}

		function getbowtied_admin_menu() {						
			$getbowtied_welcome = add_submenu_page(
				'getbowtied_theme',
				__( 'Get Bowtied', 'getbowtied' ),
				__( 'Get Bowtied', 'getbowtied' ),
				'administrator',
				'getbowtied',
				array( $this, 'getbowtied_welcome_page' )
			);
		}

		function getbowtied_theme_welcome_page() 
		{
			require_once 'welcome_theme.php';
		}

		function getbowtied_theme_admin_init() {

			if ( isset( $_GET['getbowtied-activate'] ) && $_GET['getbowtied-activate'] == 'activate-plugin' ) {
				
				check_admin_referer( 'getbowtied-activate', 'getbowtied-activate-nonce' );

				if ( ! function_exists( 'get_plugins' ) ) {
					require_once ABSPATH . 'wp-admin/includes/plugin.php';
				}

				$plugins = get_plugins();

				foreach ( $plugins as $plugin_name => $plugin ) {
					if ( $plugin['Name'] == $_GET['plugin_name'] ) {
						activate_plugin( $plugin_name );
					}
				}

			}

		}
	}
	
	new Getbowtied_Admin_Pages;

}