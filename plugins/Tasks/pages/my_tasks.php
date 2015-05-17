<?php	
########################################################
# Mantis Bugtracker Plugin Tasks
#
# By Cas Nuy  www.nuy.info 2010
# To be used with Mantis 1.20 and above
#
########################################################
$user 			= auth_get_current_user_id();
# what is the table for tasks
$tasks_table	= plugin_table('defined');
html_page_top1(  );
html_page_top2();
?>
<tr>
<td class="center" colspan="6">
<br>
<?php 
$colspan=6;
?>
<table class="width100" cellspacing="1">
<tr>
<td colspan="<?php echo $colspan ?>" class="row-category"><div align="left"><a name="taskrecord"></a>
<?php 
echo lang_get( 'mytasks' ); 
?>
</div>
</td>
</tr>
<tr class="row-category">
<td><div align="center"><?php echo lang_get( 'task_title' ); ?>/<?php echo lang_get( 'task_due' ); ?></div></td>
<td><div align="center"><?php echo lang_get( 'task_handler' ); ?></div></td>
<td><div align="center"><?php echo lang_get( 'task_desc' ); ?></div></td>
<td><div align="center"><?php echo lang_get( 'task_response' ); ?></div></td> 
<td><div align="center"><?php echo lang_get( 'task_actions' ); ?></div></td>
</tr>
<?php
# Pull all Tasks-Record entries for the current user
$query = "SELECT * FROM $tasks_table WHERE task_handler = $user and task_completed = '0000-00-00 00:00:00' ORDER BY task_due DESC";
$result = db_query_bound($query);
while ($row = db_fetch_array($result)) {
	?>
	<tr <?php echo helper_alternate_class() ?>>
	<td><div align="center"><?php  echo html_entity_decode($row["task_title"]); ?>
	<br>
	<?php  echo date("d.m.Y", strtotime($row["task_due"])); ?></div></td>
	<td><?php echo user_get_name($row["task_handler"]); ?></td>
	<td><div align="left">
    <textarea style="background-color: #eaeaea" name="task_desc" rows="2" cols="30"readonly="readonly"><?php  echo html_entity_decode($row["task_desc"]); ?>  </textarea>
	</div></td>
	<td><div align="center">
    <textarea style="background-color: #eaeaea" name="task_response" rows="2" cols="30"readonly="readonly"><?php  echo html_entity_decode($row["task_response"]); ?>  </textarea>
	</div></td>
	<td><div align="center">
	<a href="view.php?id=<?php echo $row['bug_id'];?>"><?php echo lang_get( 'issue_task' ) ?></a><br>
	</div></td>
	</tr>
	<?php
}	 
?>
</table>
</td>
</tr>
<?php
html_page_bottom1( __FILE__ );