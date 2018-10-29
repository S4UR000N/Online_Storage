<?php

// namespace
namespace App\Http\Controllers\DynamicController;

// class
class YouController {
	public function get() {
		// Final View Data
		$BaseView = array();

		// Select * User Files and return to $BaseView
		$YouRepo = new \App\Http\Controllers\Repository\DynamicRepository\YouRepository;
		$BaseView = $YouRepo->selectUserFiles($BaseView);

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

			// Select * User Files and return to $BaseView
			$YouRepo = new \App\Http\Controllers\Repository\DynamicRepository\YouRepository;
			$BaseView = $YouRepo->selectUserFiles($BaseView);

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
			// Select * User Files and return to $BaseView
			$YouRepo = new \App\Http\Controllers\Repository\DynamicRepository\YouRepository;
			$BaseView = $YouRepo->selectUserFiles($BaseView);

			// Validate Selected File
			$View = $YouRepo->validateFile();

			// Save Data and Return View
			if(!empty($View)) { return view('DynamicView/you', compact('BaseView', 'View')); }
			else {
				// Target dir/file/extension
				$target_dir = "uploads/" . $_SESSION['id'];
				$target_file = $target_dir . basename($_FILES['img_up']['name']);
				
				// Store File
				if(move_uploaded_file($_FILES['img_up']['tmp_name'], $target_file)) {
					// Save File Path to Database
					$file = new \App\Files;
				  $file->id = $_SESSION['id'];
				  $file->file = $target_file;
				  $file->save();

					// Select * User Files and return to $BaseView
					$YouRepo = new \App\Http\Controllers\Repository\DynamicRepository\YouRepository;
					$BaseView = $YouRepo->selectUserFiles($BaseView);

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
