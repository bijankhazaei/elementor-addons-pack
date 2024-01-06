<?php

add_action('acf/include_fields', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key'                   => 'group_659430151e5c5',
        'title'                 => 'migrate coach elamantor addons',
        'fields'                => array(
            array(
                'key'               => 'field_659430156ac2b',
                'label'             => 'Show As country',
                'name'              => 'show_as_country',
                'aria-label'        => '',
                'type'              => 'true_false',
                'instructions'      => '',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'message'           => '',
                'default_value'     => 0,
                'ui'                => 0,
                'ui_on_text'        => '',
                'ui_off_text'       => '',
            ),
            array(
                'key'               => 'field_659430766ac2c',
                'label'             => 'Country Flag',
                'name'              => 'country_flag',
                'aria-label'        => '',
                'type'              => 'image',
                'instructions'      => '',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'return_format'     => 'array',
                'library'           => 'all',
                'min_width'         => '',
                'min_height'        => '',
                'min_size'          => '',
                'max_width'         => '',
                'max_height'        => '',
                'max_size'          => '',
                'mime_types'        => '',
                'preview_size'      => 'medium',
            ),
            array(
                'key'               => 'field_659430d082e88',
                'label'             => 'Country Order',
                'name'              => 'country_order',
                'aria-label'        => '',
                'type'              => 'number',
                'instructions'      => '',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'default_value'     => '',
                'min'               => '',
                'max'               => '',
                'placeholder'       => '',
                'step'              => '',
                'prepend'           => '',
                'append'            => '',
            ),
        ),
        'location'              => array(
            array(
                array(
                    'param'    => 'taxonomy',
                    'operator' => '==',
                    'value'    => 'category',
                ),
            ),
        ),
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => '',
        'active'                => true,
        'description'           => '',
        'show_in_rest'          => 0,
    ));
});

