<?php 

class App{

	public static $db;
	public static $user;

	public function __construct($db, $user){
		self::$db = $db;
		self::$user = $user;
	}

	public function handle_request(){
		$this->router = new Router();
		$logic = $this->router->dispatch();
		$controller = new $logic[0];
		$this->responseOptions = $controller->$logic[1]();
	}

	public function render_response(){

		$vars = $this->responseOptions[1];

		if($this->responseOptions[0] == 'not_found'){

			include 'views/' . $this->responseOptions[0] . '.html';

		} else {
			include 'views/header.html';
			include 'views/' . $this->responseOptions[0] . '.html';
			include 'views/footer.html';
		}	
	}

}
