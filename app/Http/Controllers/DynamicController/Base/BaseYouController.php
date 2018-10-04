<?php

// namespace
namespace App\Http\Controllers\DynamicController\Base;

// abstract class
abstract class BaseYouController {
	// Constructor
	public function __construct() {
		$this->base();
	}

	// Build Base
	public function base() {
		// Final View Data
		$BaseView = array();
		$View = array();

		// Get All Image Files of the User
		$DB = \DB::select('SELECT fid, file FROM files WHERE id = :id', ['id' => $_SESSION['id']]);

		// Image type Holders
		$hold = array(
 		 'jpeg' => array(),
 		 'jpg' => array(),
 		 'png' => array(),
 		 'gif' => array()
 		 );

		 echo "<pre>";
		 var_dump($DB);
		 die();

		// Sort Images
		foreach($DB as $d) {
 			// extract extension
 			$ext = pathinfo($d, PATHINFO_EXTENSION);

 			// push to one of the holders
 			if($ext == "jpeg") { array_push($hold['jpeg'], $d); }
 			if($ext == "jpg") { array_push($hold['jpg'], $d); }
			if($ext == "png") { array_push($hold['png'], $d); }
			if($ext == "gif") { array_push($hold['gif'], $d); }
		}

		// Push nonempty Data  to View
		foreach($hold as $h) { if(!empty($h)) { array_push($BaseView, $h); } }
	}
}
