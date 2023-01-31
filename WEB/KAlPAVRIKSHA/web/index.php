<?php
    $connect = new PDO("mysql:host=localhost;dbname=kv","root","");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css"> 
</head>
<body>
    <div id="frm">
        <form action="" method="post">
                <p>  
                    <label> E-Kalpavriksha. Ask for anything you want. </label>  
                </p>  
                <p>  
                    <input type = "text" id ="password" name  = "password" />  
                </p>  
                <p>     
                    <td><input type="submit" name= "submit" id = "btn" onclick="gfg_run()"></td> 
                </p>  
        </form> 
    </div>
    <script>
        var inputF = document.getElementById("password");

        function gfg_run() {
            var str = inputF.value
            for (let i = 0; i < 3; i++) 
            {
                str = str.replace('flag','');
            }
            document.cookie = "name = " + str;
		}
    </script>
    <?php 
    session_start();

    if(isset($_POST['submit']))
    {
        $name= $_COOKIE['name'];
        $password = $_POST["password"];
        $db = $connect->query("select * from things where name = '$name'");
        $db->execute();
        $row = $db->fetch(PDO::FETCH_ASSOC);

        $flag1 = $row['flag'];
        if($row)
        {
            echo($flag1);
        } 
        else
        {
            header("location:index.php");
        }  
     }
    ?>
</body>
</html>