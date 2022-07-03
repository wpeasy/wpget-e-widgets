# wpget-e-widgets
## WPGet Elementor Widgets

This is a WordPress plugin for Elementor Widgets. I created this for learning how to create and manage Elementor Widgets.
Please feel free to use this as you please.

This plugin comes with no support or guarantees

## Concept
This plugin is for learning how to develop Elementor plugin addons. 

All code is not minified or uglified, so it is fully readable.

### Code Style
Follow standard WordPress Code Styles.
[Code Style](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/)

### Creating New Modules
Plugin Modules use PSR4 Autoloading. Therefore, follow correct directory and namespace paths, and you do not need to include or require class files. 
To create a new Module:
- create a folder under src/Modules
- Create a class called Module_Controller
- Module_Controller is a Singleton, see one of the existing Modules for structure.

## Current Widgets:
### Basic Tip Bar
Demo page TBA

### Basic Scroll Sequence
[Demo page ](https://plugins.wpget.net/plugins/wpget-elementor-widgets/scrollsequence/)
