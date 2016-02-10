<?php
include "../../Inc/koneksi.php";
$term = strip_tags(substr($_GET['nama'],0, 100));
$term = mysql_escape_string($term); // Attack Prevention
$aksi="../modul/mod_transaksi/aksi_transaksi.php";
if($term=="")
echo "<p class=\"text-error\">Masukan nama Barang yang akan anda cari!";
else{
	
$query = mysql_query("select * from barang where nama like '%$term%'") or die(mysql_error());
$hasil = '';
echo"
<div class=\"panel-body\">
					<div class=\"row\">
						<div class=\"col-lg-12\">";
if (mysql_num_rows($query)){
while($rows = mysql_fetch_array($query)){
$hasil=$hasil." 
					
				<a href='addb.$rows[kode]' class='add' 
				title=\"Harga Rp.$rows[hrg_jual]\">
				$rows[nama]</a><hr>
				
";

	}
} else{
$hasil = " <h4 style='color:red'>Nama barang tidak ditemukan!</h4>";
}
echo"
				</div>
			</div>
	</div>";
echo $hasil;
}
?>