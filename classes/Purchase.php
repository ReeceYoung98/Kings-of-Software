<?php 
class Purchase{
	private $_db,
			$_data;

	public function __construct(){
		$this->_db = DB::getInstance();
	}

	public function create($fields = array()){
		if(!$this->_db->insert('purchases', $fields)){
			throw new Exception('There was a problem creating purchases.');
		}
	}

	public function retrieve($user){
		if (!empty($user)) {
			$field = 'UserId';
			$data = $this->_db->get('purchases', array($field, '=', $user));

			if ($data->count()) {
				$this->_data = $data->results();
				return true;
			}
		}
		return false;
	}

	public function data(){
		return $this->_data;
	}
}