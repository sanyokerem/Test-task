<?php

class ModelCountry{

	public function get_all_countries(){
		$p = App::$db->prepare("SELECT * FROM `countries` ORDER BY `name`");
		$p->execute();
		return $p->fetchAll(\PDO::FETCH_ASSOC);
	}
}