function cargarTipoProceso(){
	var tipoProceso=$("#tproceso").val();

	$.ajax({
		url: "../php/class/listasDependientes.php",
		type:"POST",
		data:{sendTProceso: tipoProceso},
		success: function(data) {
			var elementosLista = data.split('|');

			$("#tipo_proceso").find('input').remove().end();
		   // $("#tipo_proceso").append('<option value="nulo">--Seleccione--</option>');

		    for (var i = 0; i < elementosLista.length -1; i++) {

		    	var elemOption = elementosLista[i].split('-');
		    	$("#tipo_proceso").append('<input type="hidden" name="tipo_proceso" value="' + elemOption[0] + '" readonly="readonly">')
		    	$("#tipo_proceso").append('<input type="text" value="' + elemOption[1] + '" readonly="readonly">')
		    	//$("#tipo_proceso").append('<option value="' + elemOption[0] + '">' + elemOption[1] + '</option>');
		    }
		}
	});
}

function cargarMeta(){
	var meta=$("#unimedida").val();

	$.ajax({
		url:"../php/class/listasDependientes.php",
		type:"POST",
		data:{sendMeta:meta},
		success: function(data){
			var elementosLista=data.split('|');

			$("#vmeta").find('option').remove().end();
			$("#vmeta").append('<option value="nulo">--Seleccione--</option>');

			for (var i = 0; i < elementosLista.length -1; i++) {
				var elemOption = elementosLista[i].split('-');
				$("#vmeta").append('<option value="' + elemOption[0] + '">' + elemOption[1] + '</option>');
			}
		}
	});
}
function cargaProceso(){
	var area=$("#area").val();

	$.ajax({
		url:"../php/class/listasDependientes.php",
		type:"POST",
		data:{sendArea: area},
		success: function(data){
			var elementosLista=data.split('|');

			$("#tproceso").find('option').remove().end();
			$("#tproceso").append('<option value="nulo">--Seleccione--</option>');

			for (var i = 0; i < elementosLista.length -1; i++) {
				var elemOption = elementosLista[i].split('-');
				$("#tproceso").append('<option value="' + elemOption[0] + '">' + elemOption[1] + '</option>');
			}
		}
	});
}

function cargaindicadores(){
	var indicadores=$("#area").val();
	document.getElementById('primero').style.display='block';
	document.getElementById('segundo').style.display='block';

	$.ajax({
		url:"../php/class/listasDependientes.php",
		type:"POST",
		data:{sendAreaForIndicadores: indicadores},
		success: function(data){
			var elementosLista=data.split('|');
			$("#valores").find('tr').remove().end();
			$("#valores").append('<thead class="thead-dark"><tr><th>N° de Indicador</th><th>Nombre del Indicador</th><th>Tipo de Indicador</th><th>Proceso que mide</th><th>Tipo de Proceso</th><th>Meta</th><th>Responsable</th><th>Calificar</th></tr></thead>');

			for (var i = 0; i < elementosLista.length -1 ; i++) {

				var wuilmer=elementosLista[i].split('-');
				$("#valores").append('<tr><td>'+wuilmer[0]+'</td><td>'+wuilmer[1]+'</td><td>'+wuilmer[2]+'</td><td>'+wuilmer[3]+'</td><td>'+wuilmer[4]+'</td><td>'+wuilmer[5]+'</td><td>'+wuilmer[6]+'</td><td><a onclick="alerta('+wuilmer[0]+')"><span class="icon-clipboard"></span></a></td></tr>');
			}
		}
	})
}

