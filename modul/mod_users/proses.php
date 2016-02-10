<?php
include "../../Inc/koneksi.php";
$op=isset($_GET['op'])?$_GET['op']:null;

if($op=='kode'){
    echo"<option>Kode supplier</option>";
    while($r=mysql_fetch_array($data)){
        echo "<option value='$r[kode]'>$r[kode]</option>";
    }
}elseif($op=='supplier'){
    echo'<table id="supplier" class="table table-hover">
    <thead>
            <tr>
                <Td colspan="5"><a href="?page=supplier&act=tambah" class="btn btn-primary">Tambah supplier</a></td>
            </tr>
            <tr>
                <td>Kode supplier</td>
                <td>Nama supplier</td>
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
    $dt=mysql_query("select * from supplier where kode='$kode'");
    $d=mysql_fetch_array($dt);
    echo $d['nama']."|".$d['hrg_beli']."|".$d['hrg_jual']."|".$d['stok'];
}elseif($op=='cek'){
    $kd=$_GET['kd'];
    $sql=mysql_query("select * from supplier where id_supplier='$kd'");
    $cek=mysql_num_rows($sql);
    echo $cek;
}elseif($op=='update'){
	$kode=($_GET['kode']);
    $nama=htmlspecialchars($_GET['nama']);
    $lengkap=htmlspecialchars($_GET['lengkap']);
    $email=htmlspecialchars($_GET['email']);
    $blokir=$_GET['blokir'];
    $level=$_GET['level'];
    $no_telp=htmlspecialchars($_GET['no_tlp']);

    $update=mysql_query("update users set username		 = '$nama',
										  level			 = '$level',
										  nama_lengkap   = '$lengkap',
                                          email          = '$email',
                                          blokir         = '$blokir',  
                                          no_telp        = '$no_telp'
										  where id_session ='$kode'") or die (mysql_error());
    if($update){
        echo "sukses";
    }else{
        echo "ERROR. . .";
    }
}elseif($op=='delete'){
    $kode=$_GET['kode'];
    $del=mysql_query("delete from supplier where kode='$kode'");
    if($del){
        echo "sukses";
    }else{
        echo "ERROR";
    }
}elseif($op=='simpan'){
    
	$nama=htmlspecialchars($_GET['nama']);
    $pass=md5(htmlspecialchars($_GET['pass']));
    $lengkap=htmlspecialchars($_GET['lengkap']);
    $level=htmlspecialchars($_GET['level']);
    $email=htmlspecialchars($_GET['email']);
    $no_telp=htmlspecialchars($_GET['no_tlp']);
          
    $tambah=mysql_query("insert into users (username,
                                 password,
                                 nama_lengkap,
                                 level,
                                 email, 
                                 no_telp,
								 id_session
                                 )
                        values ('$nama','$pass','$lengkap','$level','$email','$no_telp','$pass')");
    if($tambah){
        echo "sukses";
    }else{
        echo "error";
    }
}
elseif($op=='ubah'){
    $kode=($_GET['kode']);
	$lama=md5(htmlspecialchars($_GET['lama']));
	$baru=md5(htmlspecialchars($_GET['baru']));
	$sama=md5(htmlspecialchars($_GET['sama']));
	
	$login=mysql_query("select * from users where id_session='$kode' AND password='$lama'") or die (mysql_error());
	$ketemu=mysql_num_rows($login);
	if($ketemu > 0 AND $baru==$sama){
    $update=mysql_query("update users set password ='$baru' where id_session ='$kode'") or die (mysql_error());
	}
    if($ketemu){
        echo "sukses";
    }else{
        echo "error";
    }
}

?>