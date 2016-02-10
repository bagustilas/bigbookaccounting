<script type='text/javascript'>
/**
********************modul installer bigbook.v.12******************
** @Dibuat oleh :	Bagus T. Hidayatullah 				   	W******
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
$(document).ready(function() {
		//$("#search_results").slideUp();
		$("#button_find").click(function(event) {
			event.preventDefault();
			//search_ajax_way();
			ajax_search();
		});
		$("#search_query").keyup(function(event) {
			event.preventDefault();
			//search_ajax_way();
			ajax_search();
		});
	});
	function ajax_search() {

		var nama = $("#search_query").val();
		$.ajax({
			url : "../apotek/modul/mod_transaksi/cari.php",
			data : "nama=" + nama,
			success : function(data) {
				// jika data sukses diambil dari server, tampilkan di 
				$("#display_results").html(data);
			}
		});

	}</script>
<div class="row">
   <div class="col-lg-12">
	<form class="form-search">
		<div class="cari">
			<input type="text" class="form-control" name="search_query" id="search_query"
			placeholder="cari nama barang"
			class="input-xxlarge search-query">
		</div>
	</form>
	</div>
</div>
<div id="display">
<fieldset>
	<div id="display_results"  ></div>		
</fieldset>
</div>
</body>
</html>