<?php 

class Router{

	public static $url;
	public function dispatch(){

		$url = $_SERVER['REQUEST_URI'];
		$real_url = explode('?', $url)[0];
		self::$url = $real_url;
		switch (true) {
			case preg_match('#^/home#', $real_url):
			case preg_match('#^/$#', $real_url):
				return ['Home', 'index'];
				break;

			case preg_match('#^/user#', $real_url):
				$second_part = substr($real_url, 6);
				switch($second_part){
					case 'register':
					case 'login':
					case 'logout':
						$action = $second_part;
					break;
					default:
						$action = 'login';
				}
				return ['User', $action];
			break;
			default:
				return ['Home', 'not_found'];
				break;
		}
	}

	public static function redirect($adress = '/'){
		header("Location: {$adress}");
		exit();
	}

}