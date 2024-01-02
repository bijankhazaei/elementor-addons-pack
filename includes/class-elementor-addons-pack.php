<?php

namespace Elementor_Addons_Pack;

use Elementor_Addons_Pack\Widgets\Countries_Widget;
use Elementor_Addons_Pack\Widgets\ThreeJS_Widget;

/**
 * Elementor Addons Pack.
 *
 * @package elementor-addons-pack
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor Widgets.
 */
final class Elementor_Addons_Pack
{

    private static ?Elementor_Addons_Pack $_instance = null;


    /**
     * @return Elementor_Addons_Pack|null
     */
    public static function get_instance(): ?Elementor_Addons_Pack
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor.
     */
    public function __construct()
    {
        if ($this->is_compatible()) {
            add_action('elementor/init', [$this, 'init']);
        }
    }

    public function is_compatible(): bool
    {
        // check compatibility
        return true;
    }

    public function init()
    {
        add_action('elementor/elements/categories_registered', [$this, 'register_category']);
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
        add_action( 'elementor/frontend/after_register_scripts', [$this, 'frontend_scripts'] );
        add_action( 'elementor/frontend/after_enqueue_styles', [$this, 'frontend_stylesheets'] );

    }

    /**
     * Register Category.
     *
     * @param $elements_manager .
     */
    public function register_category($elements_manager)
    {
        $elements_manager->add_category(
            'elementor-addons-pack',
            [
                'title' => __('Elementor Addons Pack', 'elementor-addons-pack'),
                'icon' => 'fa fa-plug',
            ]
        );
    }

    /**
     * Register widgets.
     *
     * @param $widgets_manager .
     */
    public function register_widgets($widgets_manager)
    {
        require_once EAP_WIDGETS_DIR . 'Countries_Widget.php';
        require_once EAP_WIDGETS_DIR . 'ThreeJS_Widget.php';

        $widgets_manager->register_widget_type(new Countries_Widget());
        $widgets_manager->register_widget_type(new ThreeJS_Widget());
    }

    /**
     * Register Controls
     *
     * Load controls files and register new Elementor controls.
     *
     * Fired by `elementor/controls/register` action hook.
     *
     * @param \Elementor\Controls_Manager $controls_manager Elementor controls manager.
     */

    public function register_controls($controls_manager)
    {
//        $path = ELEMENTOR_ADDONS_PACK_DIR . 'controls/';
//        require_once $path . 'Countries_Control.php';
//
//        $controls_manager->register();
    }

    public function frontend_scripts(): void
    {
        wp_register_script( 'eap-main-js', EAP_URL.'/assets/main.js', array(), '1.0.0', true );
        wp_enqueue_script( 'eap-main-js' );
    }

    public function frontend_stylesheets(): void
    {
        wp_register_style( 'eap-main-css', EAP_URL.'/assets/main.css', array(), '1.0.0', 'all' );
        wp_enqueue_style( 'eap-main-css' );
    }
}