<?php

include_once 'controller/control_user.php';

$user = new ControlUser();

extract($_GET);

$delUser = $user->deleteUser($id_user);
if ($delUser)
{
  echo"<script> alert('Delete Sucessfull!'); </script>";
  echo"<meta http-equiv='refresh' content='0; url=user.php'>";
} else {
  echo"<script> alert('Delete Failled!'); </script>";
  echo"<meta http-equiv='refresh' content='0; url=user.php'>";
}
?>
