<?php

  include_once 'lib/format.php';
  include_once 'lib/database.php';

  class ControlProdi
  {
    private $format;
    private $database;

    public function __construct()
    {
      $this->format = new Format();
      $this->database = new Database();
    }

    public function getDataProdi($id_prodi)
    {
      $query = "SELECT * FROM tbl_prodi1 WHERE id_prodi = '$id_prodi' ";
      $result = $this->database->select($query);
      return $result;
    }

    public function getAllProdi()
    {
      $query = "SELECT * FROM tbl_prodi1";
      $result = $this->database->select($query);
      return $result;
    }

    public function getProdiByIdFakultas($id_fakultas)
    {
      $query = "SELECT * FROM tbl_prodi1 WHERE id_fakultas = '$id_fakultas' ";
      $result = $this->database->select($query);
      return $result;
    }

    public function getProdiByFakultas($id_prodi,$id_fakultas)
    {
      $query = "SELECT * FROM tbl_prodi1 WHERE id_prodi = '$id_prodi' AND id_fakultas = '$id_fakultas' ";
      $result = $this->database->select($query);
      return $result;
    }

    public function addProdi($data)
  	{
  		$id_prodi = mysqli_real_escape_string($this->database->link, $data['id_prodi']);
      $nama_prodi = mysqli_real_escape_string($this->database->link, $data['nama_prodi']);
  		$id_fakultas = mysqli_real_escape_string($this->database->link, $data['id_fakultas']);

  		$id_prodi = $this->format->validation($id_prodi);
      $nama_prodi = $this->format->validation($nama_prodi);
  		$id_fakultas = $this->format->validation($id_fakultas);

  		$queryId = "SELECT * FROM tbl_prodi1 WHERE id_prodi = '$id_prodi' ";
  		$result = $this->database->select($queryId);

  		if ($result)
  		{
  			$message = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
			  <strong>Id Sudah ada!</strong>
			  <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
				</div>";
  			return $message;
  		} else {
  			$query = "INSERT INTO tbl_prodi1 (id_prodi, nama_prodi, id_fakultas) VALUES ('$id_prodi','$nama_prodi','$id_fakultas')";
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

    public function deleteProdi($id_prodi)
    {
      $queryId = "SELECT * FROM tbl_prodi1 WHERE id_prodi = '$id_prodi' ";
  		$result = $this->database->select($queryId);
      if ($result)
      {
        $query = "DELETE FROM tbl_prodi1 WHERE id_prodi = '$id_prodi' ";
        $row = $this->database->delete($query);
        if ($row)
        {
          $message = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              			  <strong>Insert Success!</strong>
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

    public function editProdi($data,$id_prodi)
    {
      $id_prodi = mysqli_real_escape_string($this->database->link, $data['id_prodi']);
      $nama_prodi = mysqli_real_escape_string($this->database->link, $data['nama_prodi']);
  		$id_fakultas = mysqli_real_escape_string($this->database->link, $data['id_fakultas']);

  		$id_prodi = $this->format->validation($id_prodi);
      $nama_prodi = $this->format->validation($nama_prodi);
  		$id_fakultas = $this->format->validation($id_fakultas);

  		$query = "UPDATE tbl_prodi1 SET nama_prodi = '$nama_prodi', id_fakultas = '$id_fakultas' WHERE id_prodi = '$id_prodi' ";
      $row = $this->database->update($query);
      if ($row)
      {
        echo"<script> alert('Update Sucessfull!'); </script>";
            echo"<meta http-equiv='refresh' content='0; url=prodi.php'>";
        /*$message = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Edit Success!</strong>
                    <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
                    </div>";
          return $message;*/
    	} else {
        $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                      <strong>Edit Failled!</strong>
                      <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
                    </div>";
          return $message;
      }
    }
  }

 ?>
