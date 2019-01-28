<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/jquery.loading.css" rel="stylesheet" type="text/css" media="all"/>


<!--js-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--js-->
<script src="js/responsiveslides.min.js"></script>

<link href="css/pure-min.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/editable.js"></script>
<script src="js/switalert.js"></script>

<script src="js/jquery.loading.js"></script>
<?php
require 'autoload.php';
require 'lib/jdf.php';

$report = new report();

$report->GetAllFactorWithNaghdiDiscountList();
$report->GetFactorDataForDiscountNaghdi($report->ListArray);
?>