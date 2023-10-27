<?php 

require_once('action.php');

$tsql = "SELECT Consignment_Note.ID_Note, Client.FName as cltName, Client.Tel as cltTel, Consignment_Note.DeliveryAddress as ordAddress, FORMAT(Consignment_Note.Date, 'd/MM/yyyy') as ordDate, Employee.FName as empName, Employee.Tel as empTel, Auto.Brand, Auto.Model
FROM Consignment_Note
    INNER JOIN Client ON Client.ID_Client = Consignment_Note.[ID_Client (FK)]
    INNER JOIN Auto ON Auto.ID_Auto = Consignment_Note.[ID_Auto (FK)]
    INNER JOIN Employee ON Employee.ID_Employee = Consignment_Note.[ID_Employee (FK)]
WHERE Employee.Job = 'Менеджер'
";

fetchData($tsql);

?>