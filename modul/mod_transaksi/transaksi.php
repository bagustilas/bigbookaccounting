<?php
$aksi="modul/mod_transaksi/aksi_transaksi.php";
switch ($_GET[act]){
	default:
	
	break;
	case"trans_penj":
?>
<script>	
var thoudelim = ".";
var decdelim = ",";
var curr = "Rp ";
var d = document;


function format(s,r) 
	{
		s = Math.round(s*Math.pow(10,r))/Math.pow(10,r);
		s = String(s);s=s.split(".");
		
		var l=s[0].length;
		var t="";
		var c=0;
		
		while(l>0)
			{
				t=s[0][l-1]+(c%3==0&&c!=0?thoudelim:"")+t;l--;c++;
			}
				s[1]=s[1]==undefined?"0":s[1];
				for(i=s[1].length;i<r;i++) 
					{
						s[1]+="0";
					}
		return curr+t+decdelim+s[1];
	}
function validasi(form){
	
	if (form.nm_dokter.value == ""){
			alert("Anda belum memilih nama dokter");
		return (false);
	}
	return (true);
}

function calc(t,rel,price,ref) 
	{
	if(t.value=="")
		{
			t.value="0";
		}
		if(isNaN(t.value))
		{
			t.value=t.value.substr(0,t.value.length-1);
		}
			else 
			{
				t.value=parseFloat(t.value);
				var ot = d.getElementById("total");
				var os = d.getElementById("sub"+rel);
				var old_total = ot.getAttribute("price")-os.getAttribute("price");
				var new_sub = parseFloat(t.value)*parseFloat(price);

				var y = d.getElementById("stok"+rel);
				var yp = parseFloat(y.getAttribute("rel"));
				var pp = parseFloat(y.getAttribute("ref"));
				var xp = parseInt(t.value);
				var x2p = pp - xp;
	if (xp > pp)
	{
		alert("Penjualan melebihi stok");
		t.value='';
		return false;
	}
		else if(xp < 1)
		{
			alert("tidak boleh 0");
			return false;
			
		}

		os.setAttribute("price",new_sub);
		os.innerHTML=format(new_sub,2);
		ot.setAttribute("price",old_total+new_sub);
		ot.innerHTML=format(old_total+new_sub,2);
	}
}


function hitung()
{
	var ttlbelanja=document.getElementById("totalbelanja").value;
	var tendered=document.getElementById("uang").value;
	var kembali=tendered-ttlbelanja;
	if(kembali < 0)
	{
		kembali = "Uang Belum Cukup";
	}
	var cash=document.getElementById("kembali").innerHTML=kembali;
}
function uangotomatis() 
{
	var ttlbelanja=document.getElementById("totalbelanja").value;
	var kembali=document.getElementById("uang").value=ttlbelanja;
	document.getElementById("kembali").innerHTML=format(kembali,2);
}
function beli()
{
	var hrg = parseInt(documen.getElementById("harga").value);
	var jml = parseInt(documen.getElementById("jml").value);
	var subtotal = hrg * jml;
	if( hrg < 0)
	{
		alert("tidak boleh nol");
		return false;
	}
	if(jml < 0)
	{
		alert("tidak boleh nol");
		return false;
	}
		var sub = document.getElementById("subtotal").innerHTML=subotal;
}


</script>
		
<div class="row">
                <div class="col-lg-9">
                    <div class="panel panel-default">
						<div class="panel-heading">
		 <?php
			$tgl=date('d-m-Y');
			$date=date('Ymd');
			$initial="PJL";
			$auto=mysql_query("select * from penjualan order by id desc limit 1");
			$no=mysql_fetch_array($auto);
			$angka=$no['id']+1;
			
		 echo"
		 <form name='trans_penj' method='POST'  action='$aksi?module=transaksi&act=trans_penj&input=simpan&kode=$initial$angka$date' Onsubmit=\"return validasi(this)\">";
		 ?>				
	    <input type="button" class="btn" data-toggle="modal" data-target="#penjualan" value="Tambah"/>
	   <?php
			
		
			$sid = session_id();
			$no = 1;
			$x=$sql=mysql_query("SELECT * FROM keranjang, barang WHERE id_session='$sid' AND keranjang.id_product=barang.kode AND transaksi='jual' ORDER BY id_keranjang") or die(mysql_error());
			$cek = mysql_num_rows($x);
		
						if($cek > 0){ 
						echo"
							<input class='btn' type='submit' value='Simpan' Onclick=\"alert('Apakah Anda yakin akan menyimpan transaksi ini?')\"  >";
						} else {
						echo "
							<input class='btn' type='button' value='Simpan' Onclick=\"alert('Tambahkan data barang dahulu')\" >";	
						} 
							
	   ?>
                        </div>
						<div class="panel-heading">
					
                        </div>
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
		<div class="form-group">
          <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Item</th>
                                            <th>Satuan</th>
                                            <th>Stok</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php
										while($q=mysql_fetch_array($x)){
										$hrg = $q[hrg_jual];
										$jml = $q[qty];
										$subtotal = $hrg * $jml;
										$total = $total+$subtotal;
									echo"
										<tr>
										<td>$no</td>
										<td>$q[nama]</td>
										<td align='center'>$q[satuan]</td>
										<td  id=\"stok$no\"ref=\"$q[stok]\" rel=\"$q[stok_minim]\" >$q[stok]</td>
										<td><input class=\"form-control\" class=\"jml\" style=\"background:#fff;\"  type=\"text\" name=\"qty[$q[kode]]\" size=\"1\"value=\"$jml\" onkeyup=\"calc(this,'$no',$hrg);\"></td>
										<td>".number_format($q[hrg_jual],2,',','.');echo"</td>
										<td style=\"background:rgb(221, 255, 221);\" id=\"sub$no\"  price=\"$hrg\">".number_format($subtotal,2,',','.');echo"</td>
										<td align='center'><a href=\"delp.$q[id_keranjang]&delp.$q[kode]\" Onclick=\"return confirm('Apakah Anda yakin akan menghapus $q[nama]?')\">
										<span><i class='fa fa-pencil'></i></a></td>
										</tr>";
											$no++;
									}
										
									?>
                                        
                                    </tbody>
									<?php
									echo"<tfooter>
										<td align='right' colspan='6' style=\"background:rgb(221, 255, 221); padding: 0.25em;\"><b>Total<b></td>
										<td id=\"total\" price=\"$total\" style=\"background:rgb(221, 255, 221);\">Rp&nbsp".number_format($total,2,',','.');echo"
										</td><td></td></tfoter>";
									?>
                                </table>
                            </div>
                        </div>
					
		  </div>
	   </div>
			</div>
	</div>
					</div>
			</div>
			
			<div class="col-lg-3">
                    <div class="panel panel-default">
						<div class="panel-heading">
							<label>Total Belanja</label>
<input type="text" size='12'id="totalbelanja" name="totalbelanja" onkeyup="uangotomatis()" class="form-control" />
<label>Uang</label>
<input type="text" size='12' id="uang" name="uang" onkeyup="hitung()" class="form-control"/>
<label>Kembali</label>
<span id="kembali" style='font-size:12pt; margin-left:10px'><span style='margin-left:15px'></span>Rp.0</span>	
                        </div>
				</div> 
			 </div>
			 <div class="col-lg-3">
                    <div class="panel panel-default">
						<div class="panel-heading">
                            Transaksi Penjualan
                        </div>
						<div class="panel-heading">
								
                        </div>
	<div class="panel-body">
		<div class="row">
                <div class="col-lg-12">
		
		<div class="form-group">			
          <label>Dokter</label>
		  <select name="nm_dokter" class="form-control">
            <option value="" selected>- Pilih Dokter -</option>
		  <?php
			$tampil=mysql_query("SELECT * FROM dokter ORDER BY nm_dokter");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_dokter]>$r[nm_dokter]</option>";
            }echo"</select>";?>
		 </div>
					</div>
			</div>
			</form>
			<div class="row">
                <div class="col-lg-12">
		
		<div class="form-group">			
          <label>No. Nota</label> <input type="text" value="<?php echo"$initial$angka$date";?>"  class="form-control" disabled>
		  <label>Tanggal</label> <input type="text" value="<?php echo"$tgl";?>"  class="form-control" disabled>
		 </div>
					</div>
			</div>
				<div class="modal fade" id="penjualan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Tambahkan Item Barang</h4>
                                        </div>
                                        <div class="modal-body">
													<?php
						$pg = '';
						if(!isset($_GET['pg'])) {
							include ('modul/mod_transaksi/form.php');
						}	else {
							$pg = $_GET['pg'];
							$mod = $_GET['mod'];
							include $mod . '/' . $pg . ".php";
						}		
							?>	
										</div>
                                        <div class="modal-footer">
                                              </div>
                                    </div>
                                </div>
                         </div>
	</div>
					</div>
			</div>
	</div> 
