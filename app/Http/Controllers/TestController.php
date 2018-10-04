<?php

// namespace
namespace App\Http\Controllers;

// class
class TestController {
	// Constructor
	public function __construct($View = array()) {
			// properties
			foreach($View as $v => $val) {
				public $this->$v = $val;
			}
	}
