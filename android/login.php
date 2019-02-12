<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		require_once 'connect.php';
		
		$sql = "SELECT * FROM tbl_user1 where username = '$username' and password = '$password'"; // AND level = 'Mahasiswa' 
		
		$response = mysqli_query($con, $sql);

		$result = array();
		$result['login'] = array();

		if (mysqli_num_rows($response) === 1) 
		{
		 	$row = mysqli_fetch_assoc($response);

		 	if ($password == $row['password']) 
		 	{
		 		$index['nama'] = $row['nama'];
		 		$index['id_user'] = $row['id_user'];
		 		$index['level'] = $row['level'];

		 		$index['id_prodi'] = $row['id_prodi'];
		 		 
		 		array_push($result['login'], $index);
		 		$result['success'] = "1";
		 		$result['message'] = "success";

		 		echo json_encode($result);
		 		mysqli_close($con);
		 	} else {
		 		$result['success'] = "0";
		 		$result['message'] = "error";

		 		echo json_encode($result);
		 		mysqli_close($con);
		 	}
		}
		 
	} else {
		$result['success'] = "0";
		$result['message'] = "error";

		echo json_encode($result);
	}

?>