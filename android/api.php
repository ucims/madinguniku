<?php

include_once '../controller/control_decode_deflate.php';
$decode_deflate = new Decode_Deflate();

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'madinguniku');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (mysqli_connect_errno()) 
{
	die('Unable to connect' . mysqli_connect_errno());
}
$statment = $conn->prepare("SELECT id_post, judul, tanggal,id_prodi, level, file_url, keterangan  FROM tbl_post ;");
//decode 

// $decode_deflate->decodeDeflate($file_name);
// $file_name_decode = substr($file_name,0, -3);

// ob_start();
// $id = $result['id_post']; 
// if (array_key_exists($id, $_POST)) 
// {
//   $file_name = $result['file_url'];
//   $decode_deflate->decodeDeflate($file_name);
//   $file_name_decode = substr($file_name,0, -3);
//   header('content-Disposition: attachment; filename = '.$file_name_decode.' ');
//   header('content-type:application/octent-strem');
//   header('content-length ='.filesize($file_name_decode).'');
//   readfile($file_name_decode);
// }
// $file_uncommpresed = "uploads/".substr($result['file_url'],8, -3);
// //unlink($file_uncommpresed);
// ob_end_flush();

function decodeDeflate($file_name)
{

    $zip = new ZipArchive;
	$res = $zip->open($file_name);
    if ($res ==  true) 
    {
     	$zip->extractTo("uploads/");
      	$zip->close();      	
    } else {
      	echo "dont";
    }
}

$statment->bind_result($id_post, $judul, $tanggal, $id_prodi, $level, $file_url, $keterangan);
$statment->execute();
$product = array();

while ($statment->fetch()) 
{
	$temp = array();
	$temp['id_post'] = $id_post;
	$temp['judul'] = $judul;
	$temp['tanggal'] = $tanggal;
	$temp['id_prodi'] = $id_prodi;
	$temp['level'] = $level;
	$temp['file_url'] = $file_url;
	$temp['keterangan'] = $keterangan;

	decodeDeflate($file_url);
	$file_name_decode = substr($file_url,0, -3);
	

	array_push($product, $temp);
	// echo $file_name_decode;
	// echo "<br>";

}


// echo "<pre>";
echo json_encode($product);
// echo "</pre>";
?>