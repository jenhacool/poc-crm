<?php

/**
 * Plugin Name: POC CRM
 */

if( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

use POC\CRM\POC_CRM;

// Define constant variables
define( 'POC_CRM_PLUGIN_FILE', __FILE__ );
define( 'POC_CRM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'POC_CRM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Register activation hook
register_activation_hook( POC_CRM_PLUGIN_FILE, array( 'POC_CRM', 'activate' ) );

// Register deactivation hook
register_deactivation_hook( POC_CRM_PLUGIN_FILE, array( 'POC_CRM', 'deactivate' ) );

// Run plugin
POC_CRM::instance();