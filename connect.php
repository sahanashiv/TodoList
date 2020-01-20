<?php
    $con=new MongoDB\Driver\Manager();
    $res=new MongoDB\Driver\Command(["dbstats"=>1]);
    $bulk= new MongoDB\Driver\BulkWrite;
    $query = new MongoDB\Driver\Query([]);

?>