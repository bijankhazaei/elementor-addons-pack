<?php
/**
 * Plugin Name: Elementor Addons Pack
 * Description: Elementor Addons Pack Plugin
 * Version: 1.0.3
 * Author: Bijan Khazaei
 * Author URI:
 * Text Domain: elementor-addons-pack
 * Elementor tested up to: x.x.x
 * Elementor Pro tested up to: x.x.x
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly


if (!defined('EAP_VERSION')) {
    define('ELEMENTOR_ADDONS_PACK_VERSION', '1.0.0');
}

if (!defined('EAP_DIR')) {
    define('EAP_DIR', plugin_dir_path(__FILE__));
}

if (!defined('EAP_URL')) {
    define('EAP_URL', plugin_dir_url(__FILE__));
}

if (!defined('EAP_WIDGETS_DIR')) {
    define('EAP_WIDGETS_DIR', EAP_DIR . 'includes/widgets/');
}

if (!defined('EAP_CONTROLS_DIR')) {
    define('EAP_CONTROLS_DIR', EAP_DIR . 'includes/controls/');
}

if(!defined('EAP_ACF_DIR')){
    define('EAP_ACF_DIR', EAP_DIR . 'includes/acf/');
}

if(!defined('EAP_ACF_URL')){
    define('EAP_ACF_URL', EAP_URL . 'includes/acf/');
}

function elementor_test_addon(): void
{
    load_plugin_textdomain(
        'elementor-addons-pack',
        false,
        dirname( plugin_basename( __FILE__ ) ) . '/languages/'
    );

    require_once EAP_DIR . 'includes/class-elementor-addons-pack.php';
    \Elementor_Addons_Pack\Elementor_Addons_Pack::get_instance();
}

add_action('plugins_loaded', 'elementor_test_addon');
