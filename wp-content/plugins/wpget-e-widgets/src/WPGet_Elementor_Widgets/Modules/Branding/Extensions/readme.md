## Notes about Extensions

To split concerns between Elementor code and Non Elementor code we use two classes for each extension.
- Extension_Name_Controller - Our code excluding Elementor specific code
- Extension_Name_Elementor - Elementor specific code. Code here should be recognisable as code from elementor documentation

The Controller class must be referenced in the config.php file.