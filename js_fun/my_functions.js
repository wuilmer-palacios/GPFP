
// FUNCIONES DEL MENU ¡¡¡¡CUIDADO!!!!
// FUNCIONES DEL MENU ¡¡¡¡CUIDADO!!!!
//INICIO - INICIO - INICIO - INICIO 
function menu(){
	$("#sidebar").toggleClass("active");
	document.getElementById('capa').classList.toggle('capa-capa');
}
function despliegaSubMenu1(){
	var valor=$("#children1").css('display');
	if (valor=='none') {
		document.getElementById("children1").style.display='block';
		document.getElementById("subMenu1").classList.toggle('seleccion');
	}
	else{
		document.getElementById("children1").style.display='none';
		document.getElementById("subMenu1").classList.toggle('seleccion');
	}
	
}
function despliegaSubMenu2(){
	var valor=$("#children2").css('display');
	if (valor=='none') {
		document.getElementById("children2").style.display='block';
		document.getElementById("subMenu2").classList.toggle('seleccion');
	}
	else{
		document.getElementById("children2").style.display='none';
		document.getElementById("subMenu2").classList.toggle('seleccion');
	}
	
}
function despliegaSubMenu3(){
	var valor=$("#children3").css('display');
	if (valor=='none') {
		document.getElementById("children3").style.display='block';
		document.getElementById("subMenu3").classList.toggle('seleccion');
	}
	else{
		document.getElementById("children3").style.display='none';
		document.getElementById("subMenu3").classList.toggle('seleccion');
	}
	
}
function despliegaSubMenu4(){
	var valor=$("#children4").css('display');
	if (valor=='none') {
		document.getElementById("children4").style.display='block';
		document.getElementById("subMenu4").classList.toggle('seleccion');
	}
	else{
		document.getElementById("children4").style.display='none';
		document.getElementById("subMenu4").classList.toggle('seleccion');
	}
	
}
// FIN - FIN - FIN - FIN - FIN
// FUNCIONES DEL MENU ¡¡¡¡CUIDADO!!!!
// FUNCIONES DEL MENU ¡¡¡¡CUIDADO!!!!

function validaNombrePlan(){
	var nombrePlan=$("#nombrePlan").val();
	if (nombrePlan!=="") {
		$.ajax({
			url:'class/validaNombre.php',
			type:'POST',
			data:{sendNombrePlan:nombrePlan},
			success: function(data){
				var valor=data;

				if (valor>=1) {
					$("#label-control-danger").css("display","block");
					$("#boton-registrar").prop("disabled",true);
					
				}
				else{
					$("#label-control-danger").css("display","none");
					$("#boton-registrar").prop("disabled",false);
					$('#nombrePlan').toggleClass('form-control-success');

				}
			}
		})
	}
}

function validaFechaInicio(){

	var fechafin=$("#fechaFinal").val().split('-');
	var fechaFinal=(fechafin[1] + '/' + fechafin[2] + '/' + fechafin[0]);
	var tercera = Date.parse(fechaFinal);

	var fechaini=$("#fechaInicio").val().split('-');
	var fecha=new Date();
	var hoy=((fecha.getMonth()+1)+"/"+fecha.getDate()+"/"+fecha.getFullYear());

	fechaInicio=(fechaini[1] + '/' + fechaini[2] + '/' + fechaini[0]);

	var primera = Date.parse(fechaInicio); //01 de Octubre del 2013
	var segunda = Date.parse(hoy); //03 de Octubre del 2013
	 
	if (primera > segunda) {
		$("#label-inicio").css("display","none");
		$("#boton-registrar").prop("disabled",false);
		$("#fechaFinal").val('');
		$('#fechaInicio').addClass('form-control-success');

	}
	else{
		$("#label-inicio").css("display","block");
		$("#boton-registrar").prop("disabled",false);
	}
	$("#fechaFinal").val('');
}

function validaFechaFinal(){

	var fechaini=$("#fechaInicio").val().split('-');
	var fechaInicio=(fechaini[1] + '/' + fechaini[2] + '/' + fechaini[0]);

	var fechafin=$("#fechaFinal").val().split('-');
	var fechaFinal=(fechafin[1] + '/' + fechafin[2] + '/' + fechafin[0]);

	var primera = Date.parse(fechaInicio);
	var segunda = Date.parse(fechaFinal);
	 
	if (primera >= segunda) {
		$("#label-final").css("display","block");
		$("#boton-registrar").prop("disabled",true);
		$('#fechaFinal').addClass('form-control-success');
		$('#fechaInicio').val('');
	}
	else{
		$("#label-final").css("display","none");
		$("#boton-registrar").prop("disabled",false);
	}
}

