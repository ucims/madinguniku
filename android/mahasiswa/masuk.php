<?php

if($_SERVER['REQUEST_METHOD']=='POST') {

    $response = array();
    //mendapatakn data
    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once('../koneksi.php');
    //Cek nama pengguna dan password
    $sql = "SELECT * FROM tbl_user1 WHERE username ='$username' AND password = '$password'";
    $response = mysqli_query($con,$sql);

    $result = array();
    $result = mysqli_fetch_array($response);
    if(isset($check)) {
        $response["value"] = 1;
        $response["message"] = "Sukses masuk";
        $response["id_user"] = $check['id_user'];
        $response["nama"] = $check['nama'];
        $response["level"] = "Dosen / Staf";
        echo json_encode($response);
    } else {
        $response["value"] = 0;
       $response["message"] = "Oops! Coba lagi!";
       echo json_encode($response);
    }
    // tutup database
    mysqli_close($con);
} else {
    $response["value"] = 0;
    $response["message"] = "Oops! Coba lagi!";
    echo json_encode($response);
}
/*

if($_SERVER['REQUEST_METHOD']=='POST') 
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM tbl_user1 WHERE username ='$username' AND password = '$password' ";

    $result = mysqli_query($con, $sql);

    $check = mysqli_fetch_array($result);

    if (isset($check)) 
    {
        $result["value"] = 1;
        $result["message"] = "Sukses masuk";
        $result["id_user"] = $check['id_user'];
        $result["nama"] = $check['nama'];
        //$result["level"] = "Dosen / Staf";
        echo json_encode($result);    
    } else {
        $result["value"] = 0;
        $result["message"] = "Oops! Coba lagi!";
        echo json_encode($result);
    }
    
    mysqli_close($con);

}

*/
?>