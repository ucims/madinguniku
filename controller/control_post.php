<?php

include_once 'lib/format.php';
include_once 'lib/database.php';
include_once 'controller/control_post.php';
include_once 'controller/control_encode_deflate.php';

class ControlPost
{
  private $format;
  private $database;
  private $encode_deflate;
  public function __construct()
  {
    $this->format = new format();
    $this->database = new Database();
    $this->encode_deflate = new encode_deflate();
  }

  public function getAllPost()
  {
    $query = "SELECT * FROM tbl_post ";
    $result = $this->database->select($query);
    return $result ;
  }

  public function getPostMhs()
  {
    $query = "SELECT * FROM tbl_post WHERE level = 'Mahasiswa' OR level = 'Umum' order by tanggal ";
    $result = $this->database->select($query);
    return $result ;
  }

  public function getPostMhsTi()
  {
    $query = "SELECT * FROM tbl_post WHERE 'Mahasiswa' OR id_prodi = 8 order by tanggal ";
    $result = $this->database->select($query);
    return $result ;
  }

  public function getPostMhsSi()
  {
    $query = "SELECT * FROM tbl_post WHERE level = 'Umum' OR 'Mahasiswa' OR id_prodi = 9 order by tanggal ";
    $result = $this->database->select($query);
    return $result ;
  }

  public function getPostMhsDKV()
  {
    $query = "SELECT * FROM tbl_post WHERE level = 'Umum' OR 'Mahasiswa' OR id_prodi = 17 order by tanggal ";
    $result = $this->database->select($query);
    return $result ;
  }

  public function getPostMhsMi()
  {
    $query = "SELECT * FROM tbl_post WHERE level = 'Umum' OR 'Mahasiswa' OR id_prodi = 10 order by tanggal ";
    $result = $this->database->select($query);
    return $result ;
  }

  public function getPostByProdi($id_prodi)
  {
    $query = "SELECT * FROM tbl_post WHERE id_prodi = '$id_prodi' and level = 'Umum' ";
    $result = $this->database->select($query);
    return $result ;
  }

  public function getPostDosenStaf()
  {
    $query = "SELECT * FROM tbl_post WHERE level = 'Dosen / Staf' or level =  'Umum' order by tanggal ";
    $result = $this->database->select($query);
    return $result ;
  }

  public function getPostById($id_post)
  {
    $query = "SELECT * FROM tbl_post WHERE id_post = '$id_post'";
    $result = $this->database->select($query);
    return $result ;
  }

  public function getLevel($id_post)
  {
    $query = "SELECT sifat, level FROM tbl_post WHERE id_post = '$id_post'";
    $result = $this->database->select($query);
    return $result ;
  }

