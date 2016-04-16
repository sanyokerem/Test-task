<?php 

class ModelUser{

	protected $login;
	protected $password;
	protected $email;
	protected $real_name;
	protected $birthday;
	protected $country;
	public static $db;

	public function __construct($login, $password, $email, $real_name='', $birthday='', $country){
		$this->login = $login;
		$this->password = $password;
		$this->email = $email;
		$this->real_name = $real_name;
		$this->birthday = $birthday;
		$this->country = $country;
	}

	public function save(){

		$reg_date = new \DateTime();
		$reg_date = $reg_date->format('Y-m-d H:i:sP');

		$p = self::$db->prepare("INSERT INTO `users`(`email`, `login`, `real_name`, `password`, `birthday`, `country`, `register_date`) VALUES (?, ?, ?, ?, ?, ?, ?)");
		if($p->execute([$this->email, $this->login, $this->real_name, password_hash($this->password, PASSWORD_DEFAULT), $this->birthday, $this->country, $reg_date])) return true;
		else false;
	}

	public function finde_user(){
		if(isset($this->login)){
			$type = 'login';
			$target = $this->login;
		}else{
			$type = 'email';
			$target = $this->email;
		}	
		$p = self::$db->prepare("SELECT * FROM `users` WHERE `{$type}` = ? LIMIT 1 ");
		$p->execute([$target]);
		$db_user = $p->fetch(PDO::FETCH_ASSOC);
		return [$db_user, password_verify($this->password, $db_user['password'])];
		
		//Router::redirect('user/login');
	}

	public function get_name(){
		return $this->real_name;
	}
}

ModelUser::$db = App::$db;