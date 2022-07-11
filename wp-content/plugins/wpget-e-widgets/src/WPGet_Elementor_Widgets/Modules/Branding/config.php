<?php

/*
 * Return an Array for Config
 * Module_loader will parse this config and add to $_global_module_config
 */

return [
    "id" => "wpget_branding",

    //Stats
    "widget_count" => 0, //Will be updated by script
    "extension_count" => 0, //Will be updated by script

    //Flags
    "has_all_dependencies_active" => false, //Will be updated by script
    "is_enabled" => true, //Will be updated by script

    //Details
    "can_disable" => true, //If set to false, the module cannot be disabled
    "release_level" => \WPGet_Elementor_Widgets\Lib\Helper\Module_Helper::RELEASE_LEVEL_ALPHA,
    "name" => "WPGet Branding",
    "description" => "Extension for Site Settings to brand this Plugin Set",
    "documentation" => "https://plugins.wpget.net/plugins/wpget-elementor-widgets/branding/",
    "dependencies" => [
        [
            "name" => "Elementor Prp",
            "path" => "elementor-pro/elementor-pro.php"
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
    "widgets" => [],
    "extensions" => [
        [
            "id" => "Wireframe_SettingsElementor",
            "class" => \WPGet_Elementor_Widgets\Modules\Branding\Extensions\Wireframe_Settings_Controller::class,

            //Flags
            "has_dependencies" => false, //Will be updated by script
            "is_enabled" => true, //Will be updated by script

            //Details
            "can_disable" => true, //If set to false, the Widget cannot be disabled
            "release_level" => \WPGet_Elementor_Widgets\Lib\Helper\Module_Helper::RELEASE_LEVEL_BETA,
            "name" => "Wireframe Settings",
            "description" => "Page Setting to enable Wireframes fro compatible Widgets",

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
        ],
        [
            "id" => "Branding_Extension_Controller",
            "class" => \WPGet_Elementor_Widgets\Modules\Branding\Extensions\Branding_Extension_Controller::class,

            //Flags
            "has_dependencies" => false, //Will be updated by script
            "is_enabled" => true, //Will be updated by script

            //Details
            "can_disable" => false, //If set to false, the Widget cannot be disabled
            "release_level" => \WPGet_Elementor_Widgets\Lib\Helper\Module_Helper::RELEASE_LEVEL_BETA,
            "name" => "Plugin Branding",
            "description" => "Site Settings to brand this plugin",

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
