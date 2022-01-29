<?php

class UserRepository extends AbstractRepository implements UserRepositoryInterface{
        public $table = "user";
	public static function factory(){ return new UserRepository();}
}

