<?php
class user {
	private $_db,
			$_data,
			$_sessionName,
			$_cookieName,
			$_participante,
			$_isLoggedIn;

	public function __construct($user = null) {
		$this->_db = db::getInstance();
		$this->_sessionName = config::get('session/session_name');
		$this->_cookieName = config::get('remember/cookie_name');
		if(!$user){
			if(session::exists($this->_sessionName)){
				$user = session::get($this->_sessionName);
				if ($this->find($user)) {
					$this->_isLoggedIn = true;
				} else {
					//process logout
				}
			}
		} else {
			$this->find($user);
		}
	}

	public function update($fields = array(), $id = null) {
		if (!$id && $this->isLoggedIn()) {
			$id = $this->data()->id_participante;
		}

		if (!$this->_db->update('catalogos.participante', $id, $fields)) {
			throw new Exception("Hubo un problema al actualizar");
			
		}
	}

	public function hasPermission($key){
		$group = $this->_db->get('catalogos.groups', array('id', '=', $this->data()->grupo));
		
		if ($group->count()) {
			$permissions = json_decode($group->first()->permissions, true);
			if ($permissions[$key] == true) {
				return true;
			}
		}
		return false;
	}

	public function create ($fields = array()) {
		if(!$this->_db->insert('catalogos.participante', $fields)){
			throw new Exception("No se pudo registrar");			
		}
	}

	public function find($user = null){
		if ($user) {
			$field = (is_numeric($user)) ? 'id_participante' : 'username';
			$data = $this->_db->get('catalogos.participante', array($field, '=', $user));

			if ($data->count()) {
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}

	public function login($username = null, $password = null, $remember = false){
		if (!$username && !$password && $this->exists()) {
			session::put($this->_sessionName, $this->data()->id_participante);
		} else {
			$user = $this->find($username);
			if ($user) {
				if ($this->data()->password === hash::make($password, $this->data()->salt)) {
					session::put($this->_sessionName, $this->data()->id_participante);
					if ($remember) {
						$hash = hash::unique();
						$hashcheck = $this->_db->get('catalogos.userssession', array('user_id', "=", $this->data()->id_participante));
						if (!$hashcheck->count()) {
							$this->_db->insert('catalogos.userssession', array(
								'user_id' => $this->data()->id_participante,
								'hash' => $hash
								));
						} else {
							$hash = $hashcheck->first()->hash;
						}

						cookie::put($this->_cookieName, $hash, config::get('remember/cookie_expiry'));
					}
					return true;
				}
			}
		}
		return false;
	}

	public function exists(){
		return (!empty($this->_data)) ? true : false;
	}

	public function logout(){

		$this->_db->delete('catalogos.userssession', array('user_id', '=', $this->data()->id_participante));

		cookie::delete($this->_cookieName);
		session::delete($this->_sessionName);
	}

	public function data(){
		return $this->_data;
	}

	public function isLoggedIn(){
		return $this->_isLoggedIn;
	}

}