


<title>لیست شرکتهای طرف حساب </title>
<!--css-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--css-->
<form method="post" action="">

<!--js-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--js-->
<script src="js/responsiveslides.min.js"></script>

<?php

require 'autoload.php';

$company = new company();

$company->GetAllBranList();

?>