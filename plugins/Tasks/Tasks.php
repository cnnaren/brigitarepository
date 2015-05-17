<?php
class TasksPlugin extends MantisPlugin {
 
	function register() {
		$this->name        = 'Tasks';
		$this->description = lang_get( 'tasks_plugin_desc' );
		$this->version     = '1.10';
		$this->requires    = array('MantisCore'       => '1.2.0',);
		$this->author      = 'Cas Nuy';
		$this->contact     = 'Cas-at-nuy.info';
		$this->url         = 'http://www.nuy.info';
		$this->page			= 'config';
	}
 
	function config() {
		return array(
			'tasks_delete_threshold'	=> DEVELOPER,
			'tasks_finish_threshold'	=> DEVELOPER,
			'tasks_update_threshold'	=> DEVELOPER,
			'tasks_add_threshold'		=> DEVELOPER,
			'tasks_allocate_threshold'	=> DEVELOPER,
			'tasks_view_threshold'		=> VIEWER,
			'tasks_admin_threshold'		=> ADMINISTRATOR,
			'tasks_mail'				=> OFF,
			'tasks_history'				=> OFF,
			'tasks_mail_finish'			=> OFF,
			'tasks_show_menu'			=> ON,
			);
	}

	function init() { 
	
	}
	function hooks() { 
		event_declare('EVENT_MYVIEW');
		event_declare('EVENT_VIEW_BUG_DETAILS2');
		// plugin_event_hook( 'EVENT_VIEW_BUG_EXTRA', 'tasks_form1' );
		plugin_event_hook( 'EVENT_VIEW_BUG_DETAILS2', 'tasks_form1' );
	//	$showmenu =  config_get( 'tasks_show_menu' );
	//	if (ON == $showmenu){
		//	plugin_event_hook( 'EVENT_MENU_MAIN', 'tasks_menu1' );
//		} else {
			plugin_event_hook( 'EVENT_MYVIEW', 'tasks_view' );
	//	}
	}
 	function tasks_form1() {
		 include 'plugins/Tasks/pages/tasks_form.php';
	}

 	function tasks_menu1() {
 		 return array('<a href="'. plugin_page( 'my_tasks.php' ) . '">' . lang_get( 'plugin_tasks_mytasks' ) . '</a>' );
	}

 	function tasks_view() {
 		 include 'plugins/Tasks/pages/myview_tasks.php';
	}

/*
CREATE TABLE IF NOT EXISTS `mantis_plugin_tasks_defined_table` (
  `task_id` int(11) NOT NULL auto_increment,
  `bug_id` int(11) default NULL,
  `task_user` int(11) default NULL,
  `task_handler` int(11) default NULL,
  `task_title` varchar(50) default NULL,
  `task_desc` varchar(250) default NULL,
  `task_response` varchar(250) default NULL,
  `task_created` datetime default NULL,
  `task_changed` datetime default NULL,
  `task_due` datetime default '0000-00-00 00:00:00',
  `task_completed` datetime default '0000-00-00 00:00:00',
  PRIMARY KEY  (`task_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8  ;
*/	
	function schema() {
		return array(
			array( 'CreateTableSQL', array( plugin_table( 'defined' ), "
				task_id			I		NOTNULL UNSIGNED AUTOINCREMENT PRIMARY,
				bug_id			I		NOTNULL UNSIGNED,
				task_user		I		NOTNULL UNSIGNED,
				task_handler	I		NOTNULL UNSIGNED,
				task_title		C(50)	DEFAULT NULL,
				task_desc		C(250)	DEFAULT NULL,
				task_response	C(250)	DEFAULT NULL,
				task_created	T		NOTNULL,
				task_changed	T		NOTNULL,
				task_due		T		NOTNULL,
				task_completed	T		NOTNULL
				" ) ),
		);
	} 	
}