<?php
include_once 'controller/control_prodi.php';
include_once 'controller/control_fakultas.php';

$prodi = new ControlProdi();

extract($_GET);

$delProdi = $prodi->deleteProdi($id_prodi);
if ($delProdi)
{
  echo"<script> alert('Delete Sucessfull!'); </script>";
  echo"<meta http-equiv='refresh' content='0; url=prodi.php'>";
} else {
  echo"<script> alert('Delete Failled!'); </script>";
  echo"<meta http-equiv='refresh' content='0; url=prodi.php'>";
}
?>
