<?php
    session_start();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="dist/css/login.css">
</head>
<body>
  <div class="container">
    <div class="container-left">
      <img src="dist/img/login.svg" alt="form-login">
      <h1>PT. Sinta Prima Feedmill</h1>
      <p>Inventory Management</p>
    </div>
    <div class="container-right">
      <h2>Enter Username dan Password</h2>
      <form action="include/login_check.php" method="post">
        <div class="input">
          <input type="text" class="form-control" placeholder="ID User" name="id_user" autocomplete="Off">
        </div>        
        <div class="input">
          <input type="password" class="form-control" placeholder="Password" name="password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
      </form> 
    </div>
  </div>
</body>
</html>