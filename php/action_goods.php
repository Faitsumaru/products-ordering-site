<?php 

require_once('action.php');

$tsql = "SELECT *, [Consignment_Note Goods].Count 
FROM Goods
INNER JOIN [Consignment_Note Goods] 
ON [Consignment_Note Goods].[ID_Goods (FK)] = Goods.ID_Goods";


fetchData($tsql);

?>