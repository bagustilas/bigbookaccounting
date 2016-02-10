<?php
include "../../configurasi/koneksi.php";
$term = strip_tags(substr($_GET['kd'],0, 100));
$term = mysql_escape_string($term); // Attack Prevention
$aksi="../modul/mod_transaksi/aksi_transaksi.php";
if($term=="")
echo "<p class=\"text-error\">Masukan ID transaksi!";
else{
	
$query = mysql_query("select * from kd_penj where kd_pjl like '%$term%'") or die(mysql_error());
$hasil = '';

if (mysql_num_rows($query)){
while($rows = mysql_fetch_array($query)){
$hasil=$hasil." <div class=\"row\">
	<div class=\"span8\">
		<div class=\"row\">
			<div class=\"span8\">";
				echo"<h4><a href='$aksi?module=transaksi&act=trans_penj&input=add&id=$rows[kode]&harga=$rows[hrg_jual]' class='add' 
				title=\"Harga Rp.$rows[hrg_jual]\">
				<table><td>$rows[kd_pjl]</td><td>$rows[tanggal]</td><td>Rp&nbsp"
				.number_format($rows[total],2,',','.');echo"</td></table></a><hr></h4>";
				
			"</div>
		</div>
</div>
</div>";

}
} else{
$hasil = " <h4 style='color:red'>data transaksi tidak ditemukan!</h4>";
}

echo $hasil;
}
?>