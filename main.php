<?php

require('./contracts/factory_interface.php');
require('./contracts/user_repository_interface.php');
require('./contracts/repository_interface.php');
require('./repos/abstract_repository.php');
require('./repos/user_repository.php');
require('./factory/repository_factory.php');

class User {
	public $id = 0,$name='',$age=0;

	private function __construct($name){
		$this->name = $name;
	}
	
	public static function create($name){
		return new User($name);
	}

	public function setAge($age){ 
		$this->age = $age;
		return $this;
	}


}

$repo = RepositoryFactory::get('user');

$id = $repo->save(User::create('matheus')->setAge(24)); 

echo json_encode($repo->get($id)) . PHP_EOL;

$id = $repo->save(User::create('lucas')->setAge(20));
$id = $repo->save(User::create('jõao')->setAge(23));

echo json_encode($repo->getAll(0)).PHP_EOL;
$repo->update($repo->get($id)->setAge(99999999));
echo json_encode($repo->getAll(0)).PHP_EOL;
$repo->delete($id);
echo json_encode($repo->getAll(0)).PHP_EOL;

