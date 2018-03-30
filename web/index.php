<?php
include('config.php');
session_start();
if(!isset($_SESSION['username'])) {
  if(isset($_POST['username']) && isset($_POST['username'])) {
    $user = $_POST['username'];
    $pass = md5($_POST['password']);
    $sql = "SELECT * FROM users WHERE username='{$user}' AND passhash='{$pass}'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
    	while ($row = $result->fetch_assoc()) {
        $_SESSION['username'] = $user;
        $_SESSION['id'] = $row['id'];
        header('Location: index.php');
      }
    }
  } else {
    echo('<form method="POST" action="index.php">
    <input type="text" name="username" placeholder="Username"><br>
    <input type="text" name="password" placeholder="Password"><br>
    <input type="submit" value="Sign in">
    </form>
    ');
  }
} else {
  echo("Logged in");
}
?>
