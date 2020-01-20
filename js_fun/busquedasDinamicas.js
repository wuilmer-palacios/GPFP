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