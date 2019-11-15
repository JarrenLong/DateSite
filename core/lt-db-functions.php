<?php

require("lt-config.php");

//Singleton pattern, use: 
//$className = "LT_db";
//eval('$instance = '.$className.'::getInstance();');
//Or just: $handle = LT_db::getInstance(); /* do stuff */ unset($handle);
class LT_db {
  private $link;
  public $is_available;
  private static $instance;
  
  private function __construct() {
  	//Open the database using the supplied credentials
  	$this->link = mysql_connect(LT_DB_HOST,LT_DB_USER,LT_DB_PASS);
	if (!$this->link)
  	{
  		die('Could not connect: ' . mysql_error() . "<br/>");
  	}
  	
  	if(mysql_select_db(LT_DB_NAME, $this->link)) {
  		$this->is_available = true;
  	} else {
  		$this->is_available = false;
  	}
  }
  
  public function __destruct() {
  	//Cleanup on close
  	mysql_close($this->link);
  	$this->is_available = false;
  }
  
  
  public static function getInstance() {
  	    if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
  }

  public function query($query) {
  	if(isset($this->link) && $this->is_available) {
  		if(!mysql_query($query, $this->link)) {
  			//Failure
  			echo('Query failed: ' . mysql_error() . "<br/>");
  		}
  	}
  }

}
