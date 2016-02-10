<?php
include "../../Inc/koneksi.php";
include "../../Inc/tanggal.php";

$op=isset($_GET['op'])?$_GET['op']:null;

if($op=='kode'){
    echo"<option>Kode rekening</option>";
    while($r=mysql_fetch_array($data)){
        echo "<option value='$r[kode]'>$r[kode]</option>";
    }
}elseif($op=='rekening'){
    echo'<table id="rekening" class="table table-hover">
    <thead>
            <tr>
                <Td colspan="5"><a href="?page=rekening&act=tambah" class="btn btn-primary">Tambah rekening</a></td>
            </tr>
            <tr>
                <td>Kode rekening</td>
                <td>Nama rekening</td>
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
    $kode=$_GET['kode'];
    $dt=mysql_query("select * from rekening where kode='$kode'");
    $d=mysql_fetch_array($dt);
    echo $d['nama']."|".$d['hrg_beli']."|".$d['hrg_jual']."|".$d['stok'];
}elseif($op=='cek_kd'){
    $kd=$_GET['kd'];
    $sql=mysql_query("select * from rekening where kd_rek='$kd'");
    $cek=mysql_num_rows($sql);
    echo $cek;
}elseif($op=='update'){
    $kode=$_GET['kode'];
    $nama=htmlspecialchars($_GET['nama']);
    $jenis=htmlspecialchars($_GET['jenis']);
    $jumlah=htmlspecialchars($_GET['jumlah']); 
    
    $update=mysql_query("update rekening set nama_rekening='$nama',
											 jenis='$jenis',
											 jumlah='$jumlah'
											 where kd_rek='$kode'") or die (mysql_error());
    if($update){
        echo "sukses";
    }else{
        echo "ERROR. . .";
    }
}elseif($op=='updatepost'){
	
	
    $kode=$_GET['kode'];
    $idby=$_GET['idby'];
    $nama=htmlspecialchars($_GET['nama']);
    $jenis=htmlspecialchars($_GET['jenis']);
    $jumlah=htmlspecialchars($_GET['jumlah']); 
    
    $update=mysql_query("update rekening set nama_rekening='$nama',
											 jenis='$jenis',
											 jumlah='$jumlah'
											 where kd_rek='$kode'") or die (mysql_error());
	
	
	
	$insert = mysql_query("insert into biaya set id_biaya='$idby', kd_biaya='$kode', tanggal='$tgl_sekarang', jumlah='$jumlah', jenis='$jenis'") or die ("biaya gagal");
											 
	$post=mysql_query("insert into master_transaksi set kode_transaksi='$idby', kode_rekening='111', tanggal_transaksi='$tgl_sekarang',
						keterangan_transaksi='Kas',debet='$jumlah' ") or die (mysql_error()); 
						
	$post=mysql_query("insert into master_transaksi set kode_transaksi='$idby', kode_rekening='$kode', tanggal_transaksi='$tgl_sekarang',
						keterangan_transaksi='$nama',kredit='$jumlah' ") or die (mysql_error()); 
						
    if($update){
        echo "Sukses";
    }else{
        echo "ERROR. . .";
    }
}elseif($op=='delete'){
    $kode=$_GET['kode'];
    $del=mysql_query("delete from rekening where kd_rek='$kode'");
    if($del){
        header('location:'.$uri.'rekening');
    }else{
        echo "ERROR";
    }
}elseif($op=='simpan'){
    $kode=$_GET['kode'];
    $nama=htmlspecialchars($_GET['nama']);
    $jenis=htmlspecialchars($_GET['jenis']);
    $jumlah=htmlspecialchars($_GET['jumlah']); 
    
    $tambah=mysql_query("insert into rekening (kd_rek,nama_rekening,jenis,jumlah)
                        values ('$kode','$nama','$jenis','$jumlah')");
    if($tambah){
        echo "sukses";
    }else{
        echo "error";
    }
}
?>