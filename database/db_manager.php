<?php
if(session_status() !== PHP_SESSION_ACTIVE){
  header("Location: index.php?error=Invalid Session");
  exit();
}

include_once 'utilities/constants.php';



class DatabaseManager{
    protected $connection;

	public function __construct($dbhost = 'localhost', $dbuser = 'root', $dbpass = '', $dbname = 'pokebuy') {
		$this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

		if ($this->connection->connect_error) {
			die('Failed to connect to MySQL - ' . $this->connection->connect_error);
		}

	}

  public function getPokemons($limit=0, $offset=0){
    if($limit<=0) $limit=$this->getPokemonCount();
    
    $bottomValue = $limit*$offset+1;
    $topValue = $bottomValue+$limit-1;
    
    $sql = "SELECT * 
            FROM pokemons 
            WHERE id BETWEEN $bottomValue AND $topValue";
    $results = $this->connection->query($sql);
    
    $pokemonArray = array();
    while($row = $results->fetch_assoc()){      
      $pokemonArray[] = $row;
    }

    return json_encode($pokemonArray);
  }
    

  public function getPokemonById($id){
    $sql = "SELECT * FROM pokemons WHERE id ='$id' ";
    $result = $this->connection->query($sql);

    $pokemon = $result->fetch_assoc();

    return json_encode($pokemon);
  }
 
  public function getPokemonCount(){
    $sql = "SELECT COUNT(id)
            FROM pokemons";
    $result = $this->connection->query($sql);
    
    $count = $result->fetch_assoc();
    return $count['COUNT(id)'];

  }

  
}


$database = new DatabaseManager();


?>