  public function addPost($data)
  {

    $id_post = mysqli_real_escape_string($this->database->link, $data['id_post']);
    $judul = mysqli_real_escape_string($this->database->link, $data['judul']);
    $tanggal = mysqli_real_escape_string($this->database->link, $data['tanggal']);
    $id_fakultas = mysqli_real_escape_string($this->database->link, $data['id_fakultas']);
    $id_prodi = mysqli_real_escape_string($this->database->link, $data['id_prodi']);
    $level = mysqli_real_escape_string($this->database->link, $data['level']);
    //$file_url = mysqli_real_escape_string($this->database->link, $data['file_url']);
    $keterangan = mysqli_real_escape_string($this->database->link, $data['keterangan']);
    //$sifat = mysqli_real_escape_string($this->database->link, $data['sifat']);

    $id_post = $this->format->validation($id_post);
    $judul = $this->format->validation($judul);
    $tanggal = $this->format->validation($tanggal);
    $id_fakultas = $this->format->validation($id_fakultas);
    $id_prodi = $this->format->validation($id_prodi);
    $level = $this->format->validation($level);
    //$file_url = $this->format->validation($file_url);
    $keterangan = $this->format->validation($keterangan);
    //$sifat = $this->format->validation($sifat);      

    $queryId = "SELECT * FROM tbl_post WHERE id_post = '$id_post'";
    $result = $this->database->select($queryId);
    //compress data
/*    $filesArray = array();
    $filesArrayName = array();
    $filesArray = $_FILES['file_url'];
    for ($i=0; $i < count($filesArray['name']); $i++)
    {
        $fileName = $filesArray['name'][$i];
        $fileSize= $filesArray['size'][$i];
        $tempName = $filesArray['tmp_name'][$i];
        $destination = "uploads/".$fileName;
        move_uploaded_file($tempName,$destination );
    }
    $archiveName = time()."-".$fileName.".gz";
    $new_name = time()."-".$fileName;
    $filesArrayName = $_FILES["file_url"]["name"];
    $zipsDir = scandir("uploads/");
    $error = false;

    foreach ($zipsDir as $zipDirFile )
    {
       if ($zipDirFile == $archiveName)
       {
         $error = true;
         break;
       }
    }
    if ($error == false)
      {
        $tmpDir = scandir("uploads/");
        $zip = new ZipArchive;
        $zip->open("uploads/".$archiveName, ZipArchive::CREATE);

        for ($i=0; $i <  count($filesArray['name']); $i++)
        {
          $fileName = $filesArray['name'][$i];
          foreach ($tmpDir as $tmpDirFile)
          {
            if ($tmpDirFile == $fileName)
            {
              $zip->addFile("uploads/".$fileName, $new_name);
            }
          }
        }

        $zip->close();

        for ($i=0; $i <  count($filesArray['name']); $i++)
        {
          $fileName = $filesArray['name'][$i];
          foreach ($tmpDir as $tmpDirFile)
          {
            if ($tmpDirFile == $fileName)
            {
              unlink("uploads/".$fileName);
            }
          }
        }
      } else {
        echo "Name already exists";
      }

      $nama_data = "uploads/".$archiveName;

*/      
      if ($_FILES['file_url']['name'][0]) 
      {
        $files = $_FILES['file_url'];
        $uploaded = array();
        $failed = array();
        $allowed = array('doc', 'docx', 'odt', 'jpg', 'png', 'pdf', 'txt' , 'bmp');

        if (is_array($files['name']) || is_object($files['name'])) 
        {
          foreach ($files['name'] as $position => $file_name) 
          {
            $file_tmp = $files['tmp_name'][$position];
            $file_size = $files['size'][$position];
            $file_error = $files['error'][$position];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            if (in_array($file_ext, $allowed)) 
            {
              if ($file_error === 0) 
              {
                if ($file_size <= 10485760) //10mb
                {
                  //$new_name = time('mh').'-'. date('dmy').'-'.$file_name;
                  //$file_destination = 'uploads/'.$new_name;

                  $ecode =  $this->encode_deflate->decodeDeflate($files);

                  $nama_data = $ecode['nama_data'];
                  $asal_file = $ecode['asal_file'];
                  $size_asal_file = $ecode['size_asal_file'];
                  
                  //echo "<pre>".$ecode['nama_data']."-". $asal_file."</pre>";
                  //echo "<br><pre>". var_dump($asal_file)."</pre>";

                  $query = "INSERT INTO tbl_post (id_post, judul, tanggal, id_fakultas, id_prodi, level, file_url, keterangan) VALUES (null, '$judul', '$tanggal','$id_fakultas','$id_prodi','$level','$nama_data', '$keterangan')";
                  $row = $this->database->insert($query);
                  if ($row)
                  {
                    $filepath = $_SERVER['DOCUMENT_ROOT'] .'/madinguniku2/';
                    $ukuran = number_format($size_asal_file/1024,2);
                    $ukurangz = number_format(filesize($nama_data)/1024,2);
                    $rasio = (100 - (($ukurangz / $ukuran) * 100));

                    $message = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                      <strong>Success! Adding <b>" . $asal_file . "</b> Size " . $ukuran . " kb, Extract to <b>" . $nama_data. "</b> Size " . $ukurangz ." kb Dengan rasio pemampatan " . $rasio . " % </strong>
                      <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
                      </div>";
                    return $message;

                  } else {
                    $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                      <strong>Failled</strong>
                      <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
                      </div>";
                    return $message;
                  }                
                } else {
                  $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                      <strong>Ukuran file terlalu besar !</strong>
                      <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
                      </div>";
                  return $message;
                }

              } else {
               $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                      <strong>File error !</strong>
                      <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
                      </div>";
               return $message;
              }

            } else {
              $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                      <strong>Ekstensi file tidak diperbolehkan !</strong>
                      <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
                      </div>";
              return $message;
            }
          }
        } else {
          echo "Bukan array";
        }     
      } else {
        $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                      <strong>Tidak ada data</strong>
                      <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
                      </div>";
        return $message;
      }       
    }

