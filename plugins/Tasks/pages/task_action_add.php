<?PHP
require_once( '../../../core.php' );
$user 			= gpc_get_int( 'user' );
$bug_id			= gpc_get_int( 'bug_id' );
# what is the table for tasks
$tasks_table	= gpc_get_string( 'tasks_table' );
# should event be logged in the project
$create_his		= config_get( 'plugin_Tasks_tasks_history' );
# should mail be send to assignee
$create_mail	= config_get( 'plugin_Tasks_tasks_mail' );
# Adding task
$handler	= $_REQUEST['task_handler'];
$title		= htmlentities($_REQUEST['task_title']);
$desc		= htmlentities($_REQUEST['task_desc']);
$year = $_REQUEST["year"];
$month = $_REQUEST["month"];
$day = $_REQUEST["day"];
$bookdate = mktime(0, 0, 0, $month,$day,$year);
$bookdate2  = date("Y", $bookdate);
$bookdate2 .= "-"; 
$bookdate2 .= date("m", $bookdate);
$bookdate2 .= "-"; 
$bookdate2 .= date("d", $bookdate);
$query = "INSERT INTO $tasks_table ( bug_id,task_user, task_handler,task_title,task_desc,task_created,task_due,task_changed )
  		VALUES (  '$bug_id','$user', '$handler', '$title', '$desc',  NOW(), '$bookdate2', NOW())";
if(!db_query_bound($query)){ 
	trigger_error( ERROR_DB_QUERY_FAILED, ERROR );
}
if ( ON == $create_his ) {
	history_log_event_direct( $bug_id, 'Tasks',$title, "Added", $user );
}
# email send to handler of task
if ( ON == $create_mail ) {
	$body  = lang_get( 'tasks_body' ). " \n\n";
	$body .= $title. " \n\n";
	$body .= lang_get( 'tasks_date' ). " \n\n";
	$body .= $bookdate2;
	$result = email_bug_reminder( $handler,$bug_id, $body );
}
print_header_redirect( 'view.php?id='.$bug_id.'' );