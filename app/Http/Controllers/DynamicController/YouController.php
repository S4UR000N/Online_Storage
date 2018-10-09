<?php

// namespace
namespace App\Http\Controllers\DynamicController;

// class
class YouController {
	public function get() {
		// Final View Data
		$BaseView = array();


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

		// Push nonempty Data  to View
		foreach($hold as $key => $val) { if(!empty($val)) { $BaseView[$key] = $val; } }


		// Return View
		return view('DynamicView/you', compact('BaseView'));
	}
	public function post() {
		// Final View Data
		$BaseView = array();
		$View = array();

		/* Branch Upload & Delete */
		// Delete Branch
		if(isset($_POST['fid'])) {
			// Delete File
			$DBdelete = \DB::table('files')->where("fid", $_POST['fid'])->delete();
			$unlink = unlink($_POST['file']);

			// Get All Image Files of the User
			$DBselect = \DB::select('SELECT fid, file FROM files WHERE id = :id', ['id' => $_SESSION['id']]);

			// Image type Holders
			$hold = array(
	 		 'jpeg' => array(),
	 		 'jpg' => array(),
	 		 'png' => array(),
	 		 'gif' => array()
	 		 );

			// Sort Images
			foreach($DBselect as $d) {
	 			// extract extension
	 			$ext = pathinfo($d->file, PATHINFO_EXTENSION);

	 			// push to one of the holders
	 			if($ext == "jpeg") { $hold['jpeg'][$d->fid] = $d->file; }
	 			if($ext == "jpg") { $hold['jpg'][$d->fid] = $d->file; }
				if($ext == "png") { $hold['png'][$d->fid] = $d->file; }
				if($ext == "gif") { $hold['gif'][$d->fid] = $d->file; }
			}

			// Push nonempty Data  to View
			foreach($hold as $key => $val) { if(!empty($val)) { $BaseView[$key] = $val; } }

			// Return Proper View
			if($DBdelete == 1 && $unlink == true) {
				return view('DynamicView/you', compact('BaseView'))->with('alert', 'File Deleted Succuessfully (:');
			}
			else {
				return view('DynamicView/you', compact('BaseView'))->with('alert', 'File Deletion Failed ):');
			}
		}
		// Upload Branch
		else {
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

			// Push nonempty Data  to View
			foreach($hold as $key => $val) { if(!empty($val)) { $BaseView[$key] = $val; } }


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

			// Save Data and Return View
			if($err_bool == 1) { return view('DynamicView/you', compact('BaseView', 'View')); }
			else {
				// Store File
				if(move_uploaded_file($_FILES['img_up']['tmp_name'], $target_file)) {
					// Save File Path to Database
					$file = new \App\Files;
				  $file->id = $_SESSION['id'];
				  $file->file = $target_file;
				  $file->save();

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

					// Push nonempty Data  to View
					foreach($hold as $key => $val) { if(!empty($val)) { $BaseView[$key] = $val; } }


					// Return View With Success Message
					array_push($View, "File Uploaded!");
					return view('DynamicView/you', compact('BaseView', 'View'));
	    	}
				else {
				 // Return View With Fail Message
				 array_push($View, "File Upload Failed!");
				 return view('DynamicView/you', compact('BaseView', 'View'));
			  }
		 	}
		}
	}
}
