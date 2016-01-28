<?php
	class validate {
		private $_passed = false,
				$_errors = array(),
				$_db = null;

		public function __construct(){
			$this->_db = db::getInstance();
		}

		public function check($source, $items = array()){
			foreach($items as $item => $rules){
				foreach($rules as $rule => $rule_value){
					//echo "{$item} {$rule} must be {$rule_value} </br>";

					$value = trim($source[$item]);
					$item = escape($item);

					if($rule === 'required' && empty($value)){
						$this->addError("{$item} is required </br>");
					} else if(!empty($value)) {
						switch ($rule) {
							case 'min':
								if(strlen($value) < $rule_value){
									$this->addError("{$item} tiene que tener al menos {$rule_value} caracteres.");
								}
								break;
							
							case 'max':
								if(strlen($value) > $rule_value){
									$this->addError("{$item} tiene que tener como maximo {$rule_value} caracteres.");
								}
								break;
							
							case 'matches':
								if($value != $source[$rule_value]){
									$this->addError("{$rule_value} no coincide con {$item}");
								}
								break;
							
							case 'unique':
								$check = $this->_db->get($rule_value, array($item, "=" , $value));
								if ($check->count()) {
									$this->addError("{$item} no esta disponible.");
								}
								break;
						}
					}
				}
			}

			if(empty($this->_errors)){
				$this->_passed = true;
			}
			return $this;
		}

		private function addError($error){
			$this->_errors[] = $error;
		}

		public function errors(){
			return $this->_errors;
		}

		public function passed() {
			return $this->_passed;
		}
	}