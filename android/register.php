<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	$id_user= $_POST['id_user'];
	$username = $_POST['username'];
	$nama = $_POST['nama'];
	$password= $_POST['password'];
	$level= $_POST['level'];
	$id_fakultas= $_POST['id_fakultas'];
	$id_prodi= $_POST['id_prodi'];
	require_once 'connect.php';

	$sql = "INSERT INTO tbl_user1 (id_user,id_fakultas,id_prodi,nama,username,password,level) VALUES ('$id_user','$id_fakultas','$id_prodi','$nama', '$username', '$password','$level')";
	if (mysqli_query($con, $sql)) 
	{
		$result["success"] = 1;
		$result["message"] = "success";

		echo json_encode($result);
		mysqli_close($con);
	} else {
		$result["success"] = 0;
		$result["message"] = "error";

		echo json_encode($result);
		mysqli_close($con);
	}
}
?>