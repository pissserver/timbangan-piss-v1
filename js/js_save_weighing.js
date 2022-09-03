$(document).ready(function() {
	$("#formWeighingIn").submit(function() {
		
		// Inialisasi Variabel
			var np = $("#nopol").val();
			var mr = $("#merchant").val();
			var gd = $("#goods").val();
			var lb = $("#laborer").val();
			
		// Kondisi
			if (np == '' || mr == '' || gd == '' || lb == '') {
				alert('Data belum lengkap diisi !');
			} else {
				$.ajax({
					url: 'weighing_action.php?task=masuk',
					type: 'POST',
					data: $(this).serialize(),
					success: function(data) {
						$("#Area1").load("weighing_table.php");
						$("#nopol").val("");
						$("#merchant").val("");
						$("#goods").val("");
						$("#laborer").val("Tidak");
						$("#weight_in").val("");
					}
				});
				return false;
			}
	});
});