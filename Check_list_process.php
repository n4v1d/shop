<?php
require 'autoload.php';
require 'lib/jdf.php';
//error_reporting(0);

//Check
$date_list =  explode(',', $_GET['date']);
$check_count = count($date_list);
$price_list =  explode(',', $_GET['price']);

//Factor
$factor_list =  explode(',', $_GET['Check_List_array']);
$factor_count = count($factor_list);
$check = new chek();

// Get Check Data From DataBase
$factor_data_list_array = array();
$factor = new factor();
for($i=0;$i<$factor_count;$i++)
{
    $factor->GetFactorData($factor_list[$i]);
    $check->UpdateFactorStatusManual($factor_list[$i],1,0);
    //$check->UpdateCheckView($factor_list[$i]);
    $check->UpdateCheckToHidden($factor_list[$i]);
    $factor_data_list_array[] = $factor->factorid;

}

$time = array();

for($i=0;$i<$check_count;$i++)
{
    $date =  explode('/',$date_list[$i]);
    $time[] = jmktime('01','01','01',$date[1],$date[2],$date[0]);
}




 $message = "تجمیع شده برای فاکتور های " . implode(",", $factor_data_list_array);




for ($i = 0 ; $i<$check_count ; $i++)
{
    echo 'time:' . jdate('c',$time[$i] ,'','','en');
    echo 'price:' . $price_list[$i];

    echo '<br>';

    $check->InsertNewCheck($factor->company , $message , $price_list[$i] , $time[$i] , $time[$i],'0','1',implode(",", $factor_list),implode(",", $factor_data_list_array),$message);
}





?>