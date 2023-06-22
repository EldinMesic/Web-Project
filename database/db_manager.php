<?php
if(session_status() !== PHP_SESSION_ACTIVE){
  header("Location: index.php?error=Invalid Session");
  exit();
}

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
				return "Location: home.php";
			}else{
				return "Location: index.php?error=Invalid password. The password you entered is incorrect.";
			}
		}else{
			return "Location: index.php?error=User does not exist. Please sign up to create an account.";
		}

  }

  public function registerUser($username, $email, $password){
    $username = $this->connection->real_escape_string($username);
    $email = $this->connection->real_escape_string($email);
    $password = $this->connection->real_escape_string($password);
    $passHash = password_hash($password, PASSWORD_DEFAULT);


    
    if($this->isEmailRegistered($email)){
      return "Location: registration.php?error=Sorry, the email you entered is already registered. Please try using a different email or login with your existing account.";
    }
    if($this->isUsernameRegistered($username)){
      return "Location: registration.php?error=Sorry, this username is taken. Please try using a different username.";
    }


    $sql = "INSERT INTO users (username, email, password) 
            VALUES ('$username','$email','$passHash')";
    $result = $this->connection->query($sql);

    if($result){
      return $this->loginUser($username, $password);
    }else{
			return "Location: registration.php?error=Something went wrong. Please try again.";
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

  



}


$database = new DatabaseManager();


?>