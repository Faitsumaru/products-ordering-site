<?php 

require_once('action.php');

$tsql = "SELECT *, FORMAT(Client.BirthDate, 'd/MM/yyyy') as BirthDate FROM Client";

fetchData($tsql);

?>