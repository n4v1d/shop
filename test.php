<meta http-equiv='Content-Type' content='text/html; charset=windows-1256'/>
<?php
set_time_limit(0);

//$id = $_GET['id'];

$_pdo = new PDO('odbc:Driver={SQL Server};Server=192.168.11.2;Database=gNickHesab;Uid=sa2;Pwd=123456');


$query = $_pdo->query("select s_code_book,quantity  from dbo.tblstore  where s_code_store = 1 and s_code_book = 100125 or s_code_book = 104040");
$row = $query->fetchAll();
//var_dump($row)  ;

echo json_encode($row,true);
/*
$count = count($row);

for($i=0; $i<$count; $i++)
{
    echo '<br>';
    echo round($row[$i]['s_code_book']);

    echo '<br>';
    echo round($row[$i]['quantity']);
}

*/

?>