<?php

// namespace
namespace App\Http\Controllers\Repository\DynamicRepository;

// class
class YouRepository {
	public function selectUserFiles($BaseView = null) {
		// Get All Image Files of the User
		$DB = \DB::select('SELECT fid, file FROM files WHERE id = :id', ['id' => $_SESSION['id']]);

		// Image type Holders
		$hold = array(
 		 'jpeg' => array(),
 		 'jpg' => array(),
 		 'png' => array(),
 		 'gif' => array()
 		 );

		// Sort Images
		foreach($DB as $d) {
 			// extract extension
 			$ext = pathinfo($d->file, PATHINFO_EXTENSION);

 			// push to one of the holders
 			if($ext == "jpeg") { $hold['jpeg'][$d->fid] = $d->file; }
 			if($ext == "jpg") { $hold['jpg'][$d->fid] = $d->file; }
			if($ext == "png") { $hold['png'][$d->fid] = $d->file; }
			if($ext == "gif") { $hold['gif'][$d->fid] = $d->file; }
		}

		// Push nonempty Data to View
		foreach($hold as $key => $val) { if(!empty($val)) { $BaseView[$key] = $val; } }

		// return $BaseView data
		return $BaseView;
	}
	public function validateFile($View = array()) {
		// Error Boolean
		$err_bool = 0;

		// Target dir/file/extension
		$target_dir = "uploads/" . $_SESSION['id'];
		$target_file = $target_dir . basename($_FILES['img_up']['name']);
		$target_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		// Check if File is real/fake image
		$check = getimagesize($_FILES['img_up']['tmp_name']);
		if($check === false) { array_push($View, "File is not an image!"); $err_bool = 1; }

		// Check if File already Exists
		if($err_bool == 0) { if(file_exists($target_file) ) { array_push($View, "File already exists!"); $err_bool = 1; } }

		// Check File Size
		if($err_bool == 0) { if($_FILES['img_up']['size'] > 800000) { array_push($View, "File is too large!"); $err_bool = 1; } }

		// Allow only jpeg/jpg/png/gif
		if($err_bool == 0) {
			if($target_extension != "jpeg" && $target_extension != "jpg" && $target_extension != "png" &&  $target_extension != "gif") {
				array_push($View, "Invalid file type!"); $err_bool = 1;
			}
		}

		// return View data
		return $View;
	}
}
