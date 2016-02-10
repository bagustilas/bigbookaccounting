<script type='text/javascript'>
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

		var kd = $("#search_query").val();
		$.ajax({
			url : "../modul/mod_transaksi/cari3.php",
			data : "kd=" + kd,
			success : function(data) {
				// jika data sukses diambil dari server, tampilkan di 
				$("#display_results").html(data);
			}
		});

	}</script>
<div>
	<form class="form-search">
	<input type='radio' value='kd' name='cari'>ID transaksi
	<input type='radio' value='kd' name='cari'>Tanggal transaksi
		<div class="cari">
			<input type="text"  name="search_query" id="search_query"
			placeholder="cari data transaksi"
			class="input-xxlarge search-query">
		</div>
	</form>
</div>
<div id="display">
<fieldset>
	<div id="display_results"  ></div>		
</fieldset>
</div>
</body>
</html>