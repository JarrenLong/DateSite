<?php

require("_internal.php");
require("lt-config.php");
include("lt-structs.php");

class Database extends Widget {
	//Widget's registered name
	const name = "Database";
	//Callback Action ID# constants
	const action_select = 0;
	const action_insert = 1;
	const action_update = 2;
	const action_delete = 3;
	const action_query = 4;
	const action_install = 5;
	const action_uninstall = 6;
	
	public function __construct() {
		$acl = new Permission("Pm.Database", 10);
	}
	
	public function register() {
		Registry::register_action_c(Database::action_select, 'select', Database::name);
		Registry::register_action_c(Database::action_insert, 'insert', Database::name);
		Registry::register_action_c(Database::action_update, 'update', Database::name);
		Registry::register_action_c(Database::action_delete, 'delete', Database::name);
		Registry::register_action_c(Database::action_query, 'query', Database::name);
		Registry::register_action_c(Database::action_install, 'install', Database::name);
		Registry::register_action_c(Database::action_uninstall, 'uninstall', Database::name);
	}
	
	public function unregister() {
		Registry::unregister_action(Database::action_select);
		Registry::unregister_action(Database::action_insert);
		Registry::unregister_action(Database::action_update);
		Registry::unregister_action(Database::action_delete);
		Registry::unregister_action(Database::action_query);
		Registry::unregister_action(Database::action_install);
		Registry::unregister_action(Database::action_uninstall);
	}
	
	private static function clean($params) {
		
	}
	
	public static function select($params) {		
		Database::clean($params);
		
		$db = internal_db::getInstance();
		if(isset($db)) {
			$query = sprintf("SELECT * FROM %s",mysql_real_escape_string($params));
			$ret = $db->query($query);
			if (!$ret) {
	    		$message  = 'Invalid query: ' . mysql_error() . "<br/>";
    			$message .= 'Whole query: ' . $query . "<br/>";
    			echo($message);
			}
		}
		
		unset($db);
	}
	
	public static function insert($params) {
		Database::clean($params);
		
		$db = internal_db::getInstance();
		if(isset($db)) {
			$query = sprintf("INSERT INTO %s (%s) VALUES ('%s')",
				mysql_real_escape_string($params[0]),
				mysql_real_escape_string($params[1]),
				mysql_real_escape_string($params[2])
				);
			$ret = $db->query($query);
			if (!$ret) {
	    		$message  = 'Invalid query: ' . mysql_error() . "<br/>";
    			$message .= 'Whole query: ' . $query . "<br/>";
    			echo($message);
			}
		}
		
		unset($db);
	}
	
	public static function update($params) {}
	public static function delete($params) {}
	
	public static function query($params) {
		Database::clean($params);
		
		$db = internal_db::getInstance();
		if(isset($db)) {
			$ret = $db->query($params);
			if (!$ret) {
	    		$message  = 'Invalid query: ' . mysql_error() . "<br/>";
    			$message .= 'Whole query: ' . $params . "<br/>";
    			echo($message);
			}
		}
		
		unset($db);
	}
	
	public static function install($params) {
		//Takes no parameters
			$db = internal_db::getInstance();
	
	//Check to see if we've already installed using these settings
	if($db->is_available) {
		//Start adding tables
		$sql = sprintf("CREATE TABLE %s.%s (" . 
			"uid INT NOT NULL AUTO_INCREMENT PRIMARY KEY," .
			"user VARCHAR(255) NOT NULL" .
			")",
			mysql_real_escape_string(LT_DB_NAME),
			mysql_real_escape_string(LT_DB_TABLE_USER));
		Registry::do_action(Database::action_query, $sql);
	
		//Insert a new record
		Registry::do_action(Database::action_insert,
			array(LT_DB_TABLE_USER, 'user', 'test')
		);
		
		//And fetch it
		Registry::do_action(Database::action_select, LT_DB_TABLE_USER);
	}
	
	unset($db);
	}
	
	public static function uninstall($params) {
		//Takes no parameters
		echo("Uninstalling...<br/>");	
	}
}
