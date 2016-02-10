<?php
include "../../Inc/koneksi.php";
$op=isset($_GET['op'])?$_GET['op']:null;

if($op=='kode'){
    echo"<option>Kode dokter</option>";
    while($r=mysql_fetch_array($data)){
        echo "<option value='$r[kode]'>$r[kode]</option>";
    }
}elseif($op=='dokter'){
    echo'<table id="dokter" class="table table-hover">
    <thead>
            <tr>
                <Td colspan="5"><a href="?page=dokter&act=tambah" class="btn btn-primary">Tambah dokter</a></td>
            </tr>
            <tr>
                <td>Kode dokter</td>
                <td>Nama dokter</td>
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
    $dt=mysql_query("select * from dokter where kode='$kode'");
    $d=mysql_fetch_array($dt);
    echo $d['nama']."|".$d['hrg_beli']."|".$d['hrg_jual']."|".$d['stok'];
}elseif($op=='cek'){
    $kd=$_GET['kd'];
    $sql=mysql_query("select * from dokter where id_dokter='$kd'");
    $cek=mysql_num_rows($sql);
    echo $cek;
}elseif($op=='update'){
    $kode=$_GET['kode'];
    $nama=htmlspecialchars($_GET['nama']);
    $link=htmlspecialchars($_GET['link']);
    $akses=htmlspecialchars($_GET['akses']);
    $aktif=htmlspecialchars($_GET['aktif']);
    $publis=htmlspecialchars($_GET['publis']);
    
    $update=$waktu=date("d-m-Y H:i:s");
    mysql_query("UPDATE modul SET id_modul   = '$_POST[id]',
								nama_modul = '$nama',
                                link       = '$link',
                                publish    = '$publis',
                                aktif      = '$aktif',
                                status     = '$akses',
                                urutan     = '$urutan',
								tgl        = '$waktu'
                          WHERE id_modul   = '$kode'") or die (mysql_error());
    if($update){
        echo "sukses";
    }else{
        echo "ERROR. . .";
    }
}elseif($op=='delete'){
    $kode=$_GET['kode'];
    $del=mysql_query("delete from dokter where kode='$kode'");
    if($del){
        echo "sukses";
    }else{
        echo "ERROR";
    }
}elseif($op=='simpan'){
	
    $nama=htmlspecialchars($_GET['nama']);
    $link=htmlspecialchars($_GET['link']);
    $akses=htmlspecialchars($_GET['akses']);
    
	$u=mysql_query("SELECT urutan FROM modul ORDER by urutan DESC");
	$d=mysql_fetch_array($u);
	$urutan=$d[urutan]+1;
	$waktu=date("d-m-Y H:i:s");
    
     // Input data modul
    $tambah = mysql_query("INSERT INTO modul(
								 nama_modul,
                                 link,
                                 publish,
                                 aktif,
                                 status,
                                 urutan,
								 tgl
								 ) 
	                       VALUES('$nama',
                                '$link',
                                'Y',
                                'Y',
                                '$akses',
                                '$urutan',
								'$waktu')");
	
	if($tambah){
        echo "sukses";
    }else{
        echo "error";
    }
}
?>