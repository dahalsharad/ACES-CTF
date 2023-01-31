<?php
    $connect = new PDO("mysql:host=localhost;dbname=test","root","");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <fieldset>
        <legend><marquee  direction="to-left">Register</marquee></legend>
<form action="" method="post">
        <table>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" id="username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="text" name="password" id="password"></td>
            </tr>
            <tr>
                <td><input type="submit" name= "submit"></td>
            </tr>
            </table>
    </form> 
    </fieldset>
    <?php 
    if(isset($_POST['submit']))
    {
        $username = $_POST["username"];
        // echo $f_username =  rand(1,900).md5($username).rand(1,100);
        $password = md5($_POST["password"]);
        $sql = $connect->prepare("insert into user(username,password) values(?,?)");
        $sql->execute([$username,$password]);
     }
    ?>
</body>
</html>