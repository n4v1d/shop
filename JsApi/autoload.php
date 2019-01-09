<?php

function __autoload($class)
{
    $class = strtolower($class);

    $path = "class/" . $class . ".class.php";

    if(file_exists($path))
    {
        require $path;
    }
    else
    {
        echo $class . ' Class Not Found';
    }
}