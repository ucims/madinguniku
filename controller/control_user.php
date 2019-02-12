<?php

	include_once 'lib/format.php';
	include_once 'lib/database.php';

	class ControlUser
	{
		private $format;
		private $database;

		public function __construct()
		{
			$this->format = new Format();
			$this->database = new Database();
		}

		public function getDataUser($id_user)
		{
			$query = "SELECT * FROM tbl_user1 WHERE id_user = '$id_user' ";
			$result = $this->database->select($query);
			return $result;
		}

		public function getAllUser()
		{
			$query = "SELECT * FROM tbl_user1";
			$result = $this->database->select($query);
			return $result;
		}

		public function getUserById($id_user)
		{
			$query = "SELECT * FROM tbl_user WHERE id_user = '$id_user' ";
			$result = $this->database->select($query);
			return $result;
		}

		public function addUser($data)
		{
			$id_user = mysqli_real_escape_string($this->database->link, $data['id_user']);
      		$username = mysqli_real_escape_string($this->database->link, $data['username']);
  			$nama = mysqli_real_escape_string($this->database->link, $data['nama']);
			$id_prodi = mysqli_real_escape_string($this->database->link, $data['id_prodi']);
			$id_fakultas = mysqli_real_escape_string($this->database->link, $data['id_fakultas']);
      		$password = mysqli_real_escape_string($this->database->link, $data['password']);
			$level = mysqli_real_escape_string($this->database->link, $data['level']);

			$id_user = $this->format->validation($id_user);
      		$username = $this->format->validation($username);
  			$nama = $this->format->validation($nama);
			$id_prodi = $this->format->validation($id_prodi);
      		$password = $this->format->validation($password);
  			$id_fakultas = $this->format->validation($id_fakultas);
			$level = $this->format->validation($level);

			$queryId = "SELECT * FROM tbl_user1 WHERE id_user = '$id_user' ";
			$result = $this->database->select($queryId);

			if ($result)
			{
				$message = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
			  <strong>Id Sudah ada!</strong>
			  <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
				</div>";
  			return $message;
			} else {
				$query = "INSERT INTO tbl_user1 (id_user, id_fakultas, id_prodi, nama, username, password,level) VALUES ('$id_user', '$id_fakultas', '$id_prodi', '$nama', '$username', '$password', '$level') ";
				$row = $this->database->insert($query);
				if ($row)
				{
					$message = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              			  <strong>Insert Success!</strong>
              			  <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
              				</div>";
  					return $message;
				} else {
					$message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  										  <strong>Insert Failled!</strong>
  										  <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
  										</div>";
  					return $message;
				}
			}
		}

		public function editUser($data,$id_user)
		{
			$id_user = mysqli_real_escape_string($this->database->link, $data['id_user']);
      $username = mysqli_real_escape_string($this->database->link, $data['username']);
  		$nama = mysqli_real_escape_string($this->database->link, $data['nama']);
			$id_prodi = mysqli_real_escape_string($this->database->link, $data['id_prodi']);
			$id_fakultas = mysqli_real_escape_string($this->database->link, $data['id_fakultas']);
      $password = mysqli_real_escape_string($this->database->link, $data['password']);
			$level = mysqli_real_escape_string($this->database->link, $data['level']);

			$id_user = $this->format->validation($id_user);
      $username = $this->format->validation($username);
  		$nama = $this->format->validation($nama);
			$id_prodi = $this->format->validation($id_prodi);
      $password = $this->format->validation($password);
  		$id_fakultas = $this->format->validation($id_fakultas);
			$level = $this->format->validation($level);

			$query = "UPDATE tbl_user1 SET id_fakultas = '$id_fakultas', id_prodi = '$id_prodi', nama = '$nama', username = '$username', password = '$password', level = '$level'  WHERE id_user = '$id_user' ";
			$row = $this->database->update($query);
			if ($row)
			{
				echo"<script> alert('Update Sucessfull!'); </script>";
	      echo"<meta http-equiv='refresh' content='0; url=user.php'>";
			} else {
				$message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
											<strong>Edit Failled!</strong>
											<a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
										</div>";
					return $message;
			}
		}

		public function deleteUser($id_user)
		{
			$queryId = "SELECT * FROM tbl_user1 WHERE id_user = '$id_user' ";
			$result = $this->database->select($queryId);
			if ($result)
			{
				$query = "DELETE FROM tbl_user1 WHERE id_user = '$id_user' ";
				$row = $this->database->delete($query);
				if ($row)
				{
					$message = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              			  <strong>Delete Success!</strong>
              			  <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
              				</div>";
  					return $message;
				} else {
					$message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  										  <strong>Delete Failled!</strong>
  										  <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
  										</div>";
  					return $message;
				}
			}
		}

	}

?>
