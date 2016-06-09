<?php 
class Item{
	private $_db,
			$_data;

	public function __construct(){
		$this->_db = DB::getInstance();
	}

	public function create($fields = array()){
		if(!$this->_db->insert('items', $fields)){
			throw new Exception('There was a problem creating items.');
		}
	}

	public function retrieve($item){
		if (!empty($item)) {
			$field = 'Id';
			$data = $this->_db->get('items', array($field, '=', $item));

			if ($data->count()) {
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}

	public function data(){
		return $this->_data;
	}
}