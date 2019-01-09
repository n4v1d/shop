<meta http-equiv='Content-Type' content='text/html; charset=windows-1256'/>
<?php
set_time_limit(0);

//$id = $_GET['id'];

require 'autoload.php';


$_pdo = new PDO('odbc:Driver={SQL Server};Server=192.168.11.2;Database=gNickHesab;Uid=sa2;Pwd=123456');

$product_array = ['108096','101416','105750','108495','101407','101419','101426','104502','101420','101422','108213','108630','101423','106185','107503','108568','110882'];


$query = $_pdo->query("select s_code_book,quantity  from dbo.tblstore  where  s_code_book in ('" . implode("','", $product_array) . "')") ;
$row = $query->fetchAll();
//var_dump($row)  ;

$count = count($row);

for($i=0; $i<$count; $i++)
{
    echo round($row[$i]['s_code_book']);

    echo round($row[$i]['quantity']);


}


?>
