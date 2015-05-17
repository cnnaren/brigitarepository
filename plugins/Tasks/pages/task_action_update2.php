<?PHP
require_once( '../../../core.php' );
$update_id			= gpc_get_int( 'update_id' );
$tasks_table	= gpc_get_string( 'tasks_table' );
$response		= htmlentities($_REQUEST['task_response']);
# should event be logged in the project
$create_his		= config_get( 'plugin_Tasks_tasks_history' );
# Updating task
// get current values
$query = "SELECT * FROM $tasks_table WHERE task_id = $update_id ";
$result = db_query_bound($query);
$row = db_fetch_array( $result );
// perform update
$query = "UPDATE $tasks_table set task_changed=NOW(),task_response='$response' WHERE task_id = $update_id";        
if(!db_query_bound($query)){ 
	trigger_error( ERROR_DB_QUERY_FAILED, ERROR );
}		
if ( ON == $create_his ) {
	history_log_event_direct( $bug_id, 'Tasks-Response', $row['task_response'], $response, $user );
}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--hide
window.close();
if (window.opener && !window.opener.closed) {
window.opener.location.reload();
} 
//-->
</SCRIPT>