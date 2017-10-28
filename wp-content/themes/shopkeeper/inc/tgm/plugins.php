<?php


function getbowtied_theme_register_required_plugins() 
{

    $plugins = array(

        // PREMIUM Plugins
    
        array(
               'name'                  => 'GetBowtied Tools', // The plugin name
               'slug'                  => 'getbowtied-tools', // The plugin slug (typically the folder name)
               'source'                => 'https://my.getbowtied.com/getbowtied-tools/getbowtied-tools-new.zip', // The plugin source
               'required'              => true, // If false, the plugin is only 'recommended' instead of required
               'version'               => '1.2.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
               'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
               'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
               'external_url'          => '', // If set, overrides default API URL and points to an external URL
               'image_url'             => ''
        )
    );


    $config = array(
       'id'                => 'getbowtied',
        'default_path'      => '',
        'parent_slug'       => 'themes.php',
        'menu'              => 'tgmpa-install-plugins',
        'has_notices'       => true,
        'is_automatic'      => true
    );

    tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'getbowtied_theme_register_required_plugins' );

?>