<?php 
class User{
	private $_db,
			$_data,
			$_sessionName,
			$_cookieName,
			$_isLoggedIn;

	public function __construct($user = null){
		$this->_db = DB::getInstance();

		$this->_sessionName = Config::get('session/session_name');
		$this->_cookieName = Config::get('remember/cookie_name');

		if (!$user) {
			if(Session::exists($this->_sessionName)){
				$user = Session::get($this->_sessionName);

				if ($this->find($user)) {
					$this->_isLoggedIn = true;
				}else{
					$this->logout();
				}
			}
		}else{
			$this->find($user);
		}
	}

	public function update($fields = array(), $id = null){
		if (!$id && $this->isLoggedIn()) {
			$id = $this->data()->Id;
		}

		if(!$this->_db->update('users', $id, $fields)){
			throw new Exception('There was a problem updating.');
		}
	}

	public function create($fields = array()){
		if(!$this->_db->insert('users', $fields)){
			throw new Exception('There was a problem creating an account.');
		}
	}

	public function find($user){
		if ($user) {
			$field = (is_numeric($user)) ? 'Id' : 'Id';
			$data = $this->_db->get('users', array($field, '=', $user));

			if ($data->count()) {
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}

	public function login($id = null, $password = null, $remember = false){
		

		if (!$id && !$password && $this->exists()) {
			Session::put($this->_sessionName, $this->data()->Id);
		}else{
			$user = $this->find($id);

			if ($user) {
				if ($this->data()->Password === Hash::make($password, $this->data()->Salt)) {
					Session::put($this->_sessionName, $this->data()->Id);

					if ($remember) {
						$hash = Hash::unique();
						$hashCheck = $this->_db->get('users_sessions', array('UserId', '=', $this->data()->Id));

						if (!$hashCheck->count()) {
							$this->_db->insert('users_sessions', array(
								'UserId' => $this->data()->Id,
								'Hash' => $hash
							));
						}else{
							$hash = $hashCheck->first()->Hash;
						}

						Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
					}
					return true;
				}
			}
		}
		return false;
	}

	public function hasPermission($key){
		$group = $this->_db->get('Groups', array('Id', '=', $this->data()->Group));
		echo $group;
		echo $group->count();
		if ($group->count() === 1) {
			$permissions = json_decode($group->first()->Permissions, true);

			if ($permissions[$key]) {
				return true;
			}
		}
		return false;
	}

	public function exists(){
		return (!empty($this->_data)) ? true : false;
	}

	public function logout(){
		$this->_db->delete('users_sessions', array('UserId', '=', $this->data()->Id));
		Session::delete($this->_sessionName);
		Cookie::delete($this->_cookieName);
	}

	public function data(){
		return $this->_data;
	}

	public function isLoggedIn(){
		return $this->_isLoggedIn;
	}
}