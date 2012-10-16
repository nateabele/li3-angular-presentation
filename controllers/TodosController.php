<?php

namespace todos\controllers;

use todos\models\Todos;

class TodosController extends \lithium\action\Controller {

	public function index() {
		$todos = Todos::all();
		return compact('todos');
	}

	public function view() {
		$todo = Todos::first($this->request->id);
		return compact('todo');
	}

	public function add() {
		$todo = Todos::create($data = $this->request->data);

		if (($data) && $todo->save()) {
			return $this->redirect(array('Todos::view', 'args' => array($todo->id)));
		}
		return compact('todo');
	}

	public function delete() {
		if (!$this->request->is('post') && !$this->request->is('delete')) {
			$msg = "Todos::delete can only be called with http:post or http:delete.";
			throw new DispatchException($msg);
		}
		Todos::find($this->request->id)->delete();
		return $this->redirect('Todos::index');
	}
}

?>