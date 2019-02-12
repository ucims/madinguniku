<?php

include_once 'lib/format.php';
include_once 'lib/database.php';

class ControlFakultas
{

	private $format;
	private $database;

	public function __construct()
	{
		$this->format = new Format();
		$this->database = new Database();
	}

	public function getDataFakultas($id_fakultas)
	{
		$query = "SELECT * FROM tbl_fakultas1 WHERE id_fakultas = '$id_fakultas' ";
		$result = $this->database->select($query);
		return $result;
	}

	public function getAllFakultas()
	{
		$query = "SELECT * FROM tbl_fakultas1 ";
		$result = $this->database->select($query);
		return $result;
	}

	public function getFakultasById($id_fakultas)
	{
		$query = "SELECT * FROM tbl_fakultas1 WHERE id_fakultas = '$id_fakultas' ";
		$result = $this->database->select();
		return $result;
	}

	public function addFakultas($data)
	{
		$id_fakultas = mysqli_real_escape_string($this->database->link, $data['id_fakultas']);
		$nama_fakultas = mysqli_real_escape_string($this->database->link, $data['nama_fakultas']);

		$id_fakultas = $this->format->validation($id_fakultas);
		$nama_fakultas = $this->format->validation($nama_fakultas);

		$queryId = "SELECT * FROM tbl_fakultas1 WHERE id_fakultas = '$id_fakultas' ";
		$result = $this->database->select($queryId);

		if ($result)
		{
			$message = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
									<strong>Id Sudah ada!</strong>
									<a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
									</div>";
			return $message;
		} else {
			$query = "INSERT INTO tbl_fakultas1 (id_fakultas, nama_fakultas) VALUES ('$id_fakultas','$nama_fakultas')";
			$row = $this->database->insert($query);
			if ($row)
			{
				$message = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Success!</strong>
                    <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
                    </div>";
          return $message;
			} else {
				$message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
										  <strong>Failled!</strong>
										  <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
										</div>";
					return $message;
			}
		}
	}

	public function  editFakultas($data,$id_fakultas)
	{
		$id_fakultas = mysqli_real_escape_string($this->database->link, $data['id_fakultas']);
		$nama_fakultas = mysqli_real_escape_string($this->database->link, $data['nama_fakultas']);

		$id_fakultas = $this->format->validation($id_fakultas);
		$nama_fakultas = $this->format->validation($nama_fakultas);

		$query = "UPDATE tbl_fakultas1 SET nama_fakultas = '$nama_fakultas' WHERE id_fakultas = '$id_fakultas' ";
		$row = $this->database->update($query);
		if ($row)
		{
			$message = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
										<strong>Success!</strong>
										<a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
									</div>";
			return $message;
		} else {
			$message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
										<strong>Update Failled!</strong>
										<a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
									</div>";
				return $message;
		}
	}

	public function deleteFakultas($id_fakultas)
	{
		$queryId = "SELECT * FROM tbl_fakultas1 WHERE id_fakultas = '$id_fakultas' ";
		$result = $this->database->select($queryId);
		if ($result)
		{
			$query = "DELETE FROM tbl_fakultas1 WHERE id_fakultas = '$id_fakultas' ";
			$row = $this->database->delete($query);
			if ($row)
			{
				$message = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
											<strong>Success!</strong>
											<a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
										</div>";
				return $message;
			} else {
				$message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
										  <strong>Failled!</strong>
										  <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
										</div>";
					return $message;
			}
		}
	}

}
 ?>
