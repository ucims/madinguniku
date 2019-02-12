
<?php

include_once 'controller/control_login.php';
$coLog = new ControlLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']))
{
	$coLogin = $coLog->madunLogin($_POST);
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="icon" href="asset/images/logo.png">
	<meta name=”viewport” content=”width=device-width; initial-scale=1.0; maximum-scale=1.0;”>
	<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
	<link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="asset/login.css">
	<script src="asset/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="asset/bootstrap/js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="asset/bootstrap/js/popper.min.js"></script>
	<script type="text/javascript" src="asset/bootstrap/js/bootstrap.min.js"></script>
	<script>
	function myPassword(){
		var x = document.getElementById("myInputPassword");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}
	</script>
</head>
<body class="text-center">
    <form class="form-signin" method="post">
      <img class="mb-4" src="asset/images/logo.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Majalah Dinding UNIKU</h1>
			<?php
            if (isset($coLogin))
            {
              echo $coLogin;
            }
      ?>
      <label for="inputUsername" class="sr-only">Username</label>
      <input type="text" id="inputEmail" name="username" class="form-control" placeholder="Username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" id="myInputPassword"  class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" onclick="myPassword()" value="Show-Password"> Show Password
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2018 - Uci Muhamad Sanusi | 2014081110</p>
    </form>
  </body>
</html>
