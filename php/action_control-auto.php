<?php 

require_once('action.php');

$tsql = "SELECT *, FORMAT(Auto.ReleaseYear, 'd/MM/yyyy') as ReleaseYear FROM Auto";

fetchData($tsql);

?>