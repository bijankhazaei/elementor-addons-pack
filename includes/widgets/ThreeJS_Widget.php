<?php

namespace Elementor_Addons_Pack\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

class ThreeJS_Widget extends \Elementor\Widget_Base
{

    public function get_name(): string
    {
        return 'threejs-widget';
    }

    public function get_title(): string
    {
        return __('ThreeJS Widget', 'elementor-addons-pack');
    }

    public function get_icon(): string
    {
        return 'eicon-code';
    }


    public function get_categories(): array
    {
        return ['elementor-addons-pack'];
    }


    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'elementor-addons-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'threejs_code',
            [
                'label' => __('ThreeJS Code', 'elementor-addons-pack'),
                'type'  => \Elementor\Controls_Manager::CODE,
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
            $settings = $this->get_settings_for_display();
            echo '<div class="threejs-widget">';
            echo $settings['threejs_code'];
            echo '</div>';
    }

    protected function _content_template() {
        ?>
        <div class="threejs-widget">
            {{{ settings.threejs_code }}}
        </div>
        <?php
    }
}