<?php

use GuzzleHttp\Psr7\Query;

class DBquery{

    private $user     = null;
    private $category = null;
    private $order    = null;
    private $product  = null;
    private $dataBase = null;


    public function __construct(){
        $this->dataBase=Database::connect();
    }

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }


    public function getObjectsFromQuery(String $query):object{

        $objectsArray     = [];
		$genericStatement = $this->dataBase->prepare("$query");
		if(!$genericStatement) return false;

		$genericStatement->bind_param("i",$id);
		if(!$genericStatement->execute()) return false;

		$getAllResults = $genericStatement->get_result();
		while($row = $getAllResults->fetch_array(MYSQLI_NUM))$elementsArray[] = $row;

		return $elementsArray;
    }

    public function getArrayFromQuery(){

    }
}
