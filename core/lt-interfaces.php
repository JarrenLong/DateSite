<?php

class Permission {
	public $name;
	public $level;
	
	public function __construct($name, $val) {
		$this->name = $name;
		$this->level = $val;
	}
	
	public function equals($perm) {
		if($this->name == $perm->name &&
			$this->level == $perm->level) {
			return true;
		}
		
		return false;
	}
	
	public function compare_to($perm) {
		if(equals($perm)) {
			$ret = 0;
		} else if($this->level > $perm->level) {
			$ret = 1;
		} else {
			$ret = -1;
		}
		
		return $ret;
	}
};

abstract class Widget {
	public static $acl; //=new Permission
	public abstract function register();
	public abstract function unregister();
}

interface Table {
	public function get_field_name($index);
	public function get_field_value($index);
	public function get_fields_name();
	public function get_fields_value();
}

?>
