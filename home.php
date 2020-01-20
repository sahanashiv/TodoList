<?php include "header.php"?>
<?php include "connect.php";
    $display_data = $con->executeQuery("TodoList.data",$query);    
?>

<!-- search query -->
<?php
    if(isset($_GET['search_submit']))
    {
        $count = 0;
        $search_err = null;
        $filter = ['name' => $_GET['searchTodo']];
        $search_query =   new MongoDB\Driver\Query($filter);
        $display_data = $con->executeQuery('TodoList.data',$search_query);
        $da = $con->executeQuery('TodoList.data',$search_query);

        foreach ($da as $d) {
            $count += 1;
            // print_r($d);
        }

        if ($count < 1) {
            $search_err= "no result found";
        }
    }
?>
<!-- end search query -->

<div class="body_div">
    <div class="row" id="main_div">  
        <div class="col s6" id="left-div">
            <div class="form-data" id="display" style="background-color: #5a5a5ab0;">
                <form action="submitTodo.php" method="POST">    
                    <div class="row inputform">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="icon_prefix" type="text" class="validate" name="textbox" placeholder="Task Name">
                            <label for="icon_prefix">Task Name</label>
                        </div>
                    </div>
                    <div class="row inputform">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">mode_edit</i>
                            <input id="icon_prefix" type="text" class="validate" name="msgbox" placeholder="Message">
                            <label for="icon_prefix">Message</label>
                        </div>
                    </div>
                    <div class="row inputform">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">perm_contact_calendar</i>
                            <input id="icon_prefix" type="text" class="datepicker" name="date" placeholder="Pick Date">
                            <label for="icon_prefix">Date</label>
                        </div>
                    </div>
                    <button type="submit" name="sub" class="waves-effect waves-light btn " id="subbtn">Submit</button>
                </form>        
            </div>
        </div>
        <div class="col s6" id="right-div">
            <center><span class="flow-text">List Has to be Displayed</span></center>
            <hr>
            
            <div style="height: 89%; overflow-y: scroll;">
            
                <?php if (!isset($search_err) || $search_err == null): ?>

                    <table style="color: white;">
                        <tr>
                        <th>Name</th>
                        <th>Message</th>
                        <th>Date</th>                
                        <th></th>    
                        <th></th>             
                        </tr>
                
                        <?php foreach($display_data as $data): ?>
                            
                            <tr id="<?= $data->_id ?>">
                                <td class="name"> <?= $data->name ?></td>
                                <td class="msg"> <?= $data->msg ?></td>
                                <td class="date"> <?= $data->date ?></td>
                                <td> <button type="button" name="update_btn" class="waves-effect waves-light btn update_form_btn" data-item-id="<?= $data->_id ?>">Update</button></td>
                                
                                <td> <button type="submit" name="delete_btn" class="waves-effect waves-light btn delete_form_btn">Delete</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                <?php else: ?>

                    <div><?= $search_err ?></div>

                <?php endif; ?>
            
            </div>
        </div>
    </div>
</div>


<div class="lightbox hide">
    <div id="myDIV">
        <form action="updateTodo.php" method="POST">    

                    <input type="text" hidden name="item_id" class="update_id">

                    <div class="row inputform">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="icon_prefix" type="text" class="validate update_name" name="update_name" plalceholder="Task Name">
                            <label for="icon_prefix">Task Name</label>
                        </div>
                    </div>
                    <div class="row inputform">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">mode_edit</i>
                            <input id="icon_prefix" type="text" class="validate update_msg" name="update_msg" plalceholder="Message">
                            <label for="icon_prefix">Message</label>
                        </div>
                    </div>
                    <div class="row inputform">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">perm_contact_calendar</i>
                            <input id="icon_prefix" type="text" class="datepicker update_date" name="update_date" plalceholder="Pick Date">
                            <label for="icon_prefix">Date</label>
                        </div>
                    </div>
                    <button type="submit" name="update" class="waves-effect waves-light btn">Update</button>
                    <button type="button" class="waves-effect waves-light btn update_cancel_btn">Cancel</button>
                </form>        
            </div>
        </div>               
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#display").hide();
        $("#navbtn").click(function(){
            $("#display").show();
    });

    $(document).ready(function(){
        $('.datepicker').datepicker();
    });

    $(".update_form_btn, .update_cancel_btn").click(function() {
        $(".lightbox").toggleClass('hide');
    });

    $(".update_form_btn").click(function() {
        var item_id = $(this).attr('data-item-id'),
        name=$("#" + item_id + ">.name").text(),
        msg=$("#" + item_id + ">.msg").text(),
        date=$("#" + item_id + ">.date").text();

        $('.update_id').val(item_id);
        $('.update_date').val(date).focus();
        $('.update_msg').val(msg).focus();
        $('.update_name').val(name).focus();

    })

    $(".delete_form_btn").click(function() {
        var tr_id = $(this).parent('td').parent('tr').attr('id');

        console.log('delete id: ', tr_id);

        $.post(
            'deleteTodo.php',
            { dlt_id : tr_id },
            function (res){
                console.log('delete res: ', res);
                // if(res)
                    $('#' + tr_id).remove()
            })
    })
});
</script>
</body>
</html>




