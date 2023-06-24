<?php

$absPath = "http://localhost/Web-Project/";

if(session_status() !== PHP_SESSION_ACTIVE){
  header("Location: {$absPath}index.php?error=Invalid Session");
  exit();
}

class DatabaseManager{
    protected $connection;
    protected $absPath = "http://localhost/Web-Project/";
    protected $regenTime = 300;
    protected $maxStamina = 100;

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
  public function getUserPokemons($userID){
    $sql = "SELECT pokemonID, isShiny
            FROM user_pokemon
            WHERE useriD='$userID'";
    $results = $this->connection->query($sql);

    $userPokemons = array();

    while($row = $results->fetch_assoc()){      
      $userPokemons[] = array(
        "pokemonID" => $row['pokemonID'],
        "isShiny" => boolval($row['isShiny'])
      );
    }

    return json_encode($userPokemons);

    
  }
  public function getPokemonById($id){
    $id = $this->connection->real_escape_string($id);

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



  public function loginUser($username, $password){
    $username = $this->connection->real_escape_string($username);
    $password = $this->connection->real_escape_string($password);

    $sql = "SELECT * 
            FROM users 
            WHERE username='$username' OR email='$username'";
		$result = $this->connection->query($sql);

		if ($result->num_rows === 1) {
      $user = $result->fetch_assoc();

			if(password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        if($user['hasFinishedTutorial']){
          return "Location:  {$this->absPath}home.php";
        }else{
          return "Location:  {$this->absPath}tutorial/tutorial.php#navbar";
        }
				
			}else{
				return "Location:  {$this->absPath}index.php?error=Invalid password. The password you entered is incorrect.";
			}
		}else{
			return "Location:  {$this->absPath}index.php?error=User does not exist. Please sign up to create an account.";
		}

  }
  public function registerUser($username, $email, $password){
    $username = $this->connection->real_escape_string($username);
    $email = $this->connection->real_escape_string($email);
    $password = $this->connection->real_escape_string($password);
    $passHash = password_hash($password, PASSWORD_DEFAULT);


    
    if($this->isEmailRegistered($email)){
      return "Location:  {$this->absPath}registration.php?error=Sorry, the email you entered is already registered. Please try using a different email or login with your existing account.";
    }
    if($this->isUsernameRegistered($username)){
      return "Location:  {$this->absPath}registration.php?error=Sorry, this username is taken. Please try using a different username.";
    }


    $sql = "INSERT INTO users (username, email, password) 
            VALUES ('$username','$email','$passHash')";
    $result = $this->connection->query($sql);

    if($result){
      return $this->loginUser($username, $password);
    }else{
			return "Location:  {$this->absPath}registration.php?error=Something went wrong. Please try again.";
		}

  }



  public function isEmailRegistered($email){
    $email = $this->connection->real_escape_string($email);

    $sql = "SELECT *
            FROM users
            WHERE email='$email'";
    $result = $this->connection->query($sql);

    return $result->num_rows===1;

  }
  public function isUsernameRegistered($username){
    $username = $this->connection->real_escape_string($username);

    $sql = "SELECT *
            FROM users
            WHERE username='$username'";
    $result = $this->connection->query($sql);

    return $result->num_rows===1;

  }
  public function doesUserExist($id){
    $id = $this->connection->real_escape_string($id);

    $sql = "SELECT *
            FROM users
            WHERE id='$id'";
    $result = $this->connection->query($sql);

    return $result->num_rows===1;

  }
  public function getUser($id){
    $id = $this->connection->real_escape_string($id);

    $sql = "SELECT *
            FROM users
            WHERE id='$id'";
    $result = $this->connection->query($sql);

    $user = $result->fetch_assoc();
    return $user;

  }
  

  public function finishTutorial($userID, $pokemonID){
      if(!$this->doesUserExist($userID)){
        header("Location:{$this->absPath}index.php");
        exit();
      }

      
      if(!$this->catchPokemon($userID, $pokemonID, 0)){
        header("Location: {$this->absPath}tutorial/tutorial.php?error=Something went wrong with Pokemon selection");
        exit();
      }

      $sql = "UPDATE users
              SET hasFinishedTutorial = 1
              WHERE id=$userID";
      $result = $this->connection->query($sql);

      if(!$result){
        header("Location: {$this->absPath}tutorial/tutorial.php?error=Something went wrong with the tutorial");
        exit();
      }


      if(!isset($_SESSION['user'])){
        header("Location: {$this->absPath}index.php?error=Session Expired, please Log in again");
        exit();
      }

      $_SESSION['user']['hasFinishedTutorial'] = 1;


      header("Location: {$this->absPath}home.php");
      exit();

  }




  public function catchPokemon($userID, $pokemonID, $isShiny){  
    $sql = "INSERT INTO user_pokemon (userID, pokemonID, isShiny) 
            VALUES ($userID, $pokemonID, $isShiny)";
    $result = $this->connection->query($sql);

    return $result;
  }



  public function getStamina($userID){
    $user = $this->getUser($userID);
    $timeDiff = time() - strtotime($user['last_update']);
    
    $regenStamina = $timeDiff/$this->regenTime;
    $stamina = $regenStamina + $user['stamina'];

    return min($stamina, $this->maxStamina);
  }



  public function useStamina($userID, $stamina){
    $user = $this->getUser($userID);
    $currStamina = $this->getStamina($userID);
    $newStamina = $currStamina-$stamina;
    if($newStamina<0){
      return 0;
    }

    $newTime = date('Y-m-d H:i:s');

    $sql = "UPDATE users
            SET stamina={$newStamina}, last_update='{$newTime}'
            WHERE id=$userID";
    
    $result = $this->connection->query($sql);

    return $result;

  }



}


$database = new DatabaseManager();

?>