<?php
break;
case"trans_pemb":
?>
<script>
function calc(no) {
	var jumlah = $('#jumlah' + no).val();
	var harga = $('#harga' + no).val();
	var subTotal = jumlah * harga;
	var disk = $('#potongan').val();
	$('#sub' + no).html(subTotal);
 
 var total = 0;
 if(disk!="")
  {
	jQuery.each($('.subtotal'), function(indexArr, element) {
		console.log(element.id);
		var subtotal = $('#' + element.id).html();
		total += parseInt(subtotal);
		pot = total - parseInt(disk);
	});
	$('#total').html(pot);
  } 
	else 
	{	jQuery.each($('.subtotal'), function(indexArr, element) {
		console.log(element.id);
		var subtotal = $('#' + element.id).html();
		total += parseInt(subtotal);
		pot = total + parseInt(disk);
	});
	$('#total').html(pot);
  }
}

	
</script>
<div class="row">
                <div class="col-lg-9">
                    <div class="panel panel-default">
						<div class="panel-heading">
		 <?php
			$tgl=date('d-m-Y');
			$date=date('Ymd');
			$initial="PMB";
			$auto=mysql_query("select * from pembelian order by id_transaksi desc limit 1");
            $no=mysql_fetch_array($auto);
            $angka=$no['id']+1;
			
		 echo"
		 <form name='trans_pemb' method='POST' action=\"$aksi?module=transaksi&act=trans_pemb&input=simpan&kode=$initial$angka$date\";>";
		 ?>				
	    <input type="button" class="btn" data-toggle="modal" data-target="#penjualan" value="Tambah"/>
	   <?php
			
		
			$s = session_id();
					$z=$sql=mysql_query("SELECT * FROM keranjang, barang WHERE id_session='$s' AND keranjang.id_product=barang.kode AND transaksi='beli' ORDER BY id_keranjang") or die(mysql_error());
					$cek = mysql_num_rows($z);
					if($cek > 0){ echo"
						<input class='btn'type='submit' value='Simpan'  Onclick=\"return confirm('Apakah Anda yakin akan menyimpan transaksi ini?')\" >";
						} else {
						echo "<input class='btn' type='button' value='Simpan' Onclick=\"alert('Tambahkan data barang dahulu')\" >";	
						} 
						if($cek > 0){
						echo" 
						<a href=\"$aksi?module=transaksi&act=trans_pemb&input=hapus&status=beli\" Onclick=\"return confirm('Apakah Anda yakin akan membatalkan transaksi ini?')\">
						<input class='btn'type='button' value='Batal'></a>";
						} else {
						echo"
						";
						} 
							
	   ?>
                        </div>
						<div class="panel-heading">
					
                        </div>
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
		<div class="form-group">
          <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                         <th>No.</th>
						<th>Nama Barang</th>
						<th>satuan</th>
						<th>No. Batch</th>
						<th>Jumlah</th>
						<th>Harga</th>
						<th>Kadaluarsa</th>
						<th>Subtotal</th>
						<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php
									$sid = session_id();
									$no = 1;
									$x=$sql=mysql_query("SELECT * FROM keranjang, barang WHERE id_session='$sid' AND keranjang.id_product=barang.kode AND transaksi='beli' ORDER BY id_keranjang") or die(mysql_error());
									$cek = mysql_num_rows($x);
									while($q=mysql_fetch_array($x)){
									//start of isi
			echo"
			<td>$no</td> 
			<td>$q[nama]</td>
			<td align='center'>$q[satuan]</td>
			<td align='center'><input type='text' name=\"bacth[$q[kode]]\" class=\"form-control\" value=''/></td>
			<td><input id=\"jumlah$no\" class=\"form-control\" type=\"text\" name=\"qty[$q[kode]]\" onkeyup=\"calc($no);\"size=\"1\"value=\"1\"></td>
			<td><input type='text' class=\"form-control\" id=\"harga$no\" size='12' name=\"harga[$q[kode]]\" onkeyup=\"calc($no);\"></td>
			<td><input type='text' name=\"tgl_kd[$q[kode]]\" class=\"form-control\" value=''/></td>
			<td id=\"sub$no\" class=\"subtotal\" ></td>";
			//end of isi
			echo"<td align='center'><a href=\"$aksi?module=transaksi&act=trans_pemb&input=delete&id=$q[id_keranjang]&kode=$q[kode]\" Onclick=\"return confirm('Apakah Anda yakin akan menghapus $q[nama]?')\">
					<span><i class='fa fa-pencil'></i></a></a></td><tr>
					</tr>";
				$no++;
			}	
										
									?>
                                        
                                    </tbody>
									<tfoot> 
									<tr> 
										<th style="text-align:right" colspan="7">Potongan</th> 
										<th id="tot_bar" colspan="2"><input type="text" name='potongan' id='potongan' onkeyup="calc();"  value='0'  class="form-control"></th>
									</tr> 
									<tr> 
										<th style="text-align:right" colspan="7">Total</th> 
										<th id="tot_bar" colspan="2"><span id="total"></span></th>
									</tr> 
								</tfoot> 
                                </table>
                            </div>
                        </div>
					
		  </div>
	   </div>
			</div>
	</div>
					</div>
			</div>
			 <div class="col-lg-3">
                    <div class="panel panel-default">
						<div class="panel-heading">
                            Transaksi Pembelian
                        </div>
						<div class="panel-heading">
								
                        </div>
	<div class="panel-body">
			<div class="row">
                <div class="col-lg-12">
		
		<div class="form-group">	

		  <label>Supplier</label> 
		  <select name="nm_supplier" class="form-control">
            <option value="0" selected>- Pilih Supplier -</option>
		  <?php
			$tampil=mysql_query("SELECT * FROM supplier ORDER BY nm_supplier");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_supplier]>$r[nm_supplier]</option>";
            }echo"</select>";?>
		  <label>No. Faktur</label> <input type="text" name="no_fak_sup"  value="" placeholder="No. Faktur" class="form-control">
		  <label>Tanggal Faktur</label> <input type="date" name="tgl_fak" placeholder="YYYY-MM-DD" value=""  class="form-control">
          <label>No. Nota</label> <input type="text" value="<?php echo"$initial$angka$date";?>"  class="form-control" disabled>
		  <label>Tanggal</label> <input type="text" value="<?php echo"$tgl";?>"  class="form-control" disabled>
		  <br>
		 
		  <label class="checkbox-inline">
		  <input name='status' id="tunai" type='radio' value='Tunai'></label>
		  <label>Tunai</label>
		 
		   <label class="checkbox-inline">			
		  <input name='status' id="tempo" type='radio' value='Tempo'></label>
		   <label>Tempo</label>
		   
		  <label>Jatuh Tempo</label>
		  <input type="date" name="tgl_tempo" id="tgl_tempo" value="" class="form-control">
		 </div>
					</div>
			</div>
			</form>
				<div class="modal fade" id="penjualan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Tambahkan Item Barang</h4>
                                        </div>
                                        <div class="modal-body">
													<?php
						$pg = '';
						if(!isset($_GET['pg'])) {
							include ('modul/mod_transaksi/formpemb.php');
						}	else {
							$pg = $_GET['pg'];
							$mod = $_GET['mod'];
							include $mod . '/' . $pg . ".php";
						}		
							?>	
										</div>
                                        <div class="modal-footer">
                                              </div>
                                    </div>
                                </div>
                         </div>
	</div>
					</div>
			</div>
	</div> 
