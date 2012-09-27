<?php

namespace todos\controllers;

class PagesController extends \lithium\action\Controller {

	public function view() {
		return $this->render(array(
			'template' => join('/', $path = func_get_args() ?: array('home')),
			'layout' => ($path == array('home')) ? 'presentation' : 'default'
		));
	}
}

?>