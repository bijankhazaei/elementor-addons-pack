<?php

namespace Elementor_Addons_Pack\Widgets;

use Elementor\Core\Base\Document;
use ElementorPro\Modules\QueryControl\Module as QueryControlModule;
use ElementorPro\Plugin;

class Country_News_Widget extends \Elementor\Widget_Base
{
    public function get_name(): string
    {
        return 'country-news-widget';
    }

    public function get_title(): string
    {
        return __('Country News Widget', 'elementor-addons-pack');
    }

    public function get_icon(): string
    {
        return 'eicon-single-page';
    }


    public function get_categories(): array
    {
        return ['elementor-addons-pack'];
    }


    protected function register_controls(): void
    {
        $categories = get_terms([
            'taxonomy'   => 'category',
            'hide_empty' => false,
            'meta_key'   => 'show_as_country',
            'meta_value' => '1'
        ]);

        $categoryOptions = [];

        foreach ($categories as $category) {
            $categoryOptions[$category->term_id] = $category->name;
        }

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'elementor-addons-pack'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __('Title', 'elementor-addons-pack'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Country News', 'elementor-addons-pack'),
                'placeholder' => __('Enter your title', 'elementor-addons-pack'),
                'label_block' => true,
            ]
        );

        $document_types = Plugin::elementor()->documents->get_document_types([
            'show_in_library' => true,
        ]);
        // add list of elements repeater control
        $this->add_control(
            'countries_tab',
            [
                'label'   => __('Countries', 'elementor-addons-pack'),
                'type'    => \Elementor\Controls_Manager::REPEATER,
                'fields'  => [
                    [
                        'name'        => 'country',
                        'label'       => __('Country', 'elementor-addons-pack'),
                        'type'        => \Elementor\Controls_Manager::SELECT,
                        'options'     => $categoryOptions,
                        'label_block' => true,
                    ],
                    [
                        'name'         => 'template_selector',
                        'label'        => __('Template Selector', 'elementor-addons-pack'),
                        'type'         => QueryControlModule::QUERY_CONTROL_ID,
                        'label_block'  => true,
                        'autocomplete' => [
                            'object' => QueryControlModule::QUERY_OBJECT_LIBRARY_TEMPLATE,
                            'query'  => [
                                'meta_query' => [
                                    [
                                        'key'     => Document::TYPE_META_KEY,
                                        'value'   => array_keys($document_types),
                                        'compare' => 'IN',
                                    ],
                                ],
                            ],
                        ],
                    ]
                ],
                'default' => [
                    [
                        'country' => array_key_first($categoryOptions),
                    ],
                ],
            ],
        );

        $this->end_controls_section();

    }

    protected function render(): void
    {
        global $wp;

        $settings = $this->get_settings_for_display();
        $queryVar = $_GET['template'] ?? 0;
        ?>
        <div class="eap-countries-news-widget">
            <h3 class="title">
                <?php echo $settings['title']; ?>
            </h3>
            <div id="navigationWrapper" class="navigation-wrapper">
                <div id="eapCountrySlider" class="keen-slider" data-sliders="<?php echo count($settings['countries_tab'])?>">
                    <?php $i = 1;
                    foreach ($settings['countries_tab'] as $country) :
                        $template_id = $country['template_selector'] ?? 0;

                        $queryVar = $queryVar == 0 ? $template_id : $queryVar;

                        $countryObject = get_term_by('id', $country['country'], 'category');

                        $selected = $queryVar == $template_id ? 'selected' : '';
                        $flag =  EAP_URL.'assets/flag.png';
                        ?>
                        <div class="keen-slider__slide number-slide<?php echo $i . ' ' . $selected ?>"
                             data-selected="<?php echo $selected; ?>">

                            <a href="<?php echo home_url($wp->request); ?>/?template=<?php echo $template_id; ?>">
                                <img src="<?php echo $flag; ?>"
                                     alt="<?php echo $countryObject->name; ?>">
                                <h2><?php echo $countryObject->name; ?></h2>
                            </a>
                        </div>

                        <?php $i++; endforeach; ?>
                </div>
            </div>
            <div class="eap-countries-news-widget-content">
                <?php
                // PHPCS - should not be escaped.
                if ('publish' !== get_post_status($queryVar)) {
                    echo '<div class="error">Template Not Found</div>';
                }

                echo Plugin::elementor()->frontend->get_builder_content_for_display($queryVar); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                ?>
            </div>
        </div>
        <?php
    }
}