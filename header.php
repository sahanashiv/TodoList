<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="home.css">
    <title></title>
</head>
<body>
    <nav>
        <div class="nav-wrapper" id="nav">
        <a class="waves-effect waves-light btn" id="navbtn">Add Task</a>

        <div class="brand-logo center" style="margin-top: 14px;">
            <form action="home.php" method= "GET">
                <div class="search_box">
                    <span style="color: black; line-height: 10px" class="valign-wrapper">
                        <i class="material-icons" style="height: auto; line-height: unset;">search</i>
                    </span>
                    <input type="text" placeholder="search " name="searchTodo" style="height: auto;margin: auto">

                    <input type="submit" hidden name="search_submit">
                </div>
            
            </form>
        </div>
        </ul>
        </div>
    </nav>
