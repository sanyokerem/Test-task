<?php 

class Home{

	public function index(){
		return ['home', []];
	}

	public function not_found(){
		return ['not_found', []];
	}
}