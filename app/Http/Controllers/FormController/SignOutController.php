<?php

// namespace
namespace App\Http\Controllers\FormController;

// class
class SignOutController {
	public function get() {
		// Empty Session
		session_unset();

		// Redirect User
		return redirect()->to('http://os.local/');
	}
}
