<?php
########################################################
# Mantis Bugtracker Plugin Tasks
#
# By Cas Nuy  www.nuy.info 2010
# To be used with Mantis 1.20 and above
#
########################################################
$user 			= auth_get_current_user_id();
$bug_id			= gpc_get_int( 'id' );
# what is the table for tasks
$tasks_table	= plugin_table('defined');


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
echo lang_get( 'tasks' ); 
?>
</div>
</td>
</tr>
<tr class="row-category">
<td><div align="center"><?php echo lang_get( 'task_title' ); ?>/<?php echo lang_get( 'task_due' ); ?></div></td>
<td><div align="center"><?php echo lang_get( 'task_handler' ); ?></div></td>
<td><div align="center"><?php echo lang_get( 'task_desc' ); ?></div></td>
<td><div align="center"><?php echo lang_get( 'task_response' ); ?></div></td> 
<td><div align="center"><?php echo lang_get( 'task_completed' ); ?></div></td> 
<td><div align="center"><?php echo lang_get( 'task_actions' ); ?></div></td>
<td>&nbsp;</td>
</tr>
<?php
if ( access_has_bug_level(plugin_config_get( 'tasks_add_threshold' ), $bug_id ) ) { 
?>
	<form name="taskadding" method="post" action="plugins/Tasks/pages/task_action_add.php">
	<input type="hidden" name="bug_id" value="<?php echo $bug_id;  ?>">
	<input type="hidden" name="id" value="<?php echo $bug_id;  ?>">
	<input type="hidden" name="user" value="<?php echo $user;  ?>">
	<input type="hidden" name="tasks_table" value="<?php echo $tasks_table;  ?>">

    <tr <?php echo helper_alternate_class() ?>>

    <td nowrap><div align="left">
    <input name="task_title" type="text" size=26 maxlength=50 >
    <br><br>
	<?php 
    $current_date = explode ("-", date("Y-m-d"));
	?>
    <select tabindex="1" name="day">
    <?php print_day_option_list( $current_date[2] ) ?>
    </select>
    <select tabindex="2" name="month">
    <?php print_month_option_list( $current_date[1] ) ?>
    </select>
    <select tabindex="3" name="year">
    <?php print_year_option_list( $current_date[0] ) ?>
    </select>
    </div>
    </td>

	<td>
	<?php
	echo '<select name="task_handler">';
	print_assign_to_option_list( $handler, $project_id ,plugin_config_get( 'tasks_allocate_threshold' ));
	echo '</select>';
	?>
	</td>

    <td><div align="left">
    <textarea name="task_desc" rows="5" cols="30"></textarea>
    </div>

	<td></td>	<td></td>
	
	<td><input name="<?php echo lang_get( 'task_submit' ) ?>" type="submit" value="<?php echo lang_get( 'task_submit' ) ?>">
	</td>
	<td>	</td>
	</tr>
	</form>
<?php
} 
if ( access_has_bug_level( plugin_config_get( 'tasks_view_threshold' ), $bug_id ) ) {
	# Pull all Tasks-Record entries for the current Bug
	$query = "SELECT * FROM $tasks_table WHERE bug_id = $bug_id ORDER BY task_due DESC";
	$result = db_query_bound($query);
	while ($row = db_fetch_array($result)) {
		?>
		<tr <?php echo helper_alternate_class() ?>>
		<td><div align="center"><?php  echo html_entity_decode($row["task_title"]); ?>
		<br>
		<?php  echo date("d.m.Y", strtotime($row["task_due"])); ?></div></td>
		<td><?php echo user_get_name($row["task_handler"]); ?></td>
		<td><div align="left">
	    <textarea style="background-color: #eaeaea" name="task_desc" rows="5" cols="30"readonly="readonly"><?php  echo html_entity_decode($row["task_desc"]); ?>  </textarea>
		</div></td>
		<td><div align="center">
	    <textarea  name="task_response" rows="5" cols="30"readonly="readonly"><?php  echo html_entity_decode($row["task_response"]); ?>  </textarea>
		</div></td>
		<td><div align="center"><?php 
		if ( $row['task_completed'] <> "0000-00-00 00:00:00"){
			echo date("d.m.Y", strtotime($row["task_completed"])); 
		}
		?> </div></td>
		<td><div>
		<?php
		if ( $row['task_completed'] === "0000-00-00 00:00:00"){
			if ( access_has_bug_level( plugin_config_get( 'tasks_update_threshold' ), $bug_id ) OR ($row["task_handler"] == $user)) {
				?>
				<a href="javascript: void(0)" onclick="window.open('plugins/Tasks/pages/task_action_update.php?update_id=<?php echo $row["task_id"]; ?>&table=<?php echo $tasks_table; ?>&response=<?php echo $row['task_response']; ?>&id=<?php echo $bug_id;?>', 'TaskUpdate', 'width=800, height=600'); return false;"><?php echo lang_get( 'task_update' ) ?></a><br>
				<?php
			} 
			if ( access_has_bug_level( plugin_config_get( 'tasks_finish_threshold' ), $bug_id ) OR ($row["task_handler"] == $user)) {?>
				<a href="plugins/Tasks/pages/task_action_finish.php?finish_id=<?php echo $row["task_id"]; ?>&table=<?php echo $tasks_table; ?>&id=<?php echo $bug_id;?>"><?php echo lang_get( 'task_finish' ) ?></a><br>
				<?php
			} 
		}
		if ( access_has_bug_level( plugin_config_get( 'tasks_delete_threshold' ), $bug_id ) OR ($row["task_handler"] == $user) ) {?>
			<a href="plugins/Tasks/pages/task_action_delete.php?delete_id=<?php echo $row["task_id"]; ?>&table=<?php echo $tasks_table; ?>&id=<?php echo $bug_id;?>"><?php echo lang_get( 'task_delete' ) ?></a>
			<?php
		} 
		?>
		</div></td>
		<td></td>
		</tr>
		<?php
	}	 
}
?>
</table>
</td>
</tr>