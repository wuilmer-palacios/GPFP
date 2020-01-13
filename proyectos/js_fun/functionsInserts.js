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
/*---------------*/
function registraParticipante(){
	var valores=$('#form-participante').serialize();
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
						data: {sendUltimoParticipante: ultimo}, 
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

/*------------------*/
function registraPlanTactico(){
	var error=false;
	var valores=$("#form-plan-tactico").serialize();
	var nomPlan=$("#nombrePlan").val();
	var fecInicio=$("#fechaInicio").val();
	var fecFinal=$("#fechaFinal").val();
	var responsable=$("#responsable").val();

	if (nomPlan=="") {
		$("#nombrePlan").toggleClass('form-control-danger');
		error=true;
	}
	if (fecInicio=="") {
		$("#fechaInicio").toggleClass('form-control-danger');
		error=true;
	}
	if (fecFinal=="") {
		$("#fechaFinal").toggleClass('form-control-danger');
		error=true;
	}
	if (responsable=="nulo") {
		$("#responsable").toggleClass('form-control-danger');
		error=true;
	}
	
	if (error==false) {
		$("#nombrePlan").toggleClass('form-control-danger');
		$("#fechaInicio").toggleClass('form-control-danger');
		// $("#fechaFinal").toggleClass('form-control-danger');
		$("#responsable").toggleClass('form-control-danger');

		$.ajax({
			url:'class/sentenciasInserts.php',
			type:'POST',
			data:valores,
			success: function(data){
				var elemento=data;

				if (elemento==1) {

					$("#boton-registrar").prop("disabled",true)
					$("#success").css("display","block");

					$("#namePlanTactico").append(nomPlan);
					$("#fecInicio").append('Fecha de Inicio '+fecInicio);
					$("#fecFinal").append('Fechad de Finalizacion'+fecFinal);
					

				}


			}

		})
	}
}