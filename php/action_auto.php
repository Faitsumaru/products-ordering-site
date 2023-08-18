<?php 

require_once('action.php');

$tsql = "SELECT Employee.FName AS name, Employee.Job AS job, Employee.Tel as tel, Auto.Brand as brand, Auto.Model as model, Auto.RegNum as reg_num, FORMAT(Auto.ReleaseYear, 'd/MM/yyyy') as release_year
FROM Consignment_Note
          INNER JOIN Employee ON Employee.ID_Employee = Consignment_Note.[ID_Employee (FK)]
          INNER JOIN Auto ON Auto.ID_Auto = Consignment_Note.[ID_Auto (FK)]
WHERE Employee.Job != 'Админ' AND Employee.Job != 'Менеджер'
";

fetchData($tsql);

?>