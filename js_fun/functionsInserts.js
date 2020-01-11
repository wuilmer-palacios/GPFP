function registraResponsable(){
	var valores=$('#form-responsable').serialize();
	var insert="responsable";
	var error=false;
	var primerNom=$('#primerNombre').val();
	var segundoNom=$('#segundoNombre').val();
	var primerApe=$('#primerApellido').val();
	var segundoApe=$('#segundoApellido').val();

	if (primerNom==""){
		$('#primerNombre').toggleClass('form-control-danger');
		var error=true;
	}
	if (primerApe==""){
		$('#primerApellido').toggleClass('form-control-danger');
		var error=true;
	}	

	if (error==false){
		$('#primerNombre').toggleClass('form-control-success');
		$('#segundoNombre').toggleClass('form-control-success');
		$('#primerApellido').toggleClass('form-control-success');
		$('#segundoApellido').toggleClass('form-control-success');

		$.ajax({
			url:'class/sentenciasInserts.php',
			type:'POST',
			data: valores, 
			success:function(dataa){
				var dataw=dataa;
				if (dataw==1) {

					var ultimo=1;
					$.ajax({
						url:'class/sentenciasInserts.php',
						type:'POST',
						data: {sendUltimo: ultimo}, 
						success:function(date){
							var dat=date;
							
								$('#label').html(dat);
								$('#lista-registro').css('display','block');
						}
					})
				}
			}
		})
	}

}