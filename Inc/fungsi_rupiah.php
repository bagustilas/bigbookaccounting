<?php
function format_rupiah($rp){
  $hasil="Rp.". number_format($rp, 0, "", ".") . ",00";
  return $hasil;
}
?> 
