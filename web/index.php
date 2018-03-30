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
    echo('<!DOCTYPE html>
        <html lang="en" >

        <head>
          <meta charset="UTF-8">
          <title>PPrivatizer - Login</title>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
          <link rel="stylesheet prefetch" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900">
          <link rel="stylesheet prefetch" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
          <link rel="stylesheet prefetch" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
          <link rel="stylesheet" href="css/style.css">
        </head>

        <body>

        <div class="container">
          <div class="info">
            <h1>Privatizer</h1>
          </div>
        </div>

        <div class="form">
          <div class="thumbnail"><img src="images/spy.png"/></div>
          <form class="register-form" method="POST" action="index.php">
            <input type="text" name="username" placeholder="name"/>
            <input type="password" name="password" placeholder="password"/>
            <input type="text" placeholder="email address"/>
            <button>create</button>
            <p class="message">Already registered? <a href="#">Sign In</a></p>
          </form>
          <form class="login-form" method="POST" action="index.php">
            <input type="text" name="username" placeholder="name"/>
            <input type="password" name="password" placeholder="password"/>
            <button>login</button>
            <!--<p class="message">Not registered? <a href="#">Create an account</a></p>-->
          </form>
        </div>
          <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <script  src="js/index.js"></script>
        </body>
        </html>
    ');
  }
} else {
  echo("Logged in");
}
?>
