<?php
// authenticate
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );
// Read results
$f_tasks_admin_threshold = gpc_get_int( 'tasks_admin_threshold', ADMINISTRATOR );
$f_tasks_add_threshold = gpc_get_int( 'tasks_add_threshold', DEVELOPER );
$f_tasks_allocate_threshold = gpc_get_int( 'tasks_allocate_threshold', DEVELOPER );
$f_tasks_view_threshold = gpc_get_int( 'tasks_view_threshold', VIEWER );
$f_tasks_delete_threshold = gpc_get_int( 'tasks_delete_threshold', DEVELOPER );
$f_tasks_update_threshold = gpc_get_int( 'tasks_update_threshold', DEVELOPER );
$f_tasks_finish_threshold = gpc_get_int( 'tasks_finish_threshold', DEVELOPER );
$f_tasks_mail = gpc_get_int( 'tasks_mail', OFF );
$f_tasks_mail_finish = gpc_get_int( 'tasks_mail_finish', OFF );
$f_tasks_history = gpc_get_int( 'tasks_history', OFF );
$f_tasks_show_menu = gpc_get_int( 'tasks_show_menu', ON );
// update results
plugin_config_set( 'tasks_admin_threshold', $f_tasks_admin_threshold );
plugin_config_set( 'tasks_add_threshold', $f_tasks_add_threshold );
plugin_config_set( 'tasks_allocate_threshold', $f_tasks_allocate_threshold );
plugin_config_set( 'tasks_view_threshold', $f_tasks_view_threshold );
plugin_config_set( 'tasks_delete_threshold', $f_tasks_delete_threshold );
plugin_config_set( 'tasks_update_threshold', $f_tasks_update_threshold );
plugin_config_set( 'tasks_finish_threshold', $f_tasks_finish_threshold );
plugin_config_set( 'tasks_history', $f_tasks_history );
plugin_config_set( 'tasks_mail', $f_tasks_mail );
plugin_config_set( 'tasks_mail_finish', $f_tasks_mail_finish );
plugin_config_set( 'tasks_show_menu', $f_tasks_show_menu );
// redirect
print_successful_redirect( plugin_page( 'config',TRUE ) );