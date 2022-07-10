<?php

/*
 * Return an Array for Config
 * Module_loader will parse this config and add to $_global_module_config
 */

return [
    "id" => "wpget_content_widgets",

    //Stats
    "widget_count" => 0, //Will be updated by script
    "extension_count" => 0, //Will be updated by script

    //Flags
    "has_all_dependencies_active" => false, //Will be updated by script
    "is_enabled" => true, //Will be updated by script

    //Details
    "can_disable" => true, //If set to false, the module cannot be disabled
    "release_level" => \WPGet_Elementor_Widgets\Lib\Helper\Module_Helper::RELEASE_LEVEL_ALPHA,
    "name" => "WPGet Content Widgets",
    "description" => "Various widgets for displaying content.",
    "documentation" => "https://plugins.wpget.net/plugins/wpget-elementor-widgets/wpget_content_widgets/",
    "dependencies" => [
        [
            "name" => "Elementor Free",
            "path" => "elementor/elementor.php"
        ]
    ],
    "attributions" => [
        [
            "name" => "Alan Blair",
            "company" => "WPGet",
            "logo" => "https://www.wpget.au/wp-content/uploads/2020/09/logo-alt@2x.png",
            "comment" => "Creator of original code"
        ]
    ],
    "widgets" => [
        [
            "id" => "Basic_TipBar_Widget",
            "class" => \WPGet_Elementor_Widgets\Modules\WPGet_Content_Widgets\Widgets\Basic_TipBar_Widget::class,

            //Flags
            "has_dependencies" => false, //Will be updated by script
            "is_enabled" => true, //Will be updated by script

            //Details
            "can_disable" => true, //If set to false, the Widget cannot be disabled
            "release_level" => \WPGet_Elementor_Widgets\Lib\Helper\Module_Helper::RELEASE_LEVEL_BETA,
            "name" => "Tip Bar Basic",
            "description" => "Content area wth a Tip Bar header ",
            "documentation" => "https://plugins.wpget.net/plugins/wpget-elementor-widgets/Basic_TipBar_Widget/",

            "dependencies" => [
                [
                    "name" => "Elementor Free",
                    "path" => "elementor/elementor.php"
                ]
            ],

            "attributions" => [
                [
                    "name" => "Alan Blair",
                    "company" => "WPGet",
                    "logo" => "https://www.wpget.au/wp-content/uploads/2020/09/logo-alt@2x.png",
                    "comment" => "Creator of original code"
                ]
            ],
        ]
    ]
];
