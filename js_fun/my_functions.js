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