<?php

include_once 'controller/control_post.php';

$post = new ControlPost();

extract($_GET);

$delPost = $post->deletePost($id_post);
if ($delPost)
{
  echo"<script> alert('Delete Sucessfull!'); </script>";
  echo"<meta http-equiv='refresh' content='0; url=dashboard.php'>";
} else {
  echo"<script> alert('Delete Failled!'); </script>";
  echo"<meta http-equiv='refresh' content='0; url=dashboard.php'>";
}
?>
