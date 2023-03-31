<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Acl Dashboard
Description: Acl Dashboard for Wasnaker.ID
Version: 1.0.1
Requires at least: 2.3.*
*/

define('ACL_MODULE_NAME', 'acl');
define('ACL_ASSETS_PATH', 'modules/acl/assets');
define('ACL_ATTACHMENTS_FOLDER', 'uploads/acl/');

$CI = &get_instance();

hooks()->add_action('admin_init', 'acl_module_menu_admin_items');
hooks()->add_action('admin_init', 'acl_permissions');
hooks()->add_action('admin_init', 'acl_settings_tab');

hooks()->add_action('acl_customers_footer', 'acl_client_footer_js__component');

function acl_module_menu_admin_items()
{
  $CI = &get_instance();

  if (has_permission('acl', '', 'my_dashboard_view') || has_permission('acl', '', 'all_dashboard_view') || has_permission('acl', '', 'widget_view') || has_permission('acl', '', 'dashboard_settings')) {
    $CI->app_menu->add_sidebar_menu_item('perfex-dashboard-module-menu-master', [
        'name'     => _l('acl'),
        'href'     => 'javascript:void(0);',
        'position' => 2,
        'icon'     => 'fa fa-home menu-icon',
    ]);
  }

}


function acl_permissions()
{
    $capabilities = [];

    $capabilities['capabilities'] = [
            'my_dashboard_view'   => _l('my_dashboard_view'),
            'all_dashboard_view'   => _l('all_dashboard_view'),
    ];

    register_staff_capabilities('acl', $capabilities, _l('acl'));
}

$CI->load->helper(ACL_MODULE_NAME . '/acl');

/**
 * Register activation module hook
 */
register_activation_hook(ACL_MODULE_NAME, 'acl_module_activation_hook');

function acl_module_activation_hook()
{
  $CI = &get_instance();
  require_once(__DIR__ . '/install.php');
}


function module_acl_action_links($actions)
{
    $actions[] = '<a href="' . admin_url('settings?group=acl') . '">' . _l('settings') . '</a>';

    return $actions;
}

/**
 * Register language files, must be registered if the module is using languages
 */
register_language_files(ACL_MODULE_NAME, [ACL_MODULE_NAME]);



/**
 * [acl_client_settings_tab net menu item in setup->settings]
 * @return void
 */
function acl_settings_tab()
{
    $CI = &get_instance();
    $CI->app_tabs->add_settings_tab('acl', [
        'name'     => _l('settings_group_acl'),
        //'view'     => module_views_path(ACL_MODULE_NAME, 'admin/settings/includes/acl'),
        'view'     => 'acl/acl_settings',
        'icon'     => 'fa-solid fa-gear',
        'position' => 51,
    ]);
}

$CI = &get_instance();
$CI->load->helper(ACL_MODULE_NAME . '/acl');
$CI->load->library('acl/Acl');

$CI->app_css->add(ACL_MODULE_NAME.'-css', base_url('modules/'.ACL_MODULE_NAME.'/assets/css/'.ACL_MODULE_NAME.'.css'));
$CI->app_scripts->add(ACL_MODULE_NAME.'-js', base_url('modules/'.ACL_MODULE_NAME.'/assets/js/'.ACL_MODULE_NAME.'.js'));



/**
 * Injects theme js components in footer
 * @return null
 */

function acl_client_footer_js__component()
{
    echo '<script src="' . module_dir_url('acl', 'assets/js/acl.js') . '"></script>';
    //echo '<script src="' . module_dir_url('acl', 'assets/js/clients.js') . '"></script>';
}

//add css and js to clientside
hooks()->add_action('acl_customers_head', 'include_acl_customers_head');
//hooks()->add_action('acl_customers_footer', 'include_acl_customers_footer');


/**
 * Theme clients footer includes
 * @return stylesheet
 */
function include_acl_customers_head()
{
    echo '<link href="' . module_dir_url('acl', 'assets/css/acl.css') . '"  rel="stylesheet" type="text/css" >';
}