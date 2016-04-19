<?php 

class Router{

	public static $url;
	public function dispatch(){

		$dir = $this->get_dir();
		$url = $_SERVER['REQUEST_URI'];
		$real_url = explode('?', $url)[0];
		self::$url = $real_url;
		switch (true) {
			case preg_match('#^/'.$dir.'home$#', $real_url):
			case preg_match('#^'.$dir.'$#', $real_url):
				return ['Home', 'index'];
				break;

			case preg_match('#^'.$dir.'logout$#', $real_url):
				return ['User', 'logout'];
				break;

			case preg_match('#^'.$dir.'login$#', $real_url):
				return ['User', 'login'];
				break;

			case preg_match('#^'.$dir.'register$#', $real_url):
				return ['User', 'register'];
				break;
			
			default:
				return ['Home', 'not_found'];
				break;
		}
	}

	public static function get_dir($path='/'){
		$script_path = array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 1, -1);
		if($script_path){
			$dir = '/'.implode('/', $script_path).$path;
		}else{
			$dir = $path;
		}
		
		return $dir;
	}

	public static function redirect(){
		$adress = self::get_dir();
		header("Location: {$adress}");
		exit();
	}

}