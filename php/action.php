<?php

function fetchDATA($sql) {
    $mysqli = new mysqli('localhost', 'root', '123', 'logistics-transportation_db');
 
	//$sql="select * from lt_table";
	$res=$mysqli->query($sql);
 
	$arr=array();
	while ($row=$res->fetch_assoc()) {
		$arr[]=$row;
	}
	$res->free();
	$mysqli->close();
	
	echo (json_encode ($arr));
}

$sql = "select * from lt_table";
$sql1 = "select * from lt_table order by count asc";
fetchDATA($sql);


///////////------attempt #1------///////////
// try {
//     $db = new PDO('mysql:host = localhost; dbname=logistics-transportation_db', 'root', '123');
//         foreach($db->query('SELECT * FROM lt_table') as $row)
//     {
//         $data[] = $row;
//     }

//     for ($i = 0; $i < 5; $i++)
//         for ($j = 0; $j < 5; $j++)
//             print_r($data[$j][$i] . "\n");

//     // foreach($data as $i) {
//     //     print_r($i['count'] . ' ');
//     // }

//     $db = null;
//   }
//   catch (PDOException $e)
//   {
//       print "Error: " . $e->getMessage(). "<br/>";
//       die();
//   }


///////////------attempt #2------///////////

// $host = "localhost";
// $user = "root";
// $password = "123";
// $dbname = "twitter";

// $connection = mysqli_connect($host, $user, $password, $dbname);

// if($connection) {
//     die('Connection failed : ' . mysqli_connect_error());
// }

// $query = 
// "
// SELECT * FROM posts WHERE
// ";

// $cond = "1";

// if(isset($_GET['userid'])) {
//     $cond = " id = " . $_GET['userid'];
// }

// $userData = mysqli_query($connection, "SELECT * FROM posts WHERE
// " . $cond);

// $response = array();

// while($row = mysqli_fetch_assoc($userData)) {
//     $response[] = $row;
// }

// echo json_encode($response);
// exit;



///////////------attempt #3------///////////
// $connect = new PDO("mysql:host=localhost;dbname=logistics-transportation_db", "root", "123");

// $received_data = json_decode(file_get_contents("php://input"));

// $data = array();

// if ($received_data->action == 'fetchall') {
//     $query = "
//     SELECT * FROM lt-table
//     ORDER BY id DESC
//     ";

//     $statement = $connect->prepare($query);
//     $statement->execute();
//     while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
//         $data[] = $row;
//     }
//     echo json_encode($data);
// }

?>