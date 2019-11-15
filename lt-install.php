<?php
include("./core/lt-db-functions.php");

function install() {
$db = LT_db::getInstance();
//Check to see if we've already installed using these settings
if(!$db->is_available) {
	//Create the database
$sql = 'CREATE DATABASE ' . LT_DB_NAME;
$db->query($sql);

//Start adding tables
$sql = 'CREATE TABLE `' . LT_DB_NAME . '`.`' .
	LT_DB_TABLE_USER . '` (`uid` INT NOT NULL ' . 
	'AUTO_INCREMENT PRIMARY KEY) ENGINE = InnoDB;';
$db->query($sql);
} else {
	echo("Already installed!<br/>");
}

unset($db);
}

class Registry {
	const SELECT = 256;
	const INSERT = 512;
	const UPDATE = 768;
	const DELETE = 1024;
	
	private static $action_list = null;
	
	public static function Debug() {
		echo("<pre>");
		print_r(Registry::$action_list);
		echo("</pre>");
	}
	
	public static function is_registered($action_id) {
		return isset(Registry::$action_list[$action_id]);
	}
	
	public static function register_action($action_id, $callback) {
		if(Registry::$action_list == null) {
			Registry::$action_list = array();
		}
		
		if(!Registry::is_registered($action_id)) {
			Registry::$action_list[$action_id] = $callback;
			return true;
		}
		
		return false;
	}
	
	//No return value
	public static function unregister_action($action_id) {
		if(Registry::is_registered($action_id)) {
			unset(Registry::$action_list[$action_id]);
		}
	}
	
	public static function do_action($action_id, $params) {
		if(Registry::is_registered($action_id)) {
			if(function_exists(Registry::$action_list[$action_id])) {
	        	$callback = Registry::$action_list[$action_id];
	        	return $callback($params);
    		} else {
	        	echo("Error executing action: " . $action_id . "<br/>");
    		}
		} else {
			echo("Not registered: " . $action_id . "<br/>");
		}
	}

	private static function select($action_id, $params) {
		if($action_id == 0) {
			echo("Action ID: 0<br/>");
		} else {
			echo('Action ID: ' . $action_id . "<br/>");
		}
	}
	
	private static function insert($action_id, $params) {}
	private static function update($action_id, $params) {}
	private static function delete($action_id, $params) {}
	
}
?>
