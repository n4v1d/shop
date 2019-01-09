<?php
session_start();
unset($_SESSION['UserId']);
header('location:index.php');
?>