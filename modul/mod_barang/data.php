<?php
$r=mysql_fetch_array(mysql_query("SELECT * FROM barang ORDER BY nama"));	
echo'{ "aaData": [
	["'.$r[nama].'","'.$r[satuan].'","Win 95+","4","X"]
] };
'
?>