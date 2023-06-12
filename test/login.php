<?php
session_start();
include("../php/admin/util.inc.php");
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
           $login = $_POST["loginname"];
           $passwordhash = passwordHash($_POST["password"]);
           

           $conn = new_db_connect();
            $sql = "SELECT * FROM user WHERE LoginName = ? and PasswortHash = ? ";
            $stmt = $conn->prepare($sql);
           $stmt->bind_param("ss", $login, $passwordhash);
          
           $stmt->execute();
           $result = $stmt->get_result();
                   
          $rowCount = mysqli_num_rows($result);
            
            if ($rowCount > 0) {
                    
                    $_SESSION["user"] = "yes";
                    $_SESSION["username]"] = $login;
                    header("Location: ../index.html");
                    die();
                }else{
                    echo $login;
                   
                    echo "<div class='alert alert-danger'>Anmeldedaten stimmen nicht !</div>";
                }
            }
        
        ?>
      <form action="login.php" method="post">
        <div class="form-group">
            <input type="text" placeholder="Enter Login name:" name="loginname" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" placeholder="Enter Password:" name="password" class="form-control">
        </div>
        <div class="form-btn">
            <input type="submit" value="Login" name="login"class="btn btn-primary">
        </div>
      </form>
     <div><p>Not registered yet <a href="registration.php">Register Here</a></p></div>
    </div>
</body>
</html>