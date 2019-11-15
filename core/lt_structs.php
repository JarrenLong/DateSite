<?php

class DB_User {
	public $uid; //Unique ID
	public $user; //username
	public $pass; //MD5 hashed
	public $account_type; //User, mod, admin, etc...
}

class DB_Account {
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
}

class DB_Billing {
	public $uid;
	public $payment_type; //cash|check|credit card
	public $card_number;
	public $card_cvv;
	public $card_amount;
	public $db_billing_account; 
}

class DB_Profile {
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
}

?>