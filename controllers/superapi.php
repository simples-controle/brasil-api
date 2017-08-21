<?php
namespace app\controllers;
use stdClass;

class superapi extends stdClass 
{
	public function __construct() {
		$api = array();
		$api['version'] = 'beta';
		$api['rand'] = md5(rand(1,999999999));
		$this->api = $api;
	}	
}