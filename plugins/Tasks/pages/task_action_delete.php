<?PHP
$reqVar = '_' . $_SERVER['REQUEST_METHOD'];
$form_vars = $$reqVar;
$delete_id = $form_vars['delete_id'] ;
$tasks_table = $form_vars['table'] ;
$bug_id		= $form_vars['id'] ;
require_once( '../../../core.php' );
# should event be logged in the project
$create_his		= config_get( 'plugin_Tasks_tasks_history' );
// get current values
$query = "SELECT * FROM $tasks_table WHERE task_id = $delete_id ";
$result = db_query_bound($query);
$row = db_fetch_array( $result );
# Deleting task
$query = "DELETE FROM $tasks_table WHERE task_id = $delete_id";        
db_query_bound($query);
if ( ON == $create_his ) {
	history_log_event_direct( $bug_id, 'Task',$row['task_title'], "Deleted", $user );
}
print_header_redirect( 'view.php?id='.$bug_id.'' );