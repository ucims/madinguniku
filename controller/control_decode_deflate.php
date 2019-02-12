<?php

/**
 * 
 */
class Decode_Deflate {
	
	public function decodeDeflate($file_name)
    {
      /*$buffer_size = 4096;
      $out_file_name = str_replace('.gz', '', $file_name);
      $file = gzopen($file_name, 'rb');
      $out_file = fopen($out_file_name, 'wb');

      while (!gzeof($file)) 
      {
        fwrite($out_file, gzread($file, $buffer_size));
      }

      //echo $out_file;

      fclose($out_file);
      gzclose($file);*/

      $zip = new ZipArchive;
      $res = $zip->open($file_name);
      if ($res ==  true) 
      {
      	$zip->extractTo("uploads/");
      	$zip->close();
      	echo "Woot";
      } else {
      	echo "dont";
      }
    }
}


?>