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

				if (elemento>=1) {

					$("#boton-registrar").prop("disabled",true);
					$("#success").css("display","block");
					$("#form-alcence").css("display","block");

					$("#nombrePlan").prop("disabled", true);
					$("#fechaInicio").prop("disabled", true);
					$("#fechaFinal").prop("disabled", true);
					$("#responsable").prop("disabled", true);

					$("#nombreAlcance").prop("disabled",false);
					$("#fechaInicioAlcance").prop("disabled",false);
					$("#fechaFinalAlcance").prop("disabled",false);
					$("#participantes").prop("disabled",false);


					var ultimoRegistro="ultimoRegistro";
					$.ajax({
						url:'class/sentenciasInserts.php',
						type:'POST',
						data:{senUltimoRegistro: elemento},
						success: function(data_two){
							var valorPlanTactico=data_two.split('-');
							 sessionStorage.id=valorPlanTactico[0];
							 sessionStorage.planNombre=valorPlanTactico[1];
							 sessionStorage.planResponsable=valorPlanTactico[2];

							$("#idPlan").val(sessionStorage.id);
							$("#namePlanTactico").append(sessionStorage.planNombre);
							$("#nameResponsable").append(sessionStorage.planResponsable);

						}
					})
					
				}
			}

		})
	}
}
function unirAlcanceYParticipante(){
	var valores=$("#form-alcances").serialize();
	var error=false;
	var nomAlcance=$("#nombreAlcance").val();
	var fecInicioAlcance=$("#fechaInicioAlcance").val();
	var fecFinalAlcance=$("#fechaFinalAlcance").val();
	var participantes=$("#participantes").val();


	if (nomAlcance=="") {
		$("#nombreAlcance").toggleClass('form-control-danger');
		error=true;
	}
	if (fecInicioAlcance=="") {
		$("#fechaInicioAlcance").toggleClass('form-control-danger');
		error=true;
	}
	if (fecFinalAlcance=="") {
		$("#fechaFinalAlcance").toggleClass('form-control-danger');
		error=true;
	}
	if (participantes=="") {
		$("#participantes").toggleClass('form-control-danger');
		error=true;
	}
	
	if (error==false) {

		$("#nombreAlcance").removeClass('form-control-danger');
		$("#fechaInicioAlcance").removeClass('form-control-danger');
		$("#fechaFinalAlcance").removeClass('form-control-danger');
		$("#participantes").removeClass('form-control-danger');

		$.ajax({
			url:'class/sentenciasInserts.php',
			type:'POST',
			data:{participantes,valores},
			success: function(data){
				var value=data.split('*');
				console.log(value);
				var colaboradores=value[3].split('|');
				var rowspan=colaboradores.length-1;

				$("#form-table-wuil").css("display","block");

				$("#antepenultimo-tr").after('<tr id="ultimo-tr" class="moment"><td class="align-middle" rowspan="'+rowspan+'">'+value[0]+'</td><td class="align-middle" rowspan="'+rowspan+'"><label id="fecInicio">'+value[1]+'</label><br><label id="fecFinal">'+value[2]+'</label><td>'+colaboradores[0]+'</td></td></tr>');

				for (var i = 1; i < colaboradores.length-1; i++) {

					$(".moment").after('<tr><td>'+colaboradores[i]+'</td></tr>');
				}
				$("#ultimo-tr").removeClass('moment');
			}		
		})
	}
}