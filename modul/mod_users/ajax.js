$(document).ready(function(){
	// juga dengan input data pada bagian search
  function loadData(){
	  $.ajax({
      url: "../modul/mod_users/source.php",
      type: "GET",
      data: dataString,
  		success:function(data)
  		{
  			$('#datauser').html(data);
  		}
    });
  }
   
});