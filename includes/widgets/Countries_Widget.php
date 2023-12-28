<?php

namespace Elementor_Addons_Pack\Widgets;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


/**
 * First Widget for elementor addons pack
 * this widget developed for show countries in word map and get name and description of country
 * and get flag icon and show that on country when click over country flag
 */
class Countries_Widget extends \Elementor\Widget_Base
{

    public function get_name(): string
    {
        // TODO: Implement get_name() method.
        return 'countries_widget';
    }

    public function get_title(): string
    {
        return __('Countries Widget', 'countries_widget');
    }

    public function get_icon(): string
    {
        return 'eicon-map-pin';
    }

    public function get_categories(): array
    {
        return ['elementor-addons-pack'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'countries_widget_section',
            [
                'label' => __('Countries Widget', 'countries_widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'countries_widget_title',
            [
                'label' => __('Title', 'countries_widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Countries Widget', 'countries_widget'),
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        echo '<h1>' . $settings['countries_widget_title'] . '</h1>';
    }
}