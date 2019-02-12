<?php

include_once 'controller/control_fakultas.php';

$fakultas = new ControlFakultas();

extract($_GET);

$delFakultas = $fakultas->deleteFakultas($id_fakultas);
if ($delFakultas)
{
  echo"<script> alert('Delete Sucessfull!'); </script>";
  echo"<meta http-equiv='refresh' content='0; url=fakultas.php'>";
} else {
  echo"<script> alert('Delete Failled!'); </script>";
  echo"<meta http-equiv='refresh' content='0; url=fakultas.php'>";
}
?>
