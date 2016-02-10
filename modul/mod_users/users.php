<?php
  $aksi="../modul/mod_users/aksi_users.php";
switch($_GET[act]){
// Tampil User
  default:
    if ($_SESSION[leveluser]=='admin'){
		 $tampil = mysql_query("SELECT * FROM users ORDER BY username");
	?>
<div class="row">
                <div class="col-md-12">
			<div class="panel panel-default">
					 <div class="panel-body">
						<button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                             Tambah User
                            </button>
                        </div>
                        </div>
		  <div class="panel panel-default">
                        <div class="panel-heading">
                             Tabel User
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead><tr>	<th>No.</th>
							<th>Username</th>
							<th>level</th>
							<th>Nama Lengkap</th>
							<th>Email</th>
							<th>No.telp</th>
							<th>blokir</th>
							<th>Aksi</th>
						</tr>
				</thead>
					<tbody>
<?php
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr class='odd gradeX'><td>$no</td>
             <td>$r[username]</td>
             <td>$r[level]</td>
             <td>$r[nama_lengkap]</td>
		         <td><a href=mailto:$r[email]><span>$r[email]</span></a></td>
		         <td>$r[no_telp]</td>
		         <td align=center>$r[blokir]</td>
             <td><a href=akunedit.$r[id_session]><span><i class='fa fa-edit'></i></span></a>|
				<a href='$aksi?module=user&act=hapus&id=$r[username]'  
				Onclick=\"return confirm('Apakah Anda yakin akan menghapus $r[username] dari daftar user?')\">
					<span><i class='fa fa-pencil'></i></span></a></td></tr>";
	  $no++;
		}
		?>
		</tbody>
			<tfoot> 
		<tr> 
				</tr> 
	</tfoot> 
	</table>
	 </div>
	  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Tambah User</h4>
                                        </div>
                                        <div class="modal-body">
											
		<label>Username</label>
		<input type="text" id="username" class="form-control">
        <label>Password</label>
		<input type=password id="password" class="form-control">
		<label>Level</label>
		<select id="level" class="form-control">
										<option value="user">User</option>
										<option value="admin" >Admin</option>
										<option value="" selected >Pilih</option>
								</select> 
        <label>Nama Lengkap</label>
		<input type="text" id="nama_lengkap" size=30 class="form-control">  
		<label>E-mail</label>
		<input type="text" id="email" size=30 class="form-control">
        <label>No.Telp/HP</label>
		<input type="text" id="no_telp" size=20 class="form-control">
		 
										</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button id='simpan_user' class='btn btn-default'>Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
 <?php
	}
	else{
     echo"<div id='peretas'><center><img src='../img/icons/32x32_0400/exclamation.png'><ss><p>$_SESSION[namalengkap]&nbspdilarang mengakses halaman ini.
			<br>TINDAKAN MERTAS SISTEM </p></ss></center></div>";
    }
	
    break;
  
  case "tambahuser":
    if ($_SESSION[leveluser]=='admin'){
    echo "<script type='text/javascript' src=$js></script>
		 <h2><img src='../img/icons/16x16_0460/group.png'>&nbspTambah Pengguna</h2><hr>
          <form name='user' method=POST action='$aksi?module=user&act=input' onSubmit='return validasi(this)'>
		  <div id='tambahuser'>
		  <fieldset>
		  <legend>Registration User </legend>
          <table>
          <tr><td>Username</td>     <td> : <input type=text name='username'></td></tr>
          <tr><td>Password</td>     <td> : <input type=password name='password'></td></tr>
          <tr><td>Nama Lengkap</td> <td> : <input type=text name='nama_lengkap' size=30></td></tr>  
		  <tr><td>E-mail</td>       <td> : <input type=text name='email' size=30></td></tr>
          <tr><td>No.Telp/HP</td>   <td> : <input type=text name='no_telp' size=20></td></tr>
		  <tr rowspan='3'></tr>
          <tr><td colspan='2'><input class='btn' type=submit value=Simpan>
                            <input  class='btn' type=button value=Batal Onclick=self.history.back()></td></tr>
          </table></fieldset></div></form>";
    }
    else{
      echo"<div id='peretas'><center><img src='../img/icons/32x32_0400/exclamation.png'><ss><p>$_SESSION[namalengkap]&nbspdilarang mengakses halaman ini.
			<br>TINDAKAN MERTAS SISTEM </p></ss></center></div>";
    }
     break;
    
  case "edituser":
    $edit=mysql_query("SELECT * FROM users WHERE id_session='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    if ($_SESSION[leveluser]=='admin'){
		?>
			<div class="row">
                <div class="col-lg-5">
                    <div class="panel panel-default">
						<div class="panel-heading">
                            Edit User
                        </div>
						<div class="panel-heading">
								
                        </div>
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
					 <div class="form-group">
		<?php
    echo "
		 
          <input type=hidden id=kode value='$r[id_session]'>
          <label>Username</label>
		  <input type=text id='username' size='20' value='$r[username]' class='form-control'>";
     
		  echo"<label>Level</label>
		  <select id='level'  class='form-control'>";
			if($r[level]=="admin"){					
								echo"<option value='admin' selected>Admin</option>
									<option value='user'>User</option>";
						}else {	echo"<option value='admin' >Admin</option>
									<option value='user' selected>User</option>";
								}echo"</select>";
	
	      echo"
          <label>Nama Lengkap</label>
		  <input type=text id='nama_lengkap' size=20  value='$r[nama_lengkap]' class='form-control'>
          <label>E-mail</label>
		  <input type=text id='email' size=20 value='$r[email]' class='form-control'>
          <label>No.Telp/HP</label>
		  <input type=text id='no_telp' size=13 value='$r[no_telp]' class='form-control'>";

      echo "<label>Blokir</label><select id='blokir' class='form-control'>";
	  if($r[blokir]=="Y"){					
								echo"<option value='Y' selected>Blokir</option>
									<option value='N'>Tidak</option>";
						}else {	echo"<option value='Y' >Blokir</option>
									<option value='N' selected>Tidak</option>";
								}echo"</select>";
    ?>
		 </div>
				<button id="update_user" class="btn">Simpan</button>
               
					</div>
			</div>
	</div>
					</div>
			</div>
	
                <div class="col-lg-5">
                    <div class="panel panel-default">
						<div class="panel-heading">
                            Edit Password
                        </div>
						<div class="panel-heading">
								
                        </div>
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
					 <div class="form-group">
	<?php
    echo "
          
			<input type=hidden id=id value='$r[id_session]'>
		  <label>Password lama</label> 
		  <input type=password id='lama' placeholder='password lama' class='form-control'>
		  <label>Password baru</label> 
		  <input type=password id='baru' placeholder='password baru' class='form-control'>
		  <label>Password sama</label>
		  <input type=password id='sama' placeholder='password baru' class='form-control'>
		  "; 
	?>
		 </div>
				<button id="ubah_user" class="btn">Simpan</button>
               
					</div>
			</div>
	</div>
					</div>
			</div>
	</div>
	<?php		
    } else {
     echo "<h2><img src='../img/icons/16x16_0460/group.png'>&nbspEdit Pengguna</h2><hr>
			<div id='user'>
			<script type='text/javascript' src=$js_u></script>
		  <fieldset>
		  <legend>Edit User </legend>
          <input type=hidden id=kode value='$r[id_session]'>
          <table>
          <tr><td>Username</td>     <td> : <input type=text id='username' value='$r[username]'></td></tr>";
     
		  echo"<tr><td>Level</td>   <td> : <select id='level' style='margin-left:10px;' disabled=disabled>";
			if($r[level]=="admin"){					
								echo"<option value='admin' selected>Admin</option>
									<option value='user'>User</option>";
						}else {	echo"<option value='admin' >Admin</option>
									<option value='user' selected>User</option>";
								}echo"</select> </td></tr>";
	
	      echo"
          <tr><td>Nama Lengkap</td> <td> : <input type=text id='nama_lengkap' size=20  value='$r[nama_lengkap]'></td></tr>
          <tr><td>E-mail</td>       <td> : <input type=text id='email' size=20 value='$r[email]'></td></tr>
          <tr><td>No.Telp/HP</td>   <td> : <input type=text id='no_telp' size=13 value='$r[no_telp]'></td></tr>";

      echo "<tr><td>Blokir</td>     <td> :<select id='blokir' style='margin-left:15px;' disabled=disabled>";
	  if($r[blokir]=="Y"){					
								echo"<option value='Y' selected>Blokir</option>
									<option value='N'>Tidak</option>";
						}else {	echo"<option value='Y' >Blokir</option>
									<option value='N' selected>Tidak</option>";
								}echo"</select></td></tr>";
    
    echo "
          <tr><td colspan=2><input class='btn' type=button id='update' value=Ubah>
                            <input class='btn' type=button value=Batal onclick=self.history.back()></td></tr>
          </table>
		  </fieldset></div>
		  <div id='lama_p'>
		  <fieldset>
		    <legend>Ganti Password</legend>
			<input type=hidden id=id value='$r[id_session]'>
		  <table>
		  <tr><td>Password lama</td>     <td> : <input type=password id='lama' placeholder='password lama'> </td></tr>
		  <tr><td>Password baru</td>     <td> : <input type=password id='baru' placeholder='password baru'> </td></tr>
		  <tr><td>Password sama</td>     <td> : <input type=password id='sama' placeholder='password baru'> </td></tr>
		  </table>
		  <tr><td colspan=2><input class='btn' type=button id='ubah' value=Ubah>
                            <input class='btn' type=button value=Batal onclick=self.history.back()></td></tr></fieldset></div>";
    }
    break; 
	
	case "datauser":
		if ($_SESSION[leveluser]=='admin'){
		 $tampil = mysql_query("SELECT * FROM users ORDER BY username");
	?>
<div class="row">
                <div class="col-md-12">
			<div class="panel panel-default">
					 <div class="panel-body">
			<input class="btn btn-default" type="button" value='Tambah Modul' onclick="window.location.href='tambahmodul';">

                        </div>
                        </div>
		  <div class="panel panel-default">
                        <div class="panel-heading">
                             Tabel User
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead><tr>	<th>No.</th>
							<th>Username</th>
							<th>level</th>
							<th>Nama Lengkap</th>
							<th>Email</th>
							<th>No.telp</th>
							<th>blokir</th>
							<th>Aksi</th>
						</tr>
				</thead>
					<tbody>
<?php
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr class='odd gradeX'><td>$no</td>
             <td>$r[username]</td>
             <td>$r[level]</td>
             <td>$r[nama_lengkap]</td>
		         <td><a href=mailto:$r[email]><span>$r[email]</span></a></td>
		         <td>$r[no_telp]</td>
		         <td align=center>$r[blokir]</td>
             <td><a href=akunedit.$r[id_session]><span><i class='fa fa-edit'></i></span></a>|
				<a href='$aksi?module=user&act=hapus&id=$r[username]'  
				Onclick=\"return confirm('Apakah Anda yakin akan menghapus $r[username] dari daftar user?')\">
					<span><i class='fa fa-pencil'></i></span></a></td></tr>";
	  $no++;
		}
		?>
		</tbody>
			<tfoot> 
		<tr> 
				</tr> 
	</tfoot> 
	</table>
	 </div>
 <?php
	}
	else{
     echo"<div id='peretas'><center><img src='../img/icons/32x32_0400/exclamation.png'><ss><p>$_SESSION[namalengkap]&nbspdilarang mengakses halaman ini.
			<br>TINDAKAN MERTAS SISTEM </p></ss></center></div>";
    }
	break;
	case"lihatuser";
	if ($_SESSION[leveluser]=='admin'){
		 $lihat=mysql_query("SELECT * FROM users WHERE id_session='$_GET[id]'");
		$r=mysql_fetch_array($lihat);
		 echo "<h2><img src='../img/icons/16x16_0460/group.png'>&nbspData Pengguna</h2><hr>
		 <br><br><br>
		<div id='user'>
		  <fieldset>
		  <legend>Profil User </legend>
		  <a href=akunedit.$r[id_session]><span><i class='icon-edit'></i>Edit</span></a>
          <input type=hidden name=id value='$r[id_session]'>
          <table>
          <tr><td>Username</td>     <td> :   $r[username]</td></tr>";
     if ($r[level]=='admin'){     
		  echo"<tr><td>Level</td>   <td> :  admin  </td></tr>";
	 } else if ($r[level]=='user'){
		  echo"<tr><td>Level</td>   <td> :  user</td></tr>";
	 } else {
		  echo"<tr><td>Level</td>   <td> :      </td></tr>";
		} 
		
      echo"
          <tr><td>Nama Lengkap</td> <td> : $r[nama_lengkap]</td></tr>
          <tr><td>Tanggal</td> <td> : $r[tanggal]</td></tr>
          <tr><td>Loggin</td> <td> : $r[jamin]</td></tr>
          <tr><td>Logout</td> <td> : $r[jamout]</td></tr>
          <tr><td>E-mail</td>       <td> : <a href=mailto:$r[email]><span>$r[email]</span></a></td></tr>
          <tr><td>No.Telp/HP</td>   <td> : $r[no_telp]</td></tr>";

    if ($r[blokir]=='N'){
      echo "<tr><td>Blokir</td>     <td> : N </td></tr>";
    }
    else{
      echo "<tr><td>Blokir</td>     <td> : Y</tr>";
    } echo" </table><input class='btn' type=button value=Kembali onclick=\"window.location.href='akun';\"></fieldset></div>";	 
	
  }
	else{
     echo"<div id='peretas'><center><img src='../img/icons/32x32_0400/exclamation.png'><ss><p>$_SESSION[namalengkap]&nbspdilarang mengakses halaman ini.
			<br>TINDAKAN MERTAS SISTEM </p></ss></center></div>";
    }
}

?>