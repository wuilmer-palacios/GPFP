function listarProyectos(){

	var nombreProyecto=$("#nombreProyecto").val();
	$("#listar").empty();

	$.ajax({
		url:'class/busquedasDinamicas.php',
		type:'POST',
		data:{sendProyectoOrResponsable: nombreProyecto},
		success:function(data){

			$("#tabla").html(data);

		}
	})
}
function listarProyectos2(){

	var nombreProyecto=$("#nombreProyecto").val();
	$("#listar").empty();

	$.ajax({
		url:'class/busquedasDinamicas.php',
		type:'POST',
		data:{sendProyectoOrResponsable2: nombreProyecto},
		success:function(data){

			$("#tabla").html(data);

		}
	})
}

function dibujar(){
	var idPlan=$("#idPlan").val();
	var nombrePlan=$("#namePlan").val();
	var responsable=$("#responsable").val();

	$.ajax({
		url:'class/busquedasDinamicas.php',
		type:'POST',
		data:{
		sendidPlan: idPlan,
		sendnombrePlan: nombrePlan,
		sendresponsable: responsable},
		success:function(data){

			$("#tabla").html(data);
		}
	})
}

function listarResponsables(){
	var valor=$("#form-search").val();

	$.ajax({
		url:'class/busquedasDinamicas.php',
		type:'POST',
		data:{sendValueResponsable:valor},
		success:function(data){
			$("#list-responsable").html(data);
		}
	})
}