<?php
/*
Plugin Name: Advanced Custom Fields: Relationship Multisite
Plugin URI: https://github.com/tmconnect/acf-relationship-multisite
Description: Get post, pages and custom post types from another site of your WordPress Multisite installation. This plugin needs the installation/activation of Advanced Custom Fields V5.
Version: 1.1.02 (>= ACF 5.2.7)
Author: Thomas Meyer, Silvia Ulenberg
Author URI: www.dreihochzwo.de, https://www.silviaulenberg.de
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'acf_relationship_multisite' ) ) :
	class acf_relationship_multisite {
		/*
		*  __construct
		*
		*  This function will setup the class functionality
		*
		*  @type	function
		*  @date	17/02/2016
		*  @since	1.0.0
		*
		*  @param	n/a
		*  @return	n/a
		*/

		function __construct() {

			// vars
			$this->settings = array(
				'version' => '1.0.0',
				'url'     => plugin_dir_url( __FILE__ ),
				'path'    => plugin_dir_path( __FILE__ )
			);

			// set text domain
			// https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
			load_plugin_textdomain( 'acf-relationship-multisite', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

			// include field
			add_action( 'acf/include_field_types', array( $this, 'include_field_types' ) ); // v5
			add_action( 'acf/register_fields', array( $this, 'include_field_types' ) ); // v4

		}

		/*
		*  include_field_types
		*
		*  This function will include the field type class
		*
		*  @type	function
		*  @date	17/02/2016
		*  @since	1.0.0
		*
		*  @param	$version (int) major ACF version. Defaults to false
		*  @return	n/a
		*/

		function include_field_types( $version = false ) {

			// support empty $version
			if ( ! $version ) {
				$version = 5;
			}

			// include
			include_once( 'fields/acf-relationship-multisite-v' . $version . '.php' );
		}
	}

// initialize
	new acf_relationship_multisite();
// class_exists check
endif;
