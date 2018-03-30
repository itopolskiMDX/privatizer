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
    echo('
    <!DOCTYPE html>
    <html>

    <head>

      <meta charset="UTF-8">

      <title>Privatizer - Log-in</title>

      <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">

        <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

    </head>

    <body>

      <div class="login-card">
        <img src="images/spy.png" style="width: 200px; marigin: 0 auto;"><br>
        <h1>Log-in</h1><br>
      <form method="POST" action="index.php">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="login" class="login login-submit" value="login">
      </form>

      <div class="login-help">
        <a href="#">Register</a> • <a href="#">Forgot Password</a>
      </div>
    </div>

    <!-- <div id="error"><img src="https://dl.dropboxusercontent.com/u/23299152/Delete-icon.png" /> Your caps-lock is on.</div> -->

      <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>

    </body>

    </html>
    ');
  }
} else {
  echo("Logged in");
}
?>
