<?php
include("./core/lt-database.php");
include("./core/lt-registry.php");
/*
echo("<br/>++Action Registry Test++<br/>");
Registry::register_action(0,"cba");
Registry::register_action(1,"cbb");
Registry::Debug();

Registry::do_action(0, "test 1");
Registry::do_action(1, "test 2");
Registry::do_action(2, null);

Registry::unregister_action(0);
Registry::Debug();
Registry::unregister_action(1);
Registry::Debug();

function cba($params) {
	echo("CBA: " . $params . "<br/>");
}

function cbb($params) {
	echo("CBB: " . $params . "<br/>");
}
echo("<br/>--Action Registry Test--<br/>");

echo("<br/>++Widget Test++<br/>");
include("./widgets/lt-widget.php");

$widget = new TestWidget();
$widget->register();
Registry::Debug();

Registry::do_action(TestWidget::action_test, "Test ABC");
$widget->unregister();

echo("<br/>The following should fail: ");
Registry::do_action(TestWidget::action_test, "Test ABC");
Registry::Debug();

unset($widget);

echo("<br/>--Widget Test--<br/>");

echo("<br/>++Install Test++<br/>");
*/
$db = new Database();
$db->register();

Registry::do_action(Database::action_install, null);
Registry::do_action(Database::action_uninstall, null);

	$user = new Table_User();
	$user->uid = 0;
	$user->user = "test";
	$user->pass = "pass";
	$user->level = 10;
	
	$ret = $user->get_fields_name();
	echo("Fields: " . $ret . "<br/>");
	
	$ret = $user->get_fields_value();
	echo("Values: " . $ret . "<br/>");
	
	unset($user);
	
$db->unregister();
unset($db);

//echo("<br/>--Install Test--<br/>");

?>
