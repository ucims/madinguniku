<?php
include_once 'lib/database.php';
include_once 'lib/format.php';
include_once 'lib/session.php';

Session::checkLogin();

class ControlLogin
{
  private $fm;
  private $db;

  public function __construct()
  {
    $this->fm = new Format();
    $this->db = new Database();
  }

  public function madunLogin($data)
  {
    $username = mysqli_real_escape_string($this->db->link,$data['username']);
    $password = mysqli_real_escape_string($this->db->link,$data['password']);

    $username = $this->fm->validation($username);
    $password = $this->fm->validation($password);

    $query = "SELECT * FROM tbl_user1 WHERE username = '$username' and password = '$password' ";
    $result = $this->db->select($query);
    if ($result == true) {
      $value = $result->fetch_assoc();

      Session::set('LoginMadun', true);
      Session::set('madunId', $value['id_user']);
      Session::set('madunUser', $value['username']);
      Session::set('madunLevel', $value['level']);
      Session::set('madunProdi', $value['id_prodi']);

      if ($value['level'] == 'Administrator') {
        header("Location:dashboard.php");
      } elseif ($value['level'] == 'Tata Usaha') {
        header("Location:dashboard.php");
      } else {
        $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Akses ditolak</strong>
                    <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
                  </div>";
        return $message;
      }
      
    } else {
      $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Username or Password Salah!</strong>
                    <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
                  </div>";
      return $message;
    }
  }

}

 ?>
