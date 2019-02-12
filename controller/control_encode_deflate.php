<?php 
/**
 * 
 */
class encode_deflate 
{
	
	function __construct()
	{
		# code...
	}

	public function decodeDeflate($files)
	{
		$filesArray = array();
	    $filesArrayName = array();
	    $filesArray = $files['name'];// $_FILES['file_url'];
	    /*echo "<pre>";
	    var_dump($filesArray);
	    echo count($filesArray);
	    echo "</pre>";
	    */
	   ///*
	    for ($i=0; $i < count($filesArray); $i++)
	    {
	        $fileName = $files['name'][$i];
	        $fileSize= $files['size'][$i];
	        $tempName = $files['tmp_name'][$i];
	        $destination = "uploads/".$fileName;
	        move_uploaded_file($tempName,$destination );
	    }

	    $archiveName = time()."-".$fileName.".gz";
	    $new_name = time()."-".$fileName;
	    $filesArrayName = $files['name'];
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

	        for ($i=0; $i <  count($files['name']); $i++)
	        {
	          $fileName = $files['name'][$i];
	          foreach ($tmpDir as $tmpDirFile)
	          {
	            if ($tmpDirFile == $fileName)
	            {
	              	$zip->addFile("uploads/".$fileName, $new_name);
	            } else {
	            	echo $error;
	            }
	          }
	        }

	        $zip->close();

	        for ($i=0; $i <  count($files['name']); $i++)
	        {
	          $fileName = $files['name'][$i];
	          foreach ($tmpDir as $tmpDirFile)
	          {
	            if ($tmpDirFile == $fileName)
	            {
	              unlink("uploads/".$fileName);
	              //echo "Zip berhasil";
	            }
	            else{
	            	//echo "Zip gagal";
	            }
	          }
	        }
	      } else {
	        echo "Name already exists";
	      }

	      $nama_data = "uploads/".$archiveName;
	      $data = array('nama_data' => $nama_data, 
	      				'asal_file' => $fileName,
	      				'size_asal_file' => $fileSize);
	      return $data ;
	    //*/
	}
}

?>