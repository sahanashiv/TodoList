<?php 
include "./connect.php";

if(isset($_POST['dlt_id']))
{
    $dlt = $bulk->delete(['_id' => new MongoDB\BSON\ObjectId($_POST['dlt_id'])]);
    $con->executeBulkWrite('TodoList.data',$bulk);
    echo $dlt;
}