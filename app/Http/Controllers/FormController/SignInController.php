<?php

// namespace
namespace App\Http\Controllers\FormController;

// class
class SignInController {
	public function get() { return view('FormView/signin'); }
	public function post() {
		// Final View Data
		$View = array("Invalid Name or Password");

		// Error Boolean
		$err_bool = 0;

		// Error Checking
		if(empty($_POST['name']) || empty($_POST['password'])) {
			$err_bool = 1;

			return view('FormView/signin', compact('View'));
		}

		if($err_bool == 0) {
			// Get User Data from DB
			$user = \DB::select('SELECT * FROM users WHERE name = :name AND password = :password LIMIT 1', ['name' => $_POST['name'], 'password' => $_POST['password']]);

			// Check User Data
			if(empty($user)) {
				return view('FormView/signin', compact('View'));
			}
			else {
				// Cast DB Result(array) to (object)
				$user = (object)$user[0];

				// set SESSION Data
				$_SESSION['id'] = $user->id;
				$_SESSION['name'] = $user->name;
				$_SESSION['email'] = $user->email;

				// Redirect User
				return redirect()->to('http://os.local/you');
			}
		}
	}
}
