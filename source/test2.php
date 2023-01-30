Rewritten Code: 
session_start(); 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <meta charset="UTF-8"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>Login</title> 
</head> 
<body> 
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $email = trim($_POST['email']); 
    $password = $_POST['password']; 
    $host = "database"; 
    $username = "username";  
    $userpassword = "password";  
    $database = "form_db";  
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        die("Please enter a valid email address"); 
    } 
    if (!$password) { 
        die("Please enter a password"); 
    } 
    $mysqli = new mysqli($host, $username, $userpassword, $database); 
    if ($mysqli->connect_error) { 
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error); 
    }  
    $email = mysqli_real_escape_string($mysqli, $email);
    $password = mysqli_real_escape_string($mysqli, $password);
    $statement = $mysqli->prepare("SELECT * FROM users WHERE email=? AND password=?"); 
    $statement->bind_param('ss', $email, $password); 
    $statement->execute(); 
    $result = $statement->get_result(); 
    $user = $result->fetch_assoc(); 
    if ($user) { 
        $_SESSION['user_id'] = $user['id']; 
        header("Location: home.php"); 
        exit; 
    } else { 
        die("Incorrect email or password"); 
    } 
    $mysqli->close();
} 
?> 
      <form action="" method="POST"> 
            <label for="email" class="text-warning font-weight-bold">Email</label> 
            <input type="email" class="form-control" name="email" placeholder="email@exemple.com" required> 
            <label for="password" class="text-warning font-weight-bold">Password</label> 
            <input type="password" class="form-control" name="password" placeholder="****" required> 
        <input type="submit" name="submit" value="Login" class="btn btn-warning" /> 
      </form> 
</body> 
</html>
