<?php

class Group {
	public static $name;
	private static $acl_list = null; //=array(new Permission(), ...)
} 


class User {
	private static $gid; //=new Group();
	
	public function check_credentials($uid) {
		//Check to see if user has permission to perform an action
	}
}

?>
