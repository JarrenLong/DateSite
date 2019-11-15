<?php

$cur_dir = getcwd();
chdir(realpath(dirname(__FILE__).'/../core/'));
require_once("lt-interfaces.php");
chdir($cur_dir);

/** Usage:
//Keep registered until you're done with it
$widget = new TestWidget();
$widget->register();

//Call widget function
Registry::do_action(TestWidget::action_test,$someParam);

//We're done, cleanup
$widget->unregister();
$unset($widget);
*/
class TestWidget implements Widget {
	//Widget's registered name
	const name = "TestWidget";
	//Callback Action ID# constants
	const action_test = 0;
	
	public static function register() {
		Registry::register_action_c(TestWidget::action_test, 'test', TestWidget::name);
	}
	
	public static function unregister() {
		Registry::unregister_action(TestWidget::action_test);
	}
	
	public static function test($params) {
		echo("action_test called! Params: <br/>");
		if($params != null && isset($params)) {
			print_r($params);
		} else {
			echo("(null)<br/>");
		}
	}
}

?>
