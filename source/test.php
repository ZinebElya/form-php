Rewritten Code:
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $email = trim($_POST['email']); 
    $password = $_POST['password']; 
    $host = "localhost"; 
    $username = "root"; 
    $userpassword = ""; 
    $database = "mydatabase"; 
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        throw new Exception("Please enter a valid email address"); 
    } 
    if (!$password) { 
        throw new Exception("Please enter a password"); 
    } 
    $mysqli = new mysqli($host, $username, $userpassword, $database); 
    if ($mysqli->connect_error) { 
        throw new Exception('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error); 
    }  
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
        throw new Exception("Incorrect email or password"); 
    } 
} 
?>
