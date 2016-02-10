<?php
	$file=$_GET['nama_file'];
	
    // header yang menunjukkan nama file yang akan didownload
    header("Content-Disposition: attachment; filename=".$file);

    // header yang menunjukkan ukuran file yang akan didownload
    header("Content-length: ". filesize('./database/'.$file));

    // header yang menunjukkan jenis file yang akan didownload
    header("Content-type: ".$file);

   // proses membaca isi file yang akan didownload dari folder 'data'
   $fp  = fopen("./database/".$file, 'r');
   $content = fread($fp, filesize('./database/'.$file));
   fclose($fp);

   // menampilkan isi file yang akan didownload
   echo $content;

   exit;
?>