function desactivarDanger(){
	$('#responsable').addClass('form-control-success');
}

function agregaParticipante(){

	var variable=$('#participantes').val();
	var combo = document.getElementById("participantes");
	var selected = combo.options[combo.selectedIndex].text;


	if (!$('#'+variable).length) {
		
		$('#lista-dinamica').append('<li id="'+ variable + '" class="participantes" value="' + variable + '">' + selected + '<span class="icon-bin" onclick="eliminarListaDinamica(' + variable + ');"></span></li>');
		
	}
	else{
		alert("Participante ya esta en lista");
	}	
}

function agregaParticipante2(){

	var variable=$('#participantes').val();
	var combo = document.getElementById("participantes");
	var selected = combo.options[combo.selectedIndex].text;
	var idAlcance=$("#idAlcance").val();
	var idParticipante=variable[0];
	$.ajax({
		url:'class/validaNombre.php',
		type:'POST',
		data:{
			alcanceId:idAlcance,
			participanteId:idParticipante
		},
		success: function(data){
			var booleano=data;

			if (booleano==1) {
				alert("Participante ya fue Asignado a este alcance");
			}
			else{
				if (!$('#'+variable).length) {
					
					$('#lista-dinamica').append('<li id="'+ variable + '" class="participantes" value="' + variable + '">' + selected + '<span class="icon-bin" onclick="eliminarListaDinamica(' + variable + ');"></span></li>');

				}
				else{
					alert("Participante ya esta en lista");

				}	
			}
		}
	})

	
}
function agregaParticipante3(){

	var variable=$('#participantes3').val();
	var combo = document.getElementById("participantes3");
	var selected = combo.options[combo.selectedIndex].text;


	if (!$('#'+variable).length) {
		
		$('#lista-dinamica3').append('<li id="'+ variable + '" class="participantes" value="' + variable + '">' + selected + '<span class="icon-bin" onclick="eliminarListaDinamica(' + variable + ');"></span></li>');
		
	}
	else{
		alert("Participante ya esta en lista");
	}	
}

function eliminarListaDinamica(valorVariable){
	var variable=valorVariable;
	var node=document.getElementById(variable);
	node.parentNode.removeChild(node);
}

function find_li(contenido){

	var el = document.getElementById("lista-dinamica").getElementsByTagName("li");
	for (var i=0; i<el.length; i++)	{

		if(el[i].innerHTML==contenido)
		return false;
	}
		return true;
}

function validaNombreAlcance(){
	var nombreAlcance=$("#nombreAlcance").val();
	var planTactico=$("#idPlan").val();
	if (nombreAlcance!=="") {
		$.ajax({
			url:'class/validaNombre.php',
			type:'POST',
			data:{sendNombreAlcance:nombreAlcance, sendIdPlan:planTactico},
			success:function(data){
				var datos=data;

				if (datos==1) {
					$('#label-control-danger-alcance').css('display','block');
				}else{
					$('#label-control-danger-alcance').css('display','none');
				}
			}
		});
	}
}

function validaFechaFinalAlcance(){

	var fechaini=$("#fechaInicioAlcance").val().split('-');
	var fechaInicio=(fechaini[1] + '/' + fechaini[2] + '/' + fechaini[0]);

	var fechafin=$("#fechaFinalAlcance").val().split('-');
	var fechaFinal=(fechafin[1] + '/' + fechafin[2] + '/' + fechafin[0]);

	var primera = Date.parse(fechaInicio);
	var segunda = Date.parse(fechaFinal);
	 
	if (primera >= segunda) {
		$("#label-final-alcance").css("display","block");
		$("#boton-anadir").prop("disabled",true);
		$('#fechaFinal').addClass('form-control-success');
		$('#fechaInicio').val('');
	}
	else{
		$("#label-final-alcance").css("display","none");
		$("#boton-anadir").prop("disabled",false);
	}
}

function validaFechaInicioAlcance(){
	$("#fechaFinalAlcance").val('');
}

function iratras(){
	$("#detalle-gestion-avance").css("display","none");
	$("#col-table").css("display","block");
	$("#iratras").css("display","none");
	location.reload();
}

function iratras2(){
	$("#detalle-gestion-avance").css("display","none");
	$("#col-table").css("display","block");
	location.reload();
	window.locationf="verProyecto.php";
}

