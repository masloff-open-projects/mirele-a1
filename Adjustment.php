<?php

parse_str(file_get_contents("php://input"), $_PUT);
parse_str(file_get_contents("php://input"), $_DELETE);

/**
 * Unchangeable GET parameters
 */
define('MIRELE_GET', $_GET);

/**
 * Unchangeable POST parameters
 */
define('MIRELE_POST', $_POST);

/**
 * Unchangeable PUT parameters
 */
define('MIRELE_PUT', $_SERVER['REQUEST_METHOD'] == 'PUT' ? $_PUT : []);

/**
 * Unchangeable DELETE parameters
 */
define('MIRELE_DELETE', $_SERVER['REQUEST_METHOD'] == 'DELETE' ? $_DELETE : []);

/**
 * @deprecated
 */
define('MIRELE_REQUIRED', [
    'PHP' => '7.0.0'
]);

/**
 * The constant of Mirele plugin template support at the moment
 */
define('MIRELE_SUPPORT', true);

/**
 * The constant of WooCommerce plugin template support at the moment
 */
define('WOOCOMMERCE_SUPPORT', function_exists('is_woocommerce'));

/**
 * The constant of bbPress plugin template support at the moment
 */
define('BBPRESS_SUPPORT', function_exists('is_bbpress'));

/**
 * The constant of BuddyPress plugin template support at the moment
 */
define('BUDDYPRESS_SUPPORT', function_exists('is_buddypress'));


# Meta Constants

/**
 * Mirele version
 */
define('MIRELE_VERSION', "1.0.0");

/**
 * COMPOUND version
 */
define('COMPOUND_VERSION', "1.0.1");

/**
 * Unchangeable URL string without GET parameters
 */
define('MIRELE_URL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . explode('?', $_SERVER['REQUEST_URI'], 2)[0]);

# Constants regulators

/**
 * @deprecated deprecated since version 2.0
 */
define('MIRELE_MIN_PERMISSIONS_FOR_EDIT', 'edit_themes');

/**
 * Constant with user rights packet for certain actions
 */
define('MIRELE_RIGHTS', [
    'page' => [
        'create' => 'edit_themes',
        'edit' => 'edit_themes',
        'remove' => 'edit_themes',
    ]
]);

/**
 * Constant with a prohibited character packet for entering names, IDs or other data entered by the user
 */
define('COMPOUND_FORBIDDEN_SYMBOLS', array(':', '/', "@"));

/**
 * Constant with the name of the compound canvas template
 */
define('COMPOUND_CANVAS', 'canvas.php');

/**
 * Constant with the name of the security code
 */
define('MIRELE_NONCE', 'mrl-wp-nonce');

# File path constants

/**
 * Constant with by folder to templates
 */
define('COMPOUND_TEMPLATES_DIR', get_template_directory() . '/templates');

/**
 * Constant with folder path to TWIG templates
 */
define('COMPOUND_TWIG_DIR', get_template_directory() . '/TWIG');

/**
 * Constant with by public data folder
 * @deprecated
 */
define('MIRELE_SOURCE_DIR', get_template_directory_uri() . '/Public');

/**
 * Constant with by public data folder
 * @deprecated
 */
define('MIRELE_SOURCE_PATH', get_template_directory() . '/Public');

/**
 * Constant with by log file
 */
define('MIRELE_LOG_FILE', get_template_directory() . '/logger.log');

/**
 * Constant with the emergency log file error if the log file is not available for writing
 */
define('MIRELE_ERROR_FILE', get_template_directory() . '/.error');

# Bureaucratic information

/**
 * A constant with a package of links to external resources
 * @deprecated
 */
define('MIRELE_URLS', [
    'DOC' => 'https://irtex-mirele.github.io'
]);

/**
 * Constant with reference to the documentation file
 */
define('MIRELE_URL_DOC', 'https://irtex-mirele.github.io');