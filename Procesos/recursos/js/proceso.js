function mostrarProcesos(){
	$.post(ruta+"/procesoController/observarProcesos",function(data){
		$("#renderBody").html(data);
	})
}

function mostrarProcesosFiltrados(){
	
	$.post(ruta+"/procesoController/observarProcesos",
	{
		"fechaDesde":$("#fechaDesde").val(),
		"fechaHasta":$("#fechaHasta").val()
	},
	function(data){
		$("#renderBody").html(data);
	})
	
}

function mostrarRegistroProceso(){
	$.post(ruta+"/procesoController/mostrarRegistroProceso",function(data){
		$("#renderBody").html(data);
	})
}

function mostrarEditarProceso(id){
	$.post(ruta+"/procesoController/mostrarEditarProceso",
	{
		"id":id
	},function(data){
		$("#renderBody").html(data);
	})
}

function registrarProceso(){
	error="";
	if($("#descripcion").val()==="")
		error="La Descripción es Obligatoria!!";
	else if($("#presupuesto").val()==="")
		error="El Presupuesto es Obligatorio!!";
	else if($("#presupuesto").val()>999999999999)
		error="El Presupuesto no puede exceder los 12 Dígitos!!";
	
		if(error!="")
		{
			$('#modalErrorTexto').html(error);
			$('#modalError').modal('show');
			return false;
		}

	$.post(ruta+"/procesoController/registrarProceso",{
		"descripcion":$("#descripcion").val(),
		"sede":$("#sede").val(),
		"presupuesto":$("#presupuesto").val()
	},
	function(data){
		$("#renderBody").html(data);
	})
}

function editarProceso(id){
	error="";
	if($("#descripcion").val()==="")
		error="La Descripción es Obligatoria!!";
	else if($("#presupuesto").val()==="")
		error="El Presupuesto es Obligatorio!!";
	else if($("#presupuesto").val()>999999999999)
		error="El Presupuesto no puede exceder los 12 Dígitos!!";
	
		if(error!="")
		{
			$('#modalErrorTexto').html(error);
			$('#modalError').modal('show');
			return false;
		}

	$.post(ruta+"/procesoController/editarProceso",{
		"descripcion":$("#descripcion").val(),
		"sede":$("#sede").val(),
		"presupuesto":$("#presupuesto").val(),
		"id":id
	},
	function(data){
		$("#renderBody").html(data);
	})
}

function eliminarProceso(id){
	$.post(ruta+"/procesoController/eliminarProceso",
	{
		"id":id
	},
	function(data){
		window.location.href=ruta;
	})
}

function cerrarSesion(){
	$.post(ruta+"/usuarioController/cerrarSesion",function(data){
		window.location.href=ruta;
	})
}
