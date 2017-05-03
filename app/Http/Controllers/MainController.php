<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cat;

class MainController extends Controller {
	public function storeItem(Request $request) {
		$data = new Cat();
		$data->name = $request->name;
		$data->save ();
		return $data;
	}
	public function readItems() {
		$data = Cat::all ();
		return $data;
	}
	public function deleteItem(Request $request) {
		$data = Cat::find ( $request->id )->delete ();
	}
}
