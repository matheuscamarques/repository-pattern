<?php

interface RepositoryInterface{
	public function getAll($id);
        public function get($id);
        public function delete($id);
	public function update($data);
	public function save($data);
}
