<title>سیستم مدیریت فاکتور فروشگاه نوید </title>
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
require 'autoload.php';
$loyalty = new loyalty();


if (isset($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
} else {
    echo $page = "0";
}


if (isset($_GET['id'])) {
    $loyaltyPecent = $_REQUEST['percent'];
    $productid = $_REQUEST['id'];
    $loyalty->UpdateProductLoyalty($productid, $loyaltyPecent);

}

$loyalty->GetTotalProductForLoyalty($page * 25);

?>
<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-xs-offset-3 col-sm-offset-3">
    <nav aria-label="Page navigation example " >
        <ul class="pagination" style="font-size: 40px">
            <li class="page-item"><a class="page-link"  href="?page=<?php echo $page-1; ?>">صفحه قبل</a></li>
            <li class="page-item"><a class="page-link pure-menu-selected " href="#"><?php echo ($page + 1 ); ?></a></li>
            <li class="page-item"><a class="page-link" href="?page=<?php echo $page+1; ?>">صفحه بعد</a></li>
        </ul>
    </nav>


</div>
