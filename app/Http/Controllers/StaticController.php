<?php

// namespace
namespace App\Http\Controllers;

// class
class StaticController {
	// Home Page
  public function home() { if(!empty($_SESSION)) { return redirect()->to('http://os.local/you'); } else { return view('StaticView/home'); } }

	// FAQ Page
	public function faq() { return view('StaticView/faq'); }
}
