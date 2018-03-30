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
    <html lang="en" >

    <head>
      <meta charset="UTF-8">
      <title>Login Form</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

    </head>

    <body>

      <div class="login">
    	<h1>Login</h1>
        <form method="POST" action="index.php">
        	<input type="text" name="username" placeholder="Username" required="required" />
            <input type="password" name="password" placeholder="Password" required="required" />
            <button type="submit" class="btn btn-primary btn-block btn-large">Let me in.</button>
        </form>
    </div>



        <script src="js/index.js"></script>




    </body>

    </html>
    ');
  }
} else {
  echo("Logged in");
}
?>
