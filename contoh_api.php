<?php

include_once 'controller/control_decode_deflate.php';
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

	decodeDeflate($file_url);
	$file_name_decode = substr($file_url,0, -3);

	$temp = array();
	$temp['id_post'] = $id_post;
	$temp['judul'] = $judul;
	$temp['tanggal'] = $tanggal;
	$temp['id_prodi'] = $id_prodi;
	$temp['level'] = $level;
	$temp['file_url'] = $file_name_decode;
	$temp['keterangan'] = $keterangan;

	
	

	array_push($product, $temp);
	// echo $file_name_decode;
	// echo "<br>";

}


// echo "<pre>";
echo json_encode($product);


?>