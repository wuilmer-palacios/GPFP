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

					/*Asignar minimo y maximo de fechas de los alcances*/
					$("#fechaInicioAlcance").prop("min",fecInicio);
					$("#fechaInicioAlcance").prop("max",fecFinal);
					$("#fechaFinalAlcance").prop("min",fecInicio);
					$("#fechaFinalAlcance").prop("max",fecFinal);
					/*----------------FIN FIN ----------------*/

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
	
	var i=0;
	var partici=[];
	$("#lista-dinamica li").each(function(){
		
		partici[i]=$(this).val();
		i=i+1;
	});

	var idPlan =$("#idPlan").val();
	var valores=$("#form-alcances").serialize();
	var error=false;
	var nomAlcance=$("#nombreAlcance").val();
	var fecInicioAlcance=$("#fechaInicioAlcance").val();
	var fecFinalAlcance=$("#fechaFinalAlcance").val();
	var participantes=partici;


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
			data:{
				sendIdPlan:idPlan,
				sendPaticipante: participantes,
				sendNomAlcance: nomAlcance,
				sendFecInicioAlcance: fecInicioAlcance,
				sendFecFinalAlcance: fecFinalAlcance},
			success: function(data){
				var value=data.split('*');
				var colaboradores=value[3].split('|');
				var rowspan=colaboradores.length-1;

				$("#form-table-wuil").css("display","block");

				$("#antepenultimo-tr").after('<tr id="ultimo-tr" class="moment"><td class="align-middle" rowspan="'+rowspan+'">'+value[0]+'</td><td class="align-middle" rowspan="'+rowspan+'"><label id="fecInicio"> Fecha de Inicio: '+value[1]+'</label><br><label id="fecFinal"> Fecha Final: '+value[2]+'</label><td>'+colaboradores[0]+'</td></td></tr>');

				for (var i = 1; i < colaboradores.length-1; i++) {

					$(".moment").after('<tr><td>'+colaboradores[i]+'</td></tr>');
				}
				
				$("#ultimo-tr").removeClass('moment');

				$("#lista-dinamica").find('li').remove();
				$("#nombreAlcance").val('');
				$("#fechaInicioAlcance").val(fecFinalAlcance);
				$("#fechaFinalAlcance").val('');
				$("#participantes").val('');

				$(document).ready(function() {

				setTimeout(function() {
					$("#success-card").fadeIn(100);
					},1);
				setTimeout(function() {
					$("#success-card").fadeOut(1000);
					},3000);
				});
			}		
		})
	}
}
function unirAlcanceYParticipante2(){

	var i=0;
	var partici=[];
	$("#lista-dinamica3 li").each(function(){
		
		partici[i]=$(this).val();
		i=i+1;
	});

	var idPlan =$("#idPlan").val();
	var valores=$("#form-alcances").serialize();
	var error=false;
	var nomAlcance=$("#nombreAlcance").val();
	var fecInicioAlcance=$("#fechaInicioAlcance").val();
	var fecFinalAlcance=$("#fechaFinalAlcance").val();
	var participantes=partici;


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
			data:{
				sendIdPlan:idPlan,
				sendPaticipante: participantes,
				sendNomAlcance: nomAlcance,
				sendFecInicioAlcance: fecInicioAlcance,
				sendFecFinalAlcance: fecFinalAlcance},
			success: function(data){
				var value=data.split('*');
				var colaboradores=value[3].split('|');
				var rowspan=colaboradores.length-1;

				$("#form-table-wuil").css("display","block");

				$("#antepenultimo-tr").after('<tr id="ultimo-tr" class="moment"><td class="align-middle" rowspan="'+rowspan+'">'+value[0]+'</td><td class="align-middle" rowspan="'+rowspan+'"><label id="fecInicio"> Fecha de Inicio: '+value[1]+'</label><br><label id="fecFinal"> Fecha Final: '+value[2]+'</label><td>'+colaboradores[0]+'</td></td></tr>');

				for (var i = 1; i < colaboradores.length-1; i++) {

					$(".moment").after('<tr><td>'+colaboradores[i]+'</td></tr>');
				}
				
				$("#ultimo-tr").removeClass('moment');

				$("#lista-dinamica").find('li').remove();
				$("#nombreAlcance").val('');
				$("#fechaInicioAlcance").val(fecFinalAlcance);
				$("#fechaFinalAlcance").val('');
				$("#participantes").val('');

				$(document).ready(function() {

				setTimeout(function() {
					$("#success-card").fadeIn(100);
					},1);
				setTimeout(function() {
					$("#success-card").fadeOut(1000);
					},3000);
				});
			}		
		})
	}
}

function guardarSubAvance(){
	var fecha=new Date();
	var error=false;

	if (fecha.getMonth()<10) {
		var mes="0"+(fecha.getMonth()+1);
	}
	else{
		var mes=(fecha.getMonth()+1);
	}
	if (fecha.getDate()<10) {
		var dia="0"+fecha.getDate();
	}
	else{
		var dia=fecha.getDate();
	}

	var hoy=(fecha.getFullYear()+"-"+mes+"-"+dia);
	var idAlcance=$("#idAlcance").val();
	var gestion=$("#tarea").val();
	var observacion=$("#observacion").val();
	var porcentaje=$("#valorPorcentaje").val();

	if (gestion=="") {
		$("#tarea").toggleClass('form-control-danger');
		var error=true;
	}
	else{
		$("#tarea").removeClass('form-control-danger');
	}

	if (observacion=="") {
		$("#observacion").toggleClass('form-control-alert');
	}
	else{
		$("#observacion").removeClass('form-control-alert');
	}

	if (porcentaje=="nulo") {
		$("#valorPorcentaje").toggleClass('form-control-danger');
		var error=true;
	}
	else{
		$("#valorPorcentaje").removeClass('form-control-danger');
	}

	if (error==false) {

		$.ajax({
			url:'class/sentenciasInserts.php',
			type:'POST',
			data:{
				sendhoy:hoy,
				sendidAlcance:idAlcance,
				sendgestion:gestion,
				sendobservacion:observacion,
				sendporcentaje:porcentaje
			},
			success:function(data){

				if (data==1) {
					alert("El Valor del Porcentaje superaria en 100% de este Alcance");
				}
				else{
					$("#lista-historial").html(data);
				}

			}
		})
	}
}

function agregarParticipante(){
	
	var i=0;
	var partici=[];
	$("#lista-dinamica li").each(function(){
		
		partici[i]=$(this).val();
		i=i+1;
	});

	var idAlcance=$("#idAlcance").val();
	var participante=partici;
	var idPlan=$("#idPlan").val();

	$.ajax({
		url:'class/sentenciasInserts.php',
		type:'POST',
		data:{
			sendAlcanceId:idAlcance,
			sendPaticipanteId:participante,
			sendPlaId: idPlan
		},
		success: function(data){
			$("#lista-particpantes").html(data);
			$("#lista-dinamica").find('li').remove().end();
		}
	})
}

function formularioEmergente() {
	$("#form-emergente").removeClass("form-emergente-show");
	$("#form-emergente").addClass("form-emergente-show");
}