<?php
break;
case"detailpelunasan":
		$query=mysql_query("select kd_pemb.kd_pmb,pembelian.id_product,barang.nama,pembelian.ed,pembelian.nobacth,
                                           pembelian.harga,pembelian.jumlah,pembelian.subtotal
                                           from pembelian,kd_pemb,barang
                                           where kd_pemb.kd_pmb=pembelian.id_transaksi and barang.kode=pembelian.id_product
                                           and pembelian.id_transaksi='$_GET[id]'") or die (mysql_error());
		$sup = mysql_fetch_array(mysql_query("SELECT * FROM kd_pemb, supplier WHERE supplier.id_supplier=kd_pemb.id_supplier and status='tempo' and kd_pemb.kd_pmb='$_GET[id]'")) or die ("query gagal");
		$sql = mysql_fetch_array(mysql_query("SELECT * FROM kd_pemb WHERE kd_pmb='$_GET[id]'")) or die ("query gagal");
		$pemilik=mysql_fetch_array(mysql_query("select nm_perusahaan,alamat from bigbook_perusahaan")) or die ("gagal");

?>
<div class="col-md-12 col-sm-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
							<div class="row">
							<?php
								if($sql[status]=='Tempo'){
									echo"<input type=hidden id='kode' value='$sql[kd_pmb]'>
										<input type=hidden id='tot' value='$sql[total]' Onclick=\"return confirm('Apakah Anda yakin akan nelunasi transaksi ini?')\"><a style=\"float:right;\" id='lunas' >Bayar&nbsp<i class='icon-tags'></i></a>&nbsp";
								} else {
									echo"<a style=\"float:right;\">Lunas&nbsp<i class='icon-ok'></i></a>&nbsp";	
								}
							?>
								<div class="col-md-6">
                            <?php
								echo"
									$pemilik[nm_perusahaan]<br>
									$pemilik[alamat]<br><br>
									
									<label>Nota :<span style='margin-left:5px;'>$sql[kd_pmb]</label><br>
									<label>Pembayaran : <span style='margin-left:5px;'>$sql[status]</label><br>
									<label>Jatuh Tempo : <span style='margin-left:5px;'>$sql[tgl_tempo]</label><br>
									<label>Tanggal: <span style='margin-left:5px;'>$sql[tanggal]</label><br>";
					
											?>
							</div>		
					
								<div class="col-md-6">		
								<?php	
									echo"
									<label>Supplier : <span style='margin-left:5px;'>$sup[nm_supplier]</label><br>
									<label>No.faktur : <span style='margin-left:5px;'>$sup[nofaktur]</label><br>
									<label>Tanggal Faktur: <span style='margin-left:5px;'>$sup[tgl_faktur]</label><br>
						
												";
							?>
								</div>		
							</div>	
                        </div>
                        <div class="panel-body">
							<div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                         <th>No.</th>
                                        <th>Kode Barang</th>
                                        <th>No.Batch</th>
                                        <th>Tanggal ED</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
                                       $no=1;
                                while($r=mysql_fetch_row($query)){
                                    echo "<tr>
											<td align='center'>$no</td>
                                            <td align='center'>$r[1]</td>
                                            <td align='center'>$r[4]</td>
                                            <td align='center'>$r[3]</td>
                                            <td>$r[2]</td>
                                            <td>";echo"Rp&nbsp".number_format($r[5],2,',','.');echo"</td>
                                            <td align='center'>$r[6]</td>
                                            <td>";echo"Rp&nbsp".number_format($r[7],2,',','.');echo"</td>
                                        </tr>";
									$no++;
								}?>
										<tr>
											<td colspan="7" style="text-align:right">Total</td><td><?php
												echo"Rp&nbsp".number_format($sql[total],2,',','.');
											?></td>
										</tr>
                                    </tbody>
                                </table>
                            </div>
                        
						</div>
                        <div class="panel-footer">
                          <?php
								echo"* Faktur Pembelian Petugas :$sql[user]";
						  ?>
                        </div>
                    </div>
                </div>
<?php	
	break;
	
}
?>