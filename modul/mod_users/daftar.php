<?php 
include"../../Inc/koneksi.php";
 $aktif= mysql_query("SELECT * FROM users WHERE status='online' LIMIT 10");
 $jum_oll= mysql_num_rows($aktif);
 

  echo "<fieldset>
<legend>$jum_oll User Aktif</legend>"; 		

	$on= mysql_query("SELECT * FROM users ");
	while($r=(mysql_fetch_array($on))){
		$cek=$r[status]=='online';
		if($cek){
				$img="<img src='../img/on.gif'>";
			} else {
				$img="<img src='../img/off.gif'>";
			} echo"<table><tr>
						  <td align='center'>$img</td>
						  <td align='center'><a href=akunview.$r[id_session]><span>$r[nama_lengkap]</span></a></td>
						</tr></table>";
	
	}
	
?> 

 </fieldset>