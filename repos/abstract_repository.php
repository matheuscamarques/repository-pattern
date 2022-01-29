<?php

class Database{
	private static Database $instance;
	private function __construct(){}
	public $buffer = [];
	public $index  = 0;

	public static function getInstance(){
		if(!isset(self::$instance)){
			self::$instance = new Database();
		}
		return self::$instance;
	}

	public function select($table){
		if(!isset($this->buffer[$table])){
			$this->buffer[$table] = [];
		}
		return $this->buffer[$table];
	}

	public function insert($table,$data){
	   if(isset($data->id)) $data->id = ++$this->index;
	   
	   if(is_array($data) && isset($data['id'])) $data['id'] = ++$this->index;
		
	   $this->buffer[$table][$this->index] = $data;
   	   return $this->index;	   
	}

	public function update($table,$index,$data){
	   $this->buffer[$table][$index] = $data;  	
	}

	public function delete($table,$index){
	   unset($this->buffer[$table][$index]);
	}


}

class DriverDatabase{
    public static function connect(){
    	return Database::getInstance();
    }
}

abstract class AbstractRepository implements RepositoryInterface{
	public $table;
	public function getAll($id){
	    return DriverDatabase::connect()->select($this->table);	
	}
	public function get($id){
	    return DriverDatabase::connect()->select($this->table)[$id]; 
	}
	
	public function delete($id){
	    return DriverDatabase::connect()->delete($this->table,$id);
	}
	
	public function update($data){
	    return DriverDatabase::connect()->update($this->table,$data->id ?? $data['id'],$data);
	}
	public function save($data){
	    return DriverDatabase::connect()->insert($this->table,$data);	
	}
}
