<?php

namespace Elementor_Addons_Pack\Widgets;

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * First Widget for elementor addons pack
 * this widget developed for show countries in word map and get name and description of country
 * and get flag icon and show that on country when click over country flag
 */
class Countries_Widget extends Widget_Base
{

    public function get_name(): string
    {
        // TODO: Implement get_name() method.
        return 'countries_widget';
    }

    public function get_title(): string
    {
        return __('Countries Widget', 'elementor-addons-pack');
    }

    public function get_icon(): string
    {
        return 'eicon-map-pin';
    }

    public function get_categories(): array
    {
        return ['elementor-addons-pack'];
    }

    protected function _register_controls(): void
    {
        $this->start_controls_section(
            'countries_widget_section',
            [
                'label' => __('Countries Widget', 'elementor-addons-pack'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // add repeater control for countries
        $this->add_control(
            'countries',
            [
                'label' => __('Countries', 'elementor-addons-pack'),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'country_name',
                        'label' => __('Country Name', 'elementor-addons-pack'),
                        'type' => Controls_Manager::TEXT,
                        'default' => __('Country Name', 'elementor-addons-pack'),
                    ],
                    [
                        'name' => 'country_description',
                        'label' => __('Country Description', 'elementor-addons-pack'),
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => __('Country Description', 'elementor-addons-pack'),
                    ],
                    [
                      'name' => 'country_link',
                      'label' => __('Country Link', 'elementor-addons-pack'),
                      'type' => Controls_Manager::URL,
                      'default' => ['Country Link', 'elementor-addons-pack']
                    ],
                    [
                        'name' => 'country_flag',
                        'label' => __('Country Flag', 'elementor-addons-pack'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
                'default' => [
                    [
                        'country_name' => __('Country Name', 'elementor-addons-pack'),
                        'country_description' => __('Country Description', 'elementor-addons-pack'),
                        'country_flag' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        // start controls section for custom tab for get global map and other controls
        $this->start_controls_section(
            'countries_widget_global_map_section',
            [
                'label' => __('Global Map', 'elementor-addons-pack'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // get svg file for global map
        $this->add_control(
            'global_map_svg',
            [
                'label' => __('Global Map SVG', 'elementor-addons-pack'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section(); // end controls section for custom tab for get global map and other controls
    }

    protected function render(): void
    {
        $settings = $this->get_settings_for_display();

        $map = '';
        if(file_exists(EAP_DIR.'/templates/map.php')) {
            $map = file_get_contents(EAP_DIR.'/templates/map.php');
        }

        ?>
        <div class="eap-countries-widget">
            <?php echo $map; ?>
            <div class="eap-countries-widget-content">
                <?php foreach ($settings['countries'] as $country) : ?>
                    <div class="eap-countries-widget-item">
                        <div class="eap-countries-widget-item-flag">
                            <img src="<?php echo esc_url($country['country_flag']['url']); ?>" alt="<?php echo esc_attr($country['country_name']); ?>">
                        </div>
                        <div class="eap-countries-widget-item-content">
                            <h3><?php echo esc_html($country['country_name']); ?></h3>
                            <p><?php echo esc_html($country['country_description']); ?></p>
                            <a href="<?php echo esc_url($country['country_link']['url']); ?>" target="<?php echo esc_attr($country['country_link']['is_external'] ? '_blank' : '_self'); ?>"><?php echo esc_html($country['country_link']['title']); ?></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
}