function detallarAlcance(valor1){
	var idAlcance=valor1;
	$("#form-emergente").removeClass("form-emergente-show");
	$("#form-emergente").addClass("form-emergente");

	/*Con esta se pinta el nombre*/
	$.ajax({
		url:'class/sentenciasInserts.php',
		type:'POST',
		data:{sendIdAlcanceName:idAlcance},
		success: function (data){
			var name=data;
			$("#idAlcance").val(idAlcance);
			$("#nameAlcance").val(name);
		}
	})
	/* con esta se pinta el Historial*/
	$.ajax({
		url:'class/sentenciasInserts.php',
		type:'POST',
		data:{sendIdAlcance:idAlcance},
		success: function (data){
			$("#lista-historial").html(data);

		}
	})

	$.ajax({
		url:'class/sentenciasInserts.php',
		type:'POST',
		data:{sendIdAlcanceParticipantes:idAlcance},
		success: function (data){
			$("#lista-particpantes").html(data);

		}
	})

	$("#col-table").css("display","none");
	$("#detalle-gestion-avance").css("display","block");
	$("#form-gestion-alcance").css("display","block");
	$("#boton-tareas").css("display","block");
	$("#historial-avances").css("display","block");
	$("#iratras2").css("display","none");
	$("#iratras").css("display","block");
}
function confirmar(valorUno){
	var idAlcance=$("#idAlcance").val();
	var valor=confirm("¿Esta seguro de eliminar al participante?");

	var i=-1;
	var partici=[];
	$("#lista-particpantes li").each(function(){
		
		partici[i]=$(this).val();
		i=i+1;
	});

	if (valor==true && i>=2) {
		var id=valorUno;

		$.ajax({
			url:'class/sentenciasDelete.php',
			type:'POST',
			data:{
				sendIdParticipante:id,
				sendIdAlcance:idAlcance
			},
			success: function (data){
				$("#lista-particpantes").html(data);
			}
		})
	}
	else{
		alert("El Avance no puede quedar sin Participantes");
	}
}
/*Botones -- Botones -- Botones*/
function sumarAvance(){
	$("#col-table").css("display","none");
	$("#detalle-gestion-avance").css("display","block");
	$("#form-gestion-alcance").css("display","block");
	$("#boton-tareas").css("display","block");
	$("#historial-avances").css("display","block");
	$("#form-gestion-participantes").css("display","none");
	$("#button-participantes").css("display","none");
	$("#historial-participantes").css("display","none");

}

function buttonParticipantes(){
	$("#col-table").css("display","none");
	$("#detalle-gestion-avance").css("display","block");
	$("#form-gestion-alcance").css("display","none");
	$("#boton-tareas").css("display","none");
	$("#historial-avances").css("display","none");
	$("#form-gestion-participantes").css("display","block");
	$("#button-participantes").css("display","block");
	$("#historial-participantes").css("display","block");
	
}
/*-------------------*/

function formEmergenteClose() {

	$("#form-emergente").removeClass("form-emergente-show");
	$("#form-emergente").addClass("form-emergente");
	location.reload();
}

function actualizar(){
	var onOff=1;
	$.ajax({
		url:'class/actualizarCampos.php',
		type:'POST',
		data:{sendOnOff:onOff},
		success:function(data){

		}
	});
}

function stop(valor1){
	var valorIdPlan=valor1;
	
	var booleano=confirm("¿Estas Seguro de CANCELAR este Proyecto?");
	if (booleano==true) {
		$.ajax({
			url:'class/sentenciasDelete.php',
			type:'POST',
			data:{sendStop:valorIdPlan},
			success:function(data){
				var respuesta=data;

				if (respuesta=="1") {
					alert("Proyecto CANCELADO exitosamente");
					location.reload();
				}
			}
		})
	}

}

function pause(valor1){
	var valorIdPlan=valor1;
	
	var booleano=confirm("¿Estas Seguro de PAUSAR este Proyecto?");
	if (booleano==true) {
		$.ajax({
			url:'class/sentenciasDelete.php',
			type:'POST',
			data:{sendPause:valorIdPlan},
			success:function(data){
				var respuesta=data;

				if (respuesta=="1") {
					alert("Proyecto PAUSADO exitosamente");
					location.reload();
				}
			}
		})
	}
}

function play(valor1){
	var valorIdPlan=valor1;
	
	var booleano=confirm("¿Estas Seguro de ACTIVAR nuevamente este Proyecto?");
	if (booleano==true) {
		$.ajax({
			url:'class/sentenciasDelete.php',
			type:'POST',
			data:{sendPlay:valorIdPlan},
			success:function(data){
				var respuesta=data;

				if (respuesta=="1") {
					alert("Proyecto En EJECUCION exitosamente");
					location.reload();
				}
			}
		})
	}
}