    public function updatePost($data,$id_post)
    {
      $id_post = mysqli_real_escape_string($this->database->link, $data['id_post']);
      $judul = mysqli_real_escape_string($this->database->link, $data['judul']);
      $tanggal = mysqli_real_escape_string($this->database->link, $data['tanggal']);
      $id_fakultas = mysqli_real_escape_string($this->database->link, $data['id_fakultas']);
      $id_prodi = mysqli_real_escape_string($this->database->link, $data['id_prodi']);
      $level = mysqli_real_escape_string($this->database->link, $data['level']);
      //$file_url = mysqli_real_escape_string($this->database->link, $data['file_url']);
      $keterangan = mysqli_real_escape_string($this->database->link, $data['keterangan']);
      //$sifat = mysqli_real_escape_string($this->database->link, $data['sifat']);
      //$ubah_file = mysqli_real_escape_string($this->database->link, $data['ubah_file']);

      $id_post = $this->format->validation($id_post);
      $judul = $this->format->validation($judul);
      $tanggal = $this->format->validation($tanggal);
      $id_fakultas = $this->format->validation($id_fakultas);
      $id_prodi = $this->format->validation($id_prodi);
      $level = $this->format->validation($level);
      //$file_url = $this->format->validation($file_url);
      $keterangan = $this->format->validation($keterangan);
      //$sifat = $this->format->validation($sifat);
      //$ubah_file = $this->format->validation($ubah_file);

      if ($data['ubah_file'] == true) 
      {
        // Tidak diganti
        $queryId = "SELECT * FROM tbl_post WHERE id_post = '$id_post'";
        $result = $this->database->select($queryId);
        //unlink
        $data_post = new ControlPost();
        $getPost = $data_post->getAllPost();
        if ($getPost)
        {
          while ($resultPost = $getPost->fetch_array())
          {
            $data_file = $resultPost['file_url'];
            unlink($nama_data);
          }
        }
        //compress data
        if ($_FILES['file_url']['name'][0]) 
        {
          $files = $_FILES['file_url'];
          $uploaded = array();
          $failed = array();
          $allowed = array('doc', 'docx', 'odt', 'jpg', 'png', 'pdf', 'bmp');

          if (is_array($files['name']) || is_object($files['name'])) 
          {
            foreach ($files['name'] as $position => $file_name) 
            {
              $file_tmp = $files['tmp_name'][$position];
              $file_size = $files['size'][$position];
              $file_error = $files['error'][$position];

              $file_ext = explode('.', $file_name);
              $file_ext = strtolower(end($file_ext));

              if (in_array($file_ext, $allowed)) 
              {
                if ($file_error === 0) 
                {
                  if ($file_size <= 10485760) //10mb
                  {
                    //$new_name = time('mh').'-'. date('dmy').'-'.$file_name;
                    //$file_destination = 'uploads/'.$new_name;

                    $ecode =  $this->encode_deflate->decodeDeflate($files);

                    $nama_data = $ecode['nama_data'];
                    $asal_file = $ecode['asal_file'];
                    $size_asal_file = $ecode['size_asal_file'];
                    
                    //echo "<pre>".$ecode['nama_data']."-". $asal_file."</pre>";
                    //echo "<br><pre>". var_dump($asal_file)."</pre>";

                    $query = "UPDATE tbl_post SET judul = '$judul', tanggal = '$tanggal', id_fakultas = '$id_fakultas', id_prodi = '$id_prodi', level = '$level', file_url = '$nama_data', keterangan = '$keterangan' WHERE id_post = '$id_post' ";
                    $row = $this->database->insert($query);
                    if ($row)
                    {
                      /*$message = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Success!</strong>
                        <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
                        </div>";
                      return $message;*/
                      echo"<script> alert('Update Sucessfull!'); </script>";
                        echo"<meta http-equiv='refresh' content='0; url=dashboard.php'>";
                    } else {
                      $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Failled</strong>
                        <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
                        </div>";
                        return $message;
                    }
        
                  } else {
                    $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Ukuran file terlalu besar !</strong>
                        <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
                        </div>";
                    return $message;
                  }

                } else {
                 $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>File error !</strong>
                        <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
                        </div>";
                 return $message;
                }

              } else {
                $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Ekstensi file tidak diperbolehkan !</strong>
                        <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
                        </div>";
                return $message;
              }
            }
          } else {
            echo "Bukan array";
          }     
        } else {
          $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Tidak ada data</strong>
                        <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
                        </div>";
          return $message;
        }         
        
      } else { //tidak di checklist

        $query = "UPDATE tbl_post SET judul = '$judul', tanggal = '$tanggal', id_fakultas = '$id_fakultas', id_prodi = '$id_prodi', level = '$level', keterangan = '$keterangan' WHERE id_post = '$id_post' ";
        $row = $this->database->insert($query);
        if ($row)
        {
            echo"<script> alert('Update Sucessfull!'); </script>";
            echo"<meta http-equiv='refresh' content='0; url=dashboard.php'>";
        } else {
            $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                          <strong>Edit Failled!</strong>
                          <a href='' class='close' data-dismiss='alert' aria-label='Close'>x</a>
                        </div>";
            return $message;
        }  

      }
    }
  


    public function deletePost($id_post)
    {
      $data_post = new ControlPost();
      $getPost = $data_post->getAllPost();
      if ($getPost)
      {
        while ($resultPost = $getPost->fetch_array())
        {

          $data_file_gz = $resultPost['file_url'];
          $data_file = str_replace('.gz', '', $data_file_gz);

          if (is_file($data_file))
          {
            unlink($data_file_gz);
            unlink($data_file);
          } else {
            unlink($data_file_gz);

          }

//          unlink($data_file_gz);
//          unlink($data_file);

          $queryId = "SELECT * FROM tbl_post WHERE id_post = '$id_post' ";
      		$result = $this->database->select($queryId);
      		if ($result)
      		{

      			$query = "DELETE FROM tbl_post WHERE id_post = '$id_post' ";
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

    }
    
}
  

 ?>
