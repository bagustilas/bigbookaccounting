<?php
include "../../Inc/koneksi.php";
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
}elseif($op=='cek'){.
	
    $kd=$_GET['kd'];
    $sql=mysql_query("select * from rekening where kd_rek='$kd'");
    $cek=mysql_num_rows($sql);
    echo $cek;
	
}elseif($op=='update'){
    $kode=$_GET['kode'];
    $nama=htmlspecialchars($_GET['nama']);
    $jenis=htmlspecialchars($_GET['jenis']);
    $satuan=htmlspecialchars($_GET['satuan']);
    $beli=htmlspecialchars($_GET['beli']);
    $jual=htmlspecialchars($_GET['jual']);
    $stok=htmlspecialchars($_GET['stok']);
    $stok_m=htmlspecialchars($_GET['stok_m']);

	
    $update=mysql_query("update rekening set nama='$nama',
						jenis='$jenis',
						satuan='$satuan',
                        hrg_beli='$beli',
                        hrg_jual='$jual',
                        stok='$stok',
                        stok_minim='$stok_m'
                        where kode='$kode'");
    if($update){
        echo "Sukses";
    }else{
        echo "ERROR. . .";
    }
}elseif($op=='delete'){
    $kode=$_GET['kode'];
    $del=mysql_query("delete from rekening where kode='$kode'");
    if($del){
        header('location:'.$uri.'/apotek/rekening');
    }else{
        echo "ERROR";
    }
}elseif($op=='simpan'){
    $kode=$_GET['kode'];
    $nama=htmlspecialchars($_GET['nama']);
    $jenis=htmlspecialchars($_GET['jenis']);
    $satuan=htmlspecialchars($_GET['satuan']);
    $bacth=htmlspecialchars($_GET['bacth']);
    $ed=htmlspecialchars($_GET['ed']);
    $beli=htmlspecialchars($_GET['beli']);
    $stok=htmlspecialchars($_GET['stok']);
    $stok_m=htmlspecialchars($_GET['stok_m']);
	$harga=$beli * 10/100;
	$hasil=$beli+$harga;
    
    $tambah=mysql_query("insert into rekening (kode,nama,jenis,satuan,nobacth,ed,hrg_beli,hrg_jual,stok,stok_minim)
                        values ('$kode','$nama','$jenis','$satuan','$bacth','$ed','$beli','$hasil','$stok','$stok_m')");
    if($tambah){
        echo "sukses";
    }else{
        echo "error";
    }
}
?>