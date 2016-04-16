<?php 

class User{

	protected function convert_to_user($type=''){

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($type === 'login'){
				if (preg_match("/^\w+@\w+(\.\w+)+$/", $_POST['sing_in_str'])) {
					$_POST['email'] = $_POST['sing_in_str'];
				} else {
					$_POST['login'] = $_POST['sing_in_str'];
				}
			}
			$user = new ModelUser($_POST['login'], $_POST['password'], $_POST['email'], $_POST['real_name'], $_POST['birthday'], $_POST['country']);
			return $user;

		}

	}
 
	public function register(){
		if(isset($_SESSION['user'])){
			$_SESSION['error'] = ' You are already registered!';
			Router::redirect();
		}
		$countries = ModelCountry::get_all_countries();
		$user = $this->convert_to_user();

		if($user){
			if($user->save()){
				$this->login();
				Router::redirect();
			}else{
				$_SESSION['error'] = ' This user alredy exists!';
			}
		}
		return ['user/register_form_page',['countries'=>$countries]];
		Router::redirect();
	}

	public function login(){
		if(isset($_SESSION['user'])){
			$_SESSION['error'] = ' You are already logged in!';
			Router::redirect();
		}
		$user = $this->convert_to_user('login');
		if($user){
			$user_info = $user->finde_user();
			if($user_info[1]){
				$_SESSION['user']  = $user_info[0];
				Router::redirect();
			}else{
				$_SESSION['error'] = ' Password or login is incorrect!';
			}
		}

		return ['user/login_form_page', []];
	}

	public function logout(){
		$_SESSION['user'] = NULL;
		Router::redirect();
	}
}
