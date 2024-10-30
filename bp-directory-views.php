<?php
/**
 * Plugin Name:   BP Directory Views
 * Plugin URI:    https://wordpress.org/plugins/bp-directory-views/
 * Description:   Creates a uniform grid layout to the BP Members and Groups directories
 * Version:       1.1.1
 * Author:        Venutius
 * Author URI:    https://buddyuser.com
 * Plugin URI: 	  https://buddyuser.com/plugin-bp-directory-views
 * License:       GPL-2.0+
 * License URI:   http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:   bp-directory-views
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function bpdv_check_buddypress() {
    
	if ( ! class_exists( 'buddypress' ) ) {
        
		add_action( 'admin_notices', 'bpdv_no_bp_admin_notice' );
    
		return;
	
	}

}

add_action( 'plugins_loaded', 'bpdv_check_buddypress' );


function bpdv_no_bp_admin_notice() {
    ?>

    <div class="error fade notice-error6 is-dismissible">

		<p><?php esc_attr_e( 'BuddyPress needs to be active for BP Directory Views to work.', 'bp-directory-views' ); ?></p>
    
	</div>

	<?php
	return;
}


/**
 * Main function that removes the tools menu
 *
 * @return string $menu_slug The tools menu slug
 */
function enqueue_members_list_style_nouveau() {
			if ( is_rtl()) {
				wp_enqueue_style( 'members-list-module-styles',  plugins_url( '', __FILE__ ) . '/assets/css/members-list-module-rtl.css', array(), false, 'screen' );
			} else {
				wp_enqueue_style( 'members-list-module-styles',  plugins_url( '', __FILE__ ) . '/assets/css/members-list-module.css', array(), false, 'screen' );
			}
}
function enqueue_members_list_style_legacy() {
			if ( is_rtl()) {
				wp_enqueue_style( 'members-list-module-styles',  plugins_url( '', __FILE__ ) . '/assets/css/members-list-module-rtl.css', array(), false, 'screen' );
			} else {
				wp_enqueue_style( 'members-list-module-styles',  plugins_url( '', __FILE__ ) . '/assets/css/members-list-module.css', array(), false, 'screen' );
			}
}
function enqueue_members_list_script() {
			wp_enqueue_script( 'members-list-module-script', plugins_url( '', __FILE__ ) . '/assets/js/members-list-module.js', array('jquery'), false, true );
}
function enqueue_members_list_script_nouveau() {
			wp_enqueue_script( 'members-list-module-script', plugins_url( '', __FILE__ ) . '/assets/js/members-list-module-nouveau.js', array('jquery'), false, true );
}

function enqueue_groups_list_style_legacy() {
			if ( is_rtl() ) {
				wp_enqueue_style( 'groups-list-module-styles',  plugins_url( '', __FILE__ ) . '/assets/css/groups-list-module-rtl.css', array(), false, 'screen' );
			} else {
				wp_enqueue_style( 'groups-list-module-styles',  plugins_url( '', __FILE__ ) . '/assets/css/groups-list-module.css', array(), false, 'screen' );
			}
}
function enqueue_groups_list_style_nouveau() {
			if ( is_rtl() ) {
				wp_enqueue_style( 'groups-list-module-styles',  plugins_url( '', __FILE__ ) . '/assets/css/groups-list-module-rtl.css', array(), false, 'screen' );
			} else {
				wp_enqueue_style( 'groups-list-module-styles',  plugins_url( '', __FILE__ ) . '/assets/css/groups-list-module.css', array(), false, 'screen' );
			}
}
function enqueue_groups_list_script() {
			wp_enqueue_script( 'groups-list-module-script', plugins_url( '', __FILE__ ) . '/assets/js/groups-list-module.js', array('jquery'), false, true );
}
function enqueue_groups_list_script_nouveau() {
			wp_enqueue_script( 'groups-list-module-script', plugins_url( '', __FILE__ ) . '/assets/js/groups-list-module-nouveau.js', array('jquery'), false, true );
}


function bpdv_init() {
	if ( bp_get_theme_package_id() == 'legacy' ) {
		add_action('bp_enqueue_scripts', 'enqueue_groups_list_style_legacy', 20);
		add_action('bp_enqueue_scripts', 'enqueue_members_list_style_legacy', 20);
		add_action('bp_enqueue_scripts', 'enqueue_members_list_script');
		add_action('bp_enqueue_scripts', 'enqueue_groups_list_script');
	} else if ( bp_get_theme_package_id() == 'nouveau' ) {
		add_action('bp_enqueue_scripts', 'enqueue_groups_list_style_nouveau', 20);
		add_action('bp_enqueue_scripts', 'enqueue_members_list_style_nouveau', 20);
		add_action('bp_enqueue_scripts', 'enqueue_members_list_script_nouveau');
		add_action('bp_enqueue_scripts', 'enqueue_groups_list_script_nouveau');
	}
}

add_action( 'bp_include', 'bpdv_init'); 

add_filter( 'bp_after_has_groups_parse_args', 'bpdv_alter_groups_parse_args' );

function bpdv_alter_groups_parse_args( $loop ) {
	if ( bp_is_groups_directory() ) {
			$loop['per_page'] = 18;
	}
	return $loop;
}

add_filter( 'bp_after_has_members_parse_args', 'bpdv_theme_alter_members_parse_args' );
function bpdv_theme_alter_members_parse_args( $loop ) {
	if ( bp_is_members_directory() ) {
		{
		$loop['per_page'] = 21;
		}
	}
	return $loop;
}

