<?PHP
$reqVar		= '_' . $_SERVER['REQUEST_METHOD'];
$form_vars	= $$reqVar;
$update_id	= $form_vars['update_id'] ;
$tasks_table= $form_vars['table'] ;
$response	= $form_vars['response'] ;
require_once( '../../../core.php' );
$basepad=config_get('path');
?>
<form name="taskupdating" method="post" action="<?php echo $basepad;?>plugins/Tasks/pages/task_action_update2.php">
<center>Please maintain you comments on the given task here</center>
<input type="hidden" name="update_id" value="<?php echo $update_id;  ?>">
<input type="hidden" name="tasks_table" value="<?php echo $tasks_table;  ?>">
<td><div align="center">
<textarea name="task_response" rows="3" cols="50"><?php echo $response;  ?></textarea>
</div>
</td>
<center>
<td><input name="Update" type="submit" value="Update"></td>
<td><input type="button" value="Cancel" onclick="self.close()"></td
</tr>
</form>
