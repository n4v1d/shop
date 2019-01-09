<!--css-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>


<!--js-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--js-->
<script src="js/responsiveslides.min.js"></script>

<link href="css/pure-min.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/editable.js"></script>




<?php
require 'lib/jdf.php';
require 'autoload.php';
error_reporting(0);

set_time_limit(0);
$tax = new tax();

$tax->GetAllProductWithTax();



?>
