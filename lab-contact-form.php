<?php 
/**
*Plugin Name: Lab Contact Form
*Description: Formulario de contacto muy simple, ir a "Ajustes/Lab Contact Form" poner el Email y listo. 
*Version: 1.0
*Author: Labarta
*Author URI: https://labarta.es/
*Plugin URI: https://labarta.es/lab-contact-form
*License:     GPL2
*License URI: https://www.gnu.org/licenses/gpl-2.0.html
*Text Domain: labcf
*Domain Path: /languages

**/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define('Lab_contactform_dir', plugin_dir_path(__FILE__));
define('Lab_contactform_url', plugin_dir_url(__FILE__));


//option page
function lab_contactform_admin() {
    include(Lab_contactform_dir.'includes/admin.php');
}

function lab_contactform_admin_actions() {
 	add_options_page("Lab Contact Form", "Lab Contact Form", 1, "Lab_Contact_Form", "lab_contactform_admin");
} 
add_action('admin_menu', 'lab_contactform_admin_actions');

add_action ('wp_enqueue_scripts', function () {
      wp_enqueue_style ('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');});

// load plugin text domain

add_action( 'plugins_loaded', 'labcf_textdomain' );

function labcf_textdomain() {
load_plugin_textdomain( 'labcf', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}


//core functions
	
function lab_contactform_shortcode() {
	include(Lab_contactform_dir.'includes/core.php');
    ob_start();
    lab_deliver_mail();
    lab_html_form_code();
 
    return ob_get_clean();
}

	add_shortcode( 'lab_contactform', 'lab_contactform_shortcode' );
?>