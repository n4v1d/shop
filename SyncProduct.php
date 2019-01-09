
<?php

require 'autoload.php';

    $from = $_GET['from'];
    $to = $_GET['to'];

    $sync = new sync();

    $sync->GetProductInfo($from,$to);

    ?>