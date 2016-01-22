<?php

// File Security Check
if (!defined('ABSPATH'))
    exit;


// Theme Define Constants 
define('INC_DIR', trailingslashit(trailingslashit(THEME_DIR) . basename(dirname(__FILE__))));
define('INC_URI', trailingslashit(trailingslashit(THEME_URI) . basename(dirname(__FILE__))));

define('ADMIN_DIR', trailingslashit(trailingslashit(INC_DIR) . 'admin'));
define('ADMIN_URI', trailingslashit(trailingslashit(INC_URI) . 'admin'));

define('CUSTOMIZER_DIR', trailingslashit(trailingslashit(ADMIN_DIR) . 'customizer'));
define('CUSTOMIZER_OPT_SETT_DIR', trailingslashit(trailingslashit(CUSTOMIZER_DIR) . 'option-settings'));
define('CLASSES_DIR', trailingslashit(trailingslashit(ADMIN_DIR) . 'classes'));
define('FUNCTIONS_DIR', trailingslashit(trailingslashit(ADMIN_DIR) . 'functions'));
define('EXTENSIONS_DIR', trailingslashit(trailingslashit(ADMIN_DIR) . 'extensions'));
define('EXTENSIONS_URI', trailingslashit(trailingslashit(ADMIN_URI) . 'extensions'));


/* ----------------------------------------------------------------------------------- */
/* Load the theme-specific files.
  /*----------------------------------------------------------------------------------- */

require_once FUNCTIONS_DIR . 'composer.php';

require_once ADMIN_DIR . 'theme-setup.php'; // General Setup
require_once ADMIN_DIR . 'theme-customizer.php'; // Custom panel settings and custom settings theme customizer
require_once ADMIN_DIR . 'theme-actions.php'; // Theme actions & user defined hooks
require_once ADMIN_DIR . 'theme-comments.php'; // Custom comments/pingback loop
require_once ADMIN_DIR . 'theme-styles.php'; // Load Stylesheet via wp_enqueue_script
require_once ADMIN_DIR . 'theme-js.php'; // Load JavaScript via wp_enqueue_script
require_once ADMIN_DIR . 'theme-sidebar.php'; // Initialize widgetized areas
require_once ADMIN_DIR . 'theme-widgets.php'; // Theme widgets

// Load WooCommerce functions, if applicable.
if (is_woocommerce_activated()) {
    require_once ADMIN_DIR . 'theme-woocommerce.php';
}

// Load Events Calender functions, if applicable.
if (is_events_calender_activated()) {
    require_once ADMIN_DIR . 'theme-tribe-events.php';
}

// Load Events Calender functions, if applicable.
if (class_exists('upcoming_events_widget')) {
    require_once ADMIN_DIR . 'theme-timetable.php';
}

// Load Events Uber Menu functions, if applicable.
if (class_exists('UberMenu')) {
    require_once ADMIN_DIR . 'theme-ubermenu.php';
}