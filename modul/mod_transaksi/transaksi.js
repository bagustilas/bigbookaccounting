function online(){
    if (window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
        }
            else{
				xmlhttp =new ActiveXObject("Microsoft.XMLHTTP");    
				}
				xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById("target").innerHTML = xmlhttp.responseText;
				}
			}
             xmlhttp.open("GET","../modul/mod_transaksi/target.php");
		 xmlhttp.send();
		setTimeout("online()", 1000);
}