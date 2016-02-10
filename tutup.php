<script type="text/javascript">

				$("#tutup").change(function(){
				
						pass = $("#tutup").val();
  
						if(pass==""){
                            alert("masukan password anda");
							exit();
						}						
                    
           
                        $.ajax({
                            url:"http://localhost/apotek/Inc/proses.php",
                            data:"op=tutup&pass="+pass,
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
                                    alert("Pembukuan Berhasil Di tutup");
										window.location.href='127.0.0.1';
                                }else{
                                   alert("Password Salah");
								   $("#tutup").val("");
                                }
                            }
                        });
                    });
			
</script>
<?php
	echo"<div id='penutup'>
			<fieldset>
					<input type='password' class=\"form-control\" id='tutup' placeholder='masukan password'>
				</fieldset>
		</div>";
		
?>