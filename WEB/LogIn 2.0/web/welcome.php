<?php
    $connect = new PDO("mysql:host=localhost;dbname=login2","root","");
?>

Welcome <?php 
    session_start();
    if(isset($_SESSION['username']))
    {
        echo $_SESSION['username']; 
    }
    else{

        $_SESSION['message'] = "You need to session username";
        header("location:index.php");
    }

    if($_SESSION['username']=="admin")
    { 
        $sql = $connect->query("select * from user where username = '244563'");
        $sql->execute();
        $row = $sql->fetch(PDO::FETCH_ASSOC);

        $pass = $row['password'];
        
    }
        ?>
<h2> You got the flag.</h2>
<br>
<h1><?php
    echo($pass);
?>
</h1>

<form action="" method="post">
    <input type="submit" name="logout" value="logout">
</form>
<?php
    if(isset($_POST['logout'])){
        
        session_destroy();
        header("location:index.php");
    }
?>