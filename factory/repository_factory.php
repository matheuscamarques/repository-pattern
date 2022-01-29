<?php

	class RepositoryFactory {
		public static function get(string $strClass){
		       	$repo = match($strClass){
				'user' => UserRepository::factory()
				//'other' => OtherRepository::factory,
			};
	           return $repo;	
		}
	}




