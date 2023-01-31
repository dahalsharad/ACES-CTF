<?php
    $connect = new PDO("mysql:host=localhost;dbname=login2","root","");
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
                    <label> UserName: </label>  
                    <input type = "text" id ="username" name  = "username" />  
                </p>  
                <p>  
                    <label> Password: </label>  
                    <input type = "password" id ="password" name  = "password" />  
                </p>  
                <p>     
                    <td><input type="submit" name= "submit" id = "btn"></td> 
                </p>  
        </form> 
    </div>
    <?php 
    session_start();

    if(isset($_POST['submit']))
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $db = $connect->query("select * from user where username = '$username' && password = '$password'");
        $db->execute();
        $res = $db->fetchAll(PDO::FETCH_OBJ);
        if($res)
        {
            $_SESSION['username'] = $username;
            header("location:welcome.php");
        } 
        else{
            echo "<script>alert('Invalid User')</script>";
        }  
     }
    ?>
</body>
</html>