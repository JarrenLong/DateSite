<?php

require_once("lt-interfaces.php");

class Table_User implements Table {
	public $uid; //Unique ID
	public $user; //username
	public $pass; //MD5 hashed
	public $level; //User, mod, admin, etc...
	
	public function get_field_name($index) {
		switch($index) {
			case 0: return "uid";
			case 1: return "user";
			case 2: return "pass";
			case 3: return "level";
		}
	}
	
	public function get_field_value($index) {
		switch($index) {
			case 0: return $uid;
			case 1: return $user;
			case 2: return $pass;
			case 3: return $level;
		}
	}
	
	public function get_fields_name() {
		return "uid, user, pass, level";
	}
	
	public function get_fields_value() {
		return $this->uid . ", " . $this->user . ", " . $this->pass . ", " . $this->level;
	}
}

class Table_Account implements Table {
	public $uid; //Unique ID
	public $email;
	public $f_name;
	public $l_name;
	public $address1;
	public $address2;
	public $city;
	public $state;
	public $country;
	public $zipcode;
	
	//TODO
	public function get_field_name($index){}
	public function get_field_value($index){}
	public function get_fields_name(){}
	public function get_fields_value(){}
}

class Table_Billing implements Table {
	public $uid;
	public $payment_type; //cash|check|credit card
	public $card_number;
	public $card_cvv;
	public $card_amount;
	public $db_billing_account;
	
//TODO
	public function get_field_name($index){}
	public function get_field_value($index){}
	public function get_fields_name(){}
	public function get_fields_value(){}
}

class Table_Profile implements Table {
	public $uid;
public $birthday;
public $gender;
public $height;
public $weight;
public $body_type;
public $ethnicity;
public $religion;
public $sign; //(Aries, Taurus, etc.)
public $smokes;
public $drinks;
public $drugs;
public $education;
public $job;
public $income;
public $children;
public $pets;
public $speaks;
public $status; //(Single, etc.)
public $orientation; //(Straight, gay, etc.)

//TODO
	public function get_field_name($index){}
	public function get_field_value($index){}
	public function get_fields_name(){}
	public function get_fields_value(){}
}

?>