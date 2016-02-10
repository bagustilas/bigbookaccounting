/**
********************app-apotek.js *********************************
** @Dibuat oleh :	Bagus T. Hidayatullah 				   	******
** @Tanggal 	:	7 april 2013 21:55 WIB					******
** @Model 	    :	CMS.Accounting for busines				******
** @Version	    :	bigbookaccounting.v.12					******
** @Call	    :	www.facebook.com/bagustilash			******
** @Project	    :	bigbookaccoungting						******
##################################################################	
	Discripsi:
 * ini adalah sebuah applikasi PHP diperuntukan untuk akuntansi.
 * di gunakan pada pembukuan akuntansi dan persediaan.
 * dengan pengontrolan penuh pada semua kegiatan transaksi.
 
****Copyright 2013 Bagus T.Hidayatullah, all rights reserved.*****
*/

(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {
	
	$("#lunas").click(function(){
		if(confirm("Kami menggangap anda sudah membayar, Apakah Anda yakin?")) 
	{
	kode=$("#kode").val();
	tot=$("#tot").val();
	$("#status").html('sedang diupdate. . .');
		$("#loading").show();
		$("#back").show();
      $.ajax({
		url:"modul/mod_transaksi/proses.php",
        data:"op=update&kode="+kode+"&tot="+tot,
        cache:false,
        success:function(msg){
        if(msg=='sukses'){
		$("#status").html("<div class='alert alert-success'><strong>Berhasil</strong> Pembayaran Berhasil</div>");
			window.location.href='http://localhost/apotek/jurnal.hutang';
         }else{
           $("#status").html("<div class='alert alert-info'><strong>Oops</strong> Pembayarn Gagal</div>");
		}
		$("#loading").hide(10000);$("#back").hide(1000);
			}
		});
		}
		return false;
	});
	
	$("#tunai").click(function(){
		document.getElementById("tgl_tempo").disabled = true;
	});	
	
    $("#tempo").click(function(){
		document.getElementById("tgl_tempo").disabled = false;
	});		
	
		// ketika tombol simpan ditekan
	$("#masuk").click(function(){
		
			// mengambil nilai dari inputbox, textbox dan select
			var user = $('input:text[name=username]').val();
			var pass = $('input:password[name=password]').val();
			
			// mengirimkan data ke berkas transaksi.input.php untuk di proses
	$.ajax({
		url:"login",
        data:"user="+user+"&pass="+pass,
        cache:false,
        success:function(msg){
		if(msg=='sukses'){
				$("#status").html("Sedang Memuat. . .<meta http-equiv='refresh' content='3; url=home'>");
				$("#status").css('color','#000');
					window.location.href='';
		} else {
			$("#status").html('<div class="alert alert-danger"><strong>Username atau Password Anda salah</strong></div>');
			$("#status").css('color','#000');
			$("#username").val("");
			$("#password").val("");
		}

			$("#back").fadeOut(5000);
			$("#loading").fadeOut(5000);
		}
			});
		});
		
					
					var main_rek = "modul/mod_jurnal/form_rekening.php";
					$("#data-rekening").load(main_rek);
					
					var tutup = "tutup.php";
					$("#tutup-data").load(tutup);	
					
					
					
					/**
		script kode untuk form master barang
		fungsi js 
			@simpan
			@edit
			@hapus
			@cekkode
	 **/
				//cek kode barang yang sudah ada
                    $("#kode2").change(function(){
                        var kd=$("#kode2").val();
                        
                        $.ajax({
                            url:"modul/mod_barang/proses.php",
                            data:"op=cek&kd="+kd,
                            success:function(data){
                                if(data==0){
                                  
                                }else{
                                    alert("kode barang bisa sudah ada");
									$("#kode2").val("");
                                }
                            }
                        });
                    });
				
					
				$("#persen").keyup(function(e){
					var beli = $("#beli").val();
					var persen = $('#persen').val();
					var hyper = (persen/100) * beli;
					var hja = parseInt(beli) + parseInt(hyper);
						$("#jual").val(hja);
						});
						
				//simpan master barang
                    $("#simpan").click(function(){
                        kode=$("#kode2").val();
                        nama=$("#nama").val();
                        jenis=$("#jenis").val();
						satuan=$("#satuan").val();
						bacth=$("#bacth").val();
						ed=$("#kadaluarsa").val();
                        beli=$("#beli").val();
                        stok=$("#stok").val();
                        stok_m=$("#stok_m").val();
                        
						if(kode==""){
                            alert("Kode barang Harus diisi");
                            exit();
                        } 
						if(nama==""){
                            alert("nama barang Harus diisi");
                            exit();
						} 
						if(jenis==""){
                            alert("jenis barang Harus dipilih");
                            exit();
						} 
						if(satuan==""){
                            alert("satuan barang Harus diisi");
                            exit();
						} 
						
						
                        $("#status").html("sedang diproses. . .");
                        $("#loading").show();
                        $("#back").show();
                        
                        $.ajax({
                            url:"modul/mod_barang/proses.php",
                            data:"op=simpan&kode="+kode+"&nama="+nama+"&jenis="+jenis+"&satuan="+satuan+"&bacth="+bacth+"&ed="+ed+"&beli="+beli+"&stok="+stok+"&stok_m="+stok_m,
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
                                     $("#status").html("<div class='alert alert-success'><strong>Berhasil</strong> Data barang telah berhasil di simpan di master barang.</div>");
										window.location.href='barang';
                                }else{
                                    $("#status").html("<div class='alert alert-info'><strong>Oops</strong> terjadi kesalahan inputan.</div>");
								}
                                $("#loading").fadeOut(1000);
								$("#back").fadeOut(1000);
								$("#barang").slideUp(1000);
                                $("#nama").val("");
                                $("#jual").val("");
                                $("#satuan").val("");
								$("#bacth").val("");
								$("#kadaluarsa").val("");
                                $("#beli").val("");
                                $("#stok").val("");
                                $("#stok_m").val("");
                                $("#kode2").val("");
                            }
                        });
                    });
					
				//ketika tombol update di klik
                    $("#update_barang").click(function(){
                        //cek apakah kode barang kosong atau tidak
                        kode=$("#kode").val();
                        nama=$("#nama").val();
						jenis=$("#jenis").val();
						satuan=$("#satuan").val();
                        beli=$("#beli").val();
                        jual=$("#jual").val();
                        stok=$("#stok").val();
                        stok_m=$("#stok_m").val();
                        if(kode==""){
                            alert("Kode barang Harus diisi");
                            exit();
                        } 
						if(nama==""){
                            alert("nama barang Harus diisi");
                            exit();
						} 
						if(satuan==""){
                            alert("satuan barang Harus diisi");
                            exit();
						} 
						if(jenis==""){
                            alert("Jenis Barang Harus di pilih");
                            exit();
						} 
						if(beli==""){
                            alert("harga beli barang Harus diisi");
                            exit();
						} 
						if(jual==""){
                            alert("harga jual barang Harus diisi");
                            exit();
						} 
						if(stok==""){
                            alert("stok barang Harus diisi");
                            exit();
                        }
						if(stok_m==""){
                            alert("stok minim barang Harus diisi");
                            exit();
                        }
                        //tampilkan status update
                        $("#status").html('sedang diupdate. . .');
                        $("#loading").show();
                        $("#back").show();
                        
                        $.ajax({
                            url:"modul/mod_barang/proses.php",
                            data:"op=update&kode="+kode+"&nama="+nama+"&jenis="+jenis+"&satuan="+satuan+"&beli="+beli+"&jual="+jual+"&stok="+stok+"&stok_m="+stok_m,
                            cache:false,
                            success:function(msg){
                                if(msg=="Sukses"){
                                     $("#status").html("<div class='alert alert-success'><strong>Berhasil</strong> Data barang telah berhasil di update di master barang.</div>");
										window.location.href='barang';
                                }else{
                                    $("#status").html("<div class='alert alert-info'><strong>Oops</strong> terjadi kesalahan inputan"+msg+".</div>");
								}
                                $("#loading").fadeOut(3000);
								$("#back").fadeOut(3000);
                                $("#nama").val("");
                                $("#satuan").val("");
                                $("#jual").val("");
                                $("#beli").val("");
                                $("#jual").val("");
                                $("#stok").val("");
                                $("#stok_m").val("");
                                $("#kode").val("");
                            }
                        });
                    });
                    
                    //ketika tombol hapus diklik
                    $(".hapus").click(function(){
                        kode=$("#kode").val();
                        if(kode=="Kode Barang"){
                            alert("Kode barang belim dipilih");
                            exit();
                        }
                        $("#status").html('Sedang Dihapus. . .');
                        $("#loading").show();
                        
                        $.ajax({
                            url:"modul/mod_barang/proses.php",
                            data:"op=delete&kode="+kode,
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
                                    $("#status").html('Berhasil Dihapus. . .');
                                }else{
                                    $("#status").html('ERROR. . .');
                                }
                                $("#nama").val("");
                                $("#jual").val("");
                                $("#beli").val("");
                                $("#stok").val("");
                                $("#barang").load("proses.php","op=barang");
                                $("#kode").load("proses.php","op=kode");
                                
                            }
                        });
                    });	
					
		 /**
		 script kode untuk form master supplier
		 fungsi js 
			@simpan
			@edit
			@hapus
			@cekkode
		**/
		

                    //cek kode supplier yang sudah ada
                    $("#id_supplier").change(function(){
                        var kd=$("#id_supplier").val();
                        
                        $.ajax({
                            url:"modul/mod_supplier/proses.php",
                            data:"op=cek&kd="+kd,
                            success:function(data){
                                if(data==0){
                                    $("#pesan").html('Kode supplier Bisa digunakan');
                                    $("#id_supplier").css('border','3px #090 solid');
                                }else{
                                    $("#pesan").html('Kode supplier sudah ada');
                                    $("#id_supplier").css('border','3px #c33 solid');
									$("#id_supplier").val("");
                                }
                            }
                        });
                    });
                    
                    //ketika tombol update di klik
                    $("#update_sp").click(function(){
						kode=$("#id_supplier").val();
                        nama=$("#nm_supplier").val();
                        kota=$("#kota").val();
                        alamat=$("#alamat").val();
                        no_hp=$("#no_hp").val();
						
						if(kode==""){
                            alert("Kode supplier Harus diisi");
                            exit();
                        } 
						if(nama==""){
                            alert("nama supplier Harus diisi");
                            exit();
						} 
						if(kota==""){
                            alert("kota supplier Harus diisi");
                            exit();
						} 
						if(alamat==""){
                            alert("alamat supplier Harus diisi");
                            exit();
						}
						if(no_hp==""){
                            alert("no.Telp supplier Harus diisi");
                            exit();
                        }
						
                        $("#status").html("sedang update. . .");
                        $("#loading").show();
						 $("#back").show();
                        
                        $.ajax({
                            url:"modul/mod_supplier/proses.php",
                            data:"op=update&kode="+kode+"&nm_supplier="+nama+"&kota="+kota+"&alamat="+alamat+"&no_hp="+no_hp,
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
									$("#status").html("<i class='icon-ok' style='margin-right:10px;'></i>Berhasil disimpan");
										window.location.href='supplier'
                                }else{
                                    $("#status").html("<i class='icon-warning-sign' style='margin-right:10px;'></i>Gagal disimpan");
                                }
                                $("#loading").fadeOut(3000);
								$("#back").fadeOut(3000);
                                 $("#nm_supplier").val("");
                                $("#kota").val("");
                                $("#alamat").val("");
                                $("#no_hp").val("");
                                $("#id_supplier").val("");
                            }
                        });
                    });
              
                    
                    //ketika tombol hapus diklik
                    $("#hapus_sp").click(function(){
                        kode=$("#kode").val();
                        
						$("#back").show();
                        $("#loading").show();
                        
                        $.ajax({
                            url:"modul/mod_supplier/proses.php",
                            data:"op=delete&kode="+kode,
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
                                    $("#status").html('Berhasil Dihapus. . .');
                                }else{
                                    $("#status").html('ERROR. . .');
                                }
								$("#loading").fadeOut(1000);$("#back").fadeOut(1000); 
                            }
                        });
                    });
                    
                    //ketika tombol simpan diklik
                    $("#simpan_sp").click(function(){
                        kode=$("#id_supplier").val();
                        nama=$("#nm_supplier").val();
                        kota=$("#kota").val();
                        alamat=$("#alamat").val();
                        no_hp=$("#no_hp").val();
						
						if(kode==""){
                            alert("Kode supplier Harus diisi");
                            exit();
                        } 
						if(nama==""){
                            alert("nama supplier Harus diisi");
                            exit();
						} 
						if(kota==""){
                            alert("kota supplier Harus diisi");
                            exit();
						} 
						if(alamat==""){
                            alert("alamat supplier Harus diisi");
                            exit();
						}
						if(no_hp==""){
                            alert("no.Telp supplier Harus diisi");
                            exit();
                        }
						
                        $("#status").html("sedang diproses. . .");
                        $("#loading").show();
                        $("#back").show();
                        
                        $.ajax({
                            url:"modul/mod_supplier/proses.php",
                            data:"op=simpan&kode="+kode+"&nm_supplier="+nama+"&kota="+kota+"&alamat="+alamat+"&no_hp="+no_hp,
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
									$("#status").html("<i class='icon-ok' style='margin-right:10px;'></i>Berhasil disimpan");
										window.location.href='supplier'
                                }else{
                                    $("#status").html("<i class='icon-warning-sign' style='margin-right:10px;'></i>Gagal disimpan");
                                }
                                $("#loading").fadeOut(2000);
								$("#back").fadeOut(2000);
								$("#supplier").fadeOut(2000);
                                $("#nm_supplier").val("");
                                $("#kota").val("");
                                $("#alamat").val("");
                                $("#no_hp").val("");
                                $("#id_supplier").val("");
                            }
                        });
                    });
					
					/**
		 script kode untuk form master dokter
		 fungsi js 
			@simpan
			@edit
			@hapus
			@cekkode
		**/
		

                    //cek kode dokter yang sudah ada
                    $("#id_dokter").change(function(){
                        var kd=$("#id_dokter").val();
                        
                        $.ajax({
                            url:"modul/mod_dokter/proses.php",
                            data:"op=cek&kd="+kd,
                            success:function(data){
                                if(data==0){
                                    $("#pesan").html('Kode dokter Bisa digunakan');
                                    $("#id_dokter").css('border','3px #090 solid');
                                }else{
                                    $("#pesan").html('Kode dokter sudah ada');
                                    $("#id_dokter").css('border','3px #c33 solid');
									$("#id_dokter").val("");
                                }
                            }
                        });
                    });
                    
                    //ketika tombol update di klik
                    $("#update_dokter").click(function(){
						kode=$("#id_dokter").val();
                        nama=$("#nm_dokter").val();
                        kota=$("#kota").val();
                        alamat=$("#alamat").val();
                        no_hp=$("#no_hp").val();
						
						if(kode==""){
                            alert("Kode dokter Harus diisi");
                            exit();
                        } 
						if(nama==""){
                            alert("nama dokter Harus diisi");
                            exit();
						} 
						if(kota==""){
                            alert("kota dokter Harus diisi");
                            exit();
						} 
						if(alamat==""){
                            alert("alamat dokter Harus diisi");
                            exit();
						}
						if(no_hp==""){
                            alert("no.Telp dokter Harus diisi");
                            exit();
                        }
						
                        $("#status").html("sedang update. . .");
                        $("#loading").show();
						 $("#back").show();
                        
                        $.ajax({
                            url:"modul/mod_dokter/proses.php",
                            data:"op=update&kode="+kode+"&nm_dokter="+nama+"&kota="+kota+"&alamat="+alamat+"&no_hp="+no_hp,
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
									$("#status").html("<i class='icon-ok' style='margin-right:10px;'></i>Berhasil disimpan");
										window.location.href='dokter'
                                }else{
                                    $("#status").html("<i class='icon-warning-sign' style='margin-right:10px;'></i>Gagal disimpan");
                                }
                                $("#loading").fadeOut(3000);
								$("#back").fadeOut(3000);
                                 $("#nm_dokter").val("");
                                $("#kota").val("");
                                $("#alamat").val("");
                                $("#no_hp").val("");
                                $("#id_dokter").val("");
                            }
                        });
                    });
              
                    
                    //ketika tombol hapus diklik
                    $("#hapus_dokter").click(function(){
                        kode=$("#kode").val();
                        
						$("#back").show();
                        $("#loading").show();
                        
                        $.ajax({
                            url:"modul/mod_dokter/proses.php",
                            data:"op=delete&kode="+kode,
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
                                    $("#status").html('Berhasil Dihapus. . .');
                                }else{
                                    $("#status").html('ERROR. . .');
                                }
								$("#loading").fadeOut(1000);$("#back").fadeOut(1000); 
                            }
                        });
                    });
                    
                    //ketika tombol simpan diklik
                    $("#simpan_dokter").click(function(){
                        kode=$("#id_dokter").val();
                        nama=$("#nm_dokter").val();
                        kota=$("#kota").val();
                        alamat=$("#alamat").val();
                        no_hp=$("#no_hp").val();
						
						if(kode==""){
                            alert("Kode dokter Harus diisi");
                            exit();
                        } 
						if(nama==""){
                            alert("nama dokter Harus diisi");
                            exit();
						} 
						if(kota==""){
                            alert("kota dokter Harus diisi");
                            exit();
						} 
						if(alamat==""){
                            alert("alamat dokter Harus diisi");
                            exit();
						}
						if(no_hp==""){
                            alert("no.Telp dokter Harus diisi");
                            exit();
                        }
						
                        $("#status").html("sedang diproses. . .");
                        $("#loading").show();
                        $("#back").show();
                        
                        $.ajax({
                            url:"modul/mod_dokter/proses.php",
                            data:"op=simpan&kode="+kode+"&nm_dokter="+nama+"&kota="+kota+"&alamat="+alamat+"&no_hp="+no_hp,
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
									$("#status").html("<i class='icon-ok' style='margin-right:10px;'></i>Berhasil disimpan");
										window.location.href='dokter'
                                }else{
                                    $("#status").html("<i class='icon-warning-sign' style='margin-right:10px;'></i>Gagal disimpan");
                                }
                                $("#loading").fadeOut(2000);
								$("#back").fadeOut(2000);
								$("#dokter").fadeOut(2000);
                                $("#nm_dokter").val("");
                                $("#kota").val("");
                                $("#alamat").val("");
                                $("#no_hp").val("");
                                $("#id_dokter").val("");
                            }
                        });
                    });
		
	
                    
                    //cek kode barang yang sudah ada
                    $("#id_rekening").change(function(){
                        var kd=$("#id_rekening").val();
						
                        $.ajax({
                            url:"modul/mod_setup/aksi_setup.php",
                            data:"op=cek_kd&kd="+kd,
                            success:function(data){
                                if(data==0){
                                    $("#pesan").html('Kode Barang Bisa digunakan');
                                    $("#id_rekening").css('border','3px #090 solid');
                                }else{
                                    $("#pesan").html('Kode Barang sudah ada');
                                    $("#id_rekening").css('border','3px #c33 solid');
									$("#id_rekening").val("");
                                }
                            }
                        });
                    });
						
                    //ketika tombol update di klik
                    $("#update").click(function(){
                        //cek apakah kode barang kosong atau tidak
                        kode=$("#id_rekening").val();
                        nama=$("#nm_rekening").val();
                        jenis=$("#jenis").val();
                        jumlah=$("#jumlah").val();
						
						if(kode==""){
                            alert("Kode rekening Harus diisi");
                            exit();
                        }
						if(nama==""){
                            alert("nama rekening Harus diisi");
                            exit();
                        }
                        //tampilkan status update
                        $("#status").html('sedang diupdate. . .');
                        $("#loading").show();
                        $("#back").show();
                        
                       $.ajax({
                            url:"modul/mod_setup/aksi_setup.php",
                            data:"op=update&kode="+kode+"&nama="+nama+"&jenis="+jenis+"&jumlah="+jumlah,
                            cache:false,
                            success:function(msg){
								if(msg=='sukses'){
                                   $("#status").html("<i class='icon-ok' style='margin-right:10px;'></i>Berhasil disimpan");
										window.location.href='rekening';
                                }else{
                                    $("#status").html("<i class='icon-warning-sign' style='margin-right:10px;'></i>Gagal disimpan");
                                }
                                
                                $("#loading").fadeOut(2000);
                                $("#back").fadeOut(2000);
								$("#id_rekening").val("");
                                $("#nm_rekening").val("");
                                $("#jenis").val("");
                                $("#jumlah").val("");
                                
                            }
                        });
                    });
                    
					
					
                    //ketika tombol hapus diklik
                    $("#hapus").click(function(){
                        kode=$("#kode").val();
                        if(kode=="Kode Barang"){
                            alert("Kode barang belim dipilih");
                            exit();
                        }
                        $("#status").html('Sedang Dihapus. . .');
                        $("#loading").show();
                        
                        $.ajax({
                            url:"modul/mod_barang/proses.php",
                            data:"op=delete&kode="+kode,
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
                                    $("#status").html('Berhasil Dihapus. . .');
                                }else{
                                    $("#status").html('ERROR. . .');
                                }
                                $("#nama").val("");
                                $("#jual").val("");
                                $("#beli").val("");
                                $("#stok").val("");
                                $("#barang").load("proses.php","op=barang");
                                $("#kode").load("proses.php","op=kode");
                                
                            }
                        });
                    });
                    
                    //ketika tombol simpan diklik
                    $("#simpan").click(function(){
                        kode=$("#id_rekening").val();
                        nama=$("#nm_rekening").val();
                        jenis=$("#jenis").val();
                        jumlah=$("#jumlah").val();
						
						if(kode==""){
                            alert("Kode rekening Harus diisi");
                            exit();
                        }
						if(nama==""){
                            alert("nama rekening Harus diisi");
                            exit();
                        }
						if(jenis==""){
                            alert("jenis rekening Harus dipilih");
                            exit();
                        }
						if(jumlah==""){
                            alert("Jumlah rekening Harus diisi");
                            exit();
                        }
                      
                        $("#loading").show();
						$("#back").show();
                        
                        $.ajax({
                            url:"modul/mod_setup/aksi_setup.php",
                            data:"op=simpan&kode="+kode+"&nama="+nama+"&jenis="+jenis+"&jumlah="+jumlah,
                            cache:false,
                            success:function(msg){
								if(msg=='sukses'){
                                    $("#status").html("<i class='icon-ok' style='margin-right:10px;'></i>Berhasil disimpan");
										window.location.href='rekening';
                                }else{
                                    $("#status").html("<i class='icon-warning-sign' style='margin-right:10px;'></i>Gagal disimpan");
                                }
                                
                                $("#loading").fadeOut(2000);
                                $("#back").fadeOut(2000);
                                $("#perkiraan").fadeOut(1000);
								$("#id_rekening").val("");
                                $("#nm_rekening").val("");
                                $("#jenis").val("");
                                $("#jumlah").val("");
                                
                            }
                        });
                    });
					
					//modul user
					  //ketika tombol update di klik
                    $("#update_user").click(function(){
						kode=$("#kode").val();
						nama=$("#username").val();
						lengkap=$("#nama_lengkap").val();
						email=$("#email").val();
                        no_tlp=$("#no_telp").val();
						level=$("#level").val();
						blokir=$("#blokir").val();
                  
                        
						if(nama==""){
                            alert("username harus di isi");
                            exit();
						} 
						if(lengkap==""){
                            alert("nama lengkap Harus diisi");
                            exit();
						} 
						if(email==""){
                            alert("email Harus diisi");
                            exit();
                        }
						if(no_telp==""){
                            alert("No telp Harus diisi");
                            exit();
                        }
						if(level==""){
                            alert("Level Harus di pilih");
                            exit();
                        }if(blokir==""){
                            alert("Pilih salah satu");
                            exit();
                        }
                        //tampilkan status update
                        $("#status").html('sedang diupdate. . .');
                        $("#loading").show();
                        $("#back").show();
                        
                        $.ajax({
                            url:"modul/mod_users/proses.php",
                            data:"op=update&kode="+kode+"&nama="+nama+"&lengkap="+lengkap+"&email="+email+"&no_tlp="+no_tlp+"&level="+level+"&blokir="+blokir,
                            cache:false,
                            success:function(msg){
                                if(msg=='sukses'){
									$("#status").html("<i class='icon-ok' style='margin-right:10px;'></i>Berhasil disimpan");
										window.location.href='akun'
                                }else{
                                    $("#status").html("<i class='icon-warning-sign' style='margin-right:10px;'></i>Gagal disimpan");
                                }
                                $("#loading").fadeOut(1000);
								$("#back").fadeOut(1000);
								$("#username").val("");
								$("#nama_lengkap").val("");
								$("#email").val("");
								$("#no_telp").val("");
								
                            }
                        });
                    });
                    
					 $("#ubah_user").click(function(){
						kode=$("#id").val();
						lama=$("#lama").val();
						baru=$("#baru").val();
						sama=$("#sama").val();
						                        
						if(lama==""){
                            alert("passwor lama harus di isi");
                            exit();
						} 
						if(baru==""){
                            alert("passwor baru harus di isi");
                            exit();
						} 
						if(sama==""){
                            alert("tuliskan password yang sama");
                            exit();
                        }
                        //tampilkan status update
                        $("#status").html('sedang diupdate. . .');
                        $("#loading").show();
                        $("#back").show();
                        
                        $.ajax({
                            url:"modul/mod_users/proses.php",
                            data:"op=ubah&kode="+kode+"&lama="+lama+"&baru="+baru+"&sama="+sama,
                            cache:false,
                            success:function(msg){
                                if(msg=='sukses'){
									$("#status").html("<i class='icon-ok' style='margin-right:10px;'></i>Passwrod Berhasil diubah");
										window.location.href='akun'
                                }else{
                                    $("#status").html("<i class='icon-warning-sign' style='margin-right:10px;'></i>Gagal Mengubah Password");
                                }
                                $("#loading").fadeOut(3000);
								$("#back").fadeOut(3000);
								$("#baru").val("");
								$("#lama").val("");
								$("#sama").val("");
								
                            }
                        });
                    });
                    
                    
                    //ketika tombol simpan diklik
                    $("#simpan_user").click(function(){
                        nama=$("#username").val();
						pass=$("#password").val();
						lengkap=$("#nama_lengkap").val();
						email=$("#email").val();
						level=$("#level").val();
                        no_tlp=$("#no_telp").val();
                  
                        
						if(nama==""){
                            alert("username harus di isi");
                            exit();
						} 
						if(pass==""){
                            alert("Password Harus di isi Harus diisi");
                            exit();
						} 
						if(lengkap==""){
                            alert("nama lengkap harus di isi");
                            exit();
						} 
						if(email==""){
                            alert("email  Harus diisi");
                            exit();
                        }
						if(level==""){
                            alert("Level Harus di pilih");
                            exit();
                        }
						if(no_telp==""){
                            alert("No telp Harus diisi");
                            exit();
                        }
						
                        $("#status").html("sedang diproses. . .");
                        $("#loading").show();
                        $("#back").show();
                        
                        $.ajax({
                            url:"modul/mod_users/proses.php",
                            data:"op=simpan&nama="+nama+"&pass="+pass+"&lengkap="+lengkap+"&level="+level+"&email="+email+"&no_tlp="+no_tlp,
                            cache:false,
                            success:function(msg){
                                if(msg=='sukses'){
									$("#status").html("<i class='icon-ok' style='margin-right:10px;'></i>Berhasil disimpan");
                                }else{
                                    $("#status").html("<i class='icon-warning-sign' style='margin-right:10px;'></i>Gagal disimpan");
                                }
                                $("#loading").fadeOut(1000);
								$("#back").fadeOut(1000);
								$("#user_b").fadeOut(1000);
                                $("#username").val("");
								$("#password").val("");
								$("#nama_lengkap").val("");
								$("#email").val("");
								$("#no_telp").val("");
                            }
                        });
                    });
					
					//modul pengaturan
                    $("#simpan_modul").click(function(){
                        nama=$("#nama_modul").val();
						link=$("#link").val();
						akses=$("#akses").val();
						
                  
                        
						if(nama==""){
                            alert("Nama modul harus di isi");
                            exit();
						} 
						if(link==""){
                            alert("Link Harus di isi Harus diisi");
                            exit();
						} 
						if(akses==""){
                            alert("Pilih Satus Hak Akses");
                            exit();
						} 
					
						
                        $("#status").html("sedang diproses. . .");
                        $("#loading").show();
                        $("#back").show();
                        
                        $.ajax({
                            url:"modul/mod_modul/proses.php",
                            data:"op=simpan&nama="+nama+"&link="+link+"&akses="+akses,
                            cache:false,
                            success:function(msg){
                                if(msg=='sukses'){
									$("#status").html("<i class='icon-ok' style='margin-right:10px;'></i>Berhasil disimpan");
									window.location.href='pengaturan';
							  }else{
                                    $("#status").html("<i class='icon-warning-sign' style='margin-right:10px;'></i>Gagal disimpan");
                                }
									$("#nama_modul").val("");
									$("#link").val("");
									$("#akses").val("");
                            }
                        });
                    });
					
				//modul pengaturan
                    $("#update_modul").click(function(){
                        kode=$("#id").val();
						nama=$("#nama_modul").val();
						urutan=$("#urutan").val();
						link=$("#link").val();
						akses=$("#akses").val();
						aktif=$("#aktif").val();
						publis=$("#publis").val();
						
                  
                        
						if(nama==""){
                            alert("Nama modul harus di isi");
                            exit();
						} 
						if(link==""){
                            alert("Link Harus di isi Harus diisi");
                            exit();
						} 
						if(akses==""){
                            alert("Pilih Satus Hak Akses");
                            exit();
						} 
					
						
                        $("#status").html("sedang diproses. . .");
                        $("#loading").show();
                        $("#back").show();
                        
                        $.ajax({
                            url:"modul/mod_modul/proses.php",
                            data:"op=update&kode="+kode+"&urutan"+urutan+"&nama="+nama+"&link="+link+"&akses="+akses+"&aktif="+aktif+"&publis"+publis,
                            cache:false,
                            success:function(msg){
                                if(msg=='sukses'){
									$("#status").html("<i class='icon-ok' style='margin-right:10px;'></i>Berhasil disimpan");
									window.location.href='pengaturan';
							  }else{
                                    $("#status").html("<i class='icon-warning-sign' style='margin-right:10px;'></i>Gagal disimpan");
                                }
									$("#nama_modul").val("");
									$("#link").val("");
									$("#akses").val("");
                            }
                        });
                    });
					
           
	});
}) (jQuery);
