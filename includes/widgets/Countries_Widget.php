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
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        // add repeater control for countries
        $this->add_control(
            'countries',
            [
                'label'   => __('Countries', 'elementor-addons-pack'),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => [
                    [
                        'name'    => 'country_name',
                        'label'   => __('Country Name', 'elementor-addons-pack'),
                        'type'    => Controls_Manager::TEXT,
                        'default' => __('Country Name', 'elementor-addons-pack'),
                    ],
                    [
                        'name'    => 'country_construct',
                        'label'   => __('Country Construct', 'elementor-addons-pack'),
                        'type'    => Controls_Manager::TEXTAREA,
                        'default' => __('Country Construct', 'elementor-addons-pack'),
                    ],
                    [
                        'name'    => 'country_description',
                        'label'   => __('Country Description', 'elementor-addons-pack'),
                        'type'    => Controls_Manager::WYSIWYG,
                        'default' => __('Country Description', 'elementor-addons-pack'),
                    ],
                    [
                        'name'    => 'country_link',
                        'label'   => __('Country Link', 'elementor-addons-pack'),
                        'type'    => Controls_Manager::URL,
                        'default' => ['Country Link', 'elementor-addons-pack']
                    ],
                    [
                        'name'    => 'country_flag',
                        'label'   => __('Country Flag', 'elementor-addons-pack'),
                        'type'    => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name'    => 'country_id',
                        'label'   => __('Country Id', 'elementor-addons-pack'),
                        'type'    => Controls_Manager::SELECT2,
                        'options' => [
                            "AE" => "United Arab Emirates",
                            "AL" => "Albania",
                            "AM" => "Armenia",
                            "AR" => "Argentina",
                            "AT" => "Austria",
                            "AU" => "Australia",
                            "AZ" => "Azerbaijan",
                            "BA" => "Bosnia and Herzegovina",
                            "BD" => "Bangladesh",
                            "BE" => "Belgium",
                            "BG" => "Bulgaria",
                            "BO" => "Bolivia",
                            "BR" => "Brazil",
                            "CA" => "Canada",
                            "CH" => "Switzerland",
                            "CL" => "Chile",
                            "CN" => "China",
                            "CO" => "Colombia",
                            "CR" => "Costa Rica",
                            "CY" => "Cyprus",
                            "CZ" => "Czech Republic",
                            "DE" => "Germany",
                            "DK" => "Denmark",
                            "DO" => "Dominican Republic",
                            "EC" => "Ecuador",
                            "EE" => "Estonia",
                            "EG" => "Egypt",
                            "ES" => "Spain",
                            "FI" => "Finland",
                            "FR" => "France",
                            "GB" => "United Kingdom",
                            "GE" => "Georgia",
                            "GF" => "France",
                            "GL" => "Greenland",
                            "GR" => "Greece",
                            "HR" => "Croatia",
                            "HU" => "Hungary",
                            "ID" => "Indonesia",
                            "IE" => "Ireland",
                            "IN" => "India",
                            "IQ" => "Iraq",
                            "IR" => "Iran",
                            "IS" => "Iceland",
                            "IT" => "Italy",
                            "JO" => "Jordan",
                            "JP" => "Japan",
                            "KR" => "Republic of Korea",
                            "KW" => "Kuwait",
                            "LB" => "Lebanon",
                            "LK" => "Sri Lanka",
                            "LR" => "Liberia",
                            "LT" => "Lithuania",
                            "LU" => "Luxembourg",
                            "LV" => "Latvia",
                            "MD" => "Moldova",
                            "ME" => "Montenegro",
                            "MG" => "Madagascar",
                            "MK" => "Macedonia",
                            "ML" => "Mali",
                            "MOR" => "Morisica",
                            "MX" => "Mexico",
                            "MY" => "Malaysia",
                            "NL" => "Netherlands",
                            "NO" => "Norway",
                            "NZ" => "New Zealand",
                            "OM" => "Oman",
                            "PA" => "Panama",
                            "PE" => "Peru",
                            "PH" => "Philippines",
                            "PL" => "Poland",
                            "PR" => "Puerto Rico",
                            "PT" => "Portugal",
                            "PY" => "Paraguay",
                            "QA" => "Qatar",
                            "RO" => "Romania",
                            "RS" => "Serbia",
                            "RU" => "Russian Federation",
                            "SA" => "Saudi Arabia",
                            "SB" => "Solomon Islands",
                            "SE" => "Sweden",
                            "SI" => "Slovenia",
                            "SK" => "Slovakia",
                            "SZ" => "Swaziland",
                            "TH" => "Thailand",
                            "TJ" => "Tajikistan",
                            "TR" => "Turkey",
                            "TW" => "Taiwan",
                            "UA" => "Ukraine",
                            "US" => "United States",
                        ],
                    ]
                ],
                'default' => [
                    [
                        'country_name'        => __('Country Name', 'elementor-addons-pack'),
                        'country_description' => __('Country Description', 'elementor-addons-pack'),
                        'country_flag'        => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void
    {
        $settings = $this->get_settings_for_display();

        $map = '';
        if (file_exists(EAP_DIR . '/templates/map.php')) {
            $map = file_get_contents(EAP_DIR . '/templates/map.php');
        }

        ?>
        <div class="eap-countries-widget desktop">
            <div class="eap-countries-widget-content">
                <?php foreach ($settings['countries'] as $country) : ?>
                    <div class="eap-countries-widget-item" data-country_id="<?php echo esc_attr($country['country_id']); ?>">
                        <div class="eap-countries-item-inner hover">
                            <a href="<?php echo $country['country_link']['url'] ?? '#' ?>"
                               target="_blank"
                               class="mouse-over-link">
                                <?php echo sprintf(__('Read About %s' , 'countries'), esc_attr($country['country_name']))  ?>
                            </a>
                        </div>
                        <div class="eap-countries-item-inner normal">
                            <div class="eap-countries-widget-item-flag">
                                <img src="<?php echo esc_url($country['country_flag']['url']); ?>"
                                     alt="<?php echo esc_attr($country['country_name']); ?>">
                            </div>
                            <div class="eap-countries-widget-item-content">
                                <p><?php echo esc_html($country['country_name']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div id="mapContainer" class="map-container">
                <?php echo $map; ?>
                <div class="modals">
                    <?php foreach ($settings['countries'] as $country) : ?>
                        <div id="country_<?php echo esc_attr($country['country_id']); ?>" class="country-modal">
                            <div class="modal-title">
                                <img src="<?php echo esc_url($country['country_flag']['url']); ?>"
                                     alt="<?php echo esc_attr($country['country_name']); ?>">
                                <p><?php echo esc_html($country['country_name']); ?></p>
                            </div>
                            <div class="eap-countries-widget-item-content">
                                <?php echo $country['country_description']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="eap-countries-widget mobile">
            <div class="eap-countries-widget-content">
                <?php foreach (array_chunk($settings['countries'], 2) as $twoCountry) { ?>
                    <div class="eap-countries-widget-mobile-row">
                    <?php foreach ($twoCountry as $country) : ?>
                        <div class="eap-countries-widget-item eap-widget-item-mobile"
                             data-country_id="<?php echo esc_attr($country['country_id']); ?>">
                            <div class="eap-countries-item-inner">
                                <div class="eap-countries-widget-item-flag">
                                    <img src="<?php echo esc_url($country['country_flag']['url']); ?>"
                                         alt="<?php echo esc_attr($country['country_name']); ?>">
                                </div>
                                <div class="eap-countries-widget-item-content">
                                    <p><?php echo esc_html($country['country_name']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <div class="eap-countries-widget-mobile-row-accordion">
                    <?php foreach ($twoCountry as $country) : ?>
                        <div id="country_accordion_<?php echo esc_attr($country['country_id']); ?>" class="country-accordion">
                            <p><?php echo esc_html($country['country_description']); ?></p>
                            <a href="<?php echo $country['country_link'] ?>" target="_blank">
                                <?php echo __('Read More', 'countries'); ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                    </div>
                <?php }?>
            </div>
        </div>
        <?php
    }
}