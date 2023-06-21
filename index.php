<?php
session_start();

include_once "database/db_manager.php";

$products = $database->getPokemons();
echo $products;
?>
<script>
    console.log(<?php echo $products; ?>);
</script>