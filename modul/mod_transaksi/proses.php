<?php
include "../../Inc/koneksi.php";
include "../../Inc/tanggal.php";
$data=mysql_query("select * from tblbarang");
$op=isset($_GET['op'])?$_GET['op']:null;

if($op=='kode'){
    echo"<option>Kode Barang</option>";
    while($r=mysql_fetch_array($data)){
        echo "<option value='$r[kode]'>$r[kode]</option>";
    }
}elseif($op=='barang'){
    echo'<table id="barang" class="table table-hover">
    <thead>
            <tr>
                <Td colspan="5"><a href="?page=barang&act=tambah" class="btn btn-primary">Tambah Barang</a></td>
            </tr>
            <tr>
                <td>Kode Barang</td>
                <td>Nama Barang</td>
                <td>Harga Beli</td>
                <td>Harga Jual</td>
                <td>Stok</td>
            </tr>
        </thead>';
	while ($b=mysql_fetch_array($data)){
        echo"<tr>
                <td>$b[kode]</td>
                <td>$b[nama]</td>
                <td>$b[hrg_beli]</td>
                <td>$b[hrg_jual]</td>
                <td>$b[stok]</td>
            </tr>";
        }
    echo "</table>";
}elseif($op=='ambildata'){
    $kode=$_GET['jml'];
    $dt=mysql_query("select * from barang where kode='$kode'");
    $d=mysql_fetch_array($dt);
    echo $d['nama']."|".$d['hrg_beli']."|".$d['hrg_jual']."|".$d['stok'];
}elseif($op=='update'){
	 $kode=$_GET['kode'];
	 $tot=$_GET['tot'];
     $update=mysql_query("update kd_pemb set status='Tunai',
											tgl_tempo='',
											tgl_lunas='$tgl_sekarang' 
										where kd_pmb='$kode'");
	$y=mysql_query("update rekening set jumlah=jumlah-$tot where kd_rek='211'")or die (mysql_error());
	$z=mysql_query("update rekening set jumlah=jumlah+$tot where kd_rek='112'")or die (mysql_error());
	$z=mysql_query("update rekening set jumlah=jumlah-$tot where kd_rek='111'")or die (mysql_error());
	$f=mysql_query("insert into master_transaksi set kode_transaksi='$kode', kode_rekening='411', tanggal_transaksi='$tgl_sekarang',keterangan_transaksi='Pembelian Barang',debet='$tot'") or die (mysql_error());
	$b=mysql_query("insert into master_transaksi set kode_transaksi='$kode', kode_rekening='111', tanggal_transaksi='$tgl_sekarang',keterangan_transaksi='Hutang Dagang',kredit='$tot'") or die (mysql_error()); 
    if($update){
        echo "sukses";
    }else{
        echo "ERROR. . .";
    }
}elseif($op=='delete'){
    $kode=$_GET['kode'];
    $del=mysql_query("delete from tblbarang where kode='$kode'");
    if($del){
        echo "sukses";
    }else{
        echo "ERROR";
    }
}elseif($op=='simpan'){
    $kode=$_GET['kode'];
    $nama=htmlspecialchars($_GET['nama']);
    $jual=htmlspecialchars($_GET['jual']);
    $beli=htmlspecialchars($_GET['beli']);
    $stok=htmlspecialchars($_GET['stok']);
    
    $tambah=mysql_query("insert into tblbarang (kode,nama,hrg_beli,hrg_jual,stok)
                        values ('$kode','$nama','$beli','$jual','$stok')");
    if($tambah){
        echo "sukses";
    }else{
        echo "error";
    }
}
?>