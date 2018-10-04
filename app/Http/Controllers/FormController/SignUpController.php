<?php

// namespace
namespace App\Http\Controllers\FormController;

// class
class SignUpController {
	public function get() { return view('FormView/signup'); }
	public function post() {
		// Final View Data
		$View = array(
			'Valid' => array(),
			'Error' => array()
		);

		// Partialy Valid Data Requires Compact
		$Valid = array(
			"name" => $_POST['name'],
			"email" => "",
			"password" => ""
		);

	  // Error Possibilities
	  $Error = array(
			"1" => "All Fields Required!",
			"2" => "Invalid Email!",
			"3" => "Email is in Use!",
			"4" => "Invalid Passwords!"
		);

		// Error Controller
		$err_data = array();

	  // Error Checking
	  foreach($_POST as $err) { if(!in_array("1", $err_data) && empty($err)) { array_push($err_data, "1"); } }

		if(!empty($_POST['email']) && strpos($_POST['email'], '@') === false) { array_push($err_data, "2"); }
		else {
			// check if email aleready exist
			$email_check = \DB::table('users')->where('email', $_POST['email'])->first();
			if(is_null($email_check)) { $Valid['email'] = $_POST['email']; }
			else { array_push($err_data, "3"); }
		}

		if(!empty($_POST['password']) && $_POST['password'] !== $_POST['confirm_password']) { array_push($err_data, "4"); }
		else { $Valid['password'] = $_POST['password']; }


		// Store Errors to View Data
		foreach($err_data as $err) { array_push($View['Error'], $Error[$err]); }

		// Store All Valids to View Data
		foreach($Valid as $key => $val) { if(!empty($val)) { $View['Valid'][$key] = $val; } }


		// if Form not fully correct pass Valid and Error Data
		if(!empty($err_data)) {
			return view('FormView/signup', compact('View'));
		}
		else {
			// Save User
			$user = new \App\Users;
		  $user->name = $_POST['name'];
		  $user->email = $_POST['email'];
		  $user->password = $_POST['password'];
			$user->active = md5($_POST['email']);
		  $user->save();

			// Send Activation Mail
			//\Mail::to($user->email)->send(new \App\Mail\ActivationMail($user));

			// Redirect User
			return redirect()->to('http://os.local/signin');
		}
	}
}
