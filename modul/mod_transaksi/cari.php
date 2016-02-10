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

$cekingbarang = mysql_query("selet id_product from keranjang");

if (mysql_num_rows($query)){
while($rows = mysql_fetch_array($query)){
$hasil=$hasil." <div class=\"row\">
	<div class=\"span8\">
		<div class=\"row\">
			<div class=\"span8\">";
			if($rows[stok]==0)
			{
				echo"<div class='habis'><h4><a href='#'  
				Onclick=\"return confirm('Stock $rows[nama] Habis')\"
				title=\"Harga Rp.$rows[hrg_jual]\">
				$rows[nama]</a><hr></h4></div>";
			}
			else if ($rows[stok]<$rows[stok_minim])
			{
				
					echo"<div class='minim'><h4><a href='addp-$rows[kode]-harga-$rows[hrg_jual]'  
					class='add' Onclick=\"return confirm('Stock $rows[nama] dalam kondisi minim ')\"
					title=\"Harga Rp.$rows[hrg_jual]\">
					$rows[nama]</a><hr></h4></div>";
				
			}
			else
			{
					echo"<h4><a href='addp-$rows[kode]-harga-$rows[hrg_jual]' class='add' 
					title=\"Harga Rp.$rows[hrg_jual]\">
					$rows[nama]</a><hr></h4>";
	
			}
			"</div>
		</div>
</div>
</div>";

}
} else{
$hasil = " <h4 style='color:red'>Nama barang tidak ditemukan!</h4>";
}

echo $hasil;
}
?>