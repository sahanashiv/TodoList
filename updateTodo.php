<?php include "./connect.php";

if(isset($_POST['update']))
{
    $id= $_POST['item_id'];
    $name = $_POST['update_name'];
    $msg = $_POST['update_msg'];
    $date =$_POST['update_date'];
    
     $store = $bulk->update(
         ['_id'=> new MongoDB\BSON\ObjectID($_POST['item_id'])],
         [
             '$set' =>  [
                 'msg' => $msg,
                 'date'=> $date
                ]
        ]); 
        print_r($store);
        $stor=$con->executeBulkWrite('TodoList.data', $bulk); 
       
        header("Location: home.php");
}
?>

