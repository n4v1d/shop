<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--css-->

<!--js-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--js-->
<script src="js/responsiveslides.min.js"></script>
<?php
$productid = $_GET['productid'];

require 'autoload.php';

$product = new product();

$product->GiveLastBuyReport($productid);
?>