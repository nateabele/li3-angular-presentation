<?php

namespace todos\models;

class Todos extends \lithium\data\Model {

	public $validates = array();

	protected $_meta = array('key' => '_id');

	protected $_schema = array(
		'_id' => array('type' => 'id')
	);
}

?>