function cargarTypeProcess(){
	var type_process=$("#tproceso").val();

	$.ajax({
		url:"../php/class/listasDependientes.php",
		type:"POST",
		data:{sendTypeProcess: type_process},
		success: function(data){
			var elementosLista=data.split('-');

			$("#tipo_proceso").find('input').remove().end();
			$("#tindicador").find('input').remove().end();
			//$("#tipo_proceso").append('<option value="nulo">---Seleccione--</option>');

			for (var i = 0; i < 1; i++) {

				$("#tipo_proceso").append('<input class="form-control-wuil" type="hidden" name="tipo_proceso" value="" placeholder="'+elementosLista[0]+'" readonly="readonly">');
				$("#tipo_proceso").append('<input class="form-control-wuil" type="text" name="tipo_proceso" value="'+elementosLista[1]+'" placeholder="" readonly="readonly">');
				$("#tindicador").append('<input class="form-control-wuil" type="hidden" name="tindicador" value="" placeholder="'+elementosLista[2]+'" readonly="readonly">');
				$("#tindicador").append('<input class="form-control-wuil" type="text" name="tindicador" value="'+elementosLista[3]+'" placeholder="" readonly="readonly">');
			}
		}
	});
}
function alerta(a){
	var idIndicador=a;

	$.ajax({
		url:"../php/class/listasDependientes.php",
		type:"POST",
		data:{sendIndicador: idIndicador},
		success: function(data){

			var elementosLista=data.split('|');
			$("#indicador").find('input').remove().end();
			$("#proceso").find('input').remove().end();
			$("#tipo_proceso").find('input').remove().end();
			$("#meta_segerida").find('input').remove().end();
			
			for (var i = 0; i < elementosLista.length -1; i++) {
				var elemOption=elementosLista[i].split('-');

				$("#indicador").append('<input type="text" class="form-control-wuil" name="" readonly="readonly" value="' + elemOption[1] + '">');
				$("#indicador").append('<input type="hidden" class="form-control-wuil" name="indicador" readonly="readonly" value="' + elemOption[0] + '">');

				$("#proceso").append('<input type="text" class="form-control-wuil" name="" readonly="readonly" value="' + elemOption[3] + '">');
				$("#proceso").append('<input type="hidden" class="form-control-wuil" name="proceso" readonly="readonly" value="' + elemOption[2] + '">');

				$("#tipo_proceso").append('<input type="text" class="form-control-wuil" name="" readonly="readonly" value="' + elemOption[5] + '">');
				$("#tipo_proceso").append('<input type="hidden" class="form-control-wuil" name="tipo_proceso" readonly="readonly" value="' + elemOption[4] + '">');

				$("#meta_segerida").append('<input id="meta_c" type="text" class="form-control-wuil" readonly="readonly" name="meta" value="' + elemOption[6] + '">');
			}
		}
	});

	document.getElementById('activar_1').style.display="block";
	document.getElementById('activar_2').style.display="block";

	document.getElementById('primero').style.display='none';
	document.getElementById('segundo').style.display='none';
}
function calcularCumplimiento(){
	var ejecutado=$("#ejecutado").val();
	var meta=$("#meta_c").val();
	var d = new Date();
	var year=d.getFullYear();
	var mes=d.getMonth();
	var dia=d.getDate();
	var separacion=" --:-- ";
	var hora=d.getHours();
	var minuto=d.getMinutes();
	var fecha=year+'-'+mes+'-'+dia+''+separacion+''+hora+':'+minuto;

	meta = meta.replace(/\D/g,'');

	var cumplimiento = (ejecutado * 100)/meta;
	cumplimiento=Math.trunc(cumplimiento);
	$("#cumplimiento").find('input').remove().end();
	$("#cumplimiento").append('<input name="cumplimiento" class="form-control-wuil" type="text" readonly="readonly" value="' + cumplimiento + ' %">');
	$("#fecha").find('input').remove().end();
	$("#fecha").append('<input class="form-control-wuil" type="" value="' + fecha + '" name="fecha">');
}
function mantenerDisplay(){
	alert("dfsdfsf");
	document.getElementById('activar_1').style.display="block";
	document.getElementById('activar_2').style.display="block";
}
function pregunta(){
	if (confirm("¿Estas Seguro de Eliminar?")) {

		var eliminar="si";
		alert(""+eliminar);
	}
	else{
		var eliminar="no";
		alert(""+eliminar);
	}
	$.ajax({
		url:"classd/borradoLogico.php",
		type:"POST",
		data:{sendEliminar:eliminar},

	});
}
function validaProceso(){
	var nombreProceso=$("#nombre_proceso").val();
	$.ajax({
		url:"class/validaCampos.php",
		type:"POST",
		data:{sendNombreProceso:nombreProceso},
		success: function(data){
			var numRow=data;
			if (numRow >= 1) {
				document.getElementById('validar1').style.display="block";
				document.getElementById('validar2').style.display="none";
				document.getElementById('submit').style.display="none";

			}
			else{
				document.getElementById('validar2').style.display="block";
				document.getElementById('validar1').style.display="none";
				document.getElementById('submit').style.display="block";
			
			}
		}
	})
}

function llenaProcesos(){
	var area=$("#area").val();

	$.ajax({
		url:"../php/class/listasDependientes.php",
		type:"POST",
		data:{sendAreaProcess: area},
		success: function(data){
			var elementosLista=data.split('|');

			$("#tproceso").find('option').remove().end();
			$("#tproceso").append('<option value="nulo">--Seleccione--</option>');

			for (var i = 0; i < elementosLista.length -1; i++) {
				var elemOption = elementosLista[i].split('-');
				$("#tproceso").append('<option value="' + elemOption[0] + '">' + elemOption[1] + '</option>');
			}
		}
	});
	$.ajax({
		url:"../php/class/listasDependientes.php",
		type:"POST",
		data:{sendAreaResponsable: area},
		success: function(data){
			var responsable=data;

			$("#responsable").find('input').remove().end();
			$("#responsable").append('<input type="text" name="responsable" class="form-control-wuil" value="'+ responsable +'" readonly="readonly">');

		}
	});
}