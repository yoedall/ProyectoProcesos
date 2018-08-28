$("#btnRegistroUsuario").click(function(){mostrarRegistroUsuario();});

function mostrarRegistroUsuario(){

	$.post(ruta+"/usuarioController/mostrarRegistroUsuario",function(data){
		$("#renderBody").html(data);
	})

}

function mostrarLoginUsuario(){

	window.location.href=ruta;

}

function loginUsuario(){

	error="";

	if($("#usuario").val()=="")
		error="El campo Usuario es Obligatorio!!";
	else if($("#passw").val()=="")
		error="El campo Contraseña es Obligatorio!!";
	
	if(error!="")
	{
		$('#modalErrorTexto').html(error);
		$('#modalError').modal('show');
		return false;
	}

	$.post(ruta+"/usuarioController/loginUsuario",
	{
		"usuario":$("#usuario").val(),
		"passw":$("#passw").val()
	},
	function(data){
		if(data==99)
		{
			$('#modalErrorTexto').html("Usuario y/o Contraseña Incorrectas!!");
			$('#modalError').modal('show');
		}
		else
		{
			$("#renderBody").html(data);
		}
	})
}

function registrarUsuario(){
	error="";
	if($("#nombres").val()=="")
		error="El campo Nombres es Obligatorio!!";
	else if($("#apellidos").val()=="")
		error="El campo Apellidos es Obligatorio!!";
	else if($("#usuario").val()=="")
		error="El campo Usuario es Obligatorio!!";
	else if($("#passw").val()=="")
		error="El campo Contraseña es Obligatorio!!";
	else if($("#passw2").val()=="")
		error="El campo Repetir Contraseña es Obligatorio!!";
	else if($("#passw").val()!=$("#passw2").val())
		error="Las Contraseñas no Coinciden!!";
	
	if(error!="")
	{
		$('#modalErrorTexto').html(error);
		$('#modalError').modal('show');
		return false;
	}

	$.post(ruta+"/usuarioController/registrarUsuario",
	{
		"nombres":$("#nombres").val(),
		"apellidos":$("#apellidos").val(),
		"usuario":$("#usuario").val(),
		"passw":$("#passw").val()
	},
	function(data){
		if(data==99)
			$('#modalErrorTexto').html("El Nombre de Usuario ya Existe!!");
		else
		{
			$('#modalErrorTexto').html("Registro Realizado Correctamente!!");
			limpiarCampos();
		}
			

		$('#modalError').modal('show');
		
	})

}

function limpiarCampos(){
	$('.campoRegistro').val("");
}


