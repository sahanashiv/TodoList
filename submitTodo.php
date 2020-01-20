<?php include "./connect.php";
    if(isset($_POST['sub']))
    {
        $doc = ['_id' => new MongoDB\BSON\ObjectID, 'name' => $_POST['textbox'], 'msg' => $_POST['msgbox'], 'date' => $_POST['date']];
        $bulk->insert($doc);
        $con->executeBulkWrite('TodoList.data',$bulk);
        header("Location: home.php");
    }
?>




