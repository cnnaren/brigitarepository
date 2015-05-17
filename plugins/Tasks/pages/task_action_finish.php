<?PHP
$reqVar = '_' . $_SERVER['REQUEST_METHOD'];
$form_vars = $$reqVar;
$finish_id = $form_vars['finish_id'] ;
$tasks_table = $form_vars['table'] ;
$bug_id		= $form_vars['id'] ;
require_once( '../../../core.php' );
# should event be logged in the project
$create_his		= config_get( 'plugin_Tasks_tasks_history' );
# Updating task
// get current values
$query = "SELECT * FROM $tasks_table WHERE task_id = $finish_id ";
$result = db_query_bound($query);
$row = db_fetch_array( $result );
$bugid = $row['bug_id'];

// perform update
$query = "UPDATE $tasks_table set task_changed=NOW(),task_completed=NOW() WHERE task_id = $finish_id";        
if(!db_query_bound($query)){ 
	trigger_error( ERROR_DB_QUERY_FAILED, ERROR );
}

# email send to handler of task
# should mail be send to assignee
$create_mail_finish	= config_get( 'plugin_Tasks_tasks_mail_finish' );
if ( ON == $create_mail_finish ) {
	// get handler from original issue
	$t_bug_table	= db_get_table( 'mantis_bug_table' );
	$sql = "select handler_id from $t_bug_table where id=$bugid";
	$result2 = db_query_bound($sql);
	$row2 = db_fetch_array( $result2 );
	$body  = lang_get( 'tasks_body_finish' ). " \n\n";
	$body .= $row['task_title']. " \n\n";
	$handler = $row2['handler_id'];
	$result = email_bug_reminder( $handler,$bugid, $body );
}	



if ( ON == $create_his ) {
	history_log_event_direct( $bug_id, 'Tasks', $row['task_title'], 'Finished', $user );
}


print_header_redirect( 'view.php?id='.$bug_id.'' );