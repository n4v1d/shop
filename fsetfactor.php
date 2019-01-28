<?php
session_start();
$userid = $_SESSION['UserId'];
if(isset($_GET['factorid'])) {

    require 'autoload.php';



    if(!isset($_SESSION['UserId']))
    {
        echo 'لطفا مجددا وارد شوید';
    }
    else
    {
        $content = file_get_contents("php://input");
        $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


        $logreport = new logreport();
        $logreport->NewLogReport($userid,$content,$link);

        $id = $_GET['factorid'];
        $entity = new factor();
        if($entity->fsaveFactor($id,$userid) == '1')
        {
            header('location:index.php');
        }
        else
        {
            echo 'خطا';
        }

    }


}