<?php
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );
html_page_top1( lang_get( 'plugin_format_title' ) );
html_page_top2();
print_manage_menu();
?>
<br/>
<form action="<?php echo plugin_page( 'config_edit' ) ?>" method="post">
<table align="center" class="width50" cellspacing="1">

<tr>
<td class="form-title" colspan="3">
<?php echo lang_get( 'plugin_tasks_title' ) . ': ' . lang_get( 'plugin_tasks_config' ) ?>
</td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
<td class="category">
<?php echo lang_get( 'tasks_admin_threshold' ) ?>
</td>
<td class="center">
<select name="tasks_admin_threshold">
<?php print_enum_string_option_list( 'access_levels', plugin_config_get( 'tasks_admin_threshold'  ) ) ?>;
</select> 
</td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
<td class="category">
<?php echo lang_get( 'tasks_add_threshold' ) ?>
</td>
<td class="center">
<select name="tasks_add_threshold">
<?php print_enum_string_option_list( 'access_levels', plugin_config_get( 'tasks_add_threshold'  ) ) ?>;
</select> 
</td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
<td class="category">
<?php echo lang_get( 'tasks_allocate_threshold' ) ?>
</td>
<td class="center">
<select name="tasks_allocate_threshold">
<?php print_enum_string_option_list( 'access_levels', plugin_config_get( 'tasks_allocate_threshold'  ) ) ?>;
</select> 
</td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
<td class="category">
<?php echo lang_get( 'tasks_view_threshold' ) ?>
</td>
<td class="center">
<select name="tasks_view_threshold">
<?php print_enum_string_option_list( 'access_levels', plugin_config_get( 'tasks_view_threshold'  ) ) ?>;
</select> 
</td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
<td class="category">
<?php echo lang_get( 'tasks_update_threshold' ) ?>
</td>
<td class="center">
<select name="tasks_update_threshold">
<?php print_enum_string_option_list( 'access_levels', plugin_config_get( 'tasks_update_threshold'  ) ) ?>;
</select> 
</td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
<td class="category">
<?php echo lang_get( 'tasks_delete_threshold' ) ?>
</td>
<td class="center">
<select name="tasks_delete_threshold">
<?php print_enum_string_option_list( 'access_levels', plugin_config_get( 'tasks_delete_threshold'  ) ) ?>;
</select> 
</td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
<td class="category">
<?php echo lang_get( 'tasks_finish_threshold' ) ?>
</td>
<td class="center">
<select name="tasks_finish_threshold">
<?php print_enum_string_option_list( 'access_levels', plugin_config_get( 'tasks_finish_threshold'  ) ) ?>;
</select> 
</td>
</tr>

<tr <?php echo helper_alternate_class( )?>>
<td class="category" width="60%">
<?php echo lang_get( 'tasks_mail' )?>
</td>
<td class="center" width="20%">
<label><input type="radio" name='tasks_mail' value="1" <?php echo( ON == plugin_config_get( 'tasks_mail' ) ) ? 'checked="checked" ' : ''?>/>
<?php echo lang_get( 'tasks_enabled' )?></label>
</td>
<td class="center" width="20%">
<label><input type="radio" name='tasks_mail' value="0" <?php echo( OFF == plugin_config_get( 'tasks_mail' ) )? 'checked="checked" ' : ''?>/>
<?php echo lang_get( 'tasks_disabled' )?></label>
</td>
</tr> 

<tr <?php echo helper_alternate_class( )?>>
<td class="category" width="60%">
<?php echo lang_get( 'tasks_mail_finish' )?>
</td>
<td class="center" width="20%">
<label><input type="radio" name='tasks_mail_finish' value="1" <?php echo( ON == plugin_config_get( 'tasks_mail_finish' ) ) ? 'checked="checked" ' : ''?>/>
<?php echo lang_get( 'tasks_enabled' )?></label>
</td>
<td class="center" width="20%">
<label><input type="radio" name='tasks_mail_finish' value="0" <?php echo( OFF == plugin_config_get( 'tasks_mail_finish' ) )? 'checked="checked" ' : ''?>/>
<?php echo lang_get( 'tasks_disabled' )?></label>
</td>
</tr> 


<tr <?php echo helper_alternate_class( )?>>
<td class="category" width="60%">
<?php echo lang_get( 'tasks_history' )?>
</td>
<td class="center" width="20%">
<label><input type="radio" name='tasks_history' value="1" <?php echo( ON == plugin_config_get( 'tasks_history' ) ) ? 'checked="checked" ' : ''?>/>
<?php echo lang_get( 'tasks_enabled' )?></label>
</td>
<td class="center" width="20%">
<label><input type="radio" name='tasks_history' value="0" <?php echo( OFF == plugin_config_get( 'tasks_history' ) )? 'checked="checked" ' : ''?>/>
<?php echo lang_get( 'tasks_disabled' )?></label>
</td>
</tr> 

<tr <?php echo helper_alternate_class( )?>>
<td class="category" width="60%">
<?php echo lang_get( 'tasks_show_menu' )?>
</td>
<td class="center" width="20%">
<label><input type="radio" name='tasks_show_menu' value="1" <?php echo( ON == plugin_config_get( 'tasks_show_menu' ) ) ? 'checked="checked" ' : ''?>/>
<?php echo lang_get( 'tasks_enabled' )?></label>
</td>
<td class="center" width="20%">
<label><input type="radio" name='tasks_show_menu' value="0" <?php echo( OFF == plugin_config_get( 'tasks_show_menu' ) )? 'checked="checked" ' : ''?>/>
<?php echo lang_get( 'tasks_disabled' )?></label>
</td>
</tr> 

<tr>
<td class="center" colspan="3">
<input type="submit" class="button" value="<?php echo lang_get( 'change_configuration' ) ?>" />
</td>
</tr>

</table>
<form>
<?php
html_page_bottom1( __FILE__ );