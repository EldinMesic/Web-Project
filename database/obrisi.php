<?php 
session_start();
?> 
<html>
<body>
<?php
include "db_conn.php";
if (isset($_GET['id']))
{
   $sql="DELETE FROM proizvodi WHERE id = '$_GET[id]'";
   if ($spoj->query($sql))
   {
     echo "Proizvod je uspješno obrisan.";
	 header("Location: ispis.php");
	 exit();
   }
   else
   {
      echo "Nastala je greška pri brisanju podataka<br/>".$spoj->error;
	  header("Location: ispis.php");
	  exit();
      
   }
}

?>
</body>
</html>