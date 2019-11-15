<?php

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
	
	public static function register_action_c($action_id, $callback, $class) {
		return Registry::register_action($action_id, $class . '::' . $callback);
	}
	
	//No return value
	public static function unregister_action($action_id) {
		if(Registry::is_registered($action_id)) {
			unset(Registry::$action_list[$action_id]);
		}
	}
	
	public static function do_action($action_id, $params) {
		if(Registry::is_registered($action_id)) {
			$cb = strtok(Registry::$action_list[$action_id], "::");
			
			$has_class = false;
			$class = 0;
			if(isset($cb[0]) && isset($db[1])) {
				$has_class = true;
				if(class_exists($cb[0])) {
					$class = get_class($cb[0]); 
				} else {
					$class = $this;
				}
			}
			
	        	$callback = Registry::$action_list[$action_id];
	        	echo("cbFunct: " . $callback . "<br/>");
	        	if(!$has_class) {
	        		//return $callback($params);
	        		return call_user_func(Registry::$action_list[$action_id], $params);
	        	} else {
	        		//return $class->$callback($params);
	        		call_user_func($class . "::" . $action_id, $params);	
	        	}
		} else {
			echo("Not registered: " . $action_id . "<br/>");
		}
	}
}
?>
