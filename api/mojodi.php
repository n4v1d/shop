<meta http-equiv='Content-Type' content='text/html; charset=windows-1256'/>
<?php
set_time_limit(0);

$_pdo = new PDO('odbc:Driver={SQL Server};Server=192.168.1.3;Database=gNickHesab;Uid=sa2;Pwd=123456');


$query = $_pdo->query("select * from dbo.tblstore  where s_code_store = 1");
$row = $query->fetchAll();
//var_dump($row)  ;

 $count = count($row);

for($i=0; $i<$count; $i++)
{
    echo  'Productid: ' . $row[$i]['s_code_book'] . ' Store:' . $row[$i]['s_code_store'] . ' quantity' . $row[$i]['quantity'] . '<br>';
}/*

//
/*
////////////////////////////////// Tested Code Succ ///////////////////
$dsn = "sqlsrv:Server=87.247.179.80,1633;Database=vieratebdb";
$dbh = new PDO($dsn, "vtebuser", "fkhlonhl1763");
$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );


 $sql = "SELECT * FROM Doctors";
$res = $dbh->prepare($sql);

$res->execute();

$row = $res->fetch();
	$aa = $row['Username'];
     echo $aa;

/////////////////////////////////////////////////////////////////////
//$stmt=$dbh->query($sql); ya iin   => Bug Farsi
//$objs = $stmt->fetchAll(PDO::FETCH_OBJ)ya iin
*/
?>