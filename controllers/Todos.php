<?php

namespace todos\controllers;

class Todos extends \li3_resources\action\Resource {

	public function index($request, $todos) {
		return $todos;
	}

	public function add($request, $todo) {
		return ($data = $request->data) ? $todo->save($data) : $todo;
	}

	public function view($request, $todo) {
		return $todo;
	}

	public function edit($request, $todo) {
		return ($data = $request->data) ? $todo->save($data) : $todo;
	}

	public function delete($request, $todo) {
		return $todo->delete();
